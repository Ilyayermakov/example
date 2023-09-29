<x-title-table>
    <h2>{{ __('Прошлые записи') }}:
        @php
        $totalSum = 0;
    @endphp
    @foreach ($recordsF as $record)
        @php
            $totalSum += $record->price - $record->discount;
        @endphp
    @endforeach
    {{ $totalSum }}
    </h2>
    <x-form class="examination" action="{{ route('table.records') }}" method="get">
        <div class="myperiod-row">
            <x-input-table class="myinput-period" type="date" name="first_date" value="{{ request('first_date') }}"
                placeholder="{{ __('Дата начала') }}" />
            <x-input-table class="myinput-period" type="date" name="last_date" value="{{ request('last_date') }}"
                placeholder="{{ __('Дата оконочания') }}" />
            <x-input-table class="myinput-period" type="text" name="name" value="{{ request('name') }}"
                placeholder="{{ __('Имя') }}" />
            <x-input-table class="myinput-period" type="text" name="procedure" value="{{ request('procedure') }}"
                placeholder="{{ __('Процедура') }}" />
            <x-button-table class="mybtn-period" type="submit">{{ __('выбрать') }}</x-button-table>
        </div>
    </x-form>
</x-title-table>
<x-table-only>
    <thead class="vault-appointment">
        <tr>
            <th style="opacity: 0;"></th>
            <th>{{ __('Дата') }}</th>
            <th>{{ __('Время') }}</th>
            <th>{{ __('Процедура') }}</th>
            <th>{{ __('Цена') }}</th>
            <th>{{ __('Скидка') }}</th>
            <th>{{ __('Цена со скидкой') }}</th>
            <th>{{ __('ФИО') }}</th>
            <th>{{ __('Телефон') }}</th>
            <th>{{ __('email') }}</th>
            <th>{{ __('Комментарий') }}</th>
        </tr>
    </thead>
    <tbody class="vault-appointment">
        @foreach ($recordsF as $record)
            <tr>
                <td data-label="{{ __('Удалить запись') }}:">
                    <x-form :action="route('table.delete.record', $record)" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="record_id" value="{{ $record->id }}">
                        <x-button-table class="btn-delete" type="submit"
                            onclick="return confirm('{{ __('ВНИМАНИЕ Удаляем прошлую запись:') }} {{ $record->procedure }} {{ __('для') }} {{ $record->name }} {{ __('от') }} {{ $record->date }} {{ __('в') }} {{ $record->time }} ?')">
                            &#10006;
                        </x-button-table>
                    </x-form>
                </td>
                <td data-label="{{ __('Дата') }}:">{{ $record->date }}</td>
                <td data-label="{{ __('Время') }}:">{{ $record->time }}</td>
                <td data-label="{{ __('Процедура') }}:">{{ $record->procedure }}</td>
                <td data-label="{{ __('Цена') }} :">{{ $record->price }}</td>
                <td data-label="{{ __('Скидка') }} :">{{ $record->discount }}</td>
                <td data-label="{{ __('Цена со скидкой') }}:">{{ $record->price - $record->discount }}</td>
                <td data-label="{{ __('ФИО') }}:">
                    <a href="{{ route('table.profile.client', $record->profile_id) }}">{{ $record->name }}</a>
                </td>
                <td data-label="{{ __('Телефон') }}:">{{ $record->telephon }}</td>
                <td data-label="{{ __('email') }}:">{{ $record->email }}</td>
                <td data-label="{{ __('Комментарий') }}:">{{ $record->comment }}</td>
            </tr>
        @endforeach
    </tbody>
</x-table-only>
