<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>gelatindesign | a coder making websites + games</title>

        <link rel="shortcut icon" href="/assets/images/icon.png">

        {{ HTML::style('build/styles/combined.css') }}

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

        <!-- mmm div-soup, do this better -->
        <div id="site-nav" class="small-12 large-4 columns">
            <div class="diamonds">
                <div class="row">
                    {{ link_to_route('index', '', null, ['class' => 'diamond red']) }}
                </div>
                <div class="row">
                    {{ link_to_route('blog.tag', '', ['tag' => 'php'], ['class' => 'diamond pull-1 dark-orange']) }}
                    {{ link_to_route('blog.tag', '', ['tag' => 'javascript'], ['class' => 'diamond push-1 dark-orange']) }}
                </div>
                <div class="row">
                    {{ link_to_route('blog.tag', '', ['tag' => 'python'], ['class' => 'diamond pull-2 orange']) }}
                    {{ link_to_route('blog.tag', '', ['tag' => 'unity'], ['class' => 'diamond orange']) }}
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

        <div id="site-content" class="small-12 large-8 columns">
            @yield('content')
        </div>

        {{ HTML::script('build/scripts/combined.js') }}
        <script>
            hljs.configure({classPrefix: 'hljs-'});
            hljs.initHighlightingOnLoad();
        </script>
    </body>
</html>