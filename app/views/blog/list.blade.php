@extends('layout')

@section('content')
    <h1>{{ $title or 'Articles' }}</h1>

    <section class="blog-list">
        <p>{{ $articles->count() }} articles</p>

        @foreach ($articles as $article)
            @include('blog.includes.post', ['article' => $article])
        @endforeach
    </section>
@stop