<nav class="navbar is-dark is-fixed-top" role="navigation" aria-label="main navigation">
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
            <a class="navbar-item" href="{{ url('/#steam-app') }}" onclick="document.getElementById('burger-button').click(); return true;">
                Steam App
            </a>

            <a class="navbar-item" href="{{ url('/#steam-server') }}" onclick="document.getElementById('burger-button').click(); return true;">
                Steam Server
            </a>

            <a class="navbar-item" href="{{ url('/#steam-user') }}" onclick="document.getElementById('burger-button').click(); return true;">
                Steam User
            </a>

            <a class="navbar-item" href="{{ url('/#steam-workshop') }}" onclick="document.getElementById('burger-button').click(); return true;">
                Steam Workshop
            </a>

            <a class="navbar-item" href="{{ url('/#steam-group') }}" onclick="document.getElementById('burger-button').click(); return true;">
                Steam Group
            </a>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <img src="https://img.shields.io/github/forks/{{ env('APP_PACKAGE') }}?style=flat"/>
            </div>

            <div class="navbar-item">
                <img src="https://img.shields.io/github/stars/{{ env('APP_PACKAGE') }}?style=flat"/>
            </div>

            <div class="navbar-item">
                <img src="https://img.shields.io/npm/dt/{{ env('APP_NPMPACKAGENAME') }}?style=flat"/>
            </div>
        </div>
    </div>
</nav>