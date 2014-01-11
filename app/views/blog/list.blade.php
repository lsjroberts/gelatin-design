@extends('layout')

@section('content')
    <h1>Articles</h1>

    <section class="blog-list">
        @foreach ($articles as $article)
            @include('blog.includes.post', ['article' => $article])
        @endforeach
    </section>
@stop