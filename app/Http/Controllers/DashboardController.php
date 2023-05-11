<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\ClientTrackList;
use App\Models\Configuration;
use App\Models\Message;
use App\Models\QrCodes;
use App\Models\TrackList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function welcome (){
        if (Auth::user()){
            return redirect()->route('dashboard');
        }

            $currencies = array();
            $url = "http://www.nationalbank.kz/rss/rates_all.xml";
            $dataObj = simplexml_load_file($url);
            if ($dataObj){
                foreach ($dataObj->channel->item as $item)
                    if ($item->title == 'USD') {
                        $currencies[] = [
                            'title' => $item->title,
                            'sell' => floatval( str_replace( ',','.', $item->description ) ),
                            'buy' => floatval( str_replace( ',','.', $item->description ) ) + (floatval( str_replace( ',','.', $item->description ) ) / 100)
                        ];
                    }
                }

        $config = Configuration::query()->select( 'whats_app')->first();
        return view('welcome', ['config' => $config, 'currencies' => $currencies]);
    }
    public function index ()
    {
        $user = Auth::user();
        $config = Configuration::query()->select('address', 'title_text', 'address_two', 'whats_app')->first();
        $qr = QrCodes::query()->select()->where('id', 1)->first();
        $count = 0;
        $messages = Message::all();
        $cities = City::query()->select('title')->get();


        $currencies = array();
        $url = "http://www.nationalbank.kz/rss/rates_all.xml";
        $dataObj = simplexml_load_file($url);
        if ($dataObj){
            foreach ($dataObj->channel->item as $item)
                if ($item->title == 'USD') {
                    $currencies['USD'] = [
                        'title' => $item->title,
                        'sell' => floatval( str_replace( ',','.', $item->description ) ),
                        'buy' => floatval( str_replace( ',','.', $item->description ) ) + (floatval( str_replace( ',','.', $item->description ) ) / 100)
                    ];
                }elseif($item->title == 'CNY'){
                    $currencies['CNY'] = [
                        'title' => $item->title,
                        'sell' => floatval( str_replace( ',','.', $item->description ) ),
                        'buy' => floatval( str_replace( ',','.', $item->description ) ) + 5.15
                    ];
                }
        }

        if ($user->is_active === 1 && $user->type === null) {
            $tracks = ClientTrackList::query()
                ->leftJoin('track_lists', 'client_track_lists.track_code', '=', 'track_lists.track_code')
                ->select('client_track_lists.track_code', 'client_track_lists.detail', 'client_track_lists.created_at', 'client_track_lists.id',
                    'track_lists.to_china', 'track_lists.to_almaty', 'track_lists.to_client', 'track_lists.to_city',
                    'track_lists.city', 'track_lists.to_client_city', 'track_lists.client_accept', 'track_lists.status')
                ->where('client_track_lists.user_id', $user->id)
                ->where('client_track_lists.status', null)
                ->orderByDesc('client_track_lists.id')
                ->get();
            $count = count($tracks);

            return view('dashboard')->with(compact('tracks', 'count', 'messages', 'config', 'currencies'));
        } elseif ($user->is_active === 1) {

            if ($user->type === 'stock') {
                $count = TrackList::query()->whereDate('created_at', Carbon::today())->count();
                return view('stock')->with(compact('count', 'config', 'qr'));
            } elseif ($user->type === 'almatyin') {
                $count = TrackList::query()->whereDate('to_almaty', Carbon::today())->count();
                return view('almaty', ['count' => $count, 'config' => $config, 'cityin' => 'Алматы', 'qr' => $qr]);
            } elseif ($user->type === 'almatyout') {
                $count = TrackList::query()->whereDate('to_client_city', Carbon::today())->count();
                return view('almatyout', ['count' => $count, 'config' => $config, 'cities' => $cities, 'cityin' => 'Алматы', 'qr' => $qr]);
            } elseif ($user->type === 'othercity') {
                $count = TrackList::query()->whereDate('to_client', Carbon::today())->count();
                return view('othercity')->with(compact('count', 'config', 'cities', 'qr'));
            } elseif ($user->type === 'admin' || $user->type === 'moderator') {
                $search_phrase = '';
                $users = User::query()->select('id', 'name', 'surname', 'type', 'login', 'city', 'is_active', 'block', 'password', 'created_at')->where('type', null)->where('is_active', false)->get();
                return view('admin')->with(compact('users', 'messages', 'search_phrase', 'config'));
            }
        }

        return view('register-me')->with(compact('config'));
    }


    public function archive ()
    {
            $tracks = ClientTrackList::query()
                ->leftJoin('track_lists', 'client_track_lists.track_code', '=', 'track_lists.track_code')
                ->select( 'client_track_lists.track_code', 'client_track_lists.detail', 'client_track_lists.created_at',
                    'track_lists.to_china','track_lists.to_almaty','track_lists.to_client','track_lists.to_city','track_lists.city','track_lists.to_client_city','track_lists.client_accept','track_lists.status')
                ->where('client_track_lists.user_id', Auth::user()->id)
                ->where('client_track_lists.status', '=', 'archive')
                ->get();
        $config = Configuration::query()->select('address', 'title_text', 'address_two', 'whats_app')->first();
            $count = count($tracks);
            return view('dashboard')->with(compact('tracks', 'count', 'config'));
    }

    public function usersList()
    {
        $config = Configuration::query()->select('address', 'title_text', 'address_two', 'whats_app')->first();
        $messages = Message::all();
        $search_phrase = '';
        $users = User::query()->select('id', 'name', 'surname', 'type', 'login', 'city', 'is_active', 'block', 'password', 'created_at', 'login_date')->where('type', null)->orderByDesc('created_at')->paginate(50);
        return view('users-list')->with(compact('users', 'messages', 'search_phrase', 'config'));
    }



}
