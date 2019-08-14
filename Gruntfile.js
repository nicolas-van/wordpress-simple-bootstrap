

module.exports = function(grunt) {

  var jsFiles = [
    "node_modules/bootstrap/dist/js/bootstrap.bundle.js",
  ];

  grunt.initConfig({
    copy: {
      js: {
        files: [
          {expand: true, flatten: true, src: jsFiles, dest: 'js/'},
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
                /^node_modules\b\/?/.test(path) ||
                /^.sass-cache\/?/.test(path)
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

  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-compress');

  grunt.registerTask('dist', ['copy:js', 'compress']);


};
