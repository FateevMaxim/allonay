<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\AccountingIn;
use App\Models\City;
use App\Models\ClientTrackList;
use App\Models\Configuration;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $config = Configuration::query()->select('address', 'title_text', 'address_two', 'whats_app')->first();
        $cities = City::query()->select('title')->where('title', '!=', $request->user()->city)->get();

        return view('profile.edit', [
            'user' => $request->user(),
            'config' => $config,
            'cities' => $cities
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = User::find($request->user()->id);
        $user->city = $request->city;
        $user->save();
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function deleteClient (Request $request)
    {
        User::destroy($request['id']);
        return redirect('dashboard')->with('message', 'Клиент удалён');
    }

    public function blockClient (Request $request)
    {
        $user = User::find($request['id']);
        !$user->block ? $user->block = true : $user->block = null;
        $user->save();
        return redirect('dashboard')->with('message', 'Блокировка обновлена');
    }

    public function editClient (Request $request)
    {
        $user = User::find($request['userId']);
        $user->city = $request['editCity'];
        $user->save();
        return redirect('dashboard')->with('message', 'Город клиента изменён');
    }
    public function searchClient (Request $request)
    {
        $users = User::with(['trackLists' => function ($query) {
            $query->where('track_lists.client_accept', '=', null);
        }])
            ->where('login', 'LIKE', '%'.$request->phone.'%')->get();
        $messages = Message::all();
        $search_phrase = $request->phone;
        $config = Configuration::query()->select('address', 'rate', 'kick')->first();
        $accountingIns = AccountingIn::query()->select('id', 'created_at')->where('status', false)->orderByDesc('created_at')->get();
        return view('admin')->with(compact('users', 'messages', 'search_phrase', 'config','accountingIns'));
    }

    public function searchTrack (Request $request)
    {
        $tracks = ClientTrackList::with(['user', 'trackList'])->where('track_code', 'LIKE', '%'.$request->track_code)->get();
        $config = Configuration::query()->select('address', 'rate')->first();
        $search_track = $request->track_code;
        return view('admin-tracks')->with(compact('tracks', 'config', 'search_track'));
    }

    public function accessClient (Request $request)
    {
        $user = User::find($request['id']);
        !$user->is_active ? $user->is_active = true : $user->is_active = false;
        $user->save();
        return redirect('dashboard')->with('message', 'Доступ обновлён');
    }


    public function deleteMessage (Request $request)
    {
        Message::destroy($request['id']);
        return redirect()->back()->with('message', 'Сообщение удалено');
    }
    public function addMessage (Request $request)
    {
        $message = new Message();
        $message->message = $request['message'];
        $message->save();
        return redirect('dashboard')->with('message', 'Сообщение отправлено');
    }
}
