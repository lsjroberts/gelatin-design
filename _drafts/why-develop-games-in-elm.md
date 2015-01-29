---
layout: post
title: Why develop games in Elm?
titleSmall: Why develop games in
titleStrong: Elm?
date: 2015-01-29
category: games
draft: true
tags: project-iso elm
---

I don't think I could count the time I have spent considering design patterns. Learning new patterns, comparing them with ones I already know, analysing use cases and experimenting. At a certain point I realised I just don't enjoy it. That side of programming is something I have grown tired of. I want to describe what should happen and it should just happen, and I want one best way to do it.

## Functional

It must be said straight away, functional programming is not an opposite to object-orientated programming. It is not the opposite of the standard gang-of-four design patterns. It is simply the alternative to imperative. The imperative coder lists the details of process, the functional coder describes the desired result.

However, the key brilliance of the functional style is the far lowered requirement for depending on design patterns. Functional is all about writing short descriptions of how an input should be mapped to an output, and composing these together to create the full description of your game.

Sure, you will be dealing with given patterns, but there's really just a singular way to approach a task. I guess this stems from the mathematical origins of functional programming. There's no "different way to sum a number", there's just sum. And multiply is just a map of sum _n_ times. I'm sure this is a point that could be argued but I've found so far getting stuff done takes far less cognitive effort due to being able to just write for the output I want.

Elm is a functional language that takes this philosophy to a brilliant conclusion and compiles into the web stack of HTML and javascript.

With Elm, instead of approaching your game with an intial thought of "how should I construct my program", you can jump straight in to writing your input data, mapping that to an ouptut and rendering it to the screen. And most importantly, you will not be punished in the future for taking this approach. In an imperative (and object-orientated) style you will be forced to refactor and refactor until it's cleaned away into a correct corner. The vast majority of refactoring with Elm is to generalise a function and extract specifics so it can be composed in new ways.

I recently did a refactor to create some better seperation of concerns. This took very little effort as I just moved the functions into better groups / files and after a couple of renames it all worked again. The same refactor on an imperitive and object-orientated codebase would have been a headache. Relationships would have to be redefined and data reorganised.

Please don't get me wrong, I'm not saying the entire games industry is wrong for not taking this approach, that would be hugely naive of me. The functional style simply appeals to how I work and think. And as a solo indie developer with a separate income stream I have the luxury of experimenting a little.

## Reactive

...

## Games

...