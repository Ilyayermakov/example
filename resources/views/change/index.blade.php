@extends('layouts.auth')

@section('page.title', $user->name)
@section('auth.content')
<x-card>
    <x-title-table>
        <x-card-body>
            <div class="mychange">
                <form method="POST" action="{{ route('change-update') }}" enctype="multipart/form-data">
                    @csrf
                    <hr>
                    <h3>{{ __('Имя: ') }} <br> {{ $user->name }}</h3>
                    <x-input type="text" name="name" />
                    <hr>
                    <h3>{{ __('Email(логин): ') }} <br> {{ $user->email }}</h3>
                    <x-input type="email" name="email" />
                    <hr>
                    <h3>{{ __('Аватар') }}</h3>
                    <hr>
                    @if ($user->avatar && file_exists(public_path('img/avatars/' . $user->avatar)))
                        <img src="{{ asset('/img/avatars/' . $user->avatar) }}" width="50" height="50">
                    @endif
                    <br></br>
                    <x-input type="file" name="avatar" />
                    <hr>
                    <h3>{{ __('Старый пароль: ') }}</h3>
                    <x-input type="password" name="password" />
                    <h3>{{ __('Новый пароль: ') }}</h3>
                    <x-input type="password" name="new_password" />
                    <h3>{{ __('Новый пароль повторно: ') }}</h3>
                    <x-input type="password" name="password_confirmation" />
                    <hr>
                    <x-button-center type="submit">{{ __('Сохранить') }}</x-button-center>
                </form>
            </div>
        </x-card-body>
    </x-title-table>
</x-card>
@endsection
