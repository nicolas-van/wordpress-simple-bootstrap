

module.exports = function(grunt) {

  grunt.initConfig({
    less: {
      dev: {
        options: {
          paths: ["."]
        },
        files: {
          "style.css": "less/style.less",
        },
      }
    },
    watch: {
      less: {
        files: "less/**.less",
        tasks: ['less']
      },
      cssmin: {
        files: ["style.css"],
        tasks: ['cssmin'],
      },
    },
    cssmin: {
      dist: {
        files: {
          'style.min.css': "style.css",
        }
      },
    },
    uglify: {
      dist: {
        files: {
          'app.min.js': [
            "bower_components/respond/dest/respond.src.js",
            "bower_components/html5shiv/dist/html5shiv.js",
            "bower_components/bootstrap/dist/js/bootstrap.js",
          ],
        }
      }
    },
    copy: {
      main: {
        files: [
          // includes files within path
          {expand: true, flatten: true, src: ['bower_components/bootstrap/dist/fonts/*'], dest: 'fonts/'},
        ],
      },
    },
    compress: {
      main: {
        options: {
          archive: 'simple-bootstrap.zip'
        },
        files: [
          {
            src: ['**', '.**'],
            dest: '/',
            filter: function(path) {
              if (/^simple-bootstrap.zip$/.test(path) ||
                /^bower_components\b\/?/.test(path) ||
                /^node_modules\b\/?/.test(path) ||
                /^\.git\b\/?/.test(path)
                ) {
                return false;
              }
              return true;
            }
          },
        ]
      }
    }

  });

  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-compress');

  grunt.registerTask('make', ['less', 'cssmin', 'uglify', 'copy']);
  grunt.registerTask('dist', ['make', 'compress']);
  grunt.registerTask('watcher', ['make', 'watch']);

  grunt.registerTask('default', ['make']);

};