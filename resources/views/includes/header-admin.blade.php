<nav class="mynavbar">
    <a href="{{ route('home') }}" class="mynav-link {{ active_link('/') }}">
        <img src="http://localhost/laravel/onecode/public/img/logo.jpg" alt="logo">
    </a>
    <div class="mynav-drop">
        <button class="btn-nav">&#9776;</button>
        <div class="mynav-list">
            <a href="{{ route('table') }}" class="mynav-link {{ active_link('table') }}" aria-current="page">
                {{ __('Записи') }}
            </a>
            <a href="{{ route('table.records') }}" class="mynav-link {{ active_link('table.records') }}"
                aria-current="page">
                {{ __('Пр.Записи') }}
            </a>
            <a href="{{ route('table.clients') }}" class="mynav-link {{ active_link('table.clients') }}"
                aria-current="page">
                {{ __('Клиенты') }}
            </a>
            <a href="{{ route('table.accounting') }}" class="mynav-link {{ active_link('table.accounting') }}"
                aria-current="page">
                {{ __('Бухгалтерия') }}
            </a>
            <a href="{{ route('table.materials') }}" class="mynav-link {{ active_link('table.materials') }}"
                aria-current="page">
                {{ __('Материалы') }}
            </a>
            <a href="{{ route('table.procedures') }}" class="mynav-link {{ active_link('table.procedures') }}"
                aria-current="page">
                {{ __('Процедуры') }}
            </a>
            @guest
                <a href="{{ route('login') }}" class="mynav-link {{ active_link('login') }}" aria-current="page">
                    {{ __('Вход') }}
                </a>
            @endguest
            @auth
                <x-form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <x-button-table class="mynav-link" type="submit"><a>{{ __('Выйти') }}</a></x-button-table>
                </x-form>
            @endauth
            @if (Auth::check())
                <a href="{{ route('change.admin') }}" class="mynav-link {{ active_link('change.admin') }}"
                    aria-current="page">{{ Auth::user()->name }}</a>
            @endif
        </div>
    </div>
    <button class="current-time" id="current_date_time_block"></button>
    <div class="calendar" id="calendar"></div>
    <button class="calculate-infin">&infin;</button>
    <div class="calculator-container"></div>
    <x-errors />
</nav>
