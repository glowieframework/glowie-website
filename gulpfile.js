const gulp = require('gulp');
const concat = require('gulp-concat');
const terser = require('gulp-terser');
const sass = require('gulp-sass')(require('sass'));
const cleanCSS = require('gulp-clean-css');
const watch = require('gulp-watch');

function scripts() {
    return gulp.src('assets/js/*.js')
        .pipe(concat('glowie.min.js'))
        .pipe(terser())
        .pipe(gulp.dest('assets/js/dist'));
}

function styles() {
    return gulp.src(['assets/css/*.css', 'assets/css/*.scss'])
        .pipe(sass().on('error', sass.logError))
        .pipe(concat('glowie.min.css'))
        .pipe(cleanCSS())
        .pipe(gulp.dest('assets/css/dist'));
}

function watchFiles() {
    watch('assets/js/*.js', {
        ignoreInitial: false,
        verbose: true
    }, scripts);
    watch(['assets/css/*.css', 'assets/css/*.scss'], {
        ignoreInitial: false,
        verbose: true
    }, styles);
}

exports.default = gulp.parallel(scripts, styles);
exports.watch = gulp.series(gulp.parallel(scripts, styles), watchFiles);