<x-title-table>
    <h2>{{ __('Записи') }}:</h2>
    <x-form class="examination" action="{{ route('table') }}" method="get">
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
    <thead class="appointment">
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
        </tr>
    </thead>
    <tbody class="appointment">
        <x-form :action="route('table.store.records')" method="POST">
            <tr>
                <td style="opacity: 0;"></td>
                <td data-label="{{ __('Дата') }}:">
                    <x-input  type="date" name="date" value="{{ now() }}" required />
                </td>
                <td data-label="{{ __('Время') }}:">
                    <x-input  type="time" name="time" value="13:00" required />
                </td>
                <td data-label="{{ __('Процедура') }}:">
                    <select class="input-add" name="procedure_name">
                        @foreach ($procedures as $procedure)
                            <option class="input-add" value="{{ $procedure->name }}">{{ $procedure->name }} {{ $procedure->price }}
                            </option>
                        @endforeach
                    </select>
                </td>
                <td style="opacity: 0;"></td>

                <td data-label="{{ __('Скидка') }}">
                    <x-input  name="discount" value="0" />
                </td>
                <td style="opacity: 0;"></td>
                <td data-label="{{ __('ФИО') }}:">
                    <select class="input-add" name="client_name">
                        @foreach ($clients as $client)
                            <option class="input-add" value="{{ $client->name }}">{{ $client->name }} </option>
                        @endforeach
                    </select>
                </td>
                <td style="opacity: 0;"></td>
                <td>
                    <x-button-table class="btn-add" type="submit">{{ __('Добавить') }}</x-button-table>
                </td>
            </tr>
        </x-form>
        @foreach ($recordsT as $record)
            <tr>
                <td data-label="{{ __('Удалить запись') }}:">
                    <x-form :action="route('table.delete.record', $record)" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="record_id" value="{{ $record->id }}">
                        <x-button-table class="btn-delete" type="submit"
                            onclick="return confirm('{{ __('ВНИМАНИЕ Удаляем запись:') }} {{ $record->procedure }} {{ __('для') }} {{ $record->name }} {{ __('от') }} {{ $record->date }} {{ __('в') }} {{ $record->time }} ?')">
                            &#10006;
                        </x-button-table>
                    </x-form>
                </td>
                <td data-label="{{ __('Дата') }}:">{{ $record->date }}</td>
                <td data-label="{{ __('Время') }}:">{{ $record->time }}</td>
                <td data-label="{{ __('Процедура') }}:">{{ $record->procedure }}</td>
                <td data-label="{{ __('Цена') }}:">{{ $record->price }}</td>
                <td data-label="{{ __('Скидка') }}:">{{ $record->discount }}</td>
                <td data-label="{{ __('Цена со скидкой') }}:">{{ $record->price - $record->discount }}</td>
                <td data-label="{{ __('ФИО') }}:"><a
                        href="{{ route('table.profile.client', $record->profile_id) }}">{{ $record->name }}</a></td>
                <td data-label="{{ __('Телефон') }}:">{{ $record->telephon }}</td>
                <td>
                    <x-form :action="route('table.update.records', $record)" method="POST">
                        @csrf
                        <input type="hidden" name="record_id" value="{{ $record->id }}">
                        <x-button-table class="btn-add" type="submit"
                            onclick="return confirm('{{ __('Сохраняем Запись в Прошлые Записи,') }} {{ $record->name }} {{ __('уже посетил') }} {{ $record->date }} {{ __('в') }} {{ $record->time }} ')">
                            {{ __('Сохранить и удалить') }}
                        </x-button-table>
                    </x-form>
                </td>
            </tr>
        @endforeach
    </tbody>
</x-table-only>
