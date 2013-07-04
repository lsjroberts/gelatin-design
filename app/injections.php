<?php

// Website
Basset::collection('website', function($collection)
{
    $directory = $collection->directory('assets/stylesheets', function($collection)
    {
        $collection->add('normalize.css');
        $collection->add('foundation.min.css');
        $collection->add('less/website.less')->apply('Less');
    });

    $directory->apply('CssMin');
    $directory->apply('UriRewriteFilter');

    $directory = $collection->directory('assets/javascripts', function($collection)
    {
        $collection->requireDirectory('coffeescripts')->apply('CoffeeScript');
        $collection->add('https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js');
        
        $collection->add('website.js');
    });

    $directory->apply('JsMin');
});