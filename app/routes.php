<?php

require 'helpers.php';

// Index
Route::get('/', ['as' => 'index', function()
{
    $articles = Article::latest(4);

    $tags = Tag::all();

	return View::make('index')
        ->with('articles', $articles)
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
    $articles = Article::findByTag($tag);

    return View::make('blog.list')
        ->with('title', 'Articles tagged "' . $tag . '"')
        ->with('articles', $articles);
}]);