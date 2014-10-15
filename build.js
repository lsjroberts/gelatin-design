var metalsmith  = require('metalsmith'),
    branch      = require('metalsmith-branch'),
    ignore      = require('metalsmith-ignore'),
    drafts      = require('metalsmith-drafts'),
    templates   = require('metalsmith-templates'),
    markdown    = require('metalsmith-markdown'),
    permalinks  = require('metalsmith-permalinks'),
    collections = require('metalsmith-collections'),
    sass        = require('metalsmith-sass')

    moment      = require('moment');

metalsmith(__dirname)
    .source('src')
    .destination('public')
    .use(drafts())
    .use(collections({
        posts: {
            pattern: 'blog/*',
            sortBy: 'date',
            reverse: true,
        }
    }))
    .use(blogIndexList)
    .use(blogTagLists)
    .use(markdown({
        highlight: function (code) {
            return require('highlight.js').highlightAuto(code).value;
        }
    }))
    .use(branch('blog/*')
        .use(formatDate)
        .use(permalinks({
            pattern: 'blog/post/:slug'
        }))
    )
    .use(templates({
        engine: 'swig',
        directory: 'src/templates',
    }))
    .use(ignore([
        'templates/*'
    ]))
    .use(sass({
        outputStyle: 'compressed'
    }))
    .build(function(err) {
        if (err) throw err;
    });

function formatDate(files, metalsmith, done) {
    for (file in files) {
        files[file].date = moment(files[file].date).format('Do MMMM, YYYY');
    }
    done();
}

function blogIndexList(files, metalsmith, done) {
    var index = files['index.md']
        posts = metalsmith.metadata().posts,
        perPage = 2;

    index.posts = posts.slice(0,perPage);
    index.currentPage = 1;
    index.numPages = Math.ceil(posts.length / perPage);
    index.pagination = [];

    for (var i = 1; i <= index.numPages; i++) {
        index.pagination.push({
            num: i,
            url: (1 == i) ? '/' : '/index/' + i
        });

        if (i > 1) {
            files['index/' + i + '/index.md'] = {
                template: 'list.html',
                mode: '0644',
                contents: '',
                title: 'Page ' + i + ' of ' + index.numPages,
                posts: posts.slice((i-1) * perPage, ((i-1) * perPage) + perPage),
                currentPage: i,
                numPages: index.numPages,
                pagination: index.pagination,
            }
        }
    }

    done();
}

function blogTagLists(files, metalsmith, done) {
    var tags = {};

    for (p in metalsmith.metadata().posts) {
        if (!metalsmith.metadata().posts[p]) continue;
        for (t in metalsmith.metadata().posts[p].tags) {
            tag = metalsmith.metadata().posts[p].tags[t];
            if (! tags[tag]) {
                tags[tag] = [];
            }

            tags[tag].push(metalsmith.metadata().posts[p]);
        }
    }

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