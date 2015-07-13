---
title: Architecture
titleSmall: Developing Games in Elm
titleStrong: Architecture
date: 2015-03-11
category: developing-games-in-elm
tags: project-iso elm
---

<!-- https://commondatastorage.googleapis.com/itchio/html/28464/dist/index.html -->

{:.note}
Elm: v0.14

If you haven't read my [previous](/developing-games-in-elm/functional-programming) [articles](/developing-games-in-elm/signals) I recommend you do that first.

I also highly recommend you [read this excellent intro to elm architecture](https://github.com/evancz/elm-architecture-tutorial/) by Evan Czaplicki, the author of elm. As a quick recap of that tutorial, an elm program can be separated into 4 main sections: model, update, view, input.

The **model** represents the state of the game. It is the record that is passed into the `foldp` function.

The **update** transforms the model through a defined list of actions, each action typically corresponds to a given input signal.

This model is then passed into the **view** which translates the data into the 2d or 3d representation on the screen.

Finally, the **input** is the list of signals that give your game the ability to react to the player and the environment.

_invaders ..._

{:.important}
There are some [major changes](https://groups.google.com/forum/#!topic/elm-discuss/CgHtzkrwlpA) coming up in the future for Elm with the introduction of promises and a replacement for signals with new terminology and some better functionality.
&nbsp;
As with other articles in this series I'll keep this up to date with all the changes in Elm.


## Main

As you may remember from the previous article, we'll need to start off with a main entry point to our game. In `Main.elm` we add the code to map the state's model onto it's view along with the window dimensions.

{% highlight haskell %}
module Main where

-- Our local imports
import State (view, state)

-- Core imports
import Signal (Signal, map2)
import Window (dimensions)
import Graphics.Element (Element)

{- Map the two signals of dimensions and state together onto the view
function, generating a signal of elements.
-}
main : Signal Element
main =
    map2 view dimensions state
{% endhighlight %}

Your main file will work essentially the same across every single game you make.

Keeping the main file this simple makes it very easy to swap views as and when we need to test them independantly of the rest of the codebase.


## Model

> The **model** represents the state of the game. It is a single record object that is built up of many constituent parts from each module.

When creating your game state I recommend keeping as few properties at the root as possible. If you are developing a simple game you could typically have only the primary actors in your record:

{% highlight haskell %}
type alias State =
    { player : Player
    , enemies : List Enemy
    }
{% endhighlight %}

If you are creating something with a greater depth, say multiple modes, menus & levels you'll want to put only the highest instance of each mode at the root, for example:

{% highlight haskell %}
type Mode = Game | Menu

type alias State =
    { mode : Mode
    , game : Maybe Game
    , menu : Maybe Menu
    }
{% endhighlight %}

The most important reason for keeping it structured this way is simply how much easier it makes updating and refactoring your code. If you want to add a further level you only need to edit the code directly related to levels, rather than jumping back up and modifying all the functions relating to the state.


### Extensible records

Extensible records allow you to generalise functionality so that it is resuable across many actors and other records in your game.

For example the vast majority of actors in a game will have a position and orientation within the world. To save defining this on each actor and having multiple similar update methods you can create a `Positionable` type alias constructor:

{% highlight haskell %}
type alias Vector =
    { x : Float
    , y : Float
    }

type alias Positionable a =
    { a | pos : Vector
        , rot : Vector
    }
{% endhighlight %}

We can even extend this to create a `Moveable` type:

{% highlight haskell %}
type alias Moveable a =
    ( Positionable
        { a | dir : Vector
            , vel : Vector
            , spd : Float
        }
    )
{% endhighlight %}

We can then use these for the player, gun and bullet types:

{% highlight haskell %}
type alias Player =
    ( Moveable
        { lives : Int
        , leftGun : Gun
        , rightGun : Gun
        }
    )

type alias Gun =
    ( Positionable
        { isFiring : Bool
        , fireRate : Time
        , fireCooldown : Time
        , bullets : List Bullet
        }
    )

type alias Bullet =
    ( Moveable {} )
{% endhighlight %}

For the player the nested record wih `lives`, `leftGun` and `rightGun` is passed into the `Moveable` constructor where the `pos` and `rot` properties are added.

A gun is not a moveable object, it is bound to the position of it's parent, so it only needs to extend `Positionable`.

The bullet does not need any additional properties so we can simply pass in a blank record to `Moveable`.


### Modules

With this [separation of concerns](http://www.wikiwand.com/en/Separation_of_concerns) you can move each distinct part into their own modules which can have an influence only on those modules below them in the hierarchy.

```
src/
    Game/
        Actor/
            Enemy.elm
            Player.elm
        Actor.elm
        Level.elm
        ...
    Menu/
        Main.elm
        Options.elm
        ...
    Game.elm
    Main.elm
    Menu.elm
    State.elm
```

{% highlight haskell %}
-- State.elm
module State where

import Menu
import Game

-- [behaviour relating only to state]
{% endhighlight %}

{% highlight haskell %}
-- Menu.elm
module Menu where

import Menu.Main as Main
import Menu.Options as Options

-- [behaviour relating only to switching menu context]
{% endhighlight %}

{% highlight haskell %}
-- Menu/Options.elm
module Menu.Options where

-- [behaviour relating only to the options menu]
{% endhighlight %}

With your modules structured like this, theoretically each module should be able to run independantly of all it's parents (though with a connection to the `main` and `foldp` functions).


## Update

> The **update** transforms the model through a defined list of actions, each action typically corresponds to a given input signal.

All games will have two core parts to their update logic, the `Action` data type and the `update : Action -> State -> State` function.

{% highlight haskell %}
type Action
    = NoOp
    | SetMode Mode

update : Action -> State -> State
update action state =
    case action of
        NoOp ->
            state

        SetMode m ->
            { state | mode <- m }
{% endhighlight %}

Most modules will replicate this for their own self-contained actions. Your player module might contain:

{% highlight haskell %}
type Action
    = Move Vector2D
    | Rotate Float
    | Fire

update : Action -> Player -> Player
update action player =
    case action of
        Move vector ->
            player |> Actor.move vector

        Rotate angle ->
            player |> Actor.rotate angle

        Fire ->
            player |> fire
{% endhighlight %}


### Talking to the top

{:.important}
This section is subject to change in elm v0.15 with different terminology and some change in functionality, though it will be broadly the same.

You may have noticed there appears to be an issue here: how does the a child module tell it's parent it has changed? If `Player.update` is called how is newly transformed instance of `Player` going to be given back to the `Game` record and subsequently that given back to the top level `State` record?

Well here we can use [local channels](http://package.elm-lang.org/packages/evancz/local-channel/1.0.0). Unfortunately local channels do have some major drawbacks that are being addressed in the next update to elm. So I'll post more on that in the future and will update this section.

For now you can see them in use in the [example game](/).


## View

Views turn the data into a visual representation _more_.


## Input

{:.important}
This section is subject to change in elm v0.15 with different terminology and some change in functionality, though it will be broadly the same.

I spoke about [signals in my previous article](/developing-games-in-elm/signals). _more_