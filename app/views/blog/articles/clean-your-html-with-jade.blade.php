<p>As fundamental as html is to the web it is a bit of an ugly character.
    Angular brackets are a particular eyesore.</p>

<p>{{ link_to('http://jade-lang.com/', 'Jade') }} is a terse almost python-like
    html templating language. It is primarily a nodejs package, but there are
    compilers for {{ link_to('http://stackoverflow.com/questions/13355137/php-jade-template-parser', 'PHP') }}
    and other languages as well.</p>

@if (isset($split) and $split)
    <p><em>{{ link_to_route('blog.post', 'Continue reading "' . $article->title . '" ...', ['slug' => $article->slug]) }}</em></p>
@else

<p>It has a wonderfully basic syntax:</p>

<pre class="prettyprint jade">
doctype html
html
    head
        title Hello World
        link(rel="stylesheet", href="build/styles/combined.css")
    body
        div.container
            p Hello World
</pre>


<h2>Layouts and blocks</h2>

<p>Jade allows you to create layouts and extend them for your different views:</p>

<pre class="prettyprint jade">
// layouts/master.jade
body
    block content
</pre>

<pre class="prettyprint jade">
// index.jade
extends layouts/master

block content
    header.hero
        h1 Hello World
</pre>


<h2>Use mixins to power your views</h2>

<p>Forms are probably the lamest thing to write in HTML, it can become a bore
    rather quickly. Using jade mixins you can speed this process up and cleanly
    define your form without all the verbosity.</p>

<pre class="prettyprint jade">
// mixins/form.jade
mixin form(action, method)
    unless method
        - method= "get"
    form(action= action, method= method)
        if block
            block
        else
            p Looks like you forgot to add any inputs to your form

mixin field(name, type)
    label= name
    input(type= type, name= name)
</pre>

<pre class="prettyprint jade">
// login.jade

include mixins/form

+form("auth/login", "post")
    +field("email", "text")
    +field("password", "password")
</pre>

<p>So that's pretty cool, but there's a lot more you can do with the field
    mixin. You can run any javascript inside jade, so we can add an
    <code>unslugify</code> function to convert "email_address" to "Email
    Address". Then add in some input type guessing and we've got something
    pretty useful really quickly.</p>

<pre class="prettyprint jade">
// mixins/form.jade

//- ...

mixin field(name, type)
    //- Convert "foo_bar" to "Foo Bar"
    -var unslugify = function(input) {
    -   return input.charAt(0).toUpperCase() + input.slice(1).toLowerCase().replace(/[-|_](.)/g, function(match, group1) {
    -       return ' ' + group1.toUpperCase();
    -   });
    -}

    //- If no type has been set, try to pick an appropriate one
    unless type
        case name
            when "password"
                - type= "password"
            when "password_confirmation"
                - type= "password"
            when "email"
                - type= "email"
            default
                - type= "text"

    div.field
        label= unslugify(name)
        input(type= type, name= name)
</pre>

<pre class="prettyprint jade">
// login.jade

include mixins/form

+form("auth/login", "post")
    +field("email")
    +field("password")
</pre>


<h2>Lovely</h2>

<p>There's a few more things you can do in jade, {{ link_to('http://jade-lang.com/reference/',
    'check out the reference to see') }} all your options. But hopefully you can
    see from this quick rundown how much cleaner you can make your views.</p>

<p>Coding should be fun and jade brings that enjoyment back to html.</p>


@endif