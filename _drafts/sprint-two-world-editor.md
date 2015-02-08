---
title: Sprint Two - World Editor
titleSmall: Sprint Two
titleStrong: World Editor
date: 2015-02-08
category: project-iso
---

For this, the second sprint, I focused on refactoring my original ideas and developing the initial world editor with river and elevation brushes.

## Refactor

A few weeks ago [Evan](https://twitter.com/czaplic) (the author of Elm) wrote a tutorial on [architecture in Elm](https://github.com/evancz/elm-architecture-tutorial). This is a fantastic resource that you should definitely read if you are already using or interested in Elm.

I used this as a guide to refactoring the code and experiments from [sprint one](/project-iso/sprint-one-experiments) rendering an isometric map.

## Render

Before I could start on editing a map I needed to render it out to the screen. The existing code from the previous sprint worked, but was not at all open to dynamically changing the different tiles. Admittedly a simpler route would have been to just use text files or one of the existing isometric tile layout tools. However I fully intend to release the world editor as part of the game, and honestly it felt like a good place to start with learning a few techniques in elm.

The default world is an 8 by 8 grid of blank tiles. There's a slight offset rendering issue with the tiles at the moment, but it's placeholder so meh.

![Default world](/images/blog/2015-02-11/default-world.png)

## Editor

Having sorted out the world rendering, I needed to add the ability to edit the map through an interface. There were a few tricky technical problems I had to overcome which you'll be able to read about soon if you are interested in that. Once I understood how to get it done, building it was fairly straightforward.

_TODO: you haven't finished it yet Laz! Add 2nd paragraph._

![Default world](/images/blog/2015-02-11/default-world.png)