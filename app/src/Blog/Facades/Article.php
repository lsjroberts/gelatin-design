<?php namespace Blog\Facades;

use Illuminate\Support\Facades\Facade;

class Article extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'blog.articles';
    }

}