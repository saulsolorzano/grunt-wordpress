module.exports = function(grunt) {

	// Automaticamente carga las tareas
	require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

	// Configuración
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),

		concat: {
			options: {
				separator: ';',
			},
			dist: {
				src: ['vendor/jquery.js', 'main.js'],
				dest: 'js/app.js'
			}
		},
		uglify: {
			production: {
				options: {
					mangle: true,
					compress: true,
					banner: '/*! Author: Agencia Digital Reactor\n' +
						' * v<%= pkg.version %> - <%= grunt.template.today("yyyy-mm-dd") %>' +
						' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
						' */\n'
				},
				files: {
					'js/app.min.js': ['js/app.js']
				}
			},
		}
	});

	grunt.registerTask('default', ['concat', 'uglify']);

};
