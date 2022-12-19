<!DOCTYPE html>
<html lang="{{ getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="{{ env('APP_AUTHOR') }}">
        <meta name="description" content="{{ env('APP_DESCRIPTION') }}">
        <meta name="keywords" content="{{ env('APP_KEYWORDS') }}">

        <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/bulma.css') }}"/>
        
        <title>{{ env('APP_TITLE') }}</title>

        @if (env('APP_DEBUG'))
        <script src="{{ asset('js/vue.js') }}"></script>
        @else
        <script src="{{ asset('js/vue.min.js') }}"></script>
        @endif
        <script src="{{ asset('js/fontawesome.js') }}"></script>
        <script src="{{ url('/api/resource/query') }}?type=js&module=app&version=v1"></script>
        <script src="{{ url('/api/resource/query') }}?type=js&module=server&version=v1"></script>
        <script src="{{ url('/api/resource/query') }}?type=js&module=user&version=v1"></script>
        <script src="{{ url('/api/resource/query') }}?type=js&module=workshop&version=v1"></script>
        <script src="{{ url('/api/resource/query') }}?type=js&module=group&version=v1"></script>
    </head>

    <body>
        <div id="app">
            @include('navbar.php')
            @include('header.php')

            <div class="container">
                <div class="columns">
                    <div class="column is-2"></div>

                    <div class="column is-8">
                        {%content%}

                        <div class="scroll-to-top">
                            <div class="scroll-to-top-inner">
                                <a href="javascript:void(0);" onclick="window.scroll({top: 0, left: 0, behavior: 'smooth'});"><i class="fas fa-arrow-up fa-2x up-color"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="column is-2"></div>
                </div>
            </div>

            @include('footer.php')
        </div>

        <script src="{{ asset('js/app.js', true) }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                window.vue.initNavBar();

                @if ((isset($render_stats_to)) && (isset($render_stats_pw)))
                    window.statsChart = null;
					window.vue.renderStats('{{ $render_stats_pw }}', '{{ $render_stats_to }}', '{{ $render_stats_start }}');
				@endif
            });
        </script>
    </body>
</html>
