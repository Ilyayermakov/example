<nav class="mynavbar">
    <a href="{{ route('home') }}" class="mynav-link {{ active_link('/') }}">
        <img src="./img/logo.jpg" alt="logo">
    </a>
    <div class="mynav-drop">
        <button class="btn-nav">&#9776;</button>
        <div class="mynav-list">
            <a href="{{ route('home') }}" class="mynav-link {{ active_link('/') }}" aria-current="page">
                {{ __('Главная') }}
            </a>
            @auth
                <a href="{{ route('blog') }}" class="mynav-link {{ active_link('blog*') }}" aria-current="page">
                    {{ __('Блог') }}
                </a>
            @endauth
            @auth
                @if (auth()->user()->admin === 1)
                    <a href="{{ route('table') }}" class="mynav-link {{ active_link('table') }}" aria-current="page">
                        {{ __('Админка') }}
                    </a>
                @endif
            @endauth
            @guest
                <a href="{{ route('register') }}" class="mynav-link {{ active_link('register') }}" aria-current="page">
                    {{ __('Регистрация') }}
                </a>
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
                <a href="{{ route('change') }}" class="mynav-link {{ active_link('change') }}"
                    aria-current="page">{{ Auth::user()->name }}</a>
            @endif
            <a class="changelanguage">{{__('ru')}}</a>
            <div class="language">
                {{-- <ul> --}}
                    <a href="{{ route('locale', 'en')}}">en</a>
                    <a href="{{ route('locale', 'ru')}}">ru</a>
                    <a href="{{ route('locale', 'es')}}">es</a>
                {{-- </ul> --}}
            </div>

            <a href="https://wa.me/message/MWPCUMSLDY7FM1" target="_blank"><img class="social"
                    src="http://localhost/laravel/onecode/public/img/social/icons8-whatsapp-48.png" alt="Instagram"></a>
            <a href="https://t.me/Avenger666" target="_blank"><img class="social"
                    src="http://localhost/laravel/onecode/public/img/social/icons8-телеграмма-48.png"
                    alt="Instagram"></a>
            <a href="https://instagram.com/mastersway_?igshid=MjEwN2IyYWYwYw==" target="_blank"><img class="social"
                    src="http://localhost/laravel/onecode/public/img/social/icons8-instagram-48.png"
                    alt="Instagram"></a>
        </div>
    </div>
    <button class="current-time" id="current_date_time_block"></button>
    <div class="calendar" id="calendar"></div>
    <x-errors />
</nav>
<script>
    document.querySelector('.changelanguage').addEventListener('click', () => {
        const pricelist = document.querySelector('.language');
        pricelist.classList.toggle('active');
    });
</script>
