@extends('layouts.main')

@section('page.title', 'Password reset')

<x-title-table>
    <h5>
        {{ __('Введите Ваш email:') }}
    </h5>
    <x-form action="{{ route('password.forgot') }}" method="POST">
        <x-input type="email" name="email"></x-input>
        {{-- <x-form-item>
            <div class="form-group">
                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.sitekey') }}"></div>
            </div>
        </x-form-item> --}}
        <x-button type="submit">{{ __('Отправить') }}</x-button>
    </x-form>
</x-title-table>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
