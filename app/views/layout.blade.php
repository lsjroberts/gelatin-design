<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>gelatindesign | a coder making websites + games</title>

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">

        @stylesheets('website')
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
                <div class="small-12 large-4 columns">
                    <header id="site-header">
                        <h2><a href="/">gelatindesign</a></h2>
                        <p>i'm a coder making websites + games</p>

                        <p><small class="twitter"><a href="http://www.twitter.com/gelatindesign">@gelatindesign</a></small></p>
                        <p><small class="email"><a href="mailto:info@gelatindesign.co.uk">info@gelatindesign.co.uk</a></small></p>

                        <nav>
                            <h3>web</h3>

                            <ul>
                                <li><a href="/shopavel">shopavel</a></li>
                                <li><a href="/laravel-packages">laravel packages</a></li>
                            </ul>
                        </nav>

                        <nav>
                            <h3>games</h3>

                            <ul>
                                <li><a href="/neon-spores">neon spores <small>ludum dare 24</small></a></li>
                                <li><a href="/i-painted-a-tiny-world">i painted a tiny world <small>ludum dare 23</small></a></li>
                            </ul>
                        </nav>
                    </header>
                </div>

                <div id="site-content" class="small-12 large-8 columns">
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