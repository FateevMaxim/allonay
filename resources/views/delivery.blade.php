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
                    <div class="overflow-x-auto">
                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-left text-sm font-light">
                                    <thead
                                        class="border-b bg-white font-medium dark:border-neutral-500 dark:bg-neutral-600">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">#</th>
                                        <th scope="col" class="px-6 py-4">Клиент</th>
                                        <th scope="col" class="px-6 py-4">Тенге ({{ number_format($totalAmount, 0, '.', ' ') }}) @if(isset($kaspi)) Наличка - {{ number_format($kaspi, 0, '.', ' ') }} @endif</th>
                                        <th scope="col" class="px-6 py-4">Вес</th>
                                        <th scope="col" class="px-6 py-4">Дата</th>
                                        <th scope="col" class="px-6 py-4">Заметка</th>
                                        <th scope="col" class="px-6 py-4">Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($accountingOut as $ao)
                                        <tr
                                            class="border-b bg-neutral-100">
                                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $ao->id }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $ao->user->login }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $ao->amount_kz }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $ao->weight }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ \Illuminate\Support\Carbon::parse($ao->created_at)->format('Y-m-d') }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">{{ $ao->note }}</td>
                                            <td class="whitespace-nowrap px-6 py-4">
                                                <a href="{{ route('delivery-out', ['id' => $ao->id]) }}">
                                                    @if($ao->status === 0)
                                                        <button
                                                        type="button"
                                                        class="inline-block rounded bg-warning px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#e4a11b] transition duration-150 ease-in-out hover:bg-warning-600 hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:bg-warning-600 focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] focus:outline-none focus:ring-0 active:bg-warning-700 active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.3),0_4px_18px_0_rgba(228,161,27,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(228,161,27,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(228,161,27,0.2),0_4px_18px_0_rgba(228,161,27,0.1)]">
                                                            Выдать
                                                        </button>
                                                    @else
                                                        <button
                                                            type="button"
                                                            class="inline-block rounded bg-success px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#14a44d] transition duration-150 ease-in-out hover:bg-success-600 hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:bg-success-600 focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] focus:outline-none focus:ring-0 active:bg-success-700 active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.3),0_4px_18px_0_rgba(20,164,77,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(20,164,77,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(20,164,77,0.2),0_4px_18px_0_rgba(20,164,77,0.1)]">
                                                            Товар оплачен
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


        </div>
    </div>
</x-app-layout>
