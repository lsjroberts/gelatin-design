<p>I have spent so many hours trying to find the perfect build process for my less/sass stylesheets and coffeescripts. There are several php packages for this but I've never been too happy with them and they often seem to fail for various and difficult to debug reasons.</p>

<p>{{ link_to('http://gulpjs.com', 'Gulpjs') }} is the answer to all your woes. It is a command-line tool that simply allows you to run build tasks.</p>

@if (isset($split) and $split)
    <p><em>{{ link_to_route('blog.post', 'Continue reading "' . $article->title . '" ...', ['slug' => $article->slug]) }}</em></p>
@else


<h2>Getting started with gulp</h2>

<p>Follow {{ link_to('https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md#getting-started', 'these instructions') }} to get gulp installed and running.</p>

<h3>Plugins</h3>

<p>There are numerous plugins available for gulp which provide all the functionality you could want.</p>

<p>You can install plugins through npm:</p>

<pre>
npm install gulp-concat gulp-coffee
</pre>

<p>Then require them at the top of your <code>gulpfile.js</code>:</p>

<pre class="prettyprint js">
var concat = require('gulp-concat');
var coffee = require('gulp-coffee');
</pre>

<h3>Writing tasks</h3>

<p>A good use case of gulp is compiling and combining coffeescripts in a single javascript file. So lets start with our first task:</p>

<pre class="prettyprint js">
gulp.task('coffeescripts', function() {
    return gulp.src('assets/scripts/**/*.coffee')
        .pipe(concat('combined.coffee'))
        .pipe(coffee())
        .pipe(gulp.dest('build/scripts/combined.js'));
});
</pre>

<p>This task finds all <code>.coffee</code> files in any folder within your scripts directory. These are combined into a single file then piped into a plugin that compiles coffeescripts into javascript and finally pushed into your build directory.</p>

<p>It is important to combine your coffeescripts before compiling them. This will ensure that all your classes are defined within a single <code>(function() { ... });</code> block and can easily reference each other without having to resort to the global <code>window</code> object.</p>

<p>You can run this task with <code>gulp coffeescripts</code> in your terminal.</p>


<h2>Task dependancies</h2>

<p>So now you've got your coffeescripts compiling, you may also have some vendor javascripts that you want to also be built into the <code>combined.js</code> file. If you pipe these into your <code>coffee()</code> plugin you'll get a bunch of errors. Instead it is best to have a separate task that only runs on <code>.js</code> files.</p>

<pre class="prettyprint js">
gulp.task('coffeescripts', function() {
    return gulp.src('assets/scripts/**/*.coffee')
        .pipe(concat('combined-coffee.coffee'))
        .pipe(coffee())
        .pipe(gulp.dest('assets/scripts/'));
});

gulp.task('scripts', ['coffeescripts'], function() {
    return gulp.src('assets/scripts/**/*.js')
        .pipe(concat('combined.js'))
        .pipe(uglify())
        .pipe(gulp.dest('build/scripts'));
});
</pre>

<p>By passing in <code>['coffeescripts']</code> to the <code>scripts</code> task you ensure it is run first. This compiles the coffeescripts into <code>combined-coffee.js</code> which is then combined with normal javascript files.</p>

<p>The uglify plugin minifies the scripts before they are piped into the build directory:</p>

<pre class="prettyprint js">
var uglify = require('gulp-uglify')
</pre>

<p>Running <code>gulp scripts</code> will now run the coffeescripts and scripts tasks.</p>


<h2>Watchers and automated builds</h2>

<p>Having to run the gulp command every time you make a change to a file is a bit of a faff, this can be automated for you using watchers.</p>

<pre class="prettyprint js">
gulp.task('watch', function() {
    gulp.watch([
        'assets/scripts/**/*.coffee',
        'assets/scripts/**/*.js'
    ], ['scripts']);

    gulp.watch([
        'assets/styles/**/*.sass',
        'assets/styles/**/*.css'
    ], ['styles']);
});
</pre>

<p>If any changes are made to one of the specified files, the related task will be run. You can start the watcher with:</p>

<pre>
gulp watch
</pre>


<h2>Taking it further</h2>

<p>There are {{ link_to('http://gulpjs.com/plugins/', 'lot of existing plugins for gulp') }} and I'd suggest taking some time to look through and see which ones might prove useful in your code environment.</p>

<p>This {{ link_to('https://gist.github.com/lsjroberts/8810740', 'example build script') }} shows how I run my usual full build process, feel free it use it as you wish.</p>

<p>You may wish to install your dependancies through a <code>package.json</code> file and running <code>npm install</code> to ensure all your developers are working with the same node modules.</p>

@endif