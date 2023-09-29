<x-title-table>
    <h2>{{ __('Клиенты: ') }} {{ $clients->count() }}</h2>


    <x-form class="examination" action="{{ route('table.clients') }}" method="get">
        <div class="myperiod-row">
            <x-input-table class="myinput-period" type="text" name="name" value="{{ request('name') }}"
                placeholder="{{ __('Имя') }}" />
            <x-input-table class="myinput-period" type="text" name="telephon" value="{{ request('telephon') }}"
                placeholder="{{ __('Телефон') }}" />
            <x-button-table class="mybtn-period" type="submit">{{ __('выбрать') }}</x-button-table>
        </div>
    </x-form>
</x-title-table>
<x-table-only>
    <thead class="client">
        <tr>
            <th>{{ __('Профиль') }}</th>
            <th>{{ __('ФИО') }}</th>
            <th>{{ __('Телефон') }}</th>
            <th>{{ __('email') }}</th>
            <th>{{ __('Комментарий') }}</th>
            <th>{{ __('Откуда узнал') }}</th>
            <th>{{ __('Кол-во приведенных') }}</th>
        </tr>
    </thead>
    <tbody class="client">
        <tr>
            <x-form class="examination" action="{{ route('table.store.clients') }}" method="POST">
                @csrf
                <td style="opacity: 0;"></td>
                <td data-label="{{ __('ФИО') }}:">
                    <x-input type="text" name="name" placeholder="{{ __('ФИО') }}" required />
                </td>
                <td data-label="{{ __('Телефон') }}:">
                    <x-input type="text" name="telephon" placeholder="{{ __('Телефон') }}" />
                </td>
                <td data-label="{{ __('email') }}:">
                    <x-textarea type="email" name="email" placeholder="{{ __('email') }}" />
                </td>
                <td data-label="{{ __('Комментарий') }}:">
                    <x-textarea type='text' name="comment" placeholder="{{ __('comment') }}" />
                </td>
                <td data-label="{{ __('Откуда узнал') }}:">
                    <x-input type='text' name="camefrom" placeholder="{{ __('Откуда узнал') }}" />
                </td>
                <td data-label="{{ __('Кол-во приведенных') }}:">
                    <x-input type='number' name="brought" placeholder="{{ __('Кол-во') }}" />
                </td>
                <td>
                    <x-button-table class="btn-add" type="submit">{{ __('Добавить') }}</x-button-table>
                </td>
            </x-form>
        </tr>
        @foreach ($clients as $client)
            <tr>
                <td data-label="{{ __('Профиль') }}:">
                    <a
                        href="{{ route('table.profile.client', $client->id) }}">{{ __('Перейти ') }}({{ $client->id }})</a>
                </td>
                <x-form action="{{ route('different.updateClient', $client->id) }}" method="POST">
                    @csrf
                    <td data-label="{{ __('ФИО') }}:" class="jQuery_button">{{ $client->name }}
                        <x-input class="jQuery_appear" name="name" value="{{ $client->name }}" />
                    </td>
                    <td data-label="{{ __('Телефон') }}:" class="jQuery_button">{{ $client->telephon }}
                        <x-input class="jQuery_appear" name="telephon"
                            value="{{ old('telephon', $client->telephon) }}" />
                    </td>
                    <td data-label="{{ __('email') }}:" class="jQuery_button">{{ $client->email }}
                        <x-textarea class="jQuery_appear" name="email" value="{{ $client->email }}" />
                    </td>
                    <td data-label="{{ __('Комментарий') }}:" class="jQuery_button">{{ $client->comment }}
                        <x-textarea class="jQuery_appear" name="comment" value="{{ $client->comment }}" />
                    </td>
                    <td data-label="{{ __('Откуда узнал') }}:" class="jQuery_button">{{ $client->camefrom }}
                        <x-input class="jQuery_appear" name="camefrom" value="{{ $client->camefrom }}" />
                    </td>
                    <td data-label="{{ __('Кол-во приведенных') }}:" class="jQuery_button">{{ $client->brought }}
                        <x-input class="jQuery_appear" name="brought" type="number" value="{{ $client->brought }}" />
                    </td>
                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                    <td>
                        <x-button-table type="submit" class="btn-add">{{ __('Сохранить') }}</x-button-table>
                    </td>
                </x-form>
                <td data-label="{{ __('Удалить клиента') }}:">
                    <x-form :action="route('table.delete.client', $client)" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                        <x-button-table class="btn-delete" type="submit"
                            onclick="return confirm('{{__('ВНИМАНИЕ Удаляем эту запись и профиль клиента:')}} {{ $client->name }} ?')">
                            &#10006;
                        </x-button-table>
                    </x-form>
                </td>
            </tr>
        @endforeach
    </tbody>
</x-table-only>
