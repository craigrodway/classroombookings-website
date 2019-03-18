var gulp = require("gulp"),
	crypto = require("crypto"),
	sass = require("gulp-sass"),
	rename = require("gulp-rename"),
	autoprefixer = require("gulp-autoprefixer"),
	cleancss = require("gulp-clean-css");


// Paths config
var paths = {
	styles: {
		src: "assets/scss",
		dist: "public_html/site/templates/assets"
	}
};


// Tasks
//

gulp.task('watch', gulp.series(gulp.parallel(stylesDev, watch)));
gulp.task('default', gulp.series(gulp.parallel(stylesDev)));
gulp.task('build', gulp.parallel(stylesBuild));


// Functions
//

function stylesCore() {
	return gulp.src(paths.styles.src + '/crbs.scss')
		.pipe(sass())
		.pipe(autoprefixer())
}

function stylesDev() {
	return stylesCore()
		.pipe(rename('crbs.css'))
		.pipe(gulp.dest(paths.styles.dist));
}


function stylesBuild() {
	return stylesCore()
		.pipe(cleancss())
		.pipe(rename('crbs.min.css'))
		.pipe(gulp.dest(paths.styles.dist))
}


function watch() {
	gulp.watch(paths.styles.src + '/**/*.scss', stylesDev);
}
