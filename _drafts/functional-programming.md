---
title: Functional Programming
titleSmall: Developing games in Elm
titleStrong: Functional Programming
date: 2015-02-07
category: developing-games-in-elm
tags: project-iso elm
---

This is the first in a series of articles I will be writing about game development in [elm](http://elm-lang.org). These are no so much tutorials but more things I've had to learn as I progress. Since elm is in active development I'll be updating the articles if and when they become out of date. And also for any mistakes I make...

_Functional Programming_ (FP) is a term which has an incredibly fluid definition. What it represents to me is a community who desire to write simpler composable code, to avoid strong [complecting](http://www.infoq.com/presentations/Simple-Made-Easy) and to create easy to debug software.

## Games

Probably more so than many areas of programming, game development is strongly object-orientated and full of state. On the face of it, it lends itself very well to that methodology. A frequent response I receive when mentioning I use an FP language is "how can you make a game without state?".

_TODO: Finish that thought_

So why have I chosen to build a game with FP? To put it simply; I've grown tired of the traditional ways of architecting software. Imperative object-orientated code inevitably leads to frustrating issues like [side effects](http://www.wikiwand.com/en/Side_effect_(computer_science)), over engineering and to my eyes it looks ugly.

This is an opinion, so feel free to stick with what you know, but if you yearn for something different why not take a stroll down the functional path.


## Iteration

Consider this basic example in javascript, squaring a list of numbers. In the imperative style we have to define a temporary index variable and construct a loop to iterate through the list replacing each value:

{% highlight js imperative %}
var numbers = [1,2,3,4,5,6,7,8,9],
    i;

for (i = 0; i < numbers.length; i++) {
    numbers[i] *= numbers[i];
}
{% endhighlight %}

Compare this to the functional approach. If you are writing in javascript you can use the great [lodash](https://lodash.com) library. However using a language specifically designed as an FP language is highly beneficial, so lets do it in elm.

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

The `import List (..)` line simply brings in all the core list functions that elm provides such as `map` and `filter`.

## Filtering

Now imagine we want to remove odd numbers from a list and only square the remaining even numbers. Approaching this naively and imperatively we may write:

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

Let's try this functionally:

{% highlight haskell %}
isEven : Int -> Bool
isEven n =
    n % 2 == 0

numbers : List Int
numbers =
    map square (filter isEven [1..9])
{% endhighlight %}

We can reuse our `square` function from before so we don't need to repeat ourselves for a slightly different behaviour.

And here's the brilliant thing about FP, you spend less time working out what the author intended. You can simply just read it, and this readability improves with chaining.

<!--
But what if we had a language where the `map`, `filter` and `range` methods are built in constructs much like the `for` loop exists within an imperative language.

_TODO: This isn't strictly true, import List (map,filter)_
_TODO: Probably should only introduce elm at the end summarizing it's benefits over functional in javascript._

This is where [elm](http://elm-lang.org) comes in:

{% highlight haskell %}
import List (map, filter)

square n =
    n * n

isEven n =
    n % 2 == 0

numbers =
    map square (filter isEven [1..9])
{% endhighlight %}
-->


## Chaining

If you were thinking this nesting of functions could get out of hand, you are right. In elm we can use `|>` operator to help us chain function calls.

The `|>` operator takes the value to it's left and passes this as the tail argument to the function on it's right.

{% highlight haskell %}
-- this
1 |> add 2

-- is equivalent to this
add 2 1
{% endhighlight %}

This helps you reduce the number of brackets you have to write, and makes your code easier to read. It becomes more like a sentence:

{% highlight haskell %}
numbers : List Int
numbers =
    [1..9] |> filter isEven
           |> map square
{% endhighlight %}

<!--
So with lodash in javascript we can chain the methods:

{% highlight js %}
numbers = _.chain(_.range(1,9))
           .filter(isEven)
           .map(square)
           .value();
{% endhighlight %}

This calls each function in turn passing it's output as the input for the subsequent function. Unfortunately we have to finish the chain with `.value()` to stop chaining and retrieve the actual result. There isn't any way around this in javascript.
-->

## Composition

An often better alternative to chaining is composition, [combining simple functions to build more complicated ones](https://en.wikipedia.org/wiki/Function_composition_(computer_science)).

In elm we can compose functions together using the `>>` operator. In this example we are checking to see if the square of a given number is odd:

{% highlight haskell %}
squareIsOdd =
    square >> isEven >> not -- `not` is a built-in function

squareIsOdd 3 == True
squareIsOdd 7 == False
{% endhighlight %}


## foo


There's a multitude of advantages (in my opinion) to using a functional language, and Elm is a fine example. Furthermore Elm compiles into HTML + JS so you can deploy it straight to the web or package it in [nw.js (formally node-webkit)](https://github.com/nwjs/nw.js) to create a standalone app or game.


<!--
## Isometric

So, the first actual task I had to look into was rendering an isometric tiled map. I've gone through several iterations of this already, and thanks to the ease of refactoring functional code this has taken no time at all.

I've settled on a data structure as below:

{% highlight js %}
-- World/World.elm
type alias Model =
    { tileList : World.TileList.Model }

-- World/TileList.elm
type alias Model =
    { tiles : List (ID, World.Tile.Model)
    , nextID : ID
    }

-- World/Tile.elm
type alias Model =
    { tileType : TileType
    , pos : World.Position.Model
    }

-- World/Position.elm
type alias Model =
    { x : Int
    , y : Int
    , z : Int }
{% endhighlight %}

A world can't just be displayed by itself, it requires either an editor or game to own it:

```
-- Editor/Editor.elm
type alias Model =
    { world : World.World.Model
    , interface : Editor.Interface.Model
    }
```

-->