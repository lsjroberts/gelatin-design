<?php namespace Blog;

use Blog\Articles\Article;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Blog\Repositories\ArticleCollectionRepository;

class BlogServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['blog'] = $this->app->share(function()
        {
            $data = require app_path() . '/database/articles.php';

            $articles = new Collection;

            foreach ($data as $d)
            {
                $articles->push(new Article($d));
            }

            return new ArticleCollectionRepository($articles);
        });
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('blog');
    }

}