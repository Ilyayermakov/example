<x-title-table>
    <h2>{{ __('Бухгалтерия') }}</h2>
    <h5>{{ __('Общий Расход: ') }}{{ totalPrice('spents', ['price']) + 0 }}</h5>
    <h5>{{ __('Общий Доход: ') }}{{ totalPriceRecord(['price'], false) - totalPriceRecord(['discount'], false) }}
    </h5>
    <h5>{{ __('Общая Прибыль: ') }}{{ totalPriceRecord(['price'], false) - totalPriceRecord(['discount'], false) - totalPrice('spents', ['price']) }}
    </h5>
</x-title-table>

<div class="mytable-main-accounting color-gold">
    <x-form class="examination" :action="route('table.accounting')" method="get">
        <h5>{{ __('Дата начала периода: ') }}
            <x-input-table class="myinput-period" type="date" name="first_date" placeholder="{{ __('Дата начала') }}" />
        </h5>
        <h5>{{ __('Дата конца периода: ') }}
            <x-input-table class="myinput-period" type="date" name="last_date"
                placeholder="{{ __('Дата оконочания') }}" />
        </h5>
        <x-button-table class="mybtn-period" type="submit">{{ __('выбрать') }}</x-button-table>
    </x-form>
    <hr>
    <div>{{ __('Выбранный период: с ') }}{{ request('first_date') }} {{ __('по ') }} {{ request('last_date') }}
    </div>
    <hr>
    <div>{{ __('Расход: ') }}{{ totalPrice('spents', ['price'], request('first_date'), request('last_date')) + 0 }}
    </div>
    <div>
        {{ __('Доход: ') }}{{ totalPriceRecordDate(['price'], false, request('first_date'), request('last_date')) - totalPriceRecordDate(['discount'], false, request('first_date'), request('last_date')) }}
    </div>
    <div>
        {{ __('Прибыль: ') }}{{ totalPriceRecordDate(['price'], false, request('first_date'), request('last_date')) - totalPriceRecordDate(['discount'], false, request('first_date'), request('last_date')) - totalPrice('spents', ['price'], request('first_date'), request('last_date')) }}
    </div>
    <hr>
</div>
    <x-table>
        <thead class="color-gold">
            <tr>
                <th>{{__('Дата')}}</th>
                <th>{{__('ФИО')}}</th>
                <th>{{__('Расход')}}</th>
                <th>{{__('Доход')}}</th>
                <th>{{__('Прибыль')}}</th>
            </tr>
        </thead>
        <tbody class="color-gold">
            @foreach ($accounting as $record)
            <tr>
                <td data-label="{{__('Дата')}}:">{{ $record->date }}</td>
                <td data-label="{{__('ФИО')}}:"><a href="{{ route('table.profile.client', $record->profile_id) }}">{{ $record->name }}</a></td>
                <td data-label="{{__('Расход')}}:">{{ $record->total_rashod }}</td>
                <td data-label="{{__('Доход')}}:">{{ $record->total_dohod }}</td>
                <td data-label="{{__('Прибыль')}}:">{{ $record->total_pribl }}</td>
            </tr>
            @endforeach
        </tbody>
    </x-table>

