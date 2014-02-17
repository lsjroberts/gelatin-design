<?php namespace Blog\Repositories;

interface TagRepositoryInterface {

    public function all();
    public function allByCount();

}