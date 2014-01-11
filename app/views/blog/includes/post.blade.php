<article class="post">
    <header>
        <h3>{{ link_to_route('blog.post', $article->title, ['slug' => $article->slug]) }}</h3>
    </header>

    @include('blog.articles.' . $article->view)

    <footer>
        <ul class="tags">
            @foreach ($article->tags as $tag)
                <li>{{ link_to_route('blog.tag', $tag, ['tag' => $tag]) }}</li>
            @endforeach
        </ul>
    </footer>
</article>