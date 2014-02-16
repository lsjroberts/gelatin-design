<?php namespace Blog\Repositories;

use Illuminate\Support\Collection;

class TagArticleRepository implements TagRepositoryInterface {

    protected $articles;

    public function __construct(ArticleRepositoryInterface $articles)
    {
        $this->articles = $articles;
    }

    public function all()
    {
        $tags = [];

        foreach ($this->articles->all() as $article) {
            $tags = array_merge($tags, $article->tags);
        }

        $tags = array_unique($tags);
        sort($tags);

        return $tags;
    }

}