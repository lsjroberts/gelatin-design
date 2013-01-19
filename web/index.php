<?php

require '../vendor/autoload.php';

// Set root path
Ares\Config::$root = dirname(__DIR__);

// Set controller extension, front/back/other
Ares\Config::$ctlr_ext = "Front";

// Attempt to start the request
try {
	Ares\Request::start();

} catch (Exception $e) {
	echo $e->getMessage();
	exit;
	
}

// Attempt to find the url
try {
	Ares\Router::find();

} catch (Ares\Exception\RouterException $e) {
	switch ($e->getCode()) {
		case 401:
			echo "<h1>You are not authorized to view this page";
			break;

		case 404:
		default:
			Ares\View::$view = 'errors/404';
			Ares\View::render();
			break;
	}

} catch (Exception $e) {

	Ares\View::$args['exception'] = $e;
	Ares\View::partial('errors/exception');
}