---
title: A Better Javascript Ecosystem
titleSmall: A Better
titleStrong: Javascript Ecosystem
author: Laurence Roberts
date: 2018-06-29
category: coding
tags: wool javascript
---

> **NOTE: THIS IS A DRAFT**

### Why?

[NPM](https://www.npmjs.com/) is wonderful, and the huge volume of packages it has enabled has been a tremendous boon to the world of javascript development. It has formed the backbone of the growth in this sector.

However, I feel it has some deep rooted flaws that can not be brushed over with tools or considered approaches.

To this end, here I am proposing a new ecosystem built upon tools and architecture that present solutions to the primary flaws of NPM.

### Goals

#### Reduce bloat, dependency quantity and size escalation

With bundling and tree shaking not everything in your `node_modules` ends up in the data sent to the user's browser, but having several hundred megabytes of dependencies is still a significant problem for developers.

A package can be installed multiple times at different versions, and the cost of adding one package is relatively opaque with the sprawling tree of secondary dependencies it adds.

Even just presenting that information upfront will encourage developers to pay attention and naturally reduce the quantity of dependencies and size of their packages.

And by caching each package in your home directory, each version is truly only installed once on your local machine.

> **Aside:** This is possible with [esm loader hooks](https://nodejs.org/api/esm.html#esm_loader_hooks).

#### Improve stability when upgrading dependencies

In theory, semantic versioning is supposed to protect you from upgrading a dependency to an incompatible version.

However, in practice, since the version of every NPM package is manually entered it still leaves a lot up to human interpretation.

So when you update dependencies to the latest versions within your existing constraints things can break unexpectedly. Particularly with large projects and several layers to the dependency tree.

Due to the nature of javascript it is impossible to eliminate this entirely, but it would not be hard to bake in automatic versioning support for at least the most clear-cut cases. Especially for typescript projects.

#### Namespaces for all

Having mandatory namespaces for all published packages lets developers know who they are depending on.

It lets groups be formed that focus on [maintaining high quality packages](https://thephpleague.com/).

And reduces the need for ever creative package names, so they can be more descriptive and clear.

#### Naturally deprecate stale and unsupported packages

By forcing packages to declare all their dependencies upfront, it will naturally encourage maintained packages to rise and stale packages to fall in usage.

Packages will become stale if they are not updated in line with new releases of node and other packages they use.

If a package you are using does become stale and there is no-one left to maintain it, you can fork it under your namespace and start maintaining it yourself.

Stale packages are a hidden problem on NPM, it is often difficult to tell if it simply does not require any updates or if it is no longer viable and will cause bugs. A combination of upfront dependencies, enforced node version compatibility and namespaces will help alleviate this issue.

> **Aside:** This is something [Elm](http://elm-lang.org) does, and I've yet to see any major complaints about dependency hell so... ¯\\_(ツ)_/¯ should be fine.

#### Enable a flexible architecture for large scale projects

[Lerna](https://lernajs.io/) is cool. [Yarn workspaces](https://yarnpkg.com/lang/en/docs/workspaces/) are cool. But they are both fairly rigid and limited in scope.

Imagine being able to have a true monorepo for all the packages within your purview at your job, yet also able to version packages independently and/or shared, in any grouping.

With all installed dependencies installed in your home directory there would be no need for hoisting and so resolves the often nightmarish issues that causes.

#### Decentralise registries for package hosting

Development ecosystems should be decentralised to help prevent monopolies and improve community agility, while empowering teams to work in the best way for their situation.

The ecosystem should allow developers to install from and publish to multiple registries, including their own, even an entirely local registry running on their machine.

#### Support businesses using on premise registries

A package registry should be free and open source to allow small businesses to benefit from the ability to host internal private packages.

It should be as simple as initialising a new registry, configuring a handful of parameters and running start.

### Proposal

Below there are three sections:

1. [Package Manager](#package-manager)
2. [Registries](#registries)
3. [Taking it Further](#further)

The ideas presented are based on my experience, what I like and dislike about various package managers across several languages and where I think they can be a bit more ambitious.

If you have any ideas or feedback, supportive or critical, please send me a tweet [@lsjroberts](https://twitter.com/lsjroberts) and I'd be more than happy to listen (and a little excited you read it to be honest).

> **Note**
>
> For the purposes of the proposal I have called the package manager wool, because yarn... wool... haha so funny right.
>
> The name is not so relevant and likely to change.

> **Also note**
>
> These are just ideas I am spouting into the wind, none of it exists yet outside small experiments. It is all open to change based on feedback, feasibility and other issues.

> **Also also note**
>
> I do not intend this to be an attack on NPM or anything else, and I am genuinely grateful to all the work put into it, since I use it every day. This is just some opining.

<h2 id="package-manager" class="part-header">
    Part One
    <strong>Package Manager</strong>
</h2>

```
wool init
```

```js
// wool.json
{
  "name": "lsjroberts/example",
  "version": "1.0.0",
  "registries": ["https://registry.wooljs.org"],
  "nodeVersion": "10.5.0 <= v < 11.0.0",
  "entry": "index.mjs",
  "dependencies": {}
}
```

### Adding dependencies

A package manager should be clear and explicit about what it is doing. If I install a dependency I want to know just how much extra it is going to grow my project.

```
wool add lsjroberts/other
```

```
To add lsjroberts/other I would like to install the following dependencies:

    lsjroberts/other  1.0.0 <= v < 2.0.0
    bob/package       3.4.0 <= v < 3.5.0
    alice/package     2.2.0 <= v < 3.0.0

Adding a total of 87.9kb to your dependencies

May I install these for you? [Y/n]
```

```
Installed 3 packages.

Your dependencies now total 87.9kb in size.
```

It should list all installed dependencies upfront.

```js
// wool.json
{
  "name": "lsjroberts/example",
  "version": "1.0.0",
  "registries": ["https://registry.wooljs.org"],
  "nodeVersion": "10.5.0 <= v < 11.0.0",
  "dependencies": {
    "alice/package": "2.2.0 <= v < 3.0.0",
    "bob/package": "3.4.0 <= v < 3.5.0",
    "lsjroberts/other": "1.0.0 <= v < 2.0.0"
  }
}
```

And maintain a record of the exact versions installed.

```js
// wool-lock.json
{
  "alice/package": {
    "version": "2.2.3",
    "range": "2.2.0 <= v < 3.0.0",
    "registry": "https://registry.wooljs.org"
  },
  "bob/package": {
    "version": "3.4.0",
    "range": "3.4.0 <= v < 3.5.0",
    "registry": "https://registry.wooljs.org"
  },
  "lsjroberts/other": {
    "version": "1.0.13",
    "range": "1.0.0 <= v < 2.0.0",
    "registry": "https://registry.wooljs.org"
  }
}
```

> **Note**:
>
> Other potential methods include: removing the `wool-lock.json` and having the full dependency specification in `wool.json`, only putting directly added packages in `wool.json` and moving secondary dependencies into `wool-lock.json`.

### Automated adding

It should detect missing dependencies in my code and install them for me.

```js
import missing from 'lsjroberts/missing';
missing();
```

```
It looks like lsjroberts/missing has not been installed, should I add this for you? [Y/n]
```

```
To add lsjroberts/missing I would like to install the following dependencies:

    lsjroberts/missing  1.0.0 <= v < 2.0.0

Adding a total of 12.1kb to your dependencies

May I install these for you? [Y/n]
```

### Offline first

It should cache the dependencies on my machine to allow offline development.

```
~/.wool/
├─ packages/
│  ├─ alice/
│  │  └─ package/
│  │     ├─ 2.2.0/
│  │     └─ 2.2.3/
...
```

### Conflicting dependency versions

It should protect me from conflicting packages.

```
wool add bob/conflicting
```

```
To add bob/conflicting I would like to install the following dependencies:

    bob/conflicting  3.0.0 <= v < 4.0.0
    bob/package      2.0.0 <= v < 3.0.0

However this would conflict with your current dependencies:

    bob/package  3.4.0 <= v < 3.5.0

Therefore I am unable to install bob/conflicting safely.

If I install this you will no longer be able to publish this package to https://registry.wooljs.org.

Should I go ahead and install it? [Y/n]
```

```js
// wool.json
{
  "name": "lsjroberts/example",
  // ...
  "dependencies": {
    "alice/package": "2.2.0 <= v < 3.0.0",
    "bob/package": [
      "2.0.0 <= v < 3.0.0",
      "3.4.0 <= v < 3.5.0"
    ],
    "lsjroberts/other": "1.0.0 <= v < 2.0.0"
  }
}
```

### Outdated and future packages

It should protect me from outdated and future packages.

```
wool add alice/future
```

```
To add alice/future I would like to install the following dependencies:

    alice/future  2.0.0 <= v < 3.0.0

But none of the versions in that range work with Node 8.11.0. I recommend upgrading to Node 10.5.0, which is supported.
```

### Multiple registries

It should allow me to install packages from multiple registries.

```js
// wool.json
{
  "name": "lsjroberts/example",
  // ...
  "registries": [
    "https://registry.company.com",
    "https://registry.wooljs.org"
  ],
}
```

```
wool add company/package
```

```
To add company/package I would like to install the following dependencies:

    company/package  1.0.0 <= v < 2.0.0 (registry.company.com)
    alice/package    2.2.0 <= v < 3.0.0 (registry.wooljs.org)

Adding a total of 32.6kb to your dependencies

May I install these for you? [Y/n]
```

```js
// wool.json
{
  "name": "lsjroberts/example",
  // ...
  "registries": [
    "https://registry.company.com",
    "https://registry.wooljs.org"
  ],
  "dependencies": {
    "alice/package": "2.2.0 <= v < 3.0.0",
    "company/package": "1.0.0 <= v < 2.0.0"
  }
}
```

```js
// wool-lock.json
{
  "alice/package": {
    "version": "2.2.3",
    "range": "2.2.0 <= v < 3.0.0",
    "registry": "https://registry.wooljs.org"
  },
  "company/package": {
    "version": "1.0.2",
    "range": "1.0.0 <= v < 2.0.0",
    "registry": "https://registry.company.com"
  }
}
```

It the same package name is found on multiple registries, it would be resolved in priority from first to last registry listed.

> **Note**
>
> It may be useful for a developer to manually specifiy which registry is to be used for a dependency by using the full dependency specification as seen in `wool-lock.json`.

### Registry mirrors

It should install from mirrors if a registry is down.

```js
// wool.json
{
  "name": "lsjroberts/example",
  // ...
  "registries": [
    "https://registry.company.com",
    "https://registry.wooljs.org"
  ],
  "mirrors": {
    "https://registry.wooljs.org": [
      "https://registry.mirror1.org",
      "https://registry.mirror2.org"
    ]
  }
}
```

### Workspaces

It should support flexible workspaces.

Say I want a single repo for all my work, with the `main-core` and `main-extra` packages sharing a version and `other` indendently versioned.

```
repo/
├─ workspaces/
│  └─ main/
│  │  ├─ wool.json
│  │  ├─ main-core/
│  │  │  └─ wool.json
│  │  └─ main-extra/
│  │     └─ wool.json
│  └─ other/
│     └─ wool.json
└─ wool.json
```

```js
// wool.json
{
  "private": true,
  "registries": ["https://registry.wooljs.org"],
  "nodeVersion": "10.5.0 <= v < 11.0.0",
  "workspaces": [
    "workspaces/main",
    "workspaces/other"
  ]
}
```

Nested workspaces with independent or shared versioning can be freely defined.

```js
// workspaces/main/wool.json
{
  "private": true,
  "version": "1.2.0",
  "workspaces": [
    "main-core",
    "main-extra"
  ],
  "dependencies": {
    "bob/package": "3.4.0 <= v < 3.5.0",
    "lsjroberts/other": "workspace:workspaces/other"
  }
}
```

```js
// workspaces/main/main-core/wool.json
{
  "name": "lsjroberts/main-core"
}
```

```js
// workspaces/other/wool.json
{
  "name": "lsjroberts/other",
  "version": "2.3.0",
  "dependencies": {}
}
```

```
wool add alice/package -w main
```

```
To add alice/package I would like to install the following dependencies in your main workspace:

    alice/package  2.2.0 <= v < 3.0.0

Adding a total of 12.4kb to your main workspace dependencies

May I install these for you? [Y/n]
```

```
wool add alice/package -w main/main-core
```

```
The workspace main/main-core does not have any dependencies.

Should I try to install alice/package into your main workspace? [Y/n]
```

### Publishing

It should help me publish with accurate semantic versioning.

#### Minor

```
It looks like you have added 2 new exports:

    doThing()
    another()

Therefore this should be a minor release:

    1.0.0 => 1.1.0

Should I update the version, or enter manually? [Y/e/n]
```

#### Major

```
It looks like you have removed 1 export:

    thing()

Therefore this should be a major release:

    1.0.0 => 2.0.0

Should I update the version, or enter manually? [Y/e/n]
```

```
It looks like you have changed the signature of an export:

    -thing(foo: number): number
    +thing(foo: string): number

Therefore this should be a major release:

    1.0.0 => 2.0.0

Should I update the version, or enter manually? [Y/e/n]
```

#### Release

And tell me where my package was published.

```
Published lsjroberts/package 1.2.0 to https://registry.wooljs.org
```

#### Workspaces

It should publish all my workspaces.

```
It looks like you've added 4 new exports:

    doThing() (main/main-core)
    extraThing() (main/main-extra)
    otherThing() (other)
    anotherThing() (other)

And removed 1 export:

    otherOldThing() (other)

And made non-exported changes:

    src/something.ts (main/main-core)

Therefore main should be a minor release:

    1.2.0 => 1.3.0
      main-core
      main-extra

And other should be a major release:

    2.3.0 => 3.0.0

Should I update the version, or enter manually? [Y/e/n]
```

```
Published lsjroberts/main-core 1.3.0 to https://registry.wooljs.org
Published lsjroberts/main-extra 1.3.0 to https://registry.wooljs.org
Published lsjroberts/other 3.0.0 to https://registry.wooljs.org
```

### NPM

It should allow me to benefit from the vast swathes of existing code from the community.

```js
// wool.json
{
  "name": "lsjroberts/example",
  // ...
  "registries": [
    "https://registry.wooljs.org",
    "https://npmjs.org"
  ]
}
```

```
wool add react
```

```
To add react I would like to install the following dependencies:

    react  16.4.0 <= v < 17.0.0

However this includes the following npm modules:

    react

These will be installed into ./node_modules along with their additional dependencies and not tracked by wool.

You will no longer be able to publish lsjroberts/example to https://registry.wooljs.org.

Are you sure you wish to continue? [Y/n]
```

```
Installed 1 npm package.
```

```js
// wool.json
{
  "name": "lsjroberts/example",
  // ...
  "registries": [
    "https://registry.wooljs.org",
    "https://npmjs.org"
  ],
  "dependencies": {
    "react": "16.4.0 <= v < 17.0.0"
  }
}
```

```js
// wool-lock.json
{
  "alice/package": {
    "version": "2.2.3",
    "registry": "https://registry.wooljs.org"
  },
  "bob/package": {
    "version": "3.4.0",
    "registry": "https://registry.wooljs.org"
  },
  "lsjroberts/other": {
    "version": "1.0.13",
    "registry": "https://registry.wooljs.org"
  },
  "react": {
    "version": "16.4.3",
    "registry": "https://npmjs.org"
  }
}
```


<h2 id="registries" class="part-header">
    Part Two
    <strong>Registries</strong>
</h2>

As stated earlier, development ecosystems should be decentralised. To make this easy and actually practical it should be based on open source packages and baked in to the package manager.

```
wool init --registry
```

```js
// wool.json
{
  "name": "lsjroberts/my-registry",
  "version": "1.0.0",
  "registries": ["https://registry.wooljs.org"],
  "nodeVersion": "10.5.0 <= v < 11.0.0",
  "scripts": {
    "start": "wool-registry start"
  },
  "dependencies": {
    "wool/registry": "1.0.0 <= v < 2.0.0",
    "wool/registry-ui": "1.0.0 <= v < 2.0.0",
    "wool/registry-core": "1.0.0 <= v < 2.0.0"
  }
}
```

```
wool run start
```

```
Serving lsjroberts/my-registry

    localhost:8080
    0 packages being served
```

You can then publish packages to this registry.

```js
// example/wool.json
{
  "name": "lsjroberts/example",
  "version": "1.0.0",
  "registries": ["http://localhost:8080"]
}
```

```
wool publish
```

```
Published lsjroberts/example 1.0.0 to http://localhost:8080
```

You can configure your registry to work exactly how you want.

Perhaps you want to limit it to just typescript projects to further guarantee semantic versioning. Or reject packages that include dependencies from other registries, like NPM or outside your company.

Perhaps even require all packages be reviewed and approved before they can be published.

```js
// wool.json
{
  "name": "lsjroberts/my-registry",
  // ...
  "registryRules": {
    "extensions": [".ts"]
    "rejectConflicts": true,
    "rejectRegistries": ["https://npmjs.org"],
    "requireApproval": false,
  }
}
```

<h2 id="further" class="part-header">
    Part Three
    <strong>Taking it Further</strong>
</h2>

By creating the registries in this way it leaves open a space for innovation and ideas.

How about a peer-to-peer registry with distributed code? Perhaps utilising the [Dat protocol](https://datproject.org/). Publishing a package would create a `.dat` folder on your machine then share its `dat://` url with the network to be synchronised and distributed.

It you enjoy a bit of the hype train perhaps you could create a registry on a blockchain. Maintaining popular packages gives you coins you can spend promoting other packages or buying hats for your avatar.

If your business is true enterprise scale and needs to serve thousands of developers across the world you can host your own registry on some big cloud server farm, and mirror any less reliable registries you don't want to block your team from downtime.

And if your team is smaller and just needs to share a handful of in-house packages you can boot up a registry on the old spare box in the corner.

---

There's a lot that could be done with this approach, and I feel giving developers and businesses the control and freedom to choose how they build their personal and community ecosystem would only strengthen this rapidly growing sector.

## Addendum

If you've used [Elm](http://elm-lang.org/) you may have noticed some similarities in language and concepts. If you haven't then I'd recommend taking a look to get some of the benefits outlined here.

If you have any ideas or feedback, supportive or critical, please send me a tweet [@lsjroberts](https://twitter.com/lsjroberts) and let's have a chat.
