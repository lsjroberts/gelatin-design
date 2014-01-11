<?php namespace Blog\Repositories;

interface ArticleRepositoryInterface {

    public function getLatest($count = 1);
    public function getBySlug($slug);
    public function getByTag($tag);

}