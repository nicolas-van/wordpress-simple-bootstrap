

module.exports = function(grunt) {

  var jsFiles = [
    "node_modules/respond.js/dest/respond.src.js",
    "node_modules/html5shiv/dist/html5shiv.js",
    "node_modules/bootstrap/dist/js/bootstrap.js",
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
    },
    uglify: {
      dist: {
        files: {
          'app.min.js': [
            "node_modules/respond.js/dest/respond.src.js",
            "node_modules/html5shiv/dist/html5shiv.js",
            "node_modules/bootstrap/dist/js/bootstrap.js",
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
          {expand: true, flatten: true, src: ['node_modules/bootstrap/dist/fonts/*'], dest: 'fonts/'},
        ],
      },
      readme: {
        files: [
          {src: 'README.md', dest: 'readme.txt'},
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
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-compress');

  grunt.registerTask('make', ['less', 'uglify', 'copy:fonts', 'copy:js']);
  grunt.registerTask('dist', ['make', 'copy:readme', 'compress']);
  grunt.registerTask('watcher', ['make', 'watch']);

  grunt.registerTask('default', ['make']);

};
