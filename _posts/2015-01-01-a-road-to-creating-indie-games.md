---
layout: post
title: A road to creating indie games
titleSmall: A road to creating
titleStrong: indie games
date: 2015-01-01
category: games
---

I've been learning about and experimenting with making computer games for a number of years now. During school I started out making some browser-based text and input games about running nation states and their military and economy. After going to university and a few years working as a web dev I then entered the fantastic [Ludum Dare](http://ludumdare.com) game jam. I really can't remember what got me to enter that, but making my first actual game for it was an incredible experience. I was hooked on game development.

The following is part a stream of thought that's led me to game development and part a design concept for the game I'll be making this year and hopefully releasing early 2016.

## Why

When I first starting programming I began with C++ but soon moved to the web with HTML. The impetus for that move was a desire to see something more interesting than a dull terminal output. I wanted something that people could interact with, that I could show off to my friends and family. The web is a great option for that and the feedback is what drove me to pursue it as a career.

And, as a career, it is great. I love it. But I find the story you can tell via the web is limited, though as much by clients' requirements as technology and strict user experience issues. Experimentation on the web rarely leads to an increase in profits or happier customers.

This leads me to another interactive medium - games. Games hold a unique space in media and art, the relationship between the creator and viewer is what makes the game. As a piece of art it does not exist without both the designer and the player. A game entirely hinges on it's interactions, otherwise it is just a film. Even games which take this to it's extreme where the only interaction is merely to move around afford the player the choice to observe the world from their own preferred point of view.

While most art is made to be seen by other people, only in games can the interpretation be fundamentally changed by the observers choices. Taking them from observer to artist within the game's world.

## What

Having made a bunch of small games for various Ludum Dare jams or just for fun, I don't feel the need to make something with a tiny scope this time. I'm not looking to design a 5 minute experience, I want to engage the player and get them to stop and consider. Though obviously I'll still need to keep it within the realms of feasability for a solo developer.

Two tropes of modern games that I feel have been inadequately addressed are war and morality. To be fair, those are two massive topics and it would be arrogant and foolish of me to suggest I can address both of them perfectly and succinctly where all others have failed. Though without any need to recoup development costs I do feel I can address them from a less constrained angle.

The well discussed failure of many modern games' take on morality is the idea that it can be boiled down to some simple binary linear scale. While you may be able to do a mixture of "good" and "evil" actions, the mechanics often punish you for not sticking solely to one. This clearly does not reflect reality in any way missing out on all the nuances. Indeed in the real world there is often some dissonance between the actions taken and morality proclamined by an individual or group.

A recent game that has addressed morality in a more realistic manner is Telltale's _The Walking Dead_. It present's you with choices that have to be made in a limited amount of time. These choices have no "right" answer, and often times the choice taken has no ultimate bearing on what happens. However, you are made to feel you've made the right or wrong choice by different characters. They will comment, approve or get angry at you. Causing you to feel an emotion as a reaction to both having to make the choice and it's subsequent consequences, that is the root of a good morality system.

War is usually presented in one of two ways; completely coldly with no discussion on the reason or against a clearly defined "bad guy". The former is perfectly fine if it's simply a context for the gameplay, and the latter is sometimes messed with by having the "bad guy" change in some revelation story plot point.

But war in the real world is clearly infinitely more complex that that. Consider the [european wars of religion](http://en.wikipedia.org/wiki/European_wars_of_religion) of the 16th and 17th centuries. Even with hindsight it is essentially impossible to label any side as in the right, aggressor or not. The sheer brutality and inescapable unending destruction of the period is a feeling that should be represented.

To address this better a game should either in some way consider the war from both sides or acknowledge it is presented from a biased point of view. This could be done through something as simple as a character questioning orders and decisions the player makes, or through a satirical over-the-top glorification of the cause as done in _[Starship Troopers](http://www.imdb.com/title/tt0120201/)_.

For my game I'm going to try to ensure the player always has at least a nagging feeling they've made a mistake. You may have won a battle, but at what cost to the enemy's civilians? Was it justified to protect a smaller number of your own? Does that even matter? I won't present a explicit "right" answer, but various characters will react to your choices in different ways.

So if you take those points, throw in a bit of the tone of _[Papers, Please](http://papersplea.se/)_ and all in a Cold War-esque context you'll have what I'm aiming for.

## How

To keep the project realistically feasible I am going to take a well defined and iterated gameplay model in the style of the _[Advanced Wars](http://en.wikipedia.org/wiki/Advance_Wars)_ series and apply my desired tone and theme on top. The mechanics won't be straight up the same, but it provides a starting point from which I can expand as time allows.

This is not to say the mechanics are secondary. Certainly not. A game that is boring to play will be boring irregardless of how compelling it's story telling is. But the mechanics of combat will not be a priority but more a way to frame, drive and make choices. By keeping these mechanics fairly straightforward hopefully the player's focus won't stray too far from why they are choosing to bomb a city beyond just strategic concerns. Or indeed to let the player knowingly disregard all moral reasoning and place success above all else.

On the technical side, I'll be developing the game in [Elm](http://elm-lang.org/), a functional reactive language that compiles to HTML & javascript. The final game will be packaged and downloadable and not playable through a browser to help take out another variable for testing since there is a lot of inconsistency across browsers in animation speed. Additionally players tend to expect different things of browser games. I'll go into my reasons for using a functional language over more traditional options in a future post.

Since I am no great artist, I'm going to use assets by [Kenney](http://kenney.nl/assets) as a base for the isometric terrain and cities and modify them for my aethestic as needed. Once I'm further into the project I may look into hiring better artists for specifics such as character design.

Probably the biggest killer of personal projects is a loss of motivation. To combat this I am working on a 4-weekly sprint cycle with key targets for each sprint with the aim to producing something playable and different by the end of it. If I get ahead of schedule (as I did with my first sprint!) I'll just start the next sprint sooner. If it looks like I'll be ahead of schedule overall for the year I'll start expanding features.

Ideally I'll have gameplay finalised during the summer and will spent the latter part of the year writing in story specifics, embellishing characters and final art.

## Where

So this is the start of the road I'm taking. Where it'll take me this year and beyond I'm not sure. All I can hope is that I am able to reach the end of it and have something that people will enjoy. If I release it and even one stranger is a satisfied customer I'll consider this a success.

But there's always the dream...