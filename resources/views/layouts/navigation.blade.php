
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
                    <hr class="h-px mt-2 bg-gray-200 border-0">



                    <!-- Modal toggle -->
                    <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        Соглашение при регистрации
                    </button>

                    <!-- Main modal -->
                    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Соглашение
                                    </h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Закрыть</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 space-y-4">
                                    @yield('agreement')
                                </div>
                                <!-- Modal footer -->
                                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600"><button data-modal-hide="default-modal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">I accept</button>
                                    <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                                </div>
                            </div>
                        </div>
                    </div>

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
                    <script src="{{ asset('/js/flowbite.js') }}"></script>
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

