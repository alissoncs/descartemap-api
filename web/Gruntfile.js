module.exports = function(grunt){
	
grunt.initConfig({

uglify: {
	javascript: {
		options: {},
		files: {
			'dist/output.min.js': [
				'js/app.js',
				'js/controller.js',
				'js/service.js',
				'js/custom.js'
			]
		}
	},
	css: {
		options: {},
		files: {
			'dist/output.min.css': [
				'css/custom.css'
			]
		}
	},
}

});

	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-concat');

	grunt.registerTask('default', ['uglify']);

};