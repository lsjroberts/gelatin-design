<?php

require 'helpers.php';

// Index
Route::get('/', ['as' => 'index', function()
{
    $articles = Article::paginate(Input::get('page', 1), 2);
    $paginator = Paginator::make($articles->all(), Article::all()->count(), 2);

    $tags = Tag::allByCount();

	return View::make('index')
        ->with('articles', $articles)
        ->with('paginator', $paginator)
        ->with('tags', $tags);
}]);

// Blog Post
Route::get('blog/post/{slug}', ['as' => 'blog.post', function($slug)
{
    $article = Article::findBySlug($slug);

    return View::make('blog.post')->with('article', $article);
}]);

// Blog Tag
Route::get('blog/tag/{tag}', ['as' => 'blog.tag', function($tag)
{
    $articles = Article::findByTag($tag)->reverse();

    return View::make('blog.list')
        ->with('title', 'Articles tagged "' . $tag . '"')
        ->with('articles', $articles);
}]);