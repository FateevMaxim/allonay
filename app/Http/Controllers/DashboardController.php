<?php

namespace App\Http\Controllers;

use App\Models\AccountingIn;
use App\Models\AccountingOut;
use App\Models\City;
use App\Models\ClientTrackList;
use App\Models\Configuration;
use App\Models\Message;
use App\Models\QrCodes;
use App\Models\TrackList;
use App\Models\User;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Telegram\Bot\Laravel\Facades\Telegram;

class DashboardController extends Controller
{

    public function welcome (){
        if (Auth::user()){
            return redirect()->route('dashboard');
        }

            $currencies = array();

        $config = Configuration::query()->select( 'whats_app', 'rate')->first();

        $currencies['USD'] = [
            'title' => 'USD',
            'buy' => $config->rate
        ];

        return view('welcome', ['config' => $config, 'currencies' => $currencies]);
    }
    public function index ()
    {
       /* $response = Telegram::getUpdates();
        $phones = array();
        $i = 1;
        foreach ($response as $res){
            if(!str_contains($res->message->text, '/')) {
                $phones[$i]['login'] = $res->message->text;
                $phones[$i]['tgID'] = $res->message->chat->id;
                }
            $i++;
        }
        foreach ($phones as $ph){
            User::query()->where('login', '+'.$ph['login'])->update(['tgID' => $ph['tgID']]);
        }*/
        $user = Auth::user();
        $config = Configuration::query()->select('address', 'title_text', 'address_two', 'whats_app', 'rate', 'kick')->first();
        //$login = mb_convert_encoding(Auth::user()->login, 'UTF-8', 'ASCII');

        //dd(mb_detect_encoding($login));
        //$config->address = str_replace('ваш номер', $login, $config->address);
        $qr = QrCodes::query()->select()->where('id', 1)->first();
        $count = 0;
        $messages = Message::all();
        $cities = City::query()->select('title')->get();

        if ($user->is_active === 1 && $user->type === null) {
            $tracks = ClientTrackList::query()
                ->leftJoin('track_lists', 'client_track_lists.track_code', '=', 'track_lists.track_code')
                ->select('client_track_lists.track_code', 'client_track_lists.detail', 'client_track_lists.created_at', 'client_track_lists.id',
                    'track_lists.to_china', 'track_lists.to_almaty', 'track_lists.to_client', 'track_lists.to_city',
                    'track_lists.city', 'track_lists.to_client_city', 'track_lists.client_accept', 'track_lists.status')
                ->where('client_track_lists.user_id', $user->id)
                ->where('client_track_lists.status', null)
                ->orderBy('client_track_lists.id')
                ->get();
            $count = count($tracks);

            return view('dashboard')->with(compact('tracks', 'count', 'messages', 'config'));
        } elseif ($user->is_active === 1) {

            if ($user->type === 'stock') {
                $count = TrackList::query()->whereDate('created_at', Carbon::today())->count();
                return view('stock')->with(compact('count', 'config', 'qr'));
            } elseif ($user->type === 'newstock') {
                $count = TrackList::query()->whereDate('created_at', Carbon::today())->count();
                return view('newstock')->with(compact('count', 'config', 'qr'));
            }  elseif ($user->type === 'almatyin') {
                $count = TrackList::query()->whereDate('to_almaty', Carbon::today())->count();
                return view('almaty', ['count' => $count, 'config' => $config, 'cityin' => 'Алматы', 'qr' => $qr]);
            } elseif ($user->type === 'almatyout') {
                $count = TrackList::query()->whereDate('to_client', Carbon::today())->count();
                return view('almatyout', ['count' => $count, 'config' => $config, 'cities' => $cities, 'cityin' => 'Алматы', 'qr' => $qr]);
            } elseif ($user->type === 'othercity') {
                $count = TrackList::query()->whereDate('to_client', Carbon::today())->count();
                return view('othercity')->with(compact('count', 'config', 'cities', 'qr'));
            } elseif ($user->type === 'admin' || $user->type === 'moderator') {
                $search_phrase = '';
                $accountingIns = [];
                $users = User::query()->select('id', 'name', 'type', 'login', 'city', 'is_active', 'block', 'password', 'created_at')->where('type', null)->where('is_active', false)->get();
                return view('admin')->with(compact('users', 'messages', 'search_phrase', 'config', 'accountingIns'));
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

    public function accountingResult()
    {

        $accountingIns = AccountingIn::sum('amount_kz');
        $accountingOuts = AccountingOut::where('status', true) // Фильтрация по статусу true
                ->sum('amount_kz');
        $withdraw = Withdraw::all();
        $withdrawSum = Withdraw::sum('amount');
        return view('accounting-result')->with(compact('accountingIns', 'accountingOuts', 'withdraw', 'withdrawSum'));
    }


    public function usersRating ()
    {
        $config = Configuration::query()->select('address', 'title_text', 'address_two', 'whats_app')->first();
        $userTracksCount = User::withCount(['clientTrackLists' => function ($query) {
            $query->join('track_lists', 'client_track_lists.track_code', '=', 'track_lists.track_code');
        }])
        ->orderByDesc('client_track_lists_count')
        ->get();


        return view('users-rating')->with(compact('userTracksCount', 'config'));
        /*foreach ($userTracksCount as $user) {
            echo "Пользователь " . $user->id . " - " . $user->client_track_lists_count . "<br>";
        }*/
    }

    public function rate ()
    {
        $config = Configuration::find(1);
        $config->rate = $_REQUEST['rate'];
        $config->save();

        return redirect()->back()->with('message', 'Курс изменён!');
    }

}
