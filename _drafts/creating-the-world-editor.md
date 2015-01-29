---
title: Creating the world editor
titleSmall: Sprint Two - Creating the
titleStrong: World Editor
date: 2015-02-08
category: games
tags: project-iso elm
---

I'm splitting development into sprints with set objectives. The primary target is to develop the game to a playable state at the end of each sprint. This is to ensure motivation is maintained and the progress can be tested and feedback can be received on the current state.

For this, the second sprint, I focused on refactoring my original ideas and developing the initial world editor with river and elevation brushes.

## Refactor

A few weeks ago [Evan](https://twitter.com/czaplic) (the author of Elm) wrote a tutorial on [architecture in Elm](https://github.com/evancz/elm-architecture-tutorial). This is a fantastic resource that you should definitely read if you are already or are interested in using Elm.

I used this as a guide to refactoring my initial ideas and experiments on rendering an isometric map.

## Render

Before I could start on editing a map I needed to render it out to the screen. Admittedly a simpler route would have been to just use text files or one of the existing isometric tile layout tools. However I fully intend to release the world editor as part of the game, and honestly it felt like a good place to start with learning a few techniques in elm.

So now in `World` I have defined a default world as:

```haskell
default : Model
default =
    { tileList = World.TileList.update
        (World.TileList.Fill World.Tile.GrassTile (10,10))
        World.TileList.default
    }
```

This fires off an update action to the `TileList` model (which defaults to a single grass tile). The update fills a 10 by 10 grid with grass tiles.



## Editor