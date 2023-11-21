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
                            <div class="overflow-hidden">
                                <form method="POST" action="{{ route('edit-accounting-in') }}">
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
                                            <th scope="col" class="px-6 py-4">Статус</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                class="border-b bg-neutral-100">
                                                <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                    <div class="relative mb-3" data-te-input-wrapper-init>
                                                        <input
                                                            type="hidden"
                                                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                                            name="id"
                                                            value="{{ $accountingIn->id }}" />
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4">{{ $accountingIn->created_at }}</td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <div class="relative mb-3" data-te-input-wrapper-init>
                                                        <input
                                                            type="text"
                                                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                                            name="amount_usd"
                                                            value="{{ $accountingIn->amount_usd }}"
                                                            placeholder="{{ $accountingIn->amount_usd }}" />
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <div class="relative mb-3" data-te-input-wrapper-init>
                                                        <input
                                                            type="text"
                                                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                                            name="amount_kz"
                                                            value="{{ $accountingIn->amount_kz }}"
                                                            placeholder="{{ $accountingIn->amount_kz }}" disabled  />
                                                    </div>
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <div class="relative mb-3" data-te-input-wrapper-init>
                                                        <input
                                                            type="text"
                                                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                                            name="weight"
                                                            value="{{ $accountingIn->weight }}"
                                                            placeholder="{{ $accountingIn->weight }}" />
                                                    </div>
                                                    </td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <div class="relative mb-3" data-te-input-wrapper-init>
                                                        <input
                                                            type="text"
                                                            class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                                            name="note"
                                                            value="{{ $accountingIn->note }}"
                                                            placeholder="{{ $accountingIn->note }}" />
                                                    </div>
                                                    </td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <div class="relative mb-3" data-te-input-wrapper-init>
                                                        <input
                                                            type="checkbox"
                                                            name="status"
                                                            value="true"
                                                            {{ $accountingIn->status ? 'checked' : '' }}/>
                                                    </div>
                                                    </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="grid grid-cols-2 items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                        <button type="submit" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Сохранить</button>
                                        <a href="/accounting"><button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Отмена</button></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
