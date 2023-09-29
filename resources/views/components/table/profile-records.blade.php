<x-title-table>
    <h2>{{ __('Записи') }}:</h2>
</x-title-table>
<section class="mysection-profile">
    <x-table-profile>
        <thead class="appointment">
            <tr>
                <th style="opacity: 0;"></th>
                <th>{{ __('Дата') }}</th>
                <th>{{ __('Время') }}</th>
                <th>{{ __('Процедура') }}</th>
                <th>{{ __('Цена') }}</th>
                <th>{{ __('Скидка') }}</th>
                <th>{{ __('Цена со скидкой') }}</th>
            </tr>
        </thead>
        <tbody class="appointment">
            <x-form class="examination" action="{{ route('combined.storeRecordProfile', $client->id) }}" method="POST">
                @csrf
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
                                <option value="{{ $procedure->name }}">{{ $procedure->name }} {{ $procedure->price }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td style="opacity: 0;"></td>
                    <td data-label="{{ __('Скидка') }}">
                        <x-input  name="discount" value="0" />
                    </td>
                    <td style="opacity: 0;"></td>
                    <td>
                        <x-button-table class="btn-add" type="submit">{{ __('Добавить') }}</x-button-table>
                    </td>
                </tr>
            </x-form>
            @foreach ($recordT as $record)
                <tr>
                    <td>
                        <x-form :action="route('table.profile.delete.record', $record)" method="POST">
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
                    <td>
                        <x-form :action="route('table.update', $record)" method="POST">
                            @csrf
                            <input type="hidden" name="record_id" value="{{ $record->id }}">
                            <div class="downcenter">
                                <x-button-table class="btn-add" type="submit"
                                    onclick="return confirm('{{ __('Сохраняем Запись в Прошлые Записи,') }} {{ $record->name }} {{ __('уже посетил') }} {{ $record->date }} {{ __('в') }} {{ $record->time }} ')">
                                    {{ __('Сохранить и удалить') }}
                                </x-button-table>
                            </div>
                        </x-form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tbody class="vault-appointment">
            @foreach ($recordF as $record)
                <tr>
                    <td>
                        <x-form :action="route('table.profile.delete.record', $record)" method="POST">
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
                    <x-form action="{{ route('table.record.comment') }}" method="POST">
                        @csrf
                    <td data-label="{{ __('Комментарий') }}:">
                        <x-textarea name="comment" type="text" value="{{ $record->comment }}" />
                    </td>
                    <input type="hidden" name="record_id" value="{{ $record->id }}">
                    <td>
                        <x-button-table type="submit" class="btn-add">{{ __('Сохранить') }}</x-button-table>
                    </td>
                    </x-form>
                </tr>
            @endforeach
            <tr>
                <td style="opacity: 0;"></td>
                <td>{{ countRecordDate(['date'], false, $client->id) }} {{ __('Посещений(я)') }}</td>
                <td>{{ countRecord(['time'], false, $client->id) }} {{ __('Процедур(ы)') }}</td>
                <td style="opacity: 0;"></td>
                <td data-label="{{ __('Общая цена') }}:">{{ totalPriceRecord(['price'], false, $client->id) }}</td>
                <td style="opacity: 0;"></td>
                <td data-label="{{ __('Общая цена со скидкой') }}:">
                    {{ totalPriceRecord(['price'], false, $client->id) - totalPriceRecord(['discount'], false, $client->id) }}
                </td>
            </tr>
        </tbody>
    </x-table-profile>
</section>
<x-title-table>
    <h2>{{ __('Потраченный Материал') }}</h2>
</x-title-table>
<section class="mysection-profile">
    <x-table-profile>
        <thead class="vault-material">
            <tr>
                <td style="opacity: 0;"></td>
                <td>{{ __('Дата') }}</td>
                <td>{{ __('Материал') }}</td>
                <td>{{ __('Кол-во') }}</td>
                <td>{{ __('Цена') }}</td>
            </tr>
        </thead>
        <tbody class="vault-material">
            <x-form class="examination" action="{{ route('table.profile.storeSpent', $client->id) }}" method="POST">
                <tr>
                    <td style="opacity: 0;"></td>
                    <td data-label="{{ __('Дата') }}:">
                        <x-input  type="date" name="date" value="{{ now() }}"
                            required />
                    </td>
                    <td data-label="{{ __('Материал') }}:">
                        <select class="input-add" name="material_name">
                            @foreach ($materials as $material)
                                <option value="{{ $material->name }}">{{ $material->name }} - {{ $material->price }}
                                    -
                                    {{ $material->quantity }} - {{ $material->remainder }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td data-label="{{ __('Кол-во') }}:">
                        <x-input  type="number" name="quantity" step="0.001"
                            placeholder="{{ __('кол-во') }}" required />
                    </td>
                    <td style="opacity: 0;"></td>
                    <td>
                        <x-button-table class="btn-add" type="submit">{{ __('Добавить') }}</x-button-table>
                    </td>
                </tr>
            </x-form>
            @foreach ($spents as $spent)
                <tr>
                    <td>
                        <x-form :action="route('table.profile.delete.spent', $spent)" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="spent_id" value="{{ $spent->id }}">
                            <x-button-table class="btn-delete" type="submit"
                                onclick="return confirm('{{ __('ВНИМАНИЕ Удаляем запись:') }} {{ $spent->name }} {{ __('от') }} {{ $spent->date }} ?')">
                                &#10006;
                            </x-button-table>
                        </x-form>
                    </td>
                    <td data-label="{{ __('Дата') }}:">{{ $spent->date }}</td>
                    <td data-label="{{ __('Процедура') }}:">{{ $spent->name }}</td>
                    <td data-label="{{ __('Кол-во') }}:">{{ $spent->quantity }}</td>
                    <td data-label="{{ __('Цена') }}:">{{ $spent->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </x-table-profile>
