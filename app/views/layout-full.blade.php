<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>gelatindesign | a coder making websites + games</title>

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">

        @stylesheets('website')

        @section('head')
            
        @show

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
        <div id="top"></div>
        <div id="wrapper">
            <div class="bar">
                <div class="red"></div>
                <div class="dark-orange"></div>
                <div class="orange"></div>
                <div class="light-orange"></div>
                <div class="lighter-orange"></div>
            </div>

            <div id="inner-wrapper" class="row">
                <header id="site-header" class="layout-full">
                    <h2><a href="/">gelatindesign</a></h2>
                    <p>i'm a coder making websites + games</p>

                    <p><small class="twitter"><a href="http://www.twitter.com/gelatindesign">@gelatindesign</a></small></p>
                    <p><small class="email"><a href="mailto:info@gelatindesign.co.uk">info@gelatindesign.co.uk</a></small></p>
                </header>

                <div id="site-content">
                    @yield('content')
                </div>
            </div>

            <footer id ="site-footer">
                <div class="bar">
                    <div class="red"></div>
                </div>
                <p>gelatindesign - <a href="http://www.gelatindesign.co.uk">www.gelatindesign.co.uk</a></p>
            </footer>
        </div>

        @javascripts('website')
    </body>
</html>