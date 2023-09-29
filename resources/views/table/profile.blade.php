@extends('layouts.auth-admin')

@section('page.title', 'Profile')

<x-errors />

<x-title-table>
    <x-form action="{{ route('combined.updateClientProfile', $client->id) }}" method="POST">
        @csrf
        <h5 class="jQuery_button">{{ __('ФИО') }}: {{ $client->name }}
            <x-input class="jQuery_appear" name="name" value="{{ $client->name }}" />
        </h5>
        <h5 class="jQuery_button">{{ __('Телефон') }}: {{ $client->telephon }}
            <x-input class="jQuery_appear" name="telephon" value="{{ $client->telephon }}" />
        </h5>
        <h5 class="jQuery_button">{{ __('Email') }}: {{ $client->email }}
            <x-input class="jQuery_appear" name="email" value="{{ $client->email }}" />
        </h5>
        <h5 class="jQuery_button">{{ __('Откуда узнал') }}: {{ $client->camefrom }}
            <x-input class="jQuery_appear" name="camefrom" value="{{ $client->camefrom }}" />
        </h5>
        <h5 class="jQuery_button">{{ __('Кол-во приведенных') }}: {{ $client->brought }}
            <x-input class="jQuery_appear" name="brought" value="{{ $client->brought }}" />
        </h5>
        <h5 class="jQuery_button">{{ __('Комментарий') }}: {{ $client->comment }}
            <x-textarea class="jQuery_appear" name="comment" value="{{ $client->comment }}" />
        </h5>
        <hr>
        <h5>
            <x-button-table type="submit" class="btn-add">{{__('Сохранить')}}</x-button-table>
        </h5>
        <hr>
    </x-form>
    <h5>{{ __('Расход: ') }}{{ totalPriceProfileId('spents', ['price'], $client->id) }}</h5>
    <h5>{{ __('Доход: ') }}{{ totalPriceRecord(['price'], false, $client->id) - totalPriceRecord(['discount'], false, $client->id) }}
    </h5>
    <h5>{{ __('Прибыль: ') }}{{ totalPriceRecord(['price'], false, $client->id) - totalPriceRecord(['discount'], false, $client->id) - totalPriceProfileId('spents', ['price'], $client->id) }}
    </h5>
</x-title-table>
<x-table.profile-records :recordT="$recordT" :recordF="$recordF" :procedures="$procedures" :client="$client" :materials="$materials"
    :spents="$spents"></x-table.profile-records>
