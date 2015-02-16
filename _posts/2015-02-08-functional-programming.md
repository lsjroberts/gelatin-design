---
title: Functional Programming
titleSmall: Developing games in Elm
titleStrong: Functional Programming
date: 2015-02-08
category: developing-games-in-elm
tags: project-iso elm
---

This is the first in a series of articles I will be writing about game development in [elm](http://elm-lang.org). It is a language that currently compiles into html and javascript so you can deploy it straight to the web or package it in [nw.js](https://github.com/nwjs/nw.js) to create a standalone app or game. These are not so much tutorials but more things I've had to learn as I progress. Since elm is in active development I'll be updating the articles if and when they become out of date. And also for any mistakes I make...

Functional programming (FP) is a suprisingly ill-defined paradigm. It is many things to many people, but what it represents to me is a community who desire to write simpler composable code, to avoid strong [complecting](http://www.infoq.com/presentations/Simple-Made-Easy) and to create easy to debug software.


## Games

Probably more so than many areas of programming, game development is strongly object-orientated and full of state. On the face of it, it lends itself very well to that methodology. A frequent response I receive when mentioning I use an FP language is surprise that it's feasible to make games this way and interest in how it may be done.

So why have I chosen to build a game with FP? To put it simply; I've grown tired of the traditional ways of architecting software. Imperative object-orientated code inevitably leads to frustrating issues like [side effects](http://en.wikipedia.org/wiki/Side_effect_(computer_science)) and over engineering, and to my eyes it looks ugly.

This is just an opinion, so feel free to stick with what you know, but if you yearn for something different why not take a stroll down the functional path.


## Iteration

Consider this basic example in javascript, squaring a list of numbers. With imperative code you describe how something will happen, with functional code (a subset of [declarative](https://en.wikipedia.org/wiki/Declarative_programming)) you describe what you want to happen. So in the imperative style we have to define a temporary index variable and construct a loop to iterate through the list updating each value in turn:

{% highlight js imperative %}
var numbers = [1,2,3,4,5,6,7,8,9],
    i;

for (i = 0; i < numbers.length; i++) {
    numbers[i] *= numbers[i];
}
{% endhighlight %}

Compare this to the functional approach. If you are writing in javascript you can use the great [lodash](https://lodash.com) library. However using a language specifically designed for FP is highly beneficial, so lets do it in [elm](http://elm-lang.org).

{% highlight haskell %}
import List (..)

square : Int -> Int
square n =
    n * n

numbers : List Int
numbers =
    map square [1..9]
{% endhighlight %}

With elm we do not need to use temporary variables, we can construct our list of numbers easily, and define a function that can be used elsewhere. With `map` we apply `square` onto each number in the list and return the new list.

As you can see, functions are type-hinted for each of the parameters with the final type referring to the output. The `import List (..)` line simply brings in all the core list functions that elm provides such as `map` and `filter`.

## Filtering

Now imagine we want to remove odd numbers from a list and only square the remaining even numbers. Approaching this imperatively we may write:

{% highlight js %}
var numbers = [1,2,3,4,5,6,7,8,9],
    squaredNumbers = [],
    i;

for (i = 0; i < numbers.length; i++) {
    if (numbers[i] % 2 == 0) {
        squaredNumbers.push(numbers[i] * numbers[i]);
    }
}

numbers = squaredNumbers;
{% endhighlight %}

Sure, it works, but having to define a second array is messy and we've had to write the `for` loop definition again. This is one of my least favourite things about the imperative style; you'll write the same 35 boilerplate characters a thousand times throughout your codebase.

Let's try it functionally:

{% highlight haskell %}
isEven : Int -> Bool
isEven n =
    n % 2 == 0

numbers : List Int
numbers =
    map square (filter isEven [1..9])
{% endhighlight %}

We apply the filter to the list of numbers and can reuse our `square` function from before so we don't need to repeat ourselves for a slightly different behaviour.

And here's the brilliant thing about FP, you spend less time working out what the author intended; you can simply read it. And this improves further with chaining.


## Chaining

If you were thinking the nesting of functions could get out of hand, you are right. In elm we can use the `|>` operator to help us chain function calls.

The `|>` operator is an alias for function application. It takes the value to it's left and passes this as the tail argument to the function on it's right. There is also `<|` which does this in the reverse direction.

{% highlight haskell %}
-- this
1 |> add 2

-- is equivalent to this
add 2 (1)
{% endhighlight %}

When we have multiple functions to call it's easy to see the benefit:

{% highlight haskell %}
-- this
1 |> add 2
  |> add 3
  |> add 4

-- is equivalent to this
add 4 (add 3 (add 2 (1)))
{% endhighlight %}

This helps reduce the number of brackets you have to write, and makes your code easier to read. It becomes more like a sentence:

{% highlight haskell %}
numbers : List Int
numbers =
    [1..9] |> filter isEven
           |> map square
{% endhighlight %}

## Composition

An often better alternative to chaining is composition, [combining simple functions to build more complicated ones](https://en.wikipedia.org/wiki/Function_composition_(computer_science)).

In elm we can compose functions together using the `>>` operator. This composes two functions together without us needing to specify the way inputs are passed.

{% highlight haskell %}
-- this
(isEven >> not)

-- is equivalent to
(\n -> not (isEven n))
{% endhighlight %}

To get a bit logical, if we know that `g : A -> B` and `f : B -> C` we can then compose them together to create `g >> f : A -> C`. The call order can be reversed as using `<<`.

In this example we are checking to see if the square of a given number is odd:

{% highlight haskell %}
squareIsOdd =
    square >> isEven >> not -- `not` is a built-in function that inverts booleans

squareIsOdd 3 == True
squareIsOdd 6 == False
{% endhighlight %}

The inputs given to `squareIsOdd` are implicitly passed through to the composed functions, each one in turn passing it's output on to the next.


## State

[State](http://en.wikipedia.org/wiki/State_(computer_science)) is the data that the program stores in variables and as properties on objects. The problem with state stored in this way is that it allows the developer to modify a variable that is outside the scope of the current block, creating a side effect. For example:

{% highlight js %}
var foo, bar;

foo = {
    "baz": 1
    "setBaz": function(value) {
        this.baz = value;
        bar.qux = value * 2; // yuck!
    }
};

bar = {
    "qux": 2
};

foo.setBaz(2);
{% endhighlight %}

There may be a valid reason for changing the value of `bar.qux`, if it should always be double `foo.baz`. But unless a developer knows or reads the definition of `setBaz` they won't know that it changes `bar.qux`. The api of the object lies. In this trivial example you could easily, and correctly, identify that this is bad code. But the availability of this almost inevitably leads to programmers writing these side effects. I've seen and done it a great deal.

So how do we solve this issue? By providing no way for the developer to write side effects. With elm there is no global state, there are no variables, there is just input data and output data.

However if the function performs no update operation and only returns the input, the output is the same piece of data to prevent unnecessary copies.

{% highlight haskell %}
noop input =
    input

sameAsInput = noop { a = "b" }
{% endhighlight %}

So taking this to our `setBaz` example in elm:

{% highlight haskell %}
type alias Foo =
    { baz : Int
    }

type alias Bar =
    { qux : Int
    }

foo : Foo
foo =
    { baz = 1
    }

bar : Bar
bar =
    { qux = 2
    }

setFooBaz : Int -> Foo -> Foo
setFooBaz baz' foo =
    { foo
        | baz <- baz'
    }

foo = foo |> setFooBaz 2
{% endhighlight %}

We can see that there is no way for `setFooBaz` to modify `bar.qux`. The function can not access data outside it's scope and can only return the new version of `foo`.

To clarify, you may be thinking that `foo : Foo` is a variable of type `Foo`, but it is not. It is a function that takes no input and outputs a data object. We could easily change it to `foo : Int -> Foo`, to allow `baz` to be initialised to some value.

If we still want to ensure `bar.qux` is updated to be double `foo.baz`, we can create a function which takes a data object comprising of both, calls the two update functions and returns the modified parent:

{% highlight haskell %}
type alias FooBar =
    { foo : Foo
    , bar : Bar
    }

fooBar : FooBar
fooBar =
    { foo = foo -- our previously created `foo` function
    , bar = bar
    }

update : Int -> FooBar -> FooBar
update baz fooBar =
    { fooBar
        | foo <- fooBar.foo |> setFooBaz baz
        , bar <- fooBar.bar |> setBarQux baz * 2
    }

fooBar = fooBar |> update 2
{% endhighlight %}

We are able to update the values as desired, but without side effects. The output of `update` contains all the effects of it's operations.


## Elm

In my opinion there's a multitude of advantages to using a functional language and Elm is a fine example. Easy to read, easy to debug, resuable code without confusing side-effects. Why not give it a go for your next game jam project?

Coming next: Signals. To hear when this is published and for news about the game I'm creating [follow me on twitter](https://twitter.com/gelatindesign).

{:.update-note}
Updated [08 Feb, 2015]: Corrected a section regarding a `noop` function, only record updates produce a new value.

{:.update-note}
Updated [13 Feb, 2015]: Corrected my bad maths, the square of 7 is not an even number... changed to `squareIsOdd 6 == False`

{:.update-note}
Updated [16 Feb, 2015]: Improved some sentences to be less confusing and repetitive.