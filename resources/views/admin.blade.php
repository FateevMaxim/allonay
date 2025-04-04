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
                <button data-modal-target="defaultModalKick" data-modal-toggle="defaultModalKick" class="ml-4 mb-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Текст пинка
                </button>
            </div>

            <div id="defaultModalKick" tabindex="999" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                <div class="relative w-3/4 max-w-md md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="justify-between bg-[#313131] text-center p-4 border-b rounded-t ">
                            <h3 class="text-xl font-semibold text-white">
                                Задать текст пинка
                            </h3>
                        </div>
                        <form method="POST" action="{{ route('kick') }}">
                            @csrf
                            <!-- Modal body -->
                            <div class="p-6 text-center space-y-6">
                                <label for="kick">Текст пинка</label>
                                <input type="text" name="kick" class="rounded-t-lg w-full px-1.5 pb-1.5 pt-2 text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="{{ $config->kick }}" />
                            </div>

                            <!-- Modal footer -->
                            <div class="grid grid-cols-2 items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                <button data-modal-hide="defaultModalKick" type="submit" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Сохранить</button>
                                <button data-modal-hide="defaultModalKick" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Отмена</button>
                            </div>
                        </form>
                    </div>
                </div>
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
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mr-6 mb-4 mt-2 ml-6">
                <table class="w-full text-sm text-center text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase">
                    <tr class="border">
                        <th scope="col" class="px-6 py-3">
                            <button data-modal-target="defaultModalRate" data-modal-toggle="defaultModalRate">
                                Курс
                            </button>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Вес, кг
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Сумма тг.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Сумма +1%
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="border">

                        <th scope="row" class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">
                            <input type="text" disabled id="rate" class="rounded-t-lg w-16 px-1.5 pb-1.5 pt-2 text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                        </th>
                        <th scope="row" class="px-2 py-2 font-medium text-gray-900 whitespace-nowrap">
                            <input type="text" id="weight" class="rounded-t-lg w-16 px-1.5 pb-1.5 pt-2 text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="1" />
                        </th>
                        <td class="px-2 py-2">
                            <input type="text" disabled id="tengeSum" class="rounded-t-lg w-3/4 px-1.5 pb-1.5 pt-2 text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                        </td>
                        <td class="px-2 py-2">
                            <input type="text" disabled id="tengeSumPer" class="rounded-t-lg w-3/4 px-1.5 pb-1.5 pt-2 text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>

            <div id="defaultModalRate" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                <div class="relative w-3/4 max-w-md md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="justify-between bg-[#313131] text-center p-4 border-b rounded-t ">
                            <h3 class="text-xl font-semibold text-white">
                                Задать курс доллара
                            </h3>
                        </div>
                        <form method="POST" action="{{ route('rate') }}">
                            @csrf
                            <!-- Modal body -->
                            <div class="p-6 text-center space-y-6">
                                <label for="rate">Курс</label>
                                <input type="text" name="rate" class="rounded-t-lg w-16 px-1.5 pb-1.5 pt-2 text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                            </div>

                            <!-- Modal footer -->
                            <div class="grid grid-cols-2 items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                <button data-modal-hide="defaultModalRate" type="submit" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Сохранить</button>
                                <button data-modal-hide="defaultModalRate" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Отмена</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-2 mr-6 mb-4 mt-2 ml-6 gap-4">
                <div>
                    <form method="POST" action="{{ route('track-search') }}">
                        @csrf
                        <x-text-input id="track" class="block mt-1 w-full mb-2 border-2 border-sky-400" type="text" required="required" placeholder="Трек" name="track_code" value="" required />
                        <button type="submit" class="items-center px-4 py-3 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 bg-blue-500 hover:bg-blue-700">
                            {{ __('Найти трек') }}
                        </button>
                    </form>
                </div>
                <div>
                    <form method="POST" action="{{ route('client-search') }}">
                        @csrf
                        <x-text-input id="phone" class="block mt-1 w-full mb-2 border-2 border-sky-400" type="text" required="required" placeholder="Телефон" name="phone" value="{{ $search_phrase }}" required autofocus />
                        <button type="submit" class="items-center px-4 py-3 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150 hover:bg-[#159668] bg-[#31C48D]">
                            {{ __('Найти клиента') }}
                        </button>
                    </form>
                </div>

            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2  ml-2 mr-2 gap-2">
                @foreach($users as $user)
                    <div class="w-full bg-white border border-indigo-200 rounded-lg shadow">
                        <ul class="grid grid-cols-1 p-3 text-xl font-medium text-white border-b border-gray-200 rounded-t-lg"
                            @if($user->is_active == true && $user->block == false && $user->type != 'deleted') style="background-color: rgb(49 196 141);"
                            @elseif($user->type == 'deleted') style="background-color: rgb(28 28 28);"
                            @elseif($user->block == true) style="background-color: rgb(205 51 51);"
                            @else style="background-color: rgb(194 194 194);" @endif>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="col-span-2 ml-5">
                                    <span data-tooltip-target="tooltip-click{{$user->id}}" data-tooltip-trigger="click" class="cursor-pointer">{{$user->login}}</span>
                                    <div id="tooltip-click{{$user->id}}" role="tooltip" class="absolute left-0 z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                                        {!! $user->password !!}
                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                                </div>
                                    <div class="flex flex-row-reverse col-span-1">
                                        <li class="mr-4">

                                            <button data-modal-target="defaultModalTracks{{$user->id}}" data-modal-toggle="defaultModalTracks{{$user->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                                                </svg>
                                            </button>

                                            <!-- Main modal -->
                                            <div id="defaultModalTracks{{$user->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                                <div class="relative w-full md:w-1/2 max-w md:max-h-11/12 h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow">
                                                        <!-- Modal header -->
                                                        <div class="justify-between bg-[#313131] text-center p-4 border-b rounded-t ">
                                                            <h3 class="text-xl font-semibold text-white">
                                                                {{$user->login}}
                                                            </h3>
                                                        </div>
                                                        <div class="text-sm font-light ml-2 text-gray-500">
                                                                @php
                                                                    echo 'Всего треков: '. count($user->trackLists) .'<br />';
																	$i = 1;
                                                                 @endphp
                                                                Готово к выдаче: {{ count($user->trackLists->where('status', 'Готово к выдаче')) }}<br />
                                                                Получено на складе: {{ $user->trackLists->where('status', 'Получено на складе в Алматы')->count() }}<br />
                                                                @foreach($user->trackLists as $tracks)
                                                                    @php
                                                                        $text = '';
                                                                        $date = '';
                                                                        if($tracks->status === 'Готово к выдаче'){ $text = 'text-green-700'; $date = \Illuminate\Support\Carbon::parse($tracks->to_client)->format('Y-m-d'); }
                                                                        if($tracks->status === 'Получено на складе в Алматы'){ $text = 'text-indigo-700'; $date = \Illuminate\Support\Carbon::parse($tracks->to_almaty)->format('Y-m-d'); }
                                                                        if($tracks->status === 'Дата отправки в КЗ'){ $date = \Illuminate\Support\Carbon::parse($tracks->to_china)->format('Y-m-d'); }
                                                                        if($tracks->status === 'Товар принят'){ $date = \Illuminate\Support\Carbon::parse($tracks->client_accept)->format('Y-m-d'); }

																	    echo '<span class="'.$text.'">'.$i. '. '. $tracks->track_code. ' - '. $tracks->status. ' от '.$date.'</span><br />';

																		$i++;

                                                                    @endphp

                                                                @endforeach

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                        <li class="mr-4">

                                            <button data-modal-target="defaultModal{{$user->id}}" data-modal-toggle="defaultModal{{$user->id}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>

                                            <!-- Main modal -->
                                            <div id="defaultModal{{$user->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                                <div class="relative w-3/4 max-w-md md:h-auto">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow">
                                                        <!-- Modal header -->
                                                        <div class="justify-between bg-[#313131] text-center p-4 border-b rounded-t ">
                                                            <h3 class="text-xl font-semibold text-white">
                                                                {{$user->name}}
                                                            </h3>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="p-6 text-center space-y-6">
                                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                                Внимание!!!<br />
                                                                Удалить клиента и все его трек коды?
                                                            </p>
                                                        </div>
                                                        <form method="POST" action="{{ route('client-delete', ['id' => $user->id]) }}">
                                                            @csrf
                                                            <!-- Modal footer -->
                                                            <div class="grid grid-cols-2 items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                                                <button data-modal-hide="defaultModal{{$user->id}}" type="submit" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Да</button>
                                                                <button data-modal-hide="defaultModal{{$user->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Отмена</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="mr-4">
                                            <form method="POST" action="{{ route('client-block', ['id' => $user->id]) }}">
                                                <button type="submit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                                    </svg>
                                                </button>
                                            </form>

                                        </li>
                                        <li class="mr-4">
                                            <a href="https://api.whatsapp.com/send?phone={{Str::remove('+', $user->login)}}">
                                                <svg fill="#fff" width="24px" version="1.1" id="Icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                     viewBox="0 0 24 24" enable-background="new 0 0 18 18" xml:space="preserve">
                                                    <g id="WA_Logo">
                                                        <g>
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5,3.5C18.25,1.25,15.2,0,12,0C5.41,0,0,5.41,0,12c0,2.11,0.65,4.11,1.7,5.92
                                                                L0,24l6.33-1.55C8.08,23.41,10,24,12,24c6.59,0,12-5.41,12-12C24,8.81,22.76,5.76,20.5,3.5z M12,22c-1.78,0-3.48-0.59-5.01-1.49
                                                                l-0.36-0.22l-3.76,0.99l1-3.67l-0.24-0.38C2.64,15.65,2,13.88,2,12C2,6.52,6.52,2,12,2c2.65,0,5.2,1.05,7.08,2.93S22,9.35,22,12
                                                                C22,17.48,17.47,22,12,22z M17.5,14.45c-0.3-0.15-1.77-0.87-2.04-0.97c-0.27-0.1-0.47-0.15-0.67,0.15
                                                                c-0.2,0.3-0.77,0.97-0.95,1.17c-0.17,0.2-0.35,0.22-0.65,0.07c-0.3-0.15-1.26-0.46-2.4-1.48c-0.89-0.79-1.49-1.77-1.66-2.07
                                                                c-0.17-0.3-0.02-0.46,0.13-0.61c0.13-0.13,0.3-0.35,0.45-0.52s0.2-0.3,0.3-0.5c0.1-0.2,0.05-0.37-0.02-0.52
                                                                C9.91,9.02,9.31,7.55,9.06,6.95c-0.24-0.58-0.49-0.5-0.67-0.51C8.22,6.43,8.02,6.43,7.82,6.43S7.3,6.51,7.02,6.8
                                                                C6.75,7.1,5.98,7.83,5.98,9.3c0,1.47,1.07,2.89,1.22,3.09c0.15,0.2,2.11,3.22,5.1,4.51c0.71,0.31,1.27,0.49,1.7,0.63
                                                                c0.72,0.23,1.37,0.2,1.88,0.12c0.57-0.09,1.77-0.72,2.02-1.42c0.25-0.7,0.25-1.3,0.17-1.42C18,14.68,17.8,14.6,17.5,14.45z"/>
                                                        </g>
                                                    </g>
                                                    </svg>
                                            </a>

                                        </li>
                                    </div>
                            </div>
                        </ul>
                        <div id="defaultTabContent" class="p-4">
                            <h2 class="mb-2 text-lg font-semibold text-gray-900">{{$user->name}}</h2>
                            <ul class="max-w-md space-y-1 text-gray-500 list-inside">
                                <li class="flex items-center">
                                    <p><small>Город</small><br />
                                        <span>{{$user->city}}</span></p>
                                </li>
                                <li class="flex items-center">
                                    <p><small>Дата регистрации</small><br />
                                        <span>{{$user->created_at}}</span></p>
                                </li>
                                <li class="grid grid-cols-2 justify-center text-center gap-4 col-span-1">
                                    <form method="POST" action="{{ route('client-access', ['id' => $user->id] ) }}">
                                        <x-classic-button class="w-full">
                                            @if($user->is_active == true) {{ __('Заблокировать') }} @else {{ __('Дать доступ') }} @endif
                                        </x-classic-button>
                                    </form>
                                    <x-secondary-button data-modal-target="editModal{{$user->id}}" data-modal-toggle="editModal{{$user->id}}">
                                        Редактировать
                                    </x-secondary-button>

                                    <!-- Main modal -->
                                    <div id="editModal{{$user->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                        <div class="relative w-3/4 max-w-md md:h-auto">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow">
                                                <!-- Modal header -->
                                                <div class="justify-between bg-[#313131] text-center p-4 border-b rounded-t ">
                                                    <h3 class="text-xl font-semibold text-white">
                                                        {{$user->name}}
                                                    </h3>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-6 text-center space-y-4">
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        Внимание!!!<br />
                                                        Вы редактируете город клиента
                                                    </p>
                                                </div>
                                                <form method="POST" action="{{ route('client-edit') }}">
                                                    @csrf
                                                    <label for="editCity" class="grid w-9/12 mx-auto mb-4">
                                                        <x-input-label for="editCity" :value="__('Город')" />
                                                        <x-text-input type="text" name="editCity" value="{{$user->city}}" />
                                                    </label>

                                                    <input type="hidden" name="userId" value="{{$user->id}}" />
                                                    <!-- Modal footer -->
                                                    <div class="grid grid-cols-2 items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                                        <button data-modal-hide="editModal{{$user->id}}" type="submit" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Да</button>
                                                        <button data-modal-hide="editModal{{$user->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Отмена</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <x-secondary-button data-modal-target="new-delivery{{$user->id}}" data-modal-toggle="new-delivery{{$user->id}}">
                                        Новая выдача
                                    </x-secondary-button>

                                    <!-- Main modal -->
                                    <div id="new-delivery{{$user->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                        <div class="relative w-3/4 max-w-md md:h-auto">
                                            <!-- Modal content -->
                                            <div class="relative bg-white rounded-lg shadow">
                                                <!-- Modal header -->
                                                <div class="justify-between bg-[#313131] text-center p-4 border-b rounded-t ">
                                                    <h3 class="text-xl font-semibold text-white">
                                                        {{$user->login}}
                                                    </h3>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="p-6 text-center space-y-4">
                                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                        Добавить новую выдачу
                                                    </p>
                                                </div>
                                                <form method="POST" action="{{ route('add-delivery') }}">
                                                    @csrf
                                                    <div class="mb-4">
                                                        <select name="accounting_ins_id" class="w-9/12 border-gray-300 rounded-lg">
                                                            @foreach($accountingIns as $ai)
                                                                <option value="{{ $ai->id }}">{{ $ai->created_at }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <input type="hidden" name="user_id" value="{{$user->id}}">

                                                    <div class="mb-4">
                                                        <label for="weight" class="block text-sm font-medium text-gray-700">Вес</label>
                                                        <input type="text" name="weight" class="w-9/12 rounded-t-lg w-16 px-1.5 pb-1.5 pt-2 text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" />
                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="amount_kz" class="block text-sm font-medium text-gray-700">Тенге</label>
                                                        <input type="text" name="amount_kz" id="amount_kz" class="w-9/12 rounded-t-lg w-16 px-1.5 pb-1.5 pt-2 text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder="" />
                                                    </div>
                                                    <!-- Секция с кнопками-чекбоксами -->
                                                    <div class="mb-4 items-center gap-2">
                                                        <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300" onclick="updateAmount(30)">+30</button>
                                                        <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300" onclick="updateAmount(50)">+50</button>
                                                        <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring focus:ring-blue-300" onclick="updateAmount(100)">+100</button>
                                                    </div>

                                                    <div class="mb-4">
                                                        <label for="note" class="block text-sm font-medium text-gray-700">Заметка</label>
                                                        <input type="text" name="note" class="w-9/12 rounded-t-lg w-16 px-1.5 pb-1.5 pt-2 text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                                    </div>

                                                    <div class="mb-4 items-center">
                                                        <input type="checkbox" name="is_tracks_added" id="is_tracks_added" value="true" class="mr-2 rounded border-gray-300 text-blue-600 focus:ring-blue-500" checked />
                                                        <label for="is_tracks_added" class="text-sm font-medium text-gray-700">Все треки добавлены</label>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="grid grid-cols-2 items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                                        <button data-modal-hide="new-delivery{{$user->id}}" type="submit" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Добавить</button>
                                                        <button data-modal-hide="new-delivery{{$user->id}}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Отмена</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{ route('delivery-out-users', ['id' => $user->id] ) }}">
                                        <button
                                            type="submit"
                                            class="bg-warning block items-center px-4 py-3 border border-transparent rounded-md font-semibold text-black text-xs uppercase tracking-widest  focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition
ease-in-out duration-150 w-full">
                                            Выдать товар
                                        </button>
                                    </a>

                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function updateAmount(value) {
        // Получаем значение текущего input
        const amountField = document.getElementById('amount_kz');
        const currentValue = parseFloat(amountField.value) || 0;
        // Увеличиваем значение
        amountField.value = currentValue + value;
    }
</script>
<script type="text/javascript">
    /* прикрепить событие submit к форме */
    $("#rate").val({{$config->rate}})


    $(document).ready(function() {

        weight = $("#weight").val();
        $("#tengeSum").val(((weight * 3.9) * {{$config->rate}}).toFixed())
        $("#tengeSumPer").val(((((weight * 3.9) * {{$config->rate}})) + ((((weight * 3.9) * {{$config->rate}})))/100).toFixed())
    });

    $("#weight").keyup(function(event) {

        weight = $("#weight").val();
            $("#tengeSum").val(((weight * 3.9) * {{$config->rate}}).toFixed())
            $("#tengeSumPer").val(((((weight * 3.9) * {{$config->rate}})) + ((((weight * 3.9) * {{$config->rate}})))/100).toFixed())
    });
</script>
