const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));

// Sass compilation task
gulp.task('sass', function () {
 return gulp.src('assets/scss/**/*.scss') // SCSS files are in the 'assets/scss/' directory
 .pipe(sass().on('error', sass.logError))
 .pipe(gulp.dest('assets/scss')); // Compiled CSS will be saved in the 'assets/css/' directory
});

// Define default task
gulp.task('default', gulp.series('sass'));