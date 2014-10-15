module.exports = function(grunt) {
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
 
    var devPath = 'public/script/dev';
    var prodPath = 'public/script/prod';
    var cssPath = 'public/css';
 
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        uglify: {
            my_target: {
                files: [{
                    expand: true,
                    cwd: devPath,
                    src: '**/*.js',
                    dest: prodPath,
                    ext: '.min.js'
                }]
            }
        },
        less:{
            development:{
                options:{
                    cleancss:true
                },
                files: [{
                    expand: true,
                    cwd: cssPath,
                    src: '*.less',
                    dest: cssPath,
                    ext: '.css'
                }]
            }
        },
        cssmin: {
          add_banner: {
            options: {
              banner: '/* My minified css file */'
            },
            files: {
              'public/css/styles.min.css': [cssPath+'/*.css','!'+cssPath+'/*.min.css']
            }
          }
        },
        clean: {
            before: [prodPath + '/*'],
            after: [prodPath + '/*','!'+prodPath+'/*.min.js']
        },
        watch: {
            scripts: {
                files: [devPath + '/**/*.js',cssPath+'/*.less'],
                tasks: ['less','cssmin','clean:before','uglify','customConcat','clean:after']
            }
        }
    });
    grunt.registerTask('customConcat', 'prepare all files', function() {
        
        grunt.file.expand(prodPath + '/*').forEach(function(dir) {
            var folderArr = dir.split("/");
            var fileName = folderArr[folderArr.length - 1];
            grunt.log.writeln('fileName: ' + fileName);
 
            // get the current concat config
            var concat = grunt.config.get('concat') || {};
            
            concat[dir] = {
                src: dir + '/*.min.js',
                dest: prodPath + '/' + fileName + '.min.js'
            };
 
            // save the new concat config
            grunt.config.set('concat', concat);
        });
        
        grunt.task.run('concat');
    });
}