<?php namespace Blog;

use Blog\Articles\Article;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Blog\Repositories\ArticleCollectionRepository;
use Blog\Repositories\TagArticleRepository;

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
        $this->app['blog.articles'] = $this->app->share(function()
        {
            $data = require app_path() . '/database/articles.php';

            $articles = new Collection;

            foreach ($data as $d)
            {
                $articles->push(new Article($d));
            }

            return new ArticleCollectionRepository($articles);
        });

        $this->app['blog.tags'] = $this->app->share(function($app)
        {
            $tags = new TagArticleRepository($app['blog.articles']);

            return $tags;
        });
    }


    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('blog.articles', 'blog.tags');
    }

}