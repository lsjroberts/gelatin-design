---
title: Sprint Two - World Editor
titleSmall: Sprint Two
titleStrong: World Editor
date: 2015-02-10
category: project-iso
---

For this, the second sprint, I focused on refactoring my original ideas and developing the initial world editor with river and elevation brushes.

## Refactor

A few weeks ago [Evan](https://twitter.com/czaplic) (the author of Elm) wrote a tutorial on [architecture in Elm](https://github.com/evancz/elm-architecture-tutorial). This is a fantastic resource that you should definitely read if you are already using or interested in Elm.

I used this as a guide to refactoring the code and experiments from [sprint one](/project-iso/sprint-one-experiments) rendering an isometric map.

## Render

Before I could start on editing a map I needed to render it out to the screen. The existing code from the previous sprint worked, but was not at all open to dynamically changing the different tiles. Admittedly a simpler route would have been to just use text files or one of the existing isometric tile layout tools. However I fully intend to release the world editor as part of the game, and honestly it felt like a good place to start with learning a few techniques in elm.

The default world is an 8 by 8 grid of blank tiles. There's a slight offset rendering issue with the tiles at the moment, but it's placeholder so that's something for another day.

![Default world](/images/blog/2015-02-10/default-world.png)

## Editor

Having sorted out the world rendering, I needed to add the ability to edit the map through an interface. There were a few tricky technical problems I had to overcome but once I understood how to get it done, building it was fairly straightforward.

There remains many issues but I've got the basic principle down. I'll need to add intelligent painting of elevation and rivers that adds slopes around hills and curves rivers.

I haven't yet implemented saving and loading since there is some discussion on the elm mailing list about coming future changes which will have an impact here. So I'll leave this to a future sprint.

![Default world](/images/blog/2015-02-10/editor-interface.gif)

It's not a terribly exciting game so far (since there's no actual gameplay...), but I need to develop an [MVP](http://en.wikipedia.org/wiki/Minimum_viable_product) for the upcoming [Rezzed](http://www.egx.net/rezzed) conference in case anyone cares to ask. So the next couple of sprints will focus on actual combat gameplay, and perhaps initial conversation mechanics if I have time.