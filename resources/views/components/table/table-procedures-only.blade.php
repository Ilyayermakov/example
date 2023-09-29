<x-title-table>
    <h2>{{ __('Процедуры') }}</h2>
</x-title-table>
<x-table-only>
    <thead class="procedura">
        <tr>
            <th>{{ __('Название') }}</th>
            <th>{{ __('Цена') }}</th>
            <th>{{ __('Комментарий') }}</th>
        </tr>
    </thead>
    <tbody class="procedura">
        <tr>
            <x-form class="examination" action="{{ route('table.store.procedures') }}" method="POST">
                @csrf
                <td data-label="{{ __('Название') }}:">
                    <x-textarea  type="text" name="name" placeholder="{{ __('Название') }}" required />
                </td>
                <td data-label="{{ __('Цена') }}:">
                    <x-input  type="number" name="price" step="0.01"
                        placeholder="{{ __('Цена') }}" required />
                </td>
                <td data-label="{{ __('Комментарий') }}:">
                    <x-textarea  name="comment" placeholder="{{ __('комментарий') }}" />
                </td>
                <td>
                    <x-button-table class="btn-add" type="submit">{{ __('Добавить') }}</x-button-table>
                </td>
            </x-form>
        </tr>
        @foreach ($procedures as $procedure)
            <tr>
                <x-form action="{{ route('different.updateProcedures', $procedure->id) }}" method="POST">
                    @csrf
                    <td data-label="{{ __('Название') }}:">
                        <x-textarea name="name" value="{{ $procedure->name }}"/>
                    </td>
                    <td data-label="{{ __('Цена') }}:">
                        <x-input name="price" value="{{ $procedure->price }}" />
                    </td>
                    <td data-label="{{ __('Комментарий') }}:">
                        <x-textarea name="comment" value="{{ $procedure->comment }}" />
                    </td>
                    <input type="hidden" name="client_id" value="{{ $procedure->id }}">
                    <td>
                        <x-button-table type="submit" class="btn-add">{{__('Сохранить')}}</x-button-table>
                    </td>
                </x-form>
                <td data-label="{{ __('Удалить процедуру') }}:">
                    <x-form :action="route('table.delete.procedure', $procedure)" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="procedure_id" value="{{ $procedure->id }}">
                        <x-button-table class="btn-delete" type="submit"
                            onclick="return confirm('{{__('ВНИМАНИЕ Удаляем эту процедуру:')}} {{ $procedure->name }} ?')">
                            &#10006;
                        </x-button-table>
                    </x-form>
                </td>
            </tr>
        @endforeach
    </tbody>
</x-table-only>
