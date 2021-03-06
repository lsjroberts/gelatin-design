---
layout: post
title: Creating a blog with Metalsmith
titleSmall: Creating a blog with
titleStrong: Metalsmith
date: 2014-05-24
category: coding
tags: javascript nodejs metalsmith jekyll
---
> Update: Since writing this article I've actually updated the site to use Jekyll. Various packages kept breaking due to version compatibility issues etc. I got bored and just switched over to a more stable solution.

I've been looking at converting this site to use a static-site generator. Prior to this I've been using a simple custom blog on top of Laravel. As much as I love Laravel, it seems a touch pointless to have all this dynamic code behind what is just static content pages.

With that in mind I had a look around at what the available options were. Jekyll seemed like a good choice and I began working on porting my content to it. However I wasn't particuarly sold, not sure why I just didn't feel happy using it. I wanted more control and to organise my files how I wanted.

Yesterday I saw a retweet about [Metalsmith](http://metalsmith.io) which looked very similar to [Gulpjs which I am already a big fan of](/blog/post/easily-build-assets-with-gulpjs). I started a few hours ago writing my build script and porting my content and now not long later it's all done.

I did have to do some work to get things how I wanted. Metalsmith is very hands-off so if you want list pages, pagination, tag pages etc you will have to write these yourself.

Fortunately it's dead simple to do. Plugins are easy to write and you can just manipulate the files being generated. So for example a tagging plugin could be written as so:

```js
var metalsmith  = require('metalsmith'),
    collections = require('metalsmith-collections');

metalsmith(__dirname)

    // group together all files in the `/blog/` directory as posts
    .use(collections({
        posts: {
            pattern: 'blog/*',
            sortBy: 'date',
            reverse: true,
        }
    }))

    // generate the tag listing pages
    .use(blogTagLists)

    // build
    .build(function(err) {
        if (err) throw err;
    });

function blogTagLists(files, metalsmith, done) {
    var tags = {};

    // loop the posts collection, creating new groups on the tags
    for (p in metalsmith.data.posts) {
        for (t in metalsmith.data.posts[p].tags) {
            tag = metalsmith.data.posts[p].tags[t];
            if (! tags[tag]) {
                tags[tag] = [];
            }

            tags[tag].push(metalsmith.data.posts[p]);
        }
    }

    // loop the tags and create a new index file for each tag
    for (tag in tags) {
        files['blog/tag/' + tag + '/index.md'] = {
            template: 'list.html',
            mode: '0644',
            contents: '',
            title: "Posts tagged '" + tag + "'",
            posts: tags[tag],
        }
    }

    done();
}
```

You can see my full [build.js file here](http://github.com/lsjroberts/gelatin-design/tree/master/build.js) along with the rest of the code for this site.

If you're looking for a static-site generator which gives you a lot of control then I really recommend [Metalsmith](http://metalsmith.io).