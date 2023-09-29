@extends('layouts.main')

@section('page.title', 'Change Password')

<x-title-table>
    <x-form method="POST" action="{{ route('updatePassword') }}">
        <h5>{{__('Введите новый пароль:')}}</h5>
        <x-input type="password" name="new_password" />
        <h5>{{__('Повторите новый пароль:')}}</h5>
        <x-input type="password" name="password_confirmation" />
        <x-button type="submit">{{__('Подтвердить')}}</x-button>
    </x-form>
</x-title-table>
