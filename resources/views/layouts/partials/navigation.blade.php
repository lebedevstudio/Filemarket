<nav class="nav">
    <div class="container">
        <div class="nav-left">
            <a href="{{ route('home') }}" class="nav-item is-brand">
                {{ config('app.name') }}
            </a>
        </div>

        <span class="nav-toggle">
			<span></span>
			<span></span>
			<span></span>
		</span>

        <div class="nav-right nav-menu">
            @if(auth()->check())
                <a href="{{ route('logout') }}" class="nav-item"
                   onclick="event.preventDefault(); document.getElementById('logout').submit();">Выход</a>

                <a href="{{ route('account') }}" class="nav-item">Мой аккаунт</a>
            @else
                <a href="{{ route('login') }}" class="nav-item">Войти</a>

                <div class="nav-item">
                    <a href="{{ route('register') }}" class="button">Начать продажи</a>
                </div>
            @endif
        </div>
    </div>
</nav>

<form id="logout" action="{{ route('logout') }}" method="post" class="is-hidden">
    {{ csrf_field() }}
</form>