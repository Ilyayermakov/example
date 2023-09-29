<x-title-table>
    <h2>{{ __('Материалы') }}</h2>
</x-title-table>
<x-table-only>
    <thead class="material">
        <tr>
            <th>{{ __('Название') }} </th>
            <th>{{ __('Кол-во') }}</th>
            <th>{{ __('Общая Цена') }}</th>
            <th>{{ __('Цена одной шт.') }}</th>
            <th>{{ __('Дата покупки') }}</th>
            <th>{{ __('Остаток') }}</th>
            <th>{{ __('Описание') }}</th>
            <th>{{ __('Место покупки') }}</th>
        </tr>
    </thead>
    <tbody class="material">
        <tr>
            <x-form class="examination" action="{{ route('table.store.materials') }}" method="POST">
                @csrf
                <td data-label="{{ __('Название') }}:">
                    <x-textarea  type="text" name="name" placeholder="{{ __('Название') }}" required />
                </td>
                <td data-label="{{ __('Кол-во') }}:">
                    <x-input  type="number" name="quantity" placeholder="{{ __('Кол-во') }}"
                        required />
                </td>
                <td data-label="{{ __('Общая Цена') }}:">{{ totalPrice('materials', ['price', 'quantity']) }}</td>

                <td data-label="{{ __('Цена одной шт.') }}:">
                    <x-input  type="number" name="price" step="0.01"
                        placeholder="{{ __('Цена') }}" required />
                </td>
                <td data-label="{{ __('Дата покупки') }}:">
                    <x-input  name="date" type="date" value="{{ now() }}" />
                </td>
                <td data-label="{{ __('Остаток') }}:">
                    <x-input  type="number" name="remainder" step="0.001"
                        placeholder="{{ __('Остаток') }}" value="0" required />
                </td>
                <td data-label="{{ __('Описание') }}:">
                    <x-textarea  name="description" placeholder="{{ __('Описание') }}" />
                </td>
                <td data-label="{{ __('Место покупки') }}:">
                    <x-input  name="place" placeholder="{{ __('Место покупки') }}" />
                </td>
                <td>
                    <x-button-table class="btn-add" type="submit">{{ __('Добавить') }}</x-button-table>
                </td>
            </x-form>
        </tr>
        @foreach ($materials as $material)
            <tr>
                <x-form action="{{ route('different.updateMaterials', $material->id) }}" method="POST">
                    @csrf
                    <td data-label="{{ __('Название') }}:" class="jQuery_button">{{ $material->name }}
                        <x-textarea class="jQuery_appear" name="name" value="{{ $material->name }}" />
                    </td>
                    <td data-label="{{ __('Кол-во') }}:" class="jQuery_button">{{ $material->quantity }}
                        <x-input class="jQuery_appear" name="quantity" value="{{ $material->quantity }}" />
                    </td>
                    <td data-label="{{__('Цена')}}">{{ $material->price * $material->quantity }}</td>
                    <td data-label="{{ __('Цена одной шт.') }}:" class="jQuery_button">{{ $material->price }}
                        <x-input class="jQuery_appear" name="price" value="{{ $material->price }}" />
                    </td>
                    <td data-label="{{ __('Дата покупки') }}:">
                        <x-input name="date" value="{{ $material->formattedDate }}" />
                    </td>
                    <td data-label="{{ __('Остаток') }}:" class="jQuery_button">{{ $material->remainder }}
                        <x-input class="jQuery_appear" name="remainder" value="{{ $material->remainder }}" />
                    </td>
                    <td data-label="{{ __('Описание') }}:" class="jQuery_button">{{ $material->description }}
                        <x-textarea class="jQuery_appear" name="description" value="{{ $material->description }}" />
                    </td>
                    <td data-label="{{ __('Место покупки') }}:" class="jQuery_button">{{ $material->place }}
                        <x-input class="jQuery_appear" name="place" value="{{ $material->place }}" />
                    </td>
                    <input type="hidden" name="client_id" value="{{ $material->id }}">
                    <td>
                        <x-button-table type="submit" class="btn-add">{{__('Сохранить')}}</x-button-table>
                    </td>
                </x-form>
                <td data-label="{{ __('Удалить материалы') }}:">
                    <x-form :action="route('table.delete.material', $material)" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="material_id" value="{{ $material->id }}">
                        <x-button-table class="btn-delete" type="submit"
                            onclick="return confirm('{{__('ВНИМАНИЕ Удаляем эти материалы:')}} {{ $material->name }} ?')">
                            &#10006;
                        </x-button-table>
                    </x-form>
                </td>
            </tr>
        @endforeach
    </tbody>
</x-table-only>
