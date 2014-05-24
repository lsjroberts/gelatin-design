var metalsmith = require('metalsmith')
    async      = require('async')
    prompt     = require('cli-prompt');

metalsmith(__dirname)
    .use(ask)
    .use(template)
    .build(function(err) {
        if (err) throw err;
    });

function ask(files, metalsmith, done) {
    var prompts = ['Title', 'Slug', 'Tags', 'Date'],
        defaults = {'Date': (new Date).toISOString().slice(0,10)},
        metadata = metalsmith.metadata();

    async.eachSeries(prompts, run, done);

    function run(key, done) {
        question = ' ' + key;
        if (defaults[key]) question += ' (' + defaults[key] + ')';
        question += ': ';
        prompt(question, function(val) {
            metadata[key] = (val) ? val : defaults[key];

            if ('title' == key) {
                defaults['Slug'] = val.toLowerCase();
            }

            done();
        });
    }
}

function template(files, metalsmith, done) {

}