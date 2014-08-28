

module.exports = function(grunt) {

  grunt.initConfig({
    less: {
      dev: {
        options: {
          paths: ["."]
        },
        files: {
          "static/style.css": "less/style.less",
        },
      }
    },
    watch: {
      less: {
        files: "less/**.less",
        tasks: ['less']
      },
      cssmin: {
        files: ["static/style.css"],
        tasks: ['cssmin'],
      },
    },
    cssmin: {
      dist: {
        files: {
          'static/style.min.css': "static/style.css",
        }
      },
    },
    uglify: {
      dist: {
        files: {
          'static/app.min.js': [
            "bower_components/respond/dest/respond.src.js",
            "bower_components/html5shiv/dist/html5shiv.js",
            "bower_components/bootstrap/dist/js/bootstrap.js",
          ],
        }
      }
    },
  });

  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');

  grunt.registerTask('make', ['less', 'cssmin', 'uglify']);
  grunt.registerTask('watcher', ['make', 'watch']);

  grunt.registerTask('default', ['make']);

};