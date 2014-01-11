@extends('layout')

@section('content')
    <h1>Hi</h1>

    <p>Here you'll find stuff on <code>php</code>, <code>javascript</code>, <code>python</code> and
        <code>unity</code>.</p>

    <ul>
        <li><a href="//github.com/lsjroberts">github</a></li>
        <li><a href="//twitter.com/gelatindesign">twitter</a></li>
    </ul>

    <section class="blog-list">
        @foreach ($articles as $article)
            @include('blog.includes.post', ['article' => $article])
        @endforeach
    </section>
@stop