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

    public function allByCount()
    {
        $tags = [];

        foreach ($this->articles->all() as $article) {
            foreach ($article->tags as $tag)
            {
                if (!isset($tags[$tag])) $tags[$tag] = 0;
                $tags[$tag]++;
            }
        }

        ksort($tags);

        uasort($tags, function($a, $b)
        {
            if ($a == $b) return 0;
            return $a < $b;
        });

        return array_keys($tags);
    }

}