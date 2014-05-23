var metalsmith = require('metalsmith'),
	drafts     = require('metalsmith-drafts'),
	markdown   = require('metalsmith-markdown'),
	permalinks = require('metalsmith-permalinks'),
	sass       = require('metalsmith-sass');

metalsmith(__dirname)
	.source('src')
	.destination('public')
	.use(drafts())
	.use(markdown())
	.use(permalinks('blog/post/:slug'))
	.use(sass({
        outputStyle: 'compact'
    }))
	.build();