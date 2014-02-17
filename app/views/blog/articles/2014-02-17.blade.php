<p>I can see no reason why anyone would use javascript over {{ link_to('http://coffeescript.org/', 'coffeescript') }}. The
    latter is without a doubt objectively better. Sure, it will take a bit of
    time to learn, perhaps a day or two. But if you are in the web development
    game you should be learning every single day. One day off and you are behind
    and have to play catch up.</p>

<p>The time investment is clearly worth it.</p>

@if (isset($split) and $split)
    <p><em>{{ link_to_route('blog.post', 'Continue reading "' . $article->title . '" ...', ['slug' => $article->slug]) }}</em></p>
@else

<h2>It's just better looking javascript</h2>

<p>I got driven to coffeescript through my frustration with the many opinions
    and methods of just simply writing class-based javascript. Prototypes work
    great but are messy, and inheritence is implemented in a slightly odd
    fashion.</p>

<p>Clean code is good code is fun code.</p>

<p>So how do you write a class in coffeescript? One line.</p>

<pre>
<code class="coffeescript">class Foo
</code></pre>

<p>Compare that to the generated javascript:</p>

<pre>
<code class="javascript">(function() {
  var Foo;

  Foo = (function() {
    function Foo() {}

    return Foo;

  })();

}).call(this);
</code></pre>

<p>There's definitely some boilerplate going on, but what about something more
    complicated?</p>

<pre>
<code class="coffeescript">class Foo
    constructor: (@who) ->

    say: ->
        console.log('Hello ' + @who + '!')

class Bar extends Foo
    say: ->
        console.log('Good evening ' + @who + '!')
</code></pre>

<p>Looking at the generated javascript it's hard to deny the superiority of
    coffeescript.</p>

<pre>
<code class="javascript">(function() {
  var Bar, Foo,
    __hasProp = {}.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

  Foo = (function() {
    function Foo(who) {
      this.who = who;
    }

    Foo.prototype.say = function() {
      return console.log('Hello ' + this.who + '!');
    };

    return Foo;

  })();

  Bar = (function(_super) {
    __extends(Bar, _super);

    function Bar() {
      return Bar.__super__.constructor.apply(this, arguments);
    }

    Bar.prototype.say = function() {
      return console.log('Good evening ' + this.who + '!');
    };

    return Bar;

  })(Foo);

}).call(this);
</code></pre>

<p>Really the only thing going against coffeescript is that it needs to be
    compiled. But using {{ link_to_route('blog.post', 'a build tool like gulp',
    ['slug' => 'easily-build-assets-with-gulpjs']) }} solves that. In fact,
    compiling to javascript is one of it's greatest strengths. You get the
    benefit of a nicer, cleaner language and complete compatibility with all
    browsers.</p>

<p>There's far more to coffeescript as well, things like looping over array
    comprehensions:</p>

<pre>
<code class="coffeescript">console.log fruit for fruit in ['apple', 'banana', 'grape']
</code></pre>

<p>Block regular expressions:</p>

<pre>
<code class="coffeescript">OPERATOR = /// ^ (
  ?: [-=]>             # function
   | [-+*/%<>&|^!?=]=  # compound assign / compare
   | >>>=?             # zero-fill right shift
   | ([-+:])\1         # doubles
   | ([&|<>])\2=?      # logic / shift
   | \?\.              # soak access
   | \.{2,3}           # range or splat
) ///
</code></pre>

<p>Function argument splats:</p>

<pre>
<code class="coffeescript">foo = (first, rest...) ->
    console.log first, rest

# console.log('a', ['b', 'c', 'd'])
foo('a', 'b', 'c', 'd')
</code></pre>

<p>And {{ link_to('http://coffeescript.org/', 'much more') }}.</p>

<p>The cleanliness of coffeescript allows you to write large applications and
    keep on top of it. With all redundant syntax removed it is far easier to
    see what your code is actually doing. Making your workflow more fun and
    your code better.</p>

@endif