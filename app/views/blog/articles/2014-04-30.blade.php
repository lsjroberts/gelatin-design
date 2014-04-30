<p>For this week's CodeClub lesson we looked at the python library {{ link_to('https://docs.python.org/3.4/library/turtle.html', 'turtle') }}. It's a easy and fun little graphics library based around moving a "turtle" cursor around the screen, drawing lines and filling in shapes.</p>

<p>For something that is so basic in functionality it's surprising how the results can be so satisfying.</p>

<p>{{ link_to('https://github.com/lsjroberts/codeclub/tree/master/python/turtle', 'You can check out the code at github.') }}</p>

<p>
    <a href="{{ url('/build/images/blog/2014-04-30/turtle-1.png') }}">
        <img src="/build/images/blog/2014-04-30/turtle-1.png" alt="Python Turtle Screenshot 1">
    </a>
</p>

<p>
    <a href="{{ url('/build/images/blog/2014-04-30/turtle-2.png') }}">
        <img src="/build/images/blog/2014-04-30/turtle-2.png" alt="Python Turtle Screenshot 2">
    </a>
</p>

<iframe width="1000" height="563" src="//www.youtube.com/embed/WC75-nAJylo" frameborder="0" allowfullscreen></iframe>


@if (isset($split) and $split)
    <p><em>{{ link_to_route('blog.post', 'Continue reading "' . $article->title . '" ...', ['slug' => $article->slug]) }}</em></p>
@else

@endif