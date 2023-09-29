<x-card>
    <x-title-table>
            <a href="{{route('register')}}">
                {{__('Регистрация')}}
            </a>
            <h2>{{ __('Вход') }}</h2>

    <x-card-body>
        <x-form action="{{route('login.store')}}" method="POST">
            <x-form-item>
                <x-label required>{{__('Email')}}</x-label>
                <x-input type="email" name="email" autofocus/>
            </x-form-item>
            <x-form-item>
                <x-label required>{{ __('Пароль') }}</x-label>
                <x-input type="password" name="password" />
            </x-form-item>
            <x-form-item>
                <x-checkbox name="remeber">
                    {{ __('Запомнить меня') }}
                </x-checkbox>
            </x-form-item>
            <x-button-center type="submit">
                {{ __('Войти') }}
            </x-button-center>
            <a href="{{route('password.reset')}}">{{__('Забыли пароль')}}</a>
        </x-form>
    </x-card-body>
</x-title-table>
</x-card>
