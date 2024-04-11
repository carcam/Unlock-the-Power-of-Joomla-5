var gulp = require("gulp");

var config = require("./config");
var rename = require("gulp-rename");
var run = require('gulp-run');
var remove = require('del');
var zip = require("gulp-zip");

var browserSync = require("browser-sync").create();
var reload = browserSync.reload;

var rsync = require("gulp-rsync");
const { del } = require("object-path");

var files = [
  "src/_dev/css/**/*.css",
  "src/_dev/**/*.css",
  "src/**/*.html",

  "!node_modules/**/*",
  "!bower_components/**/*",
];

var joomlaFiles = [
    "src/j3component/**/*",
];

var mediaFiles = [
	"temp/component/media/com_sandpaperletters/**/*"
];

var backendFiles = [
	"temp/component/administrator/components/com_sandpaperletters/**/*"
];

var frontendFiles = [
	"temp/component/components/com_sandpaperletters/**/*"
];

var vueFiles = ["src/vue/sandpaperback/dist/**/*"];

gulp.task("copyToTemp:joomla", function () {
  return gulp.src(joomlaFiles).pipe(gulp.dest("temp/component"));
});

gulp.task("copyToTemp:vue", function () {
  return gulp.src(vueFiles).pipe(gulp.dest("temp/component/media/com_sandpaperletters"));
});

gulp.task("copy",
	gulp.series('copyToTemp:joomla', 'copyToTemp:vue')
);

gulp.task("zip", function () {
  return gulp
    .src(["temp/component/**"])
    .pipe(zip("com_sandpaperletters.zip"))
    .pipe(gulp.dest("release"));
});

gulp.task("clean", function () {
  return remove(['temp/**']);
});


gulp.task('compile:vue', function(){
  return gulp.src('src/vue/sandpaperback')
    .pipe(run('cd src/vue/sandpaperback && npm run build'));

});

gulp.task("remote:Vue", function () {
  return (test = gulp.src(vueFiles).pipe(
    rsync({
      root: config.sshData.root + 'vue/',
      hostname: config.sshData.hostname,
      destination: config.sshData.destination,
      archive: true,
      compress: true,
      progress: true,
      recursive: true,
    })
  ));
});

gulp.task('deploy-frontend',function(){
	return gulp.src(frontendFiles)
		.pipe(rsync({
			root: 'temp/component/components/com_sandpaperletters',
			hostname: config.sshData.ssh1.hostname,
			destination: config.sshData.ssh1.destination + 'components/com_sandpaperletters/',
			archive: true,
			compress: true,
			progress: true,
			recursive: true
		}));
});

gulp.task('deploy-backend',function(){
	return gulp.src(backendFiles)
		.pipe(rsync({
			root: 'temp/component/administrator/components/com_sandpaperletters',
			hostname: config.sshData.ssh1.hostname,
			destination: config.sshData.ssh1.destination + 'administrator/components/com_sandpaperletters/',
			archive: true,
			compress: true,
			progress: true,
			recursive: true
		}));
});

gulp.task('deploy-media',function(){
	return gulp.src(mediaFiles)
		.pipe(rsync({
			root: 'temp/component/media/com_sandpaperletters',
			hostname: config.sshData.ssh1.hostname,
			destination: config.sshData.ssh1.destination + 'media/com_sandpaperletters/',
			archive: true,
			compress: true,
			progress: true,
			recursive: true
		}));
});


gulp.task('create-temp', 
  gulp.series("compile:vue", "copy")
);

gulp.task('deploy-joomla',
	gulp.series('deploy-frontend', 'deploy-backend', 'deploy-media')
);

gulp.task('deploy-to-rsync', gulp.series('create-temp', 'deploy-joomla'));


gulp.task('watch-joomla', function() {
	gulp.watch(joomlaFiles, gulp.series('copyToTemp:joomla', 'deploy-joomla'));
});

gulp.task('watch-full', function() {
	gulp.watch(joomlaFiles.concat(vueFiles), gulp.series('copyToTemp:joomla', 'deploy-joomla'));
});

gulp.task('watch', gulp.series('watch-full'));

gulp.task(
  "default",
  gulp.series("compile:vue", "copy", "zip", "clean")
);
/*
gulp.task("browser-sync", function () {
  return browserSync.init(files, {
    server: {
      baseDir: "./src/",
      index: "screenshots/main.html",
    },
    notify: false,
    port: 8080,
    injectChanges: true,
  });
});
*/
