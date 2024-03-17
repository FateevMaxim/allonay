<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Информация профиля') }}
        </h2>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Имя')" />
            <x-text-input id="name" name="name" type="text" disabled class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="login" :value="__('Номер телефона')" />
            <x-text-input id="login" name="login" type="text" disabled class="mt-1 block w-full" :value="old('login', $user->login)" required autocomplete="login" />
            <x-input-error class="mt-2" :messages="$errors->get('login')" />
        </div>

        <div>
            <x-input-label for="city" :value="__('Пунк выдачи заказов')" />

            <select id="city" name="city" class="block mt-1 w-full border-2 border-gray-300 rounded-md" required>
                <option value="{{$user->city}}">{{$user->city}}</option>
                @foreach($cities as $city)
                    <option value="{{$city->title}}">{{$city->title}}</option>
                @endforeach
             </select>
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>
        <x-primary-button>{{ __('Сохранить') }}</x-primary-button>
    </form>
</section>
