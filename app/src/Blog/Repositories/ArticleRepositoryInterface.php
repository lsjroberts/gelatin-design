<?php namespace Blog\Repositories;

interface ArticleRepositoryInterface {

    public function all();
    public function latest($count = 1);
    public function findBySlug($slug);
    public function findByTag($tag);

}