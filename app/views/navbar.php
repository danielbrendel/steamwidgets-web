<nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item navbar-item-brand is-font-title" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}"/>&nbsp;{{ env('APP_NAME') }}
        </a>

        <a id="burger-button" role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item" href="{{ url('/documentation') }}">
                Documentation
            </a>

            <a class="navbar-item" href="{{ url('/documentation#steam-app') }}" onclick="document.getElementById('burger-button').click(); document.querySelector('[name=steam-app]').scrollIntoView({behavior: 'smooth'}); return false;">
                Steam App
            </a>

            <a class="navbar-item" href="{{ url('/documentation#steam-server') }}" onclick="document.getElementById('burger-button').click(); document.querySelector('[name=steam-server]').scrollIntoView({behavior: 'smooth'}); return false;">
                Steam Server
            </a>

            <a class="navbar-item" href="{{ url('/documentation#steam-user') }}" onclick="document.getElementById('burger-button').click(); document.querySelector('[name=steam-user]').scrollIntoView({behavior: 'smooth'}); return false;">
                Steam User
            </a>

            <a class="navbar-item" href="{{ url('/documentation#steam-workshop') }}" onclick="document.getElementById('burger-button').click(); document.querySelector('[name=steam-workshop]').scrollIntoView({behavior: 'smooth'}); return false;">
                Steam Workshop
            </a>

            <a class="navbar-item" href="{{ url('/documentation#steam-group') }}" onclick="document.getElementById('burger-button').click(); document.querySelector('[name=steam-group]').scrollIntoView({behavior: 'smooth'}); return false;">
                Steam Group
            </a>
        </div>

        <div class="navbar-end">
            @if (env('APP_REPOSITORY'))
            <div class="navbar-item">
                <img src="https://img.shields.io/github/stars/{{ env('APP_REPOSITORY') }}?style=flat"/>
            </div>
            @endif

            @if (env('APP_REPOSITORY'))
            <div class="navbar-item">
                <img src="https://img.shields.io/github/forks/{{ env('APP_REPOSITORY') }}?style=flat"/>
            </div>
            @endif

            @if (env('APP_NPMPACKAGENAME'))
            <div class="navbar-item">
                <img src="https://img.shields.io/npm/dt/{{ env('APP_NPMPACKAGENAME') }}?style=flat"/>
            </div>
            @endif
        </div>
    </div>
</nav>