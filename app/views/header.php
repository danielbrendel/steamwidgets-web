@if ((isset($show_header)) && ($show_header == true))
<div class="header">
    <div class="header-overlay">
        <div class="container">
            <div class="columns">
                <div class="column is-half">
                    <div class="header-content">
                        <h1 class="header-gradient">{{ env('APP_NAME') }}</h1>

                        <h2>{{ env('APP_DESCRIPTION') }}</h2>

                        <div class="header-description">
                            {{ env('APP_NAME') }} is a clientside web component that offers an easy way to integrate Steam Widgets of various Steam entities into your website. Therefore you only need very few code in order to render Steam Widgets into your document.
                            {{ env('APP_NAME') }} is used via JavaScript. Since JavaScript is supported by all major browser per default it is platform independent and compatible.
                            {{ env('APP_NAME') }} widgets are responsive, localizable, customizable and easily adjustable.
                        </div>

                        <div class="header-buttons">
                            <span><a href="#readmore" class="button is-info is-outlined" onclick="document.querySelector('[name=readmore]').scrollIntoView({behavior: 'smooth'}); return false;">Read More</a></span>
                            <span><a href="{{ url('/documentation') }}" class="button is-primary is-outlined">Documentation</a></span>
                        </div>
                    </div>
                </div>

                <div class="column is-half hide-mobile">
                    <div class="header-content header-image">
                        <img src="{{ asset('img/header-image.png') }}"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif