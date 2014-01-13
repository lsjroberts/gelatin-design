@extends('layout')

@section('content')
    <h1>Hi</h1>

    <p>Here you'll find stuff on
        <a class="tag" href="/blog/tag/php">php</a>,
        <a class="tag" href="/blog/tag/javascript">javascript</a>,
        <a class="tag" href="/blog/tag/python">python</a> and
        <a class="tag" href="/blog/tag/unity">unity</a>.
    </p>

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