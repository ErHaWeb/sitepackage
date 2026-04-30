const fs = require('node:fs/promises');
const path = require('node:path');
const {watch, series, parallel} = require('gulp');
const sass = require('sass');

const paths = {
    stylesSrc: path.join(__dirname, 'Resources/Public/Scss'),
    stylesDist: path.join(__dirname, 'Resources/Public/Css'),
    scriptsSrc: path.join(__dirname, 'Resources/Public/JavaScript/Src'),
    scriptsDist: path.join(__dirname, 'Resources/Public/JavaScript/Dist'),
};

async function collectFiles(directory, extension) {
    let entries;
    try {
        entries = await fs.readdir(directory, {withFileTypes: true});
    } catch (error) {
        if (error.code === 'ENOENT') {
            return [];
        }
        throw error;
    }

    const files = await Promise.all(entries.map(async (entry) => {
        const entryPath = path.join(directory, entry.name);
        if (entry.isDirectory()) {
            return collectFiles(entryPath, extension);
        }
        return entry.isFile() && entry.name.endsWith(extension) ? [entryPath] : [];
    }));

    return files.flat().sort();
}

async function ensureDirectory(filePath) {
    await fs.mkdir(path.dirname(filePath), {recursive: true});
}

async function writeFile(filePath, content) {
    await ensureDirectory(filePath);
    await fs.writeFile(filePath, content);
}

function targetPath(sourceFile, sourceRoot, targetRoot, extension, suffix = '') {
    const parsedPath = path.parse(path.relative(sourceRoot, sourceFile));
    return path.join(targetRoot, parsedPath.dir, `${parsedPath.name}${suffix}${extension}`);
}

function isSassEntryPoint(filePath) {
    return !path.basename(filePath).startsWith('_');
}

async function compileSass(filePath, style, suffix = '') {
    const result = sass.compile(filePath, {
        style,
        loadPaths: [paths.stylesSrc],
    });
    await writeFile(
        targetPath(filePath, paths.stylesSrc, paths.stylesDist, '.css', suffix),
        `${result.css}\n`
    );
}

async function removeGeneratedFiles(directory, extension) {
    const files = await collectFiles(directory, extension);
    await Promise.all(files.map((filePath) => fs.rm(filePath, {force: true})));
}

async function css() {
    const files = (await collectFiles(paths.stylesSrc, '.scss')).filter(isSassEntryPoint);
    await Promise.all(files.map(async (filePath) => {
        await compileSass(filePath, 'expanded');
        await compileSass(filePath, 'compressed', '.min');
    }));
}
css.description = 'Compile SCSS files from "Resources/Public/Scss/" to CSS at target "Resources/Public/Css/"';

async function js() {
    const files = await collectFiles(paths.scriptsSrc, '.js');
    const sources = await Promise.all(files.map((filePath) => fs.readFile(filePath, 'utf8')));
    const source = sources.join('\n');

    await writeFile(path.join(paths.scriptsDist, 'main.js'), source);
    await writeFile(path.join(paths.scriptsDist, 'main.min.js'), source.trim() === '' ? '' : `${source.trim()}\n`);
}
js.description = 'Concatenate JavaScript files from "Resources/Public/JavaScript/Src/" to target "Resources/Public/JavaScript/Dist/"';

async function cleanAll() {
    await Promise.all([
        removeGeneratedFiles(paths.stylesDist, '.css'),
        removeGeneratedFiles(paths.scriptsDist, '.js'),
    ]);
}
cleanAll.description = 'Remove all compiled CSS files under "Resources/Public/Css/" and JavaScript files under "Resources/Public/JavaScript/Dist/"';

async function cleanCss() {
    await removeGeneratedFiles(paths.stylesDist, '.css');
}
cleanCss.description = 'Remove all compiled CSS files under "Resources/Public/Css/"';

async function cleanJs() {
    await removeGeneratedFiles(paths.scriptsDist, '.js');
}
cleanJs.description = 'Remove all compiled JavaScript files under "Resources/Public/JavaScript/Dist/"';

function watching() {
    watch('Resources/Public/Scss/**/*.scss', series(cleanCss, css));
    watch('Resources/Public/JavaScript/Src/**/*.js', series(cleanJs, js));
}
watching.description = 'Watch for SCSS / JavaScript changes in "Resources/Public/Scss/" / "Resources/Public/JavaScript/Src/" and rebuild CSS / JavaScript';

const build = series(cleanAll, parallel(css, js));

exports.css = css;
exports.js = js;
exports.cleanAll = cleanAll;
exports.cleanCss = cleanCss;
exports.cleanJs = cleanJs;
exports.watch = watching;
exports.build = build;
exports.default = build;
