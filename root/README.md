# {%= title %}

***
## Instalar dependencias de FrontEnd

Hay que navegar hasta la ruta del tema `/wp-content/themes/{%= title %}/`

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


## Tamaños básicos de imágenes
* Imagen de login de wordpress: *326x146*, debe llamarse `wdt_logo.png` y tiene que estar dentro de la carpeta `/img/` del tema
* Imagen de tema en panel de wordpress *1200x900* y debe llamarse `screenshot.jpg` o `screenshot.png` y tiene que estar en la raíz del tema.

***
### Recordatorios
* Al pasar el proyecto a Backend cambiar el nombre del tema de [tema] a {proyecto}