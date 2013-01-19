<?php

/**
 * Controls page routes
 *
 * @author  Laurence Roberts <info@gelatindesign.co.uk>
 */
class PagesFront extends Ares\FrontController {

	function GET_view($slug = null) {
		$slug = ($slug) ? $slug : 'home';

		$view = PATH_VIEWS . 'pages/' . $slug . '.php';

		if (is_file($view)) {
			Ares\View::$view = 'pages/' . $slug;
		} else {
			Ares\View::$view = 'errors/404';
		}
		
		Ares\View::render();
	}

}