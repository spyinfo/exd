<?php

use DI\ContainerBuilder;
use FastRoute\RouteCollector;
use League\Plates\Engine;
use Tamtamchik\SimpleFlash\Flash;

$containerBuilder = new ContainerBuilder;

$containerBuilder->addDefinitions([
    Engine::class => function() {
        return new Engine("../app/views");
    },
    PHPMailer::class => function() {
        return new PHPMailer();
    },
    Flash::class => function() {
        return new Flash();
    },
    PDO::class => function() {
        return new PDO('mysql:host=91.219.194.1;dbname=bhx20210_exd', 'bhx20210_evgeny_admin', 'mgkitevgeny');
    },
]);

$container = $containerBuilder->build();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', ["App\controllers\HomeController", "index"]);
});



$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0])
{
    case FastRoute\Dispatcher::NOT_FOUND:
        // Ошибка 404. Страница не найдена
//        abort(404);
        echo "<div>ошибка 404...</div>";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // Ошибка 405. Метод не разрешен
//        abort(405);
        echo "<div>ошибка 405...</div>";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $container->call($handler, $vars);
        break;
}