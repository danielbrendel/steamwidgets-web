<nav class="navbar is-light is-fixed-top" role="navigation" aria-label="main navigation">
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
            <a class="navbar-item" href="{{ url('/#about') }}" onclick="document.getElementById('burger-button').click(); return true;">
                About
            </a>

            <a class="navbar-item" href="{{ url('/#steam-app') }}" onclick="document.getElementById('burger-button').click(); return true;">
                Steam App
            </a>

            <a class="navbar-item" href="{{ url('/#steam-server') }}" onclick="document.getElementById('burger-button').click(); return true;">
                Steam Server
            </a>

            <a class="navbar-item" href="{{ url('/#steam-user') }}" onclick="document.getElementById('burger-button').click(); return true;">
                Steam User
            </a>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <img src="https://img.shields.io/github/forks/{{ env('APP_PACKAGE') }}?style=social"/>
            </div>

            <div class="navbar-item">
                <img src="https://img.shields.io/github/issues/{{ env('APP_PACKAGE') }}?style=social"/>
            </div>

            <div class="navbar-item">
                <img src="https://img.shields.io/github/downloads/{{ env('APP_PACKAGE') }}/total?style=social"/>
            </div>
        </div>
    </div>
</nav>