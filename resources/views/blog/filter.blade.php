<x-title-table>
<x-form action="{{ route('blog') }}" method="get">
    <div class="mygrid">
        <div class="mygrid-item">
            <div class="mycenter">
                <x-input name="from_date" value="{{ request('from_date') }}" placeholder="{{ __('Дата начала') }}" />
            </div>
        </div>

        <div class="mygrid-item">
            <div class="mycenter">
                <x-input name="search" value="{{ request('search') }}" placeholder="{{ __('Поиск по названию') }}" />
            </div>
        </div>

        <div class="mygrid-item">
            <div class="mycenter">
                <x-input name="to_date" value="{{ request('to_date') }}" placeholder="{{ __('Дата окончания') }}" />
            </div>
        </div>

        <div class="mygrid-item">
            <div class="mycenter">
                <x-input name="content" value="{{ request('content') }}" placeholder="{{ __('Поиск по содержанию') }}" />
            </div>
        </div>

        <div class="mygrid-item">
            <div class="mycenter">
                <x-input name="tags" value="{{ request('tags') }}" placeholder="{{ __('Один Тэг') }}" />
            </div>
        </div>

        <div class="mygrid-item">
            <div class="mycenter">
                <x-button type="submit" class="">
                    {{ __('Применить') }}
                </x-button>
            </div>
        </div>
    </div>
</x-form>
</x-title-table>
