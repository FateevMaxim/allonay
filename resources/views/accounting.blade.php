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
            @if(Route::currentRouteName() != 'dashboard')
                <div class="flex items-center justify-start mt-2 ml-6">
                    <a href="{{ route('dashboard') }}">
                        <x-classic-button class="mx-auto mb-4 w-full">
                            {{ __('Назад') }}
                        </x-classic-button>
                    </a>
                </div>
            @endif
            @if(session()->has('message'))
                <div id="alert-3" class="flex p-4 mb-4 mr-6 ml-6 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <div class="ml-3 text-sm font-medium">
                        {{ session()->get('message') }}
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
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

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mr-6 mb-4 mt-2 ml-6">

                <div class="flex flex-col">
                    <button data-modal-target="defaultModalRate" data-modal-toggle="defaultModalRate">
                        Добавить приход
                    </button>
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-left text-sm font-light">
                                    <thead
                                        class="border-b bg-white font-medium dark:border-neutral-500 dark:bg-neutral-600">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">#</th>
                                        <th scope="col" class="px-6 py-4">Дата</th>
                                        <th scope="col" class="px-6 py-4">USD</th>
                                        <th scope="col" class="px-6 py-4">Тенге</th>
                                        <th scope="col" class="px-6 py-4">Вес</th>
                                        <th scope="col" class="px-6 py-4">Заметка</th>
                                        <th scope="col" class="px-6 py-4">Выдача</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($accountingIn as $ai)
                                        <tr
                                            class="border-b bg-neutral-100">
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $ai->id }}</td>
                                            <td class="whitespace-nowrap px-6 py-4"><a href="/edit-accounting-in/{{ $ai->id }}">{{ $ai->created_at }}</a></td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $ai->amount_usd }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $ai->amount_kz }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $ai->weight }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $ai->note }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">
                                                <a href="/delivery/{{ $ai->id }}">

                                                    @if($ai->status === 0)
                                                        <button
                                                        type="button"
                                                        class="inline-block rounded bg-warning px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#e4a11b] transition duration-150 ease-in-out hover:bg-warning-600 hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:bg-warning-600 focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:outline-none focus:ring-0 active:bg-warning-700 active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(228,161,27,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)]">
                                                        Выдача
                                                        </button>
                                                    @else
                                                        <button
                                                            type="button"
                                                            class="inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                                                            Все товары выданы
                                                        </button>
                                                    @endif
                                                </a>


                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="defaultModalRate" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                <div class="relative w-3/4 max-w-md md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow">
                        <!-- Modal header -->
                        <div class="justify-between bg-[#313131] text-center p-4 border-b rounded-t ">
                            <h3 class="text-xl font-semibold text-white">
                                Добавить новый приход
                            </h3>
                        </div>
                        <form method="POST" action="{{ route('add-accounting-in') }}">
                            @csrf
                            <div class="p-6 text-center space-y-6">
                                <label for="amount_usd">USD</label>
                                <input type="text" name="amount_usd" class="rounded-t-lg w-16 px-1.5 pb-1.5 pt-2 text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="weight">Вес</label>
                                <input type="text" name="weight" class="rounded-t-lg w-16 px-1.5 pb-1.5 pt-2 text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="note">Заметка</label>
                                <input type="text" name="note" class="rounded-t-lg w-16 px-1.5 pb-1.5 pt-2 text-sm text-gray-900 bg-gray-50 border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
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
        </div>
    </div>
</x-app-layout>
