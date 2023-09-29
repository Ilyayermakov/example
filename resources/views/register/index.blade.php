@extends('layouts.auth')

@section('page.title', 'Registration')

@section('auth.content')

    <x-card>
        <x-title-table>
            <a href="{{ route('login') }}">
                {{ __('Вход') }}
            </a>
            <h2>{{ __('Регистрация') }}</h2>

            <x-errors />

            <x-card-body>
                <x-form action="{{ route('register.store') }}" method="POST">
                    <x-form-item>
                        <x-label required>{{ __('Имя') }}</x-label>
                        <x-input name="name" autofocus />
                        <x-label required>{{ __('Email') }}</x-label>
                        <x-input type="email" name="email" />
                    </x-form-item>
                    <x-form-item>
                        <x-label required>{{ __('Пароль') }}</x-label>
                        <x-input type="password" name="password" />
                    </x-form-item>
                    <x-form-item>
                        <x-label required>{{ __('Пароль еще раз') }}</x-label>
                        <x-input type="password" name="password_confirmation" />
                    </x-form-item>
                    {{-- <x-form-item>
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.sitekey') }}"></div>
                        </div>
                    </x-form-item> --}}
                    <x-form-item>
                        <x-checkbox name="agreement" :checked="!!old('agreement')">
                            {{ __('Я согласен на обработку пользовательских данных') }}
                        </x-checkbox>
                    </x-form-item>
                    <x-button-center type="submit">
                        {{ __('Зарегистрироваться') }}
                    </x-button-center>
                </x-form>
            </x-card-body>
        </x-title-table>
    </x-card>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

@endsection
