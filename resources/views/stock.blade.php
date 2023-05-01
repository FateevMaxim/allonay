@if(isset($config->address)) @section( 'chinaaddress', $config->address ) @endif
@if(isset($config->title_text)) @section( 'title_text', $config->title_text ) @endif
@if(isset($config->address_two)) @section( 'address_two', $config->address_two ) @endif
<x-app-layout>
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                @if(session()->has('message'))
                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                        <span class="font-medium">{{ session()->get('message') }}
                    </div>
                @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 h-22 pl-6 pr-6 pb-4">

                        <div class="p-4 round_border">
                            <div class="grid">
                                <h2>Загрузка трек кодов из Excel</h2>
                            </div>
                            <form method="POST" action="{{ route('file-import') }}" enctype="multipart/form-data">
                                <div>
                                    <div>
                                        <div class="relative w-full mt-2">
                                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                            </div>
                                            <input datepicker datepicker-format="yyyy-mm-dd" name="date" required type="text" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"  placeholder="Дата приёмки">
                                        </div>
                                        <input type="file" name="file" class="block w-full mb-5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none mt-4 mb-4" id="small_size" title=" "/>
                                        <x-primary-button class="mx-auto w-9/12 pt-4">
                                            {{ __('Загрузить файл') }}
                                        </x-primary-button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="grid round_border md:mt-0 mt-4 grid-cols-1 p-4">
                            <div>
                                <h3 class="mt-0 p-4 text-2xl font-medium leading-tight text-primary">Пункт приёма China</h3>
                            </div>
                            <div class="p-4">
                                <span>Количество зарегистрированных трек кодов за сегодня</span>
                                <h3 class="mt-0 text-2xl font-medium leading-tight text-primary">{{ $count }}</h3>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/datepicker.min.js"></script>
