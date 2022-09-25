<!doctype html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="{{ env('APP_AUTHOR') }}">
        <meta name="description" content="{{ env('APP_DESCRIPTION') }}">
        <meta name="keywords" content="{{ env('APP_KEYWORDS') }}">

        <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}"/>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/bulma.css') }}"/>
        
        <title>{{ env('APP_TITLE') }}</title>

        <style>
            html {
                width: 100%;
                height: 100%;
                overflow-y: auto;
                background-color: rgb(32, 32, 30);
            }

            body {
                width: 100%;
                height: 100%;
                padding: 0;
            }

            #generator {
                position: relative;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
            }

            .generator-outer {
                width: 100%;
                height: 93%;
                padding: 0;
            }

            .generator-outer h1 {
                text-align: center;
                color: rgb(200, 200, 200);
                margin-bottom: 20px;
                font-size: 1.3em;
            }

            .generator-outer p {
                color: rgb(150, 150, 150);
                margin-bottom: 20px;
                padding-left: 10px;
                padding-right: 10px;
                text-align: center;
            }

            .generator-outer a:hover {
                color: #3273dc;
                text-decoration: underline;
            }

            .generator-inner {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 90%;
                transform: translate(-50%, -50%);
                margin: 0;
            }

            .generator-headline {
                width: 100%;
                height: 50px;
                margin-bottom: 53px;
                background-color: rgb(85, 145, 245);
            }

            .generator-headline h1 {
                position: relative;
                top: 8px;
                color: rgb(255, 255, 255);
            }

            .generator-menu-options {
                text-align: center;
            }

            .generator-menu-options div {
                margin-bottom: 15px;
            }

            .button-fixed-size {
                min-width: 200px;
            }

            #generator-widget-app {
                display: none;
            }

            #generator-widget-app h2 {
                margin-bottom: 20px;
            }

            #generator-widget-app, #generator-widget-app label {
                color: rgb(200, 200, 200);
            }

            #generator-widget-app input {
                background-color: rgba(0, 0, 0, 0.1);
                color: rgb(150, 150, 150);
            }

            #generator-widget-app form {
                margin-bottom: 30px;
            }

            #widget-output-app {
                display: none;
            }

            #widget-output-app pre {
                background-color: rgb(55, 55, 55);
            }

            #widget-output-app code {
                background-color: rgb(200, 200, 200);
            }

            #widget-output-codecopy-app {
                display: none;
            }

            #generator-widget-server {
                display: none;
            }

            #generator-widget-server h2 {
                margin-bottom: 20px;
            }

            #generator-widget-server, #generator-widget-server label {
                color: rgb(200, 200, 200);
            }

            #generator-widget-server input {
                background-color: rgba(0, 0, 0, 0.1);
                color: rgb(150, 150, 150);
            }

            #generator-widget-server form {
                margin-bottom: 30px;
            }

            #widget-output-server {
                display: none;
            }

            #widget-output-server pre {
                background-color: rgb(55, 55, 55);
            }

            #widget-output-server code {
                background-color: rgb(200, 200, 200);
            }

            #widget-output-codecopy-server {
                display: none;
            }

            #generator-widget-user {
                display: none;
            }

            #generator-widget-user h2 {
                margin-bottom: 20px;
            }

            #generator-widget-user, #generator-widget-user label {
                color: rgb(200, 200, 200);
            }

            #generator-widget-user input {
                background-color: rgba(0, 0, 0, 0.1);
                color: rgb(150, 150, 150);
            }

            #generator-widget-user form {
                margin-bottom: 30px;
            }

            #widget-output-user {
                display: none;
            }

            #widget-output-user pre {
                background-color: rgb(55, 55, 55);
            }

            #widget-output-user code {
                background-color: rgb(200, 200, 200);
            }

            #widget-output-codecopy-user {
                display: none;
            }

            .footer-frame {
                width: 100%;
                height: 40px;
            }

            .footer-content {
                text-align: center;
                color: rgb(150, 150, 150);
            }

            .footer-content a {
                color: rgb(130, 130, 130);
            }

            .footer-content a:hover {
                color: rgb(150, 150, 150);
                text-decoration: none;
            }
        </style>

        @if (env('APP_DEBUG'))
        <script src="{{ asset('js/vue.js') }}"></script>
        @else
        <script src="{{ asset('js/vue.min.js') }}"></script>
        @endif
        <script src="{{ asset('js/fontawesome.js') }}"></script>
        <script src="{{ url('/api/resource/query') }}?type=js&module=app&version=v1"></script>
        <script src="{{ url('/api/resource/query') }}?type=js&module=server&version=v1"></script>
        <script src="{{ url('/api/resource/query') }}?type=js&module=user&version=v1"></script>
    </head>

    <body id="body" style="background-image: url('{{ asset('img/genbg.jpg') }}');">
        <div id="generator">
            <div class="generator-outer">
                <div class="generator-headline">
                    <h1>{{ env('APP_NAME') }} Widget Generator</h1>
                </div>

                <div id="infos">
                    <p>Please select a type of widget you want to create.</p>

                    <p>For more information about {{ env('APP_NAME') }} please visit <a href="{{ url('/') }}">{{ url('/') }}</a></p>
                </div>

                <div class="generator-inner" id="generator-inner">
                    <div class="generator-menu-options" id="generator-options">
                        <div><a class="button is-link is-outlined button-fixed-size" href="javascript:void(0);" onclick="document.getElementById('generator-options').style.display = 'none'; document.getElementById('generator-widget-app').style.display = 'unset'; window.setWidgetStyle(true); document.getElementById('footer').style.display = 'none'; document.getElementById('body').style.backgroundImage = 'unset'; document.getElementById('generator').style.backgroundColor = 'unset'; document.getElementById('infos').style.display = 'none';">Steam App Widget</a></div>
                        <div><a class="button is-link is-outlined button-fixed-size" href="javascript:void(0);" onclick="document.getElementById('generator-options').style.display = 'none'; document.getElementById('generator-widget-server').style.display = 'unset'; window.setWidgetStyle(true); document.getElementById('footer').style.display = 'none'; document.getElementById('body').style.backgroundImage = 'unset'; document.getElementById('generator').style.backgroundColor = 'unset'; document.getElementById('infos').style.display = 'none';">Steam Server Widget</a></div>
                        <div><a class="button is-link is-outlined button-fixed-size" href="javascript:void(0);" onclick="document.getElementById('generator-options').style.display = 'none'; document.getElementById('generator-widget-user').style.display = 'unset'; window.setWidgetStyle(true); document.getElementById('footer').style.display = 'none'; document.getElementById('body').style.backgroundImage = 'unset'; document.getElementById('generator').style.backgroundColor = 'unset'; document.getElementById('infos').style.display = 'none';">Steam User Widget</a></div>
                    </div>

                    <div id="generator-widget-app">
                        <a href="javascript:void(0);" onclick="document.getElementById('generator-options').style.display = 'unset'; document.getElementById('generator-widget-app').style.display = 'none'; document.getElementById('footer').style.display = 'unset'; document.getElementById('body').style.backgroundImage = 'url(\'{{ asset('img/genbg.jpg') }}\')'; document.getElementById('generator').style.backgroundColor = 'rgb(0, 0, 0, 0.5)'; document.getElementById('infos').style.display = 'initial'; window.setWidgetStyle(false);">Go Back</a><br/><br/>

                        <h2>Create Steam App Widget</h2>

                        <form>
                            <div class="field">
                                <label class="label">AppID</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-app-appid" value="12345" required/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Language</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-app-lang" value="english"/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Author</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-app-author" value="By :developer"/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Online Count</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-app-onlinecount" value=":count playing"/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Rating</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-app-rating" value="0"/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Playtext</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-app-playtext" value="Play"/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Width</label>
                                <div class="control">
                                    <input type="number" class="input" id="inp-widget-app-width" value=""/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Height</label>
                                <div class="control">
                                    <input type="number" class="input" id="inp-widget-app-height" value=""/>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <a class="button is-success is-outlined" onclick="window.genAppWidget();">Generate</a>
                                </div>
                            </div>
                        </form>

                        <div id="widget-output-app">
                            <textarea id="widget-output-codecopy-app"></textarea>
                            <pre><code id="widget-code-app" class="language-html" onclick="window.copyToClipboard(document.getElementById('widget-output-codecopy-app').value); alert('Code copied to clipboard!');"></code></pre>
                            <br/><br/>
                            <div id="widget-sample-app"></div>
                            <br/><br/><br/>
                        </div>
                    </div>

                    <div id="generator-widget-server">
                        <a href="javascript:void(0);" onclick="document.getElementById('generator-options').style.display = 'unset'; document.getElementById('generator-widget-server').style.display = 'none'; document.getElementById('footer').style.display = 'unset'; document.getElementById('body').style.backgroundImage = 'url(\'{{ asset('img/genbg.jpg') }}\')'; document.getElementById('generator').style.backgroundColor = 'rgb(0, 0, 0, 0.5)'; document.getElementById('infos').style.display = 'initial'; window.setWidgetStyle(false);">Go Back</a><br/><br/>

                        <h2>Create Steam Server Widget</h2>

                        <form>
                            <div class="field">
                                <label class="label">Address</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-server-addr" value="ip:port" required/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Header</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-server-header" value=""/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Bots</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-server-bots" value=":count bots"/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Secure Text</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-server-secure-yes" value="secure"/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Insecure text</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-server-secure-no" value="insecure"/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Dedicated Hosting Text</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-server-hosting-dedicated" value="dedicated"/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Listen Hosting Text</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-server-hosting-listen" value="listen"/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Join text</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-server-join" value="Join"/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Width</label>
                                <div class="control">
                                    <input type="number" class="input" id="inp-widget-server-width" value=""/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Height</label>
                                <div class="control">
                                    <input type="number" class="input" id="inp-widget-server-height" value=""/>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <a class="button is-success is-outlined" onclick="window.genServerWidget();">Generate</a>
                                </div>
                            </div>
                        </form>

                        <div id="widget-output-server">
                            <textarea id="widget-output-codecopy-server"></textarea>
                            <pre><code id="widget-code-server" class="language-html" onclick="window.copyToClipboard(document.getElementById('widget-output-codecopy-server').value); alert('Code copied to clipboard!');"></code></pre>
                            <br/><br/>
                            <div id="widget-sample-server"></div>
                            <br/><br/><br/>
                        </div>
                    </div>

                    <div id="generator-widget-user">
                        <a href="javascript:void(0);" onclick="document.getElementById('generator-options').style.display = 'unset'; document.getElementById('generator-widget-user').style.display = 'none';  document.getElementById('footer').style.display = 'unset'; document.getElementById('body').style.backgroundImage = 'url(\'{{ asset('img/genbg.jpg') }}\')'; document.getElementById('generator').style.backgroundColor = 'rgb(0, 0, 0, 0.5)'; document.getElementById('infos').style.display = 'initial'; window.setWidgetStyle(false);">Go Back</a><br/><br/>

                        <h2>Create Steam User Widget</h2>

                        <form>
                            <div class="field">
                                <label class="label">SteamID</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-user-steamid" value="12345" required/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Header</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-user-header" value=""/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Online Text</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-user-online-yes" value="online"/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Offline Text</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-user-online-no" value="offline"/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Member Since Text</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-user-membersince" value="Member since: :year-:month-:day"/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">View Text</label>
                                <div class="control">
                                    <input type="text" class="input" id="inp-widget-user-viewtext" value="View"/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Width</label>
                                <div class="control">
                                    <input type="number" class="input" id="inp-widget-user-width" value=""/>
                                </div>
                            </div>

                            <div class="field">
                                <label class="label">Height</label>
                                <div class="control">
                                    <input type="number" class="input" id="inp-widget-user-height" value=""/>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <a class="button is-success is-outlined" onclick="window.genUserWidget();">Generate</a>
                                </div>
                            </div>
                        </form>

                        <div id="widget-output-user">
                            <textarea id="widget-output-codecopy-user"></textarea>
                            <pre><code id="widget-code-user" class="language-html" onclick="window.copyToClipboard(document.getElementById('widget-output-codecopy-user').value); alert('Code copied to clipboard!');"></code></pre>
                            <br/><br/>
                            <div id="widget-sample-user"></div>
                            <br/><br/><br/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-frame" id="footer">
                <div class="footer-content">
                    &copy; {{ date('Y') }} by {{ env('APP_AUTHOR') }} | <a href="{{ env('APP_LINK_GITHUB') }}" title="GitHub"><i class="fab fa-github"></i></a>&nbsp;&nbsp;<a href="{{ env('APP_LINK_TWITTER') }}" title="Twitter"><i class="fab fa-twitter"></i></a>&nbsp;&nbsp;<a href="{{ env('APP_LINK_STEAM') }}" title="Steam"><i class="fab fa-steam"></i></a>
                </div>
            </div>

            <div id="app" style="display: none;"></div>
        </div>
        
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            window.genAppWidget = function() {
                let appid = document.getElementById('inp-widget-app-appid').value;
                let lang = document.getElementById('inp-widget-app-lang').value;
                let author = document.getElementById('inp-widget-app-author').value;
                let playtext = document.getElementById('inp-widget-app-playtext').value;
                let onlinecount = document.getElementById('inp-widget-app-onlinecount').value;
                let rating = document.getElementById('inp-widget-app-rating').value;
                let width = document.getElementById('inp-widget-app-width').value;
                let height = document.getElementById('inp-widget-app-height').value;

                document.getElementById('widget-output-app').style.display = 'unset';

                let codeOutput = `
&lt;script src="{{ url('/api/resource/query?type=js&module=app&version=v1') }}"&gt;&lt;/script&gt;
&lt;steam-app appid="` + appid + `" lang="` + lang + `" author="` + author + `" playtext="` + playtext + `" onlinecount="` + onlinecount + `" rating="` + rating + `" width="` + width + `" height="` + height + `"&gt;&lt;/steam-app&gt;
                `;

                document.getElementById('widget-code-app').innerHTML = codeOutput;

                document.getElementById('widget-output-codecopy-app').value = codeOutput;
                while ((document.getElementById('widget-output-codecopy-app').value.indexOf('&lt;') >= 0) || (document.getElementById('widget-output-codecopy-app').value.indexOf('&gt;') >= 0)) {
                    document.getElementById('widget-output-codecopy-app').value = document.getElementById('widget-output-codecopy-app').value.replace('&lt;', '<').replace('&gt;', '>')
                }

                document.getElementById('widget-sample-app').innerHTML = '';

                let sampleWidget = new SteamApp('#widget-sample-app', {
                    appid: appid,
                    lang: lang,
                    playtext: playtext,
                    onlinecount: onlinecount,
                    rating: rating,
                    width: width,
                    height: height
                });

                window.hljs.highlightAll();

                setTimeout(function(){
                    window.scrollBy(0, 600);
                }, 1500);
            };

            window.genServerWidget = function() {
                let addr = document.getElementById('inp-widget-server-addr').value;
                let header = document.getElementById('inp-widget-server-header').value;
                let bots = document.getElementById('inp-widget-server-bots').value;
                let secYes = document.getElementById('inp-widget-server-secure-yes').value;
                let secNo = document.getElementById('inp-widget-server-secure-no').value;
                let dedicated = document.getElementById('inp-widget-server-hosting-dedicated').value;
                let listen = document.getElementById('inp-widget-server-hosting-listen').value;
                let playtext = document.getElementById('inp-widget-server-join').value;
                let width = document.getElementById('inp-widget-server-width').value;
                let height = document.getElementById('inp-widget-server-height').value;

                document.getElementById('widget-output-server').style.display = 'unset';

                let codeOutput = `
&lt;script src="{{ url('/api/resource/query?type=js&module=server&version=v1') }}"&gt;&lt;/script&gt;
&lt;steam-server addr="` + addr + `" header="` + header + `" secure-yes="` + secYes + `" secure-no="` + secNo + `" hosting-dedicated="` + dedicated + `" hosting-listen="` + listen + `" playtext="` + playtext + `" width="` + width + `" height="` + height + `"&gt;&lt;/steam-server&gt;
                `;

                document.getElementById('widget-code-server').innerHTML = codeOutput;

                document.getElementById('widget-output-codecopy-server').value = codeOutput;
                while ((document.getElementById('widget-output-codecopy-server').value.indexOf('&lt;') >= 0) || (document.getElementById('widget-output-codecopy-server').value.indexOf('&gt;') >= 0)) {
                    document.getElementById('widget-output-codecopy-server').value = document.getElementById('widget-output-codecopy-server').value.replace('&lt;', '<').replace('&gt;', '>')
                }

                document.getElementById('widget-sample-server').innerHTML = '';

                let sampleWidget = new SteamServer('#widget-sample-server', {
                    addr: addr,
                    header: header,
                    playtext: playtext,
                    bots: bots,
                    secure_yes: secYes,
                    secure_no: secNo,
                    hosting_dedicated: dedicated,
                    hosting_listen: listen,
                    width: width,
                    height: height
                });

                window.hljs.highlightAll();

                setTimeout(function(){
                    window.scrollBy(0, 600);
                }, 1500);
            };

            window.genUserWidget = function() {
                let steamid = document.getElementById('inp-widget-user-steamid').value;
                let header = document.getElementById('inp-widget-user-header').value;
                let online = document.getElementById('inp-widget-user-online-yes').value;
                let offline = document.getElementById('inp-widget-user-online-no').value;
                let membersince = document.getElementById('inp-widget-user-membersince').value;
                let viewtext = document.getElementById('inp-widget-user-viewtext').value;
                let width = document.getElementById('inp-widget-user-width').value;
                let height = document.getElementById('inp-widget-user-height').value;

                document.getElementById('widget-output-user').style.display = 'unset';

                let codeOutput = `
&lt;script src="{{ url('/api/resource/query?type=js&module=user&version=v1') }}"&gt;&lt;/script&gt;
&lt;steam-user steamid="` + steamid + `" header="` + header + `" online-yes="` + online + `" online-no="` + offline + `" member-since="` + membersince + `" viewtext="` + viewtext + `" width="` + width + `" height="` + height + `"&gt;&lt;/steam-user&gt;
                `;

                document.getElementById('widget-code-user').innerHTML = codeOutput;

                document.getElementById('widget-output-codecopy-user').value = codeOutput;
                while ((document.getElementById('widget-output-codecopy-user').value.indexOf('&lt;') >= 0) || (document.getElementById('widget-output-codecopy-user').value.indexOf('&gt;') >= 0)) {
                    document.getElementById('widget-output-codecopy-user').value = document.getElementById('widget-output-codecopy-user').value.replace('&lt;', '<').replace('&gt;', '>')
                }

                document.getElementById('widget-sample-user').innerHTML = '';

                let sampleWidget = new SteamUser('#widget-sample-user', {
                    steamid: steamid,
                    header: header,
                    online_yes: online,
                    online_no: offline,
                    member_since: membersince,
                    viewtext: viewtext,
                    width: width,
                    height: height
                });

                window.hljs.highlightAll();

                setTimeout(function(){
                    window.scrollBy(0, 600);
                }, 1500);
            };

            window.setWidgetStyle = function(flag) {
                if (flag) {
                    document.getElementById('generator-inner').style.top = 'unset';
                    document.getElementById('generator-inner').style.transform = 'translate(-50%, -0%)';
                    document.getElementById('generator-inner').style.overflowY = 'hidden';
                } else {
                    document.getElementById('generator-inner').style.top = '50%';
                    document.getElementById('generator-inner').style.transform = 'translate(-50%, -50%)';
                    document.getElementById('generator-inner').style.overflowY = 'unset';
                }
            };

            window.copyToClipboard = function(text) {
                const el = document.createElement('textarea');
                el.value = text;
                document.body.appendChild(el);
                el.select();
                document.execCommand('copy');
                document.body.removeChild(el);
            };
        </script>
    </body>
</html>