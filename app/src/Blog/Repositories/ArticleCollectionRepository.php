<?php namespace Blog\Repositories;

use Illuminate\Support\Collection;

class ArticleCollectionRepository implements ArticleRepositoryInterface {

    protected $articles;

    public function __construct(Collection $articles)
    {
        $this->articles = $articles;
    }

    public function all()
    {
        return $this->articles;
    }

    public function latest($count = 1)
    {
        return $this->articles->slice(max(0, $this->articles->count() - $count), $count);
    }

    public function findBySlug($slug)
    {
        $articles = $this->articles->filter(function($article) use ($slug)
        {
            if ($article->slug == $slug) return $article;
        });

        return $articles->last();
    }

    public function findByTag($tag)
    {
        return $this->articles->filter(function($article) use ($tag)
        {
            foreach ($article->tags as $articleTag)
            {
                if ($articleTag == $tag) return $article;
            }
        });
    }

}