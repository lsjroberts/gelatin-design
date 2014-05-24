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
    .use(collections({
        posts: {
            pattern: 'blog/*',
            sortBy: 'date',
            reverse: true,
        }
    }))
    .use(blogIndexList)
    .use(markdown())
    .use(branch('blog/*')
        .use(drafts())
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
        posts = metalsmith.data.posts,
        perPage = 2;

    index.posts = posts.slice(0,perPage);
    index.numPages = perPage / posts.length;

    done();
}

function blogTagList(files, metalsmith, done) {

}