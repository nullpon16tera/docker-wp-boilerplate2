require('dotenv').config();
const { src, watch, series, parallel, dest, lastRun, task } = require('gulp')
const rimraf   = require('rimraf')
const $ = require('gulp-load-plugins')()
const imagemin = require('gulp-imagemin')
const mozjpeg  = require('imagemin-mozjpeg')
const pngquant = require('imagemin-pngquant')
const postcss = require('gulp-postcss')
const autoprefixer = require('autoprefixer')
const sass     = require('gulp-sass')
const sassGlob = require('gulp-sass-glob')

sass.compiler = require('node-sass')

const packageImporter = require('node-sass-package-importer')
const webpackStream = require('webpack-stream')
const webpack = require('webpack')
const browserSync = require('browser-sync').create('bsServer')
const through2 = require('through2')

const ENV = (process.env.NODE_ENV || 'development').trim().toLowerCase()

let serverConfig = {
  scheme: 'http://',
  proxy_name: process.env.VIRTUAL_NAME,
  port: 1081
}

let webroot_path = 'resource/';
let assets_path = `${webroot_path}assets/`;
let sassFiles = [
  'src/scss/app.scss',
  'src/scss/404.scss',
  'src/scss/editor.scss',
  'src/scss/vendor.scss',
  'src/scss/login.scss',
  'src/scss/editor-block.scss'
]


let webpackConfig = require('./webpack.config')

function clean(cb) {
  rimraf(`${assets_path}`, cb)
}

function imageMinTask() {
  return src("src/img/**/*")
    .pipe($.changed(`${assets_path}img/`))
    .pipe(
      imagemin([
        imagemin.gifsicle(),
        mozjpeg({
          quality: 100
        }),
        pngquant({
          strip: true
        }),
        imagemin.svgo()
      ], {
        verbose: false
      })
    )
    .pipe(dest(`${assets_path}img`));
}

function sassBuild() {
  let sassSet =  src(sassFiles, {
    sourcemaps: true
  })
    .pipe($.plumber({
      errorHandler: function(err) {
        console.log(err.messageFormatted)
        this.emit('end')
      }
    }))
    .pipe(sassGlob())
    .pipe(
      sass({
        importer: packageImporter()
      }).on("error", sass.logError)
    )
    .pipe(
      postcss([
        autoprefixer({
          cascade: false,
          grid: true
        })
      ])
    )

    if ( ENV === 'production' ) {
      sassSet.pipe($.cleanCss())
      return sassSet
        .pipe(
          through2.obj(function(chunk, enc, callback) {
            const date = new Date();
            // date.setTime(date.getTime() + 1000 * 60 * 60 * 9);
            chunk.stat.atime = date;
            chunk.stat.mtime = date;
            callback(null, chunk);
          })
        )
        .pipe(dest(`${assets_path}css`))
    }

  return sassSet
    .pipe(
      through2.obj(function(chunk, enc, callback) {
        const date = new Date();
        // date.setTime(date.getTime() + 1000 * 60 * 60 * 9);
        chunk.stat.atime = date;
        chunk.stat.mtime = date;
        callback(null, chunk);
      })
    )
    .pipe(
      dest(`${assets_path}css`, {
        sourcemaps: "maps"
      })
    )
    .pipe(
      browserSync.stream({
        match: "**/*.css"
      })
    );
}

function jsBuild() {
  if (ENV === 'production') {
    webpackConfig.mode = 'production'
  }
  return src('src/js/**/*.js')
    .pipe($.plumber({
      errorHandler: function(err) {
        console.log(err.messageFormatted)
        this.emit('end')
      }
    }))
    .pipe(webpackStream(webpackConfig, webpack))
    .pipe(dest(`${assets_path}js`))
}

function bsInit(cb) {
  browserSync.init({
    // host: '0.0.0.0',
    port: serverConfig.port,
    files: [
      `./${webroot_path}**/*.php`,
      `./${assets_path}css/**/*.css`,
      `./${assets_path}js/**/*.js`,
    ],
    // server: './_site',
    watch: true,
    ui: false,
    watchOptions: {
      usePolling: true,
      interval: 1000
    },
    proxy: {
      target: serverConfig.scheme + serverConfig.proxy_name,
      ws: true
    },
    notify: false,
    reloadOnRestart: true,
    scrollProportionally: false,
    ghostMode: {
      clicks: false,
      scroll: false
    }
  })
  cb()
}

function browserReload(done) {
  browserSync.reload()
  done()
}

function watchFiles(done) {
  watch(
    [
      `${webroot_path}**/*.php`,
      `${assets_path}**/*.(^js|jpg|png|svg|gif)`,
    ],
    series(browserReload)
  );
  watch("src/img/**/*", series(imageMinTask))
  watch("src/js/**/*.js", series(jsBuild))
  watch("src/scss/**/*.scss", series(sassBuild))
  done()
}

exports.sassBuild = task(sassBuild)
exports.jsBuild = task(jsBuild)
exports.build = series(clean, parallel(imageMinTask, sassBuild, jsBuild))
exports.default = series(clean, parallel(imageMinTask, sassBuild, jsBuild), series(bsInit, watchFiles))