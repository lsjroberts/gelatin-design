@extends('layout')

@section('content')
    <h1>Hi</h1>

    <p>My name is Laurence Roberts, I'm a developer who makes websites and games.</p>

    <p>Here you'll find stuff on
        @foreach ($tags as $key => $tag)
            @if ($key == count($tags) - 1)
                and
            @endif
            <a class="tag tag-{{ $tag }}" href="/blog/tag/{{ $tag }}">{{ $tag }}</a>
            @if ($key < count($tags) - 2)
                ,
            @endif
        @endforeach
        .
    </p>

    <p>You can find all my open-source code at {{ link_to('//github.com/lsjroberts', 'github') }}.</p>

    <p>And follow my various ramblings and thoughts while coding on {{ link_to('//twitter.com/gelatindesign', 'twitter @gelatindesign') }}.</p>

    <section class="blog-list">
        @foreach ($articles as $article)
            @include('blog.includes.post', ['article' => $article])
        @endforeach
    </section>
@stop