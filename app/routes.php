<?php

require 'helpers.php';

// Index
Route::get('/', ['as' => 'index', function()
{
    $articles = Article::latest(4);

	return View::make('index')->with('articles', $articles);
}]);

// Blog Post
Route::get('blog/post/{slug}', ['as' => 'blog.post', function($slug)
{
    $article = Article::findBySlug($slug);

    return View::make('blog.post')->with('article', $article);
}]);

// Blog Post Comments
Route::get('blog/post/{slug}#comments', ['as' => 'blog.post.comments', function($slug)
{
    $article = Article::findBySlug($slug);

    return View::make('blog.post')->with('article', $article);
}]);

// Blog Tag
Route::get('blog/tag/{tag}', ['as' => 'blog.tag', function($tag)
{
    $articles = Article::findByTag($tag);

    return View::make('blog.list')->with('articles', $articles);
}]);