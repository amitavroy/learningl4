module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    jshint: {
      myAppPreConcat: ['public/assets/js/dev/*.js'],
      myAppPostConcat: ['public/assets/js/prod/*.js']
    },
    concat: {
      options: {
        separators: '\n\n'
      },
      myApp: {
        src: ['public/assets/js/dev/*.js'],
        dest: 'public/assets/js/prod/main.js'
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-jshint');
  grunt.loadNpmTasks('grunt-contrib-concat');

  grunt.registerTask('myApp', ['jshint', 'concat']);
}