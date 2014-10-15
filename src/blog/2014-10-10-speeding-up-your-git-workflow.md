---
template: post.html
title: Speeding up your git workflow
slug: speeding-up-your-git-workflow
date: 2014-10-10
tags:
    - coding
    - git
---

If you are doing a small task frequently then spending a little time to speed up that task really can pay off in a significant way ([relevant xkcd](https://xkcd.com/1205/)). As a developer there are few tools you will be interacting with more times a day than git, so lets speed it up!

## Alias git

First things first, you are going to want to alias `git` to something even shorter. Open up your `.bash_profile` (or `.zshrc` [if you are using that](/blog/post/improve-your-terminal)) in nano or whatever and append:

```
alias g="git"
```

Now you will be able to reference commands like `git checkout master` using just `g checkout master`.


## Alias git's commands

That's a good start but `checkout` is a lot of characters, let's bring that down along with all the other git commands. Git comes with it's own aliasing which you can configure by running this in your terminal:

```
g config --global alias.a add
g config --global alias.b branch
g config --global alias.c commit
g config --global alias.cf config
g config --global alias.co checkout
g config --global alias.s status
g config --global alias.sh stash
g config --global alias.pl pull
g config --global alias.ps push
```

Now your typical workflow can be reduced to:

```
$ g co -b "feature/foo"
$ g a .
$ g c -m "Added foo"
$ g ps
```

This is pretty great, it may seem like only a few characters but if you are typing those characters dozens of times a day it can add up quickly.


## Alias your workflow

And we can take it one final step further. What is your most common action? Pulling down the latest changes, adding and commiting yours on top and then pushing back up. So lets shorten that as far as we possibly can. Once again, open up and edit your `.bash_profile` or `.zshrc` file and append it with a custom method:

```
gqc() {
    g sh && g pl && g sh pop && g a -A && g c -m $1 && g ps
}
```

Here we stash any local changes, pull the remote, pop our local changes, add them, then commit with the first argument as the message and finally push them up. You can call it like so:

```
$ gqc "Updated foo"
```

What would have required 80 keystrokes can now be done in 18. At 60 wpm that's a saving of about 4.5 seconds each time (not counting waiting) which could be up to 3 minutes a day. That's around 12 hours a year. Or 20 days in a 40 year career! 20 days saved, from what is a 5 minute job!

Amazing.

_totally accurate numbers..._