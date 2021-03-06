---
layout: post
title: "Clean your HTML with Jade"
titleSmall: Clean your HTML with
titleStrong: Jade
date: 2014-02-16
category: coding
tags:
    - javascript
    - node
    - jade
---
As fundamental as html is to the web it is a bit of an ugly character. Angular brackets are a particular eyesore.

[Jade](http://jade-lang.com) is a terse almost python-like html templating language. It is primarily a nodejs package, but there are compilers for [PHP](http://stackoverflow.com/questions/13355137/php-jade-template-parser) and other languages as well.

<!-- more -->

It has a wonderfully basic syntax:

```jade
doctype html
html
    head
        title Hello World
        link(rel="stylesheet", href="build/styles/combined.css")
    body
        div.container
            p Hello World
```


## Layouts and blocks

Jade allows you to create layouts and extend them for your different views:

```jade
// layouts/master.jade
body
    block content

// index.jade
extends layouts/master

block content
    header.hero
        h1 Hello World
```


## Use mixins to power your views

Forms are probably the lamest thing to write in HTML, it can become a bore rather quickly. Using jade mixins you can speed this process up and cleanly define your form without all the verbosity.

```jade
// mixins/form.jade
mixin form(action, method)
    unless method
        - method= "get"
    form(action= action, method= method)
        if block
            block
        else
            p Looks like you forgot to add any inputs to your form

mixin field(name, type)
    label= name
    input(type= type, name= name)
```

```jade
// login.jade

include mixins/form

+form("auth/login", "post")
    +field("email", "text")
    +field("password", "password")
```

So that's pretty cool, but there's a lot more you can do with the field mixin. You can run any javascript inside jade, so we can add an <code>unslugify</code> function to convert "email_address" to "Email Address". Then add in some input type guessing and we've got something pretty useful really quickly.

```jade
// mixins/form.jade

//- ...

mixin field(name, type)
    //- Convert "foo_bar" to "Foo Bar"
    -var unslugify = function(input) {
    -   return input.charAt(0).toUpperCase() + input.slice(1).toLowerCase().replace(/[-|_](.)/g, function(match, group1) {
    -       return ' ' + group1.toUpperCase();
    -   });
    -}

    //- If no type has been set, try to pick an appropriate one
    unless type
        case name
            when "password"
                - type= "password"
            when "password_confirmation"
                - type= "password"
            when "email"
                - type= "email"
            default
                - type= "text"

    div.field
        label= unslugify(name)
        input(type= type, name= name)
```

```jade
// login.jade

include mixins/form

+form("auth/login", "post")
    +field("email")
    +field("password")
```


## Lovely

There's a few more things you can do in jade, [check out the reference](http://jade-lang.com/reference/) to see all your options. But hopefully you can see from this quick rundown how much cleaner you can make your views.

Coding should be fun and jade brings that enjoyment back to html.