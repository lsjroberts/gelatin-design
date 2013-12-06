<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>gelatindesign | a coder making websites + games</title>

        <link rel="shortcut icon" href="/assets/images/icon.png">

        {{ HTML::style('http://fonts.googleapis.com/css?family=Lato:300') }}
        {{ HTML::style('assets/stylesheets/normalize.css') }}
        {{ HTML::style('assets/stylesheets/foundation.min.css') }}
        {{ HTML::style('assets/website.css') }}

        @section('head')

        @stop

        @if (Cookie::get('laurence') != 'true')
            <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-18813637-1']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
            </script>
        @endif
    </head>
    <body>

        <div id="site-nav" class="small-12 large-12 columns">
            <div class="diamonds">
                <div class="row">
                    <a href="/" class="diamond red"></a>
                </div>
                <div class="row">
                    <a href="/shopavel" class="diamond pull-1 dark-orange"></a>
                    <a href="/laravel-packages" class="diamond push-1 dark-orange"></a>
                </div>
                <div class="row">
                    <a href="/neon-spores" class="diamond pull-2 orange"></a>
                    <a href="/i-painted-a-tiny-world" class="diamond orange"></a>
                    <div class="diamond push-2 orange"></div>
                </div>
                <div class="row">
                    <div class="diamond pull-1 light-orange"></div>
                    <div class="diamond push-1 light-orange"></div>
                </div>
                <div class="row">
                    <div class="diamond lighter-orange"></div>
                </div>
            </div>
        </div>

        <div id="site-content" class="small-12 large-12 columns">
            @yield('content')
        </div>

        {{ HTML::script('assets/javascripts/website.js') }}
    </body>
</html>