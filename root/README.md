# {%= title %}

***
## Instalar dependencias de FrontEnd

Hay que navegar hasta la ruta del tema `/wp-content/themes/mater/`

Debemos primero descargar las dependencias de JS usando `bower` con el siguiente código

```bash
bower install
```

Se nos creará la carpeta `bower_components` en la raiz del tema y esta carpeta tendrá los plugins que nos descargamos.

Ahora debemos intalar los plugins de grunt que usaremos para actualizar nuestros archivos

Corremos el siguiente código:

```bash
npm install
```

Luego en nuestra terminal estando en el tema podemos correr `grunt watch` y este comando se quedara "escuchando" cualquier cambio que hagamos a `main.js` y los compilará automáticamente a `app.min.js`