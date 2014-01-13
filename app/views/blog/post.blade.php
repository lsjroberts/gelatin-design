@extends('layout')

@section('content')
	<article class="blog-article">
    	@include('blog.includes.post', ['article' => $article])
    </article>

    @include('blog.includes.comments', ['article' => $article])
@stop