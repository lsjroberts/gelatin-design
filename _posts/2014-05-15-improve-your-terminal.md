---
layout: post
title: "Improve your terminal"
titleSmall: Improve your
titleStrong: Terminal
date: 2014-05-15
category: coding
tags: terminal
---
I believe one of the main contributing factors to people being wary of using the terminal is the terrible defaults for text and colours. The good news is that these are pretty easy to fix.

After going through the following changes you'll end up with a lovely terminal like this:

![lovely terminal](/images/blog/2014-05-15/lovely-terminal.png)

## Oh my zshell!

[on-my-zsh](https://github.com/robbyrussell/oh-my-zsh) is a must-have tool for frequent terminal users. It makes it easy to use themes for styling, but provides so much more functionality than that.

If you trust the author of that tool then you can install it by just running

```
$ curl -L http://install.ohmyz.sh | sh
```

That'll set up the default config at `~/.zshrc`.

If you want to you can install it manually, check that out at the [github repo](https://github.com/robbyrussell/oh-my-zsh).


### Pick a theme

I personally use the `ys` theme, it presents your current directory, git branch and status and the current type before each command you type. This lets you see at a glance what's going on and when you fired a long running command allowing you to see how long it's taking.

![ys line header](/images/blog/2014-05-15/ys-line-header.png)

To install your theme of choice, change your `~/.zshrc` to include

```
ZSH_THEME=ys
```


## Fonts and colours

In addition to your theme you should set your default text font and colour and your terminal background colour. On a Mac you can do this quite easily within the terminal preferences by going to `Terminal > Preferences...` and change the options under `Text` and `Window`. On Linux you can do this under `Edit > Profile Preferences`.

Picking a font is pretty important, it has to be monospaced and some good choices are Monaco, Source Code Pro, Inconsolata. I personally use Iconsolata.

Secondly you really should think about setting the font size to something nice and large, I go with 18px. You will be staring at your terminal for a long time, don't break your eyes to do it.

It's worth nothing, that while background transparency might look cool, it will definitely hinder your ability to focus and work, so please just set it to 100% opacity.

Finally, I personally like to add extra space between lines, I find it really helps reading, so I set line spacing to `1.5` and character spacing to `1.05`. But this will depend on your personal tastes and the font you chose.


## The terminal is the best place for a developer to develop

So much of development requires running a command-line tool here and there that you may as well just stay in the terminal the whole time. Don't use a gui program to manage your git repos, they are all slower than just running the git commands yourself. It takes time to learn but once you've learnt it you'll gain that back in time saved getting things done.

With that in mind I've been looking to get away from my final non-terminal based development tool, the text editor (Sublime Text 2 in my case). I've been learning vim, indeed I wrote this article with vim. It's fantastic. If you are interested in learning vim, run

```
$ vimtutor
```

and go through it's lessons every day and you'll soon get the hang of this powerful tool.

Once I'm comfortable using vim I'll write up a tutorial on customising it, though it might take a few weeks to get to that stage.

> Update: I never got comfortable with vim. It may be powerful, but good grief it's just way too frustrating to get there.