@if(isset($config->address)) @section( 'chinaaddress', $config->address ) @endif
@if(isset($config->title_text)) @section( 'title_text', $config->title_text ) @endif
@if(isset($config->address_two)) @section( 'address_two', $config->address_two ) @endif
<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full h-22 pl-4 pr-4 pb-4">
                <div class="grid h-full grid-cols-3 mx-auto circleBaseTwo circle2">
                    <button type="button" class="inline-flex flex-col items-center justify-center px-5">
                    </button>
                    <div class="mx-auto">
                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" type="button" class="inline-flex flex-col items-center justify-center px-5">
                            <div class="circleBase circle1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-11 h-11 block mx-auto mt-2 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                            </div>
                        </button>
                    </div>
                    @if(Auth::user()->type === 'admin')<a href="{{ route('result') }}" class="inline-flex flex-col items-center justify-center px-5">
                        <button type="button">
                            <div class="items-center">
                                <span class="text-sm text-white leading-8">Итоги</span>
                            </div>
                        </button>
                    </a>@endif
                </div>
            </div>
            <div id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                <div class="relative w-full h-full max-w-md md:h-auto">
                    <div class="relative bg-white rounded-lg shadow">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="popup-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Закрыть</span>
                        </button>
                        <div class="p-6 text-center">
                            <h4 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Добавление сообщения</h4>
                            <form method="POST" action="{{ route('message-add') }}">
                                <textarea id="message" name="message" rows="5" required="required" class="block mb-2 mx-auto w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 " placeholder="Сообщение..."></textarea>
                                <button type="submit" class="items-center px-4 py-3 bg-fuchsia-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700  focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('Отправить сообщение') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-start mt-2 ml-6">
                @if(Route::currentRouteName() != 'dashboard')

                        <a href="{{ route('dashboard') }}">
                            <x-classic-button class="mx-auto mb-4 w-full">
                                {{ __('Назад') }}
                            </x-classic-button>
                        </a>
                @endif
            </div>

            @if(session()->has('message'))
                <div id="alert-3" class="flex p-4 mb-4 mr-6 ml-6 text-green-800 rounded-lg bg-green-50" role="alert">
                    <div class="ml-3 text-sm font-medium">
                        {!! session()->get('message') !!}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8" data-dismiss-target="#alert-3" aria-label="Close">
                        <span class="sr-only">Закрыть</span>
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            @endif
            @if(session()->has('error'))
                <div id="alert-2" class="flex mr-6 ml-6 p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
                    <div class="ml-3 text-sm font-medium">
                        {{ session()->get('error') }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-2" aria-label="Close">
                        <span class="sr-only">Закрыть</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            @endif
            @if(Route::currentRouteName() === 'dashboard')
                @foreach($messages as $message)
                    <div id="alert-2" class="flex justify-between mr-6 ml-6 p-4 mb-4 text-red-800 rounded-lg bg-red-50" role="alert">
                        <div class="flex flex-row ml-3 text-sm font-medium">
                            <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                            <span class="sr-only">Info</span>
                            &nbsp;{{ $message->message }}
                        </div>
                        @if(\Illuminate\Support\Facades\Auth::user()->type === 'admin' || \Illuminate\Support\Facades\Auth::user()->type === 'moderator')
                            <form method="POST" action="{{ route('message-delete', ['id' => $message->id]) }}">
                                <button type="submit" class="ml-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-1" aria-label="Close">
                                    <span class="sr-only">Закрыть</span>
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            @endif


            <div class="grid grid-cols-1 mr-6 mb-4 mt-2 ml-6">
                <h4>Поиск трека</h4>
                <form method="POST" action="{{ route('track-search') }}">
                    @csrf
                    <x-text-input id="track" class="block mt-1 w-full mb-2 border-2 border-sky-400" type="text" required="required" placeholder="Введите запрос" name="track_code" value="{{ $search_track }}" required />
                    <button type="submit" class="items-center px-4 py-3 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700  focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" style="background-color: rgb(49 196 141)">
                        {{ __('Поиск') }}
                    </button>
                </form>
            </div>


            <div class="grid grid-cols-1 ml-5 mr-5 gap-2">
                    <table id="data-table" class="w-full border-2 text-center">
                        <thead>
                        <tr>
                            <th>Трек</th>
                            <th>Имя</th>
                            <th>Номер телефона</th>
                            <th>Статус</th>
                            <th>Китай</th>
                            <th>Алматы</th>
                            <th>Выдано</th>
                            <th>Получено</th>
                        </tr>
                        </thead>
                        <tbody>



                        @foreach($tracks as $track)
                            <tr class="bg-white border-b  hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    {{ $track->track_code }}
                                </td>
                                <td class="px-6 py-4">
                                    @if(isset($track->user)) {{ $track->user->name }} @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if(isset($track->user)) {{ $track->user->login }} @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if(isset($track->trackList)) {{ $track->trackList->status }}@endif
                                </td>
                                <td class="px-6 py-4">
                                    @if(isset($track->trackList)) {{ $track->trackList->to_china }}@endif
                                </td>
                                <td class="px-6 py-4">
                                    @if(isset($track->trackList)) {{ $track->trackList->to_almaty }}@endif
                                </td>
                                <td class="px-6 py-4">
                                    @if(isset($track->trackList)) {{ $track->trackList->to_client }}@endif
                                </td>
                                <td class="px-6 py-4">
                                    @if(isset($track->trackList)) {{ $track->trackList->client_accept }}@endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

            </div>
        </div>
    </div>
</x-app-layout>
