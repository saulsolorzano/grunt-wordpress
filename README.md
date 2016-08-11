# grunt-wordpress

> Crea un proyecto que incluye maquetación y tema básico con [grunt-init][]

[grunt-init]: http://gruntjs.com/project-scaffolding

## Instalación
Si aún no tienes instalado [grunt-init][] hazlo antes de continuar.

Una vez que grunt-init esté instalado coloca este template en tu carpeta `~/.grunt-init/`. Es recomendado que uses git para clonar este template en la carpeta, de la siguiente manera:

```
git clone git@github.com:saulsolorzano/grunt-wordpress.git ~/.grunt-init/wordpress
```

_(Usuarios de windows, por favor ver [the documentation][grunt-init] para tener el $PATH correcto de donde debe ir)_

## Uso

Desde la linea de comandos, `cd` a un directorio vacio y corre el siguiente comando.

```
grunt-init wordpress
```

_Por favor tomar en consideración que este template generará archivos en el directorio actual así que si no quieres sobreescribir archivos cambia a un directorio nuevo antes de correrlo._

## Tamaños básicos de imágenes
* Imagen de login de wordpress: *326x146*, debe llamarse `wdt_logo.png` y tiene que estar dentro de la carpeta `/img/` del tema
* Imagen de tema en panel de wordpress *1200x900* y debe llamarse `screenshot.jpg` o `screenshot.png` y tiene que estar en la raíz del tema.

***
### Recordatorios
* Al pasar el proyecto a Backend cambiar el nombre del tema de [tema] a {proyecto}