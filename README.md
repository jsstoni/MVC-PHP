# MVC-PHP

## Install

```
git clone https://github.com/jsstoni/MVC-PHP
```
```
composer install
```
---
## DEV
utiliza composer para iniciar el servidor
```
composer dev
```

o tambien puedes utilizar:
```
php -S localhost:9000 -t public server.php
```
pudes instalar xampp, wampp o cualquier otro servidor que puedas utilizar en tu sistema operativo.
si creas el proyecto dentro de una carpeta se debe establecer ese punto de entrada a la ruta "main" del proyecto

configurando tu main desde el archivo ".env"
```
MAIN="/path"
```
por defecto la ruta main es "/"

## Router
las rutas se encuentra en "./routes/"

se utiliza el archivo "web.php" para definir todas las rutas bases de la web del proyecto

nuestro sistema Router tambien tiene configurado su propio auto-load de archivos de rutas

crea un nuevo archivo en "./routes/products.php"

va corresponder a tu nueva ruta:
"localhost:9000/products"
___
``` php
<?php
use App\Http\Router;
Router::get('/', function ($req, $res) {
	$res->status(200)->send("hola mundo");
});

//use controller
Router::get('/other', 'Controller\Web@home');
```