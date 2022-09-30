// Load plugins
const {src, dest, watch, series, parallel} = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const autoprefixer = require('gulp-autoprefixer');
const cssnano = require('gulp-cssnano');
const jshint = require('gulp-jshint');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const concat = require('gulp-concat');
const clean = require('gulp-clean');

// Define paths
const paths = {
    stylesSrc: 'Resources/Public/Scss/',
    stylesDist: 'Resources/Public/Css/',
    scriptsSrc: 'Resources/Public/JavaScript/Src/',
    scriptsDist: 'Resources/Public/JavaScript/Dist/'
}

// Styles
function css() {
    return src(paths.stylesSrc + '**/*.scss')
        .pipe(sass('', {}))
        .pipe(autoprefixer('last 2 version'))
        .pipe(dest(paths.stylesDist))
        .pipe(rename({suffix: '.min'}))
        .pipe(cssnano())
        .pipe(dest(paths.stylesDist));
}

// Scripts
function js() {
    return src(paths.scriptsSrc + '**/*.js')
        .pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter('default', {}))
        .pipe(concat('main.js'))
        .pipe(dest(paths.scriptsDist))
        .pipe(rename({suffix: '.min'}))
        .pipe(uglify())
        .pipe(dest(paths.scriptsDist));
}

// Clean
function cleanAll() {
    return src([
        paths.stylesDist + '**/*.css',
        paths.scriptsDist + '**/*.js'
    ], {
        read: false,
        allowEmpty: true
    }).pipe(clean());
}

// Clean compiled CSS
function cleanCss() {
    return src(paths.stylesDist + '**/*.css', {
        read: false,
        allowEmpty: true
    }).pipe(clean());
}

// Clean compiled JavaScript
function cleanJs() {
    return src(paths.scriptsDist + '**/*.js', {
        read: false,
        allowEmpty: true
    }).pipe(clean());
}

// Watch files
function watching() {
    watch(paths.stylesSrc + '**/*.scss', series(cleanCss, css));
    watch(paths.scriptsSrc + '**/*.js', series(cleanJs, js));
}

exports.clean = cleanAll;
exports.css = css;
exports.js = js;
exports.watch = watching;
exports.default = series(cleanAll, parallel(css, js), watching);
