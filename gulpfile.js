/**
 * Install:
 * $ npm install gulp gulp-minify-css gulp-autoprefixer gulp-ruby-sass gulp-coffee gulp-uglify gulp-concat gulp-rimraf gulp-notify
 */

var gulp = require('gulp');

// styles
var minifycss = require('gulp-minify-css');
var autoprefixer = require('gulp-autoprefixer');
var sass = require('gulp-ruby-sass');

// scripts
var coffee = require('gulp-coffee');
var uglify = require('gulp-uglify');

// other
var concat = require('gulp-concat');
var rimraf = require('gulp-rimraf');
var notify = require('gulp-notify');

// paths to assets
var paths = {
    styles: [
        'app/assets/styles/vendor/**/*.css',
        'app/assets/styles/**/*.css',
        'app/assets/styles/**/*.sass'
    ],
    scripts: {
        coffee: [
            'app/assets/scripts/**/*.coffee'
        ],
        js: [
            'app/assets/scripts/vendor/**/*.js',
            'app/assets/scripts/**/*.js'
        ]
    },
    images: [
        'app/assets/images/**/*'
    ],
    fonts: [
        'app/assets/fonts/**/*'
    ]
};

// clean out old styles build
gulp.task('styles-clean', function() {
    return gulp.src('public/build/styles/**/*.css')
        .pipe(rimraf());
});

// clean out old scripts build
gulp.task('scripts-clean', function() {
    return gulp.src('public/build/scripts/**/*.js')
        .pipe(rimraf())
});

// build styles
gulp.task('styles', ['styles-clean'], function() {
    return gulp.src(paths.styles)
        .pipe(sass({ style: 'compressed' }))
        .pipe(autoprefixer('last 2 versions'))
        .pipe(concat('combined.css'))
        .pipe(minifycss({ removeEmpty: true }))
        .pipe(gulp.dest('public/build/styles'))
        .pipe(notify({ message: 'styles built' }));
});

// build coffeescripts
gulp.task('scripts-coffee', function() {
    return gulp.src(paths.scripts.coffee)
        .pipe(concat('combined-coffee.coffee'))
        .pipe(coffee())
        .pipe(gulp.dest('app/assets/scripts'));
});

// build scripts
gulp.task('scripts', ['scripts-clean', 'scripts-coffee'], function() {
    return gulp.src(paths.scripts.js)
        .pipe(concat('combined.js'))
        // .pipe(uglify())
        .pipe(gulp.dest('public/build/scripts'))
        .pipe(notify({ message: 'scripts built' }));
});

// move & compress images
gulp.task('images', function() {
    return gulp.src(paths.images)
        .pipe(gulp.dest('public/build/images'))
        .pipe(notify({ message: 'images built'}));
});

// move fonts
gulp.task('fonts', function() {
    return gulp.src(paths.fonts)
        .pipe(gulp.dest('public/build/fonts'))
        pipe(notify({ message: 'fonts built' }));
});

// compile static assets
gulp.task('statics', ['fonts', 'images'], function() {

});

// file watchers
gulp.task('watch', function() {
    gulp.watch(paths.styles, ['styles']);
    gulp.watch(paths.scripts.js, ['scripts']);
    gulp.watch(paths.images, ['images']);
    gulp.watch(paths.fonts, ['fonts']);
});

// default
gulp.task('default', ['styles', 'scripts', 'images', 'fonts']);