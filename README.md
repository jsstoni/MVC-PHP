# PHP https://www.php.net/

## Install
`>  git clone https://github.com/jsstoni/MVC-PHP `
`> composer install`
`> composer dump-autoload`
___
## Router
##### ./routes/web.php
___
``` php
<?php
use App\Router\Router;
Router::get('/', function ($req) {
	echo "Hello world";
});

//use controller
Router::get('/other', 'Controller\Web@home');
```

`php -S localhost:9000`