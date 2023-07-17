<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\TracksImport;
use App\Models\ClientTrackList;
use App\Models\Configuration;
use App\Models\TrackList;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Telegram\Bot\Laravel\Facades\Telegram;

class ProductController extends Controller
{
    public function addChina(Request $request)
    {

        $array =  preg_split("/\s+/", $request["track_codes"]);
        $wordsFromFile = [];
        foreach ($array as $ar){
            $wordsFromFile[] = [
                'track_code' => $ar,
                'to_china' => date(now()),
                'status' => 'Получено в Китае',
                'reg_china' => 1,
                'created_at' => date(now()),
            ];
        }

        /*foreach ($wordsFromFile as $item) {
            $user = ClientTrackList::query()->select('user_id')->where('track_code', $item['track_code'])->first();
            if ($user){
                $messageTracks = '';
                $userTracks = ClientTrackList::where('user_id', $user->user->id)->pluck('track_code')->toArray();
                dd($userTracks);
                Telegram::sendMessage(['chat_id' => $user->user->tgID, 'text' => 'Статус трека(-ов) - '.$messageTracks.' изменился на Получено в Китае']);
                TrackList::where('id', $user->user->id)->update(['notification', true]);
            }
        }*/



        TrackList::insertOrIgnore($wordsFromFile);
        return response('success');

    }

    public function almatyIn(Request $request)
    {

        $array =  preg_split("/\s+/", $request["track_codes"]);
        $wordsFromFile = [];
        $city = null;
        if (Auth::user()->type === 'aktobein'){
            $city_field = 'to_city';
            $city_value = 'Получено на складе в Актобе';
            $city = 'Актобе';
            $reg_field = 'reg_city';
        }elseif (Auth::user()->type === 'almatyin'){
            $city_field = 'to_almaty';
            $city_value = 'Получено на складе в Алматы';
            $reg_field = 'reg_almaty';
        }elseif (Auth::user()->type === 'zheskazganin'){
            $city_field = 'to_city';
            $city_value = 'Получено на складе в Жезказгане';
            $city = 'Жезказган';
            $reg_field = 'reg_city';
        }elseif (Auth::user()->type === 'shimkentin'){
            $city_field = 'to_city';
            $city_value = 'Получено на складе в Шымкенте';
            $city = 'Шымкент';
            $reg_field = 'reg_city';
        }elseif (Auth::user()->type === 'astanain'){
            $city_field = 'to_city';
            $city_value = 'Получено на складе в Астане';
            $city = 'Астана';
            $reg_field = 'reg_city';
        }elseif (Auth::user()->type === 'kokshetauin'){
            $city_field = 'to_city';
            $city_value = 'Получено на складе в Кокшетау';
            $city = 'Кокшетау';
            $reg_field = 'reg_city';
        }elseif (Auth::user()->type === 'uralskin'){
            $city_field = 'to_city';
            $city_value = 'Получено на складе в Уральске';
            $city = 'Уральск';
            $reg_field = 'reg_city';
        }elseif (Auth::user()->type === 'petropavlovskin') {
            $city_field = 'to_city';
            $city_value = 'Получено на складе в Петропавловске';
            $city = 'Петропавловск';
            $reg_field = 'reg_city';
        }elseif (Auth::user()->type === 'atyrauin'){
            $city_field = 'to_city';
            $city_value = 'Получено на складе в Атырау';
            $city = 'Атырау';
            $reg_field = 'reg_city';
        }else{
            $city_field = 'to_city';
            $city_value = 'Получено на складе в Талдыкоргане';
            $city = 'Талдыкорган';
            $reg_field = 'reg_city';
        }

        foreach ($array as $ar){
            $wordsFromFile[] = [
                'track_code' => $ar,
                $city_field => date(now()),
                'status' => $city_value,
                $reg_field => 1,
                'city' => $city,
                'updated_at' => date(now()),
            ];

           /* $user = ClientTrackList::query()->select('user_id')->where('track_code', $ar)->first();
            if ($user){
                Telegram::sendMessage(['chat_id' => $user->user->tgID, 'text' => 'Статус Вашего трек-кода изменился на '.$city_value]);
            }
*/
        }
        TrackList::upsert($wordsFromFile, ['track_code', $city_field, 'status', $reg_field, 'updated_at']);

        return redirect()->back()->with('message', 'Трек коды успешно добавлены');

    }

    public  function acceptProduct (Request $request)
    {
        $track_lists = TrackList::query()->where('track_code', $request->track_code)->first();
        $track_lists->status = 'Товар принят';
        $track_lists->client_accept = date(now());
        $track_lists->save();

        $client_track_lists = ClientTrackList::query()->where('track_code', $request->track_code)->first();
        $client_track_lists->status = 'archive';
        $client_track_lists->save();
        return redirect()->back()->with('message', 'Товар успешно доставлен!');
    }

    public function almatyOut(Request $request)
    {
        $status = "Выдано клиенту";
        if ($request["send"] === 'true'){
            $status = "Отправлено в Ваш город";
        }
        $array =  preg_split("/\s+/", $request["track_codes"]);
        $client_field = 'to_client';
        $wordsFromFile = [];
        foreach ($array as $ar){
            $wordsFromFile[] = [
                'track_code' => $ar,
                $client_field => date(now()),
                'status' => $status,
                'reg_client' => 1,
                'updated_at' => date(now()),
            ];
            $user = ClientTrackList::query()->select('user_id')->where('track_code', $ar)->first();
            if ($user){
                Telegram::sendMessage(['chat_id' => $user->user->tgID, 'text' => 'Статус Вашего трек-кода изменился на '.$status]);
            }
        }

        TrackList::upsert($wordsFromFile, ['track_code', $client_field, 'status', 'reg_client', 'updated_at']);
        return response('success');
    }
    public function almatyOutAll()
    {
        $tracks = TrackList::query()->select('track_code')->where('to_almaty', '!=', NULL)
            ->where('to_client', NULL)->get();
        ClientTrackList::whereIn('track_code', $tracks)
            ->update(['status' => 'Готово к выдаче', 'updated_at' => date(now())]);
        TrackList::where('to_almaty', '!=', NULL)
            ->where('to_client', NULL)
            ->update(['to_client' => date(now()), 'status' => 'Выдано клиенту']);

        return response('success');
    }
    public function getInfoProduct(Request $request)
    {

        $track_code = ClientTrackList::query()->select('user_id')->where('track_code', $request['track_code'])->first();
        $track_code_statuses =  TrackList::query()->select('to_china', 'to_almaty', 'city', 'to_client', 'client_accept', 'to_city', 'to_client_city',)
            ->where('track_code', $request['track_code'])->first();
        if ($track_code){
            $user_data = User::query()->select('name', 'surname', 'login', 'city', 'block')->where('id', $track_code->user_id)->first();
        }else{
            $user_data = [
                'name' => 'нет',
                'surname' => 'нет',
                'login' => 'нет',
                'block' => 'нет',
                'city' => 'нет',
            ];
        }

        return response([$track_code_statuses, $user_data]);

    }


    public function addClient(Request $request)
    {

        if (Str::length($request["track_code"]) > 100){
            return redirect()->back()->with('error', 'Неверный трек, пожалуйста, перепроверьте');
        }

        $issetTrack = ClientTrackList::query()->where('track_code', $request["track_code"])->exists();
        if ($issetTrack){
            return redirect()->back()->with('error', 'Трек код уже добавлен');
        }
        $track_list = new ClientTrackList();
        $track_list->track_code = $request["track_code"];
        $track_list->detail = $request["detail"];
        $track_list->user_id = Auth::user()->id;
        $track_list->save();

        return redirect()->back()->with('message', 'Трек код успешно добавлен');
    }

    public function deleteTrack (Request $request)
    {
        $validated = $request->validate([
            'delete_track' => 'required|string|max:100',
        ]);

        if ($validated){
            $archive = ClientTrackList::query()->select('id')->where('track_code', $request['delete_track'])->first();
            ClientTrackList::destroy($archive->id);
            return redirect()->back()->with('message', 'Трек код успешно удалён');
        }

    }

    public function archiveProduct (Request $request)
    {
        $validated = $request->validate([
            'archive_track' => 'required|string|max:100',
        ]);

        if ($validated){
            $archive = ClientTrackList::query()->where('track_code', $request['archive_track'])->first();
            $archive->status = 'archive';
            $archive->save();
            return redirect()->back()->with('message', 'Трек код успешно добавлен в архив');
        }

    }

    public function unArchiveProduct (Request $request)
    {
        $validated = $request->validate([
            'archive_track' => 'required|string|max:100',
        ]);

        if ($validated){
            $archive = ClientTrackList::query()->where('track_code', $request['archive_track'])->first();
            $archive->status = null;
            $archive->save();
            return redirect()->back()->with('message', 'Трек код успешно извлечён из архива');
        }

    }

    public function fileImport(Request $request)
    {
        Excel::import(new TracksImport($request['date']), $request->file('file')->store('temp'));
        return back();
    }

    public function fileExport(Request $request)
    {
        return Excel::download(new UsersExport($request['date'], $request['city']), 'users.xlsx');;
    }
    public function result ()
    {

        $chinaTracks = TrackList::select('id', 'to_china', DB::raw("DATE_FORMAT(to_china, '%m') as month_name"))
            ->whereYear('to_china', date('Y'))
            ->groupBy('to_china')
            ->pluck('id', 'month_name');

        $almatyTracks = TrackList::select('id', 'to_almaty', DB::raw("DATE_FORMAT(to_almaty, '%m') as month_name"))
            ->whereYear('to_almaty', date('Y'))
            ->groupBy('to_almaty')
            ->pluck('id', 'month_name');
        $clientTracks = TrackList::select('id', 'to_client', DB::raw("DATE_FORMAT(to_client, '%m') as month_name"))
            ->whereYear('to_client', date('Y'))
            ->groupBy('to_client')
            ->pluck('id', 'month_name');

        $datesTracks = ($chinaTracks)->merge($almatyTracks)->merge($clientTracks)->sortKeys();

        $datesTracks = $datesTracks->toArray();
        $labels = array_keys($datesTracks);

        $data = [];
        $data2 = [];
        $data3 = [];

        foreach ($labels as $dateT) {
            $data[] = TrackList::query()->where('to_china', 'LIKE', '%-'.$dateT.'-%')->count();
            $data2[] = TrackList::query()->where('to_almaty', 'LIKE', '%-'.$dateT.'-%')->count();
            $data3[] = TrackList::query()->where('to_client', 'LIKE', '%-'.$dateT.'-%')->count();
        }

        $arr = [
            '01' => 'Янв.',
            '02' => 'Фев.',
            '03' => 'Март',
            '04' => 'Апр.',
            '05' => 'Май',
            '06' => 'Июнь',
            '07' => 'Июль',
            '08' => 'Авг.',
            '09' => 'Сен.',
            '10.' => 'Окт.',
            '11.' => 'Ноя.',
            '12' => 'Дек.'
        ];
        $labels = array_map(function($v) use($arr) {
            return $arr[$v] ?? $v;
        }, $labels);

        $data = collect($data);
        $data2 = collect($data2);
        $data3 = collect($data3);

        $now = Carbon::now()->format('Y-m-d');
        $targetDay = Carbon::now()->subDays(9)->format('Y-m-d');

        while ($now > $targetDay) {
            $labelsDays[] = Carbon::parse($now)->format('Y-m-d');
            $now = Carbon::parse($now)->sub(1, 'day');
        }

        $dataDays = [];
        $dataDays2 = [];
        $dataDays3 = [];
        $i = 0;
        $monthes = array(
            1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
            5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
            9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря'
        );
        $days = array(
            'Воскресенье', 'Понедельник', 'Вторник', 'Среда',
            'Четверг', 'Пятница', 'Суббота'
        );
        foreach ($labelsDays as $date) {

            $dataDays[$i] = TrackList::query()->where('to_china', 'LIKE', $date . '%')->count();
            $dataDays2[$i] = TrackList::query()->where('to_almaty', 'LIKE', $date . '%')->count();
            $dataDays3[$i] = TrackList::query()->where('to_client', 'LIKE', $date . '%')->count();


            $labelsDays[$i] = date('j', strtotime($date)).' '.$monthes[(date('n', strtotime($date)))]. " \r\n".$days[(date('w', strtotime($date)))];
            $i++;

        }

        $dataDays = collect($dataDays);
        $dataDays2 = collect($dataDays2);
        $dataDays3 = collect($dataDays3);

        $clients = User::query()->where('type', null)->count();
        $clients_today = User::query()->where('type', null)->whereDate('created_at',  Carbon::today())->count();
        $clients_false = User::query()->where('type', null)->where('is_active', false)->count();
        $clients_true = User::query()->where('type', null)->where('is_active', true)->count();
        $clients_auth = User::query()->where('type', null)->whereDate('login_date', Carbon::today())->count();

        $tracks_today = ClientTrackList::query()->whereDate('created_at', Carbon::today())->count();
        $tracks_month = ClientTrackList::query()->where('created_at', 'LIKE', Carbon::now()->format('Y-m').'%')->count();
        $tracks_total = ClientTrackList::query()->count();
        $config = Configuration::query()->select('address', 'title_text')->first();
        return view('result', compact('labels', 'data', 'data2', 'data3', 'clients', 'clients_today',
            'clients_false', 'clients_true', 'clients_auth', 'tracks_today', 'tracks_month', 'tracks_total', 'labelsDays',
            'dataDays', 'dataDays2', 'dataDays3', 'config'));
    }
}
