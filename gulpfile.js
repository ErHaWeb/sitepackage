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
css.description = 'Compile SCSS files from "Resources/Public/Scss/" to CSS at target "Resources/Public/Css/"';

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
js.description = 'Check, Concatenate and Minify JavaScript files from "Resources/Public/JavaScript/Src/" to target "Resources/Public/JavaScript/Dist/"';

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
cleanAll.description = 'Remove all compiled CSS files under "Resources/Public/Css/" and JavaScript files under "Resources/Public/JavaScript/Dist/"';

// Clean compiled CSS
function cleanCss() {
    return src(paths.stylesDist + '**/*.css', {
        read: false,
        allowEmpty: true
    }).pipe(clean());
}
cleanCss.description = 'Remove all compiled CSS files under "Resources/Public/Css/"';

// Clean compiled JavaScript
function cleanJs() {
    return src(paths.scriptsDist + '**/*.js', {
        read: false,
        allowEmpty: true
    }).pipe(clean());
}
cleanJs.description = 'Remove all compiled JavaScript files under "Resources/Public/JavaScript/Dist/"';

// Watch files
function watching() {
    watch(paths.stylesSrc + '**/*.scss', series(cleanCss, css));
    watch(paths.scriptsSrc + '**/*.js', series(cleanJs, js));
}
watching.description = 'Watch for SCSS / JavaScript changes in "Resources/Public/Scss/" / "Resources/Public/JavaScript/Src/" and run "cleanCss" / "cleanJS" + "css" / "js" tasks accordingly';

exports.css = css;
exports.js = js;
exports.cleanAll = cleanAll;
exports.cleanCss = cleanCss;
exports.cleanJs = cleanJs;
exports.watch = watching;
exports.default = series(cleanAll, parallel(css, js), watching);
