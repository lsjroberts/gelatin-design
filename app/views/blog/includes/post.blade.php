<article class="blog-article">
    <header>
        <h1>{{ link_to_route('blog.post', $article->title, ['slug' => $article->slug]) }}</h1>

        <span class="date">{{ $article->date->toFormattedDateString() }}</span>
    </header>

    @include('blog.articles.' . $article->view)

    <footer>
        <nav class="tags">
            @foreach ($article->tags as $tag)
                {{ link_to_route('blog.tag', $tag, ['tag' => $tag], ['class' => 'tag']) }}
            @endforeach
        </nav>
    </footer>
</article>