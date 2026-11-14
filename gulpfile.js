const {watch, src, dest, series } = require('gulp');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const cleanCss = require('gulp-clean-css');

function minifyJs(done) {
  return src('./src/js/*.js')
    .pipe(uglify())
    .pipe(dest('./public/js'));
    done();
}

function minifyCss (done){
  return src('./src/css/*.css')
    .pipe(cleanCss())
    .pipe(concat('style.min.css'))
    .pipe(dest('./public/css'));
    done();
}

function watchFiles() {
  watch('./src/css/*.css', series(minifyCss));
  watch('./src/js/*.js', series(minifyJs));
}

exports.watch = watchFiles;
exports.build = series(minifyJs, minifyCss);