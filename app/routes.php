<?php

$app['basset.manifest'] = $app->share(function($app)
{
    $meta = base_path() . '/public/builds';

    return new \Basset\Manifest\Manifest($app['files'], $meta);
});

require 'helpers.php';

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});

Route::get('/shopavel', function()
{
    return View::make('pages.shopavel');
});

Route::get('/laravel-packages', function()
{
    return View::make('pages.laravel-packages');
});

Route::get('/neon-spores', function()
{
    return View::make('pages.neon-spores');
});

Route::get('/i-painted-a-tiny-world', function()
{
    return View::make('pages.i-painted-a-tiny-world');
});

Route::get('/maths/primes-ulam-spirals', function()
{
    return View::make('maths.primes-ulam-spirals');
});

Route::get('/p2p', function()
{
    return View::make('p2p.index');
});

Route::get('/setcookie', function()
{
    return Response::make()->withCookie(Cookie::forever('laurence', 'true'));
});