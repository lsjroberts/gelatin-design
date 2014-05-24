var metalsmith = require('metalsmith'),
    branch     = require('metalsmith-branch'),
    ignore     = require('metalsmith-ignore'),
    drafts     = require('metalsmith-drafts'),
    templates  = require('metalsmith-templates'),
    markdown   = require('metalsmith-markdown'),
    permalinks = require('metalsmith-permalinks'),
    sass       = require('metalsmith-sass');

metalsmith(__dirname)
    .source('src')
    .destination('public')
    .use(markdown())
    .use(branch('blog/*')
        .use(drafts())
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