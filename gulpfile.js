// --------------------------------------------------
// [Gulpfile]
// --------------------------------------------------

'use strict';

var gulp 		= require('gulp'),
    sass 		= require('gulp-sass'),
    changed 	= require('gulp-changed'),
    cleanCSS 	= require('gulp-clean-css'),
    rtlcss 		= require('gulp-rtlcss'),
    rename 		= require('gulp-rename'),
    uglify 		= require('gulp-uglify'),
    pump 		= require('pump');
var devDomain = 'perlick.dev';
var browserSync = require('browser-sync').create();


// Gulp plumber error handler
function errorLog(error) {
    console.error.bind(error);
    this.emit('end');
}


// --------------------------------------------------
// [Libraries]
// --------------------------------------------------

// Sass - Compile Sass files into CSS
gulp.task('sass', function () {
    gulp.src('src/scss/**/*.scss')
        .pipe(changed('./assets/css/'))
        .pipe(sass({ outputStyle: 'expanded' }))
        .on('error', sass.logError)
        .pipe(gulp.dest('./assets/css/'))
        .pipe(browserSync.reload({
            stream: true
        }));
});

// Minify CSS
gulp.task('minify-css', function() {
    // Theme
    gulp.src(['./assets/css/style.css', '!./assets/css/style.min.css'])
        .pipe(cleanCSS({debug: true}, function(details) {
            console.log(details.name + ': ' + details.stats.originalSize);
            console.log(details.name + ': ' + details.stats.minifiedSize);
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('./assets/css/'));

    // RTL
    gulp.src(['./assets/css/layout-rtl.css', '!./assets/css/layout-rtl.min.css'])
        .pipe(cleanCSS({debug: true}, function(details) {
            console.log(details.name + ': ' + details.stats.originalSize);
            console.log(details.name + ': ' + details.stats.minifiedSize);
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest('./assets/css/'));
});


// RTL CSS - Convert LTR CSS to RTL.
gulp.task('rtlcss', function () {
    gulp.src(['./assets/css/layout.css', '!./assets/css/layout.min.css', '!./assets/css/layout-rtl.css', '!./assets/css/layout-rtl.min.css'])
        .pipe(changed('./assets/css/'))
        .pipe(rtlcss())
        .pipe(rename({ suffix: '-rtl' }))
        .pipe(gulp.dest('./assets/css/'));
});


// Minify JS - Minifies JS
gulp.task('uglify', function (cb) {
    pump([
            gulp.src(['./assets/js/**/*.js', '!./assets/js/**/*.min.js']),
            uglify(),
            rename({ suffix: '.min' }),
            gulp.dest('./assets/js/')
        ],
        cb
    );
});

gulp.task('browserSync', function() {
    browserSync.init({
        logPrefix: devDomain,
        proxy: devDomain,
        port: 8081
    })
});


// --------------------------------------------------
// [Gulp Task - Watch]
// --------------------------------------------------

// Lets us type "gulp" on the command line and run all of our tasks
// gulp.task('default', ['sass', 'minify-css', 'rtlcss', 'uglify', 'watch']);

// This handles watching and running tasks
gulp.task('watch', ['browserSync','sass', 'minify-css'], function () {
    gulp.watch('src/scss/**/*.scss', ['sass']);
    gulp.watch('assets/css/style.css', ['minify-css', browserSync.reload]);
    gulp.watch('assets/css/layout.css', ['rtlcss', browserSync.reload]);
    gulp.watch('assets/js/**/*.js', ['uglify', browserSync.reload]);
    gulp.watch('**/**/*.php', browserSync.reload);
});


/* Old Gulp * Use for file paths then delete */

// gulp.task('default', function () {
//     console.log("Starting gulp tasks....");
// });
// gulp.task('sass', function () {
//    return gulp.src('./src/scss/**/*.scss')
//        .pipe(sass().on('error', sass.logError))
//        .pipe(gulp.dest('./'))
//        .pipe(browserSync.reload({
//            stream: true
//        }))
// });
// gulp.task('watch', ['default','browserSync','sass'], function (){
//     gulp.watch('src/scss/**/*.scss', ['sass']);
//     gulp.watch('src/scss/**/*.scss', browserSync.reload);
//     gulp.watch('src/js/**/*.js', browserSync.reload);
//     gulp.watch('**/**/*.php', browserSync.reload);
// });