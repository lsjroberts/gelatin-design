@extends('layout')

@section('content')
    @if ($paginator->getCurrentPage() <= 1)
        <h1>Hi</h1>

        <p>My name is Laurence Roberts, I'm a developer who makes websites and games.</p>

        <p>Here you'll find stuff on
            <a class="tag tag-python" href="/blog/tag/python">python</a>,
            <a class="tag tag-javascript" href="/blog/tag/javascript">javascript</a>,
            <a class="tag tag-php" href="/blog/tag/php">php</a>
            and <a class="tag tag-codeclub" href="/blog/tag/codeclub">codeclub</a>

            {{--
            @foreach ($tags as $key => $tag)
                @if ($key == count($tags) - 1)
                    and
                @endif
                <a class="tag tag-{{ $tag }}" href="/blog/tag/{{ $tag }}">{{ $tag }}</a>
                @if ($key < count($tags) - 2)
                    ,
                @endif
            @endforeach
            --}}
            .
        </p>

        <p>You can find all my open-source code at {{ link_to('//github.com/lsjroberts', 'github') }}.</p>

        <p>And follow my various ramblings and thoughts while coding on {{ link_to('//twitter.com/gelatindesign', 'twitter @gelatindesign') }}.</p>
    @else
        <p class="right">Page {{ $paginator->getCurrentPage() }} of {{ $paginator->getLastPage() }}</p>
    @endif

    <section class="blog-list">
        @foreach ($articles as $article)
            @include('blog.includes.post', ['article' => $article])
        @endforeach

        <div class="pagination-asdf">
            {{ $paginator->links() }}
        </div>
    </section>
@stop