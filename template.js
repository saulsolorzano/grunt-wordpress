exports.description = 'Crea un tema nuevo de Wordpress.';

exports.template = function( grunt, init, done ) {

	init.process({}, [

		init.prompt('name'),
		init.prompt('title'),
		init.prompt('description', 'Descripción del tema'),
		init.prompt('homepage'),
		init.prompt('version'),
		init.prompt('author_name', 'Agencia Digital Reactor'),
		init.prompt('author_email', 'contacto@reactor.cl'),
		init.prompt('author_twitter', '@reactorhq'),
		init.prompt('author_url', 'http://reactor.cl/')

	], function(err, props){

		var files = init.filesToCopy(props);

		init.copyAndProcess(files, props);

		init.writePackageJSON('package.json', {
			name: props.name,
			version: props.version,
			description: props.description,
			author: {
				name: props.author_name,
				url: props.author_url
			},
			devDependencies: {
				"grunt": "~0.4.5",
				"grunt-contrib-concat": "~0.5.0",
				"grunt-contrib-uglify": "~0.7.0",
				"matchdep": "~0.3.0"
			}
		});

		done();

	});

};