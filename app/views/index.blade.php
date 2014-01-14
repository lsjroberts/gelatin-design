@extends('layout')

@section('content')
    <h1>Hi</h1>

    <p>My name is Laurence Roberts, I'm a developer who makes websites and games.</p>

    <p>Here you'll find stuff on
        <a class="tag tag-php" href="/blog/tag/php">php</a>,
        <a class="tag tag-javascript" href="/blog/tag/javascript">javascript</a>,
        <a class="tag tag-python" href="/blog/tag/python">python</a> and
        <a class="tag tag-unity" href="/blog/tag/unity">unity</a>.
    </p>

    <p>You can find all my open-source code at {{ link_to('//github.com/lsjroberts', 'github') }}.</p>

    <p>And follow my various ramblings and thoughts while coding on {{ link_to('//twitter.com/gelatindesign', 'twitter @gelatindesign') }}.</p>

    <section class="blog-list">
        @foreach ($articles as $article)
            @include('blog.includes.post', ['article' => $article])
        @endforeach
    </section>
@stop