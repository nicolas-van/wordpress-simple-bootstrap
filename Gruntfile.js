

module.exports = function(grunt) {

  var jsFiles = [
    "bower_components/respond/dest/respond.src.js",
    "bower_components/html5shiv/dist/html5shiv.js",
    "bower_components/bootstrap/dist/js/bootstrap.js",
  ];

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
      js: {
        files: [
          {expand: true, flatten: true, src: jsFiles, dest: 'js/'},
        ],
      },
      fonts: {
        files: [
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
            src: ['**'],
            dest: '/',
            filter: function(path) {
              if (/^simple-bootstrap.zip$/.test(path) ||
                /^bower_components\b\/?/.test(path) ||
                /^node_modules\b\/?/.test(path)
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

  grunt.registerTask('make', ['less', 'uglify', 'copy:fonts', 'copy:js']);
  grunt.registerTask('dist', ['make', 'compress']);
  grunt.registerTask('watcher', ['make', 'watch']);

  grunt.registerTask('default', ['make']);

};