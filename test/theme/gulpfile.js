/rest//*global -$ */
'use strict';
var gulp = require('gulp');
var sass = require('gulp-sass');
var mainBowerFiles = require('main-bower-files');
var $ = require('gulp-load-plugins')();
var browserSync = require('browser-sync');
var reload = browserSync.reload;
var minify = require('gulp-minify-css');

// Error notifications
var reportError = function(error) {
  $.notify({
    title: 'Gulp Task Error',
    message: 'Check the console.'
  }).write(error);
  console.log(error.toString());
  this.emit('end');
}
var config = {
    bootstrapDir: './bower_components/bootstrap-sass',
};

// Sass processing
gulp.task('sass', function() {
  return gulp.src('scss/**/*.scss')
    .pipe($.sourcemaps.init())
    // Convert sass into css
    
    .pipe($.sass({
      outputStyle: 'nested',
      precision: 10,

    }))
    .on('error', $.sass.logError)
    .pipe(minify({keepBreaks: true}))
    .pipe($.autoprefixer({
      browsers: ['last 2 versions']
    }))
    .pipe($.sourcemaps.write())
     .pipe($.rename({suffix: '.min'}))
    .pipe(gulp.dest('./css'))	
    .pipe($.notify({
      title: "SASS Compiled",
      message: "Your CSS files are ready sir.",
      onLast: true
    }))
    .pipe(browserSync.stream());
});

// process JS files and return the stream.
gulp.task('js', function () {
    return gulp.src(['js/**/*.js', '!js/**/*.min.js'])
        .pipe(browserSync.stream())
        // .pipe($.jsmin())
        // .pipe($.rename({suffix: '.min'}))
        .pipe(gulp.dest('js'));
});

// Optimize Images
gulp.task('images', function() {
  return gulp.src('images/**/*')
    .pipe($.imagemin({
      progressive: true,
      interlaced: true,
      svgoPlugins: [{
        cleanupIDs: false
      }]
    }))
    .pipe(gulp.dest('images'));
});

// JS hint
gulp.task('jshint', function() {
  return gulp.src('js/*.js')
    .pipe(reload({
      stream: true,
      once: true
    }))
    .pipe($.jshint())
    .pipe($.jshint.reporter('jshint-stylish'))
    .pipe($.notify({
      title: "JS Hint",
      message: "JS Hint says all is good.",
      onLast: true
    }));
});

// Beautify JS
gulp.task('beautify', function() {
  gulp.src('js/*.js')
    .pipe($.beautify({indentSize: 2}))
    .pipe(gulp.dest('scripts'))
    .pipe($.notify({
      title: "JS Beautified",
      message: "JS files in the theme have been beautified.",
      onLast: true
    }));
});

// Compress JS
gulp.task('compress', function() {
  return gulp.src('js/*.js')
    .pipe($.sourcemaps.init())
    .pipe($.uglify())
    .pipe($.sourcemaps.write())
    .pipe(gulp.dest('scripts'))
    .pipe($.notify({
      title: "JS Minified",
      message: "JS files in the theme have been minified.",
      onLast: true
    }));
});

gulp.task('php', function() {
  return gulp.src('', {
      read: false
    })
    // .pipe($.shell([
    //   'drush cc views',
    // ]))
    .pipe(browserSync.stream())
    .pipe($.notify({
      title: "PHP Files Complied",
      message: "Your PHP files are ready Master.",
      onLast: true
    }));
});

// BrowserSync
gulp.task('browser-sync', function() {
  //watch files
  var files = [
    'css/**/*.css',
    'js/**/*.js',
    'images/**/*',
    '**/*.php'
  ];
  browserSync.init({
    proxy: "p4p.dev" ,
    online: true,
    injectChanges: true // this is new
  });
  //initialize browsersync
});
// gulp.task('bower', function() {
//     // mainBowerFiles is used as a src for the task,
//     // usually you pipe stuff through a task
//     return gulp.src(mainBowerFiles())
//         // Then pipe it to wanted directory, I use
//         // dist/lib but it could be anything really
//         .pipe(gulp.dest('dist/lib'))
// });

// Default task to be run with `gulp`
gulp.task('default', ['sass', 'browser-sync', 'js'], function() {
 // gulp.watch("css/**/*.min.css").on("change", browserSync.reload);
  gulp.watch("scss/**/*.scss", ['sass']);
  gulp.watch("js/**/*.js", ['js']);
  gulp.watch("**/*.php", ['php']);
});
