module.exports = function(grunt){
	
grunt.initConfig({

cssmin: {
	options: {
    	shorthandCompacting: false,
    	roundingPrecision: -1
	},
	target: {
		files: {
		  'dist/css/output.min.css': [
				'bower_components/bootstrap/dist/css/bootstrap.min.css',
				'bower_components/bootstrap-material-design/dist/css/material.min.css',
				'bower_components/bootstrap-material-design/dist/css/ripples.min.css',
				'bower_components/bootstrap-material-design/dist/css/roboto.min.css',
				'bower_components/chosen/chosen.min.css',
				'css/custom.css'
			]
		}
	}
},
uglify: {
	options: {},
	deploy: {
		files: {
			'dist/js/output.min.js': [
				'bower_components/jquery/dist/jquery.min.js',
				'bower_components/chosen/chosen.jquery.min.js',
				'bower_components/angular/angular.min.js',				
				'js/angular-chosen.min.js',
				'bower_components/bootstrap/dist/js/bootstrap.min.js',
				'bower_components/bootstrap-material-design/dist/js/material.min.js',
				'bower_components/bootstrap-material-design/dist/js/ripples.min.js',
				'js/app.js',
				'js/controller.js',
				'js/service.js',
				'js/custom.js'
			]
		}
	}
},
copy: {
  main: {
    files: [
      // includes files within path
      {expand: true, 
      	cwd: 'bower_components/bootstrap-material-design/dist/fonts/',
      	src: ['*'], 
      dest: 'dist/fonts/', 
      filter: 'isFile'},
    ],
  },
},

});

	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-copy');


	grunt.registerTask('default', ['uglify', 'cssmin', 'copy']);

};