---
title: Creating Websites in Elm
titleSmall: Creating Websites in
titleStrong: Elm
date: 2015-08-07
category: coding
tags: elm
---

{:.note}
Elm: v0.15.1

Creating large highly interactive websites almost always leads to thousands of lines of impenatrable & overly complex javascript. Dozens of frameworks have been made trying to overcome this painful situation.

The concepts and approach presented by React are fantastic, but personally I find the implementation to be barely any improvement over more traditional Backbone and Angular applications.

The industry is trying to move into the world of fully reactive web apps and Elm is the simple and maintainable solution.


## Setup

If you have not already, install elm by following the [instructions on the website](http://elm-lang.org/).

### Project Structure

```
elm-stuff/
public/
src/
elm-package.json
```

## Start

{% highlight bash %}
$ cd /path/to/project
$ elm package install evancz/start-app
$ elm package install evancz/elm-html
{% endhighlight %}

Create your `Main.elm` and wire up the `StartApp` with:

{% highlight haskell %}
module Main where

import Html exposing (..)
import StartApp

main : Signal Html
main =
  StartApp.start
    { model = initialModel
    , view = view
    , update = update
    }

initialModel : Model
initialModel =
  "Hello, World!"

view : Address Action -> Model -> Html
view address model =
  p [ ] [ text model ]

update : Address Action -> Model -> Model
update address model =
  model
{% endhighlight %}

The start app follows the standard elm architecture pattern, the `model` represents the state of your application, `view` describes how the state is displayed and `update` changes the state in reaction to events.

Don't worry about stuff you don't quite understand yet, ...

### Model

foo

### View

foo

### Update

foo


## Html

We've already installed and imported the Html package, so lets start building our views.

{% highlight haskell %}
view : Address Action -> Model -> Html
view address model =
  section [ class="home" ]
    [ h1 [ ] [ text "Hello, World!" ]
    , p [ ] [ text "Lorem ipsum dolor sit amet" ]
    ]
{% endhighlight %}


## Markdown

{% highlight bash %}
$ elm package install evancz/elm-markdown
{% endhighlight %}


## Routing

{% highlight bash %}
$ elm package install TheSeamau5/elm-router
$ elm package install TheSeamau5/elm-history
{% endhighlight %}


## JSON

{% highlight bash %}
$ elm package install evancz/elm-json
{% endhighlight %}

