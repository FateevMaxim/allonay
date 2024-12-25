
    <nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100">
        <!-- Primary Navigation Menu -->

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <x-navigation-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                        </a>
                    </div>
                    @if(Auth::user()->type === 'admin')
                    <!-- Navigation Links -->
                    <div class="space-x-8 flex sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('accounting')" :active="request()->routeIs('accounting')">
                            {{ __('Бухгалтерия') }}
                        </x-nav-link>
                    </div>
                    @endif
                </div>

                @if(\Illuminate\Support\Facades\Auth::user()->is_active == true)
                <!-- drawer init and toggle -->
                <div class="text-center mt-2">
                    <button class="text-gray-800 font-bold px-5 py-2.5 mr-2 mb-2" type="button" data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example" data-drawer-placement="right" aria-controls="drawer-right-example">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>

                <!-- drawer component -->
                <div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
                    <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" >
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Закрыть</span>
                    </button>
                    @if(Auth::user()->code)
                        <div class="p-2 mt-8 -mb-6">
                            <p class="mb-6 text-dark font-bold">Ваш код: <span class="text-2xl">{{ Auth::user()->code }}</span></p>
                        </div>
                    @endif

                    <div class="bg-[#b6da3a82] p-2 mt-8 mb-4">
                        <p class="mb-6 text-sm text-dark font-bold">Адрес склада в Китае</p>
                        <p class="mb-6 text-sm text-dark" id="china">@yield( 'chinaaddress' )</p>
                        <p class="mb-6 text-sm text-dark" style="display: none;" id="chinaaddress">@yield( 'chinaaddress' )</p>
                        <button onclick="copyText()" class="focus:outline-none text-white bg-[#b6da3a] hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Копировать</button>
                    </div>

                    <div class="bg-[#fab4b4] p-2 mt-4 mb-4">
                        <p><span>Образец</span></p>
                        <img src="{{asset('images/china.jpg')}}" alt="China">
                    </div>

                    <hr class="h-px mt-4 bg-gray-200 border-0">
                    @if(\Illuminate\Support\Facades\Auth::user()->type === 'othercity')
                        <a href="{{ route('track_report_page') }}"  class="grid grid-col-1 px-4 mt-6 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">Отчёт по трек кодам</a>
                    @endif
                    <hr class="h-px mt-4 bg-gray-200 border-0">

                    <div class="p-2 mt-4 mb-2">
                        <div class="grid grid-cols-1 gap-4">
                            <a href="https://t.me/+9hY9nPs0GVIzYTk6" target="_blank" class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">{{ __('Уроки по Pinduoduo') }}</a>
                        </div>
                    </div>
                    <div class="p-2 mt-4 mb-2">
                        <div class="grid grid-cols-1 gap-4">
                            <a href="https://t.me/onayall" target="_blank" class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">{{ __('Telegram') }}</a>
                        </div>
                    </div>
                    @if(isset($config->agreement))
                    <hr class="h-px mt-2 bg-gray-200 border-0">

                    <div class="mt-4">
                        <input type="checkbox" name="checkbox" value="true" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2" required />
                        <label for="checkbox" class="ml-2 text-sm text-gray-900">Принимаю условия <a data-modal-target="staticModal" data-modal-toggle="staticModal" class="font-medium cursor-pointer">Соглашения при регистрации</a></label>


                        <!-- Main modal -->
                        <div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                            <div class="relative w-full h-full max-w-2xl">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow">
                                    <!-- Modal header -->
                                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                            Условия соглашения
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-6 space-y-2">
                                        {!! $config->agreement !!}
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                        <button data-modal-hide="staticModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">Закрыть</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    {{--<div class="p-2 mt-2 mb-4">
                        <div class="grid grid-cols-1 gap-4">
                            <a href="https://t.me/allonaykzBot?start" target="_blank" class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">{{ __('Telegram Bot') }}</a>
                        </div>
                    </div>--}}

                    <hr class="h-px my-8 bg-gray-200 border-0">
                    <div class="grid grid-cols-2 mt-4 gap-4">
                        <a href="{{ route('profile.edit') }}" class="px-4 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200">{{ __('Профиль') }}</a>
                        <form method="POST" action="{{ route('logout') }}" class="flex inline-flex"><a onclick="event.preventDefault();
                          this.closest('form').submit();" class="w-full justify-center inline-flex cursor-pointer px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">{{ __('Выйти') }}</a></form>
                    </div>
                </div>
                <script>
                    function copyText() {
                        /* Copy text into clipboard */
                        var chinaaddress = $("#china").html();
                        navigator.clipboard.writeText(chinaaddress);
                    }

                </script>
                    <script>
                        let deferredPrompt = null;

                        window.addEventListener('beforeinstallprompt', function(e) {
                            // Prevent Chrome 67 and earlier from automatically showing the prompt
                            e.preventDefault();
                            // Stash the event so it can be triggered later.
                            deferredPrompt = e;
                        });

                        // Installation must be done by a user gesture! Here, the button click
                        async function install() {
                            if(deferredPrompt){
                                // Show the prompt
                                deferredPrompt.prompt();
                                // Wait for the user to respond to the prompt
                                deferredPrompt.userChoice.then(function(choiceResult){
                                        if (choiceResult.outcome === 'accepted') {
                                            console.log('Your PWA has been installed');
                                        } else {
                                            console.log('User dismissed installation');
                                        }
                                        deferredPrompt = null;
                                    });
                            }
                        }
                    </script>
                @endif
            </div>
        </div>
    </nav>

