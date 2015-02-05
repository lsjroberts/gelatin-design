---
title: Functional Programming
titleSmall: Developing games in Elm
titleStrong: Functional Programming
date: 2015-02-07
category: developing-games-in-elm
tags: project-iso elm
---

## Elm

I'll cover the question of _why elm?_ in a future post, but to summarise; I've grown tired of the traditional ways of architecting software. Imperative object-orientated code inevitably leads to frustrating issues like [side effects](http://www.wikiwand.com/en/Side_effect_(computer_science)), and frankly to my eyes it looks ugly.

Compare for example, the imperative:

```js
for (var i = 0; i < values.length; i++) {
    values[i] = doValue(values[i]);
}
```

To the functional:

```js
values = map(values, doValue);
```

There's a multitude of advantages (in my opinion) to using a functional language, and Elm is a fine example. Furthermore Elm compiles into HTML + JS so you can deploy it straight to the web or package it in [nw.js (formally node-webkit)](https://github.com/nwjs/nw.js) to create a standalone app or game.


## Isometric

So, the first actual task I had to look into was rendering an isometric tiled map. I've gone through several iterations of this already, and thanks to the ease of refactoring functional code this has taken no time at all.

I've settled on a data structure as below:

```elm
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
```
-->