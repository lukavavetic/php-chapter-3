<?php

use App\Presentation\PostController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

// php index.php /post.create '{"title":"PHP Chapter"}'

if (false === isset($argv[1])) {
    throw new Exception("Route missing!");
}

$requestedRoute = $argv[1];
$requestBody = $argv[2];

$route = new Route('/post.create', ['_controller' => PostController::class]);
$routes = new RouteCollection();
$routes->add('create_post', $route);

$context = new RequestContext();

$matcher = new UrlMatcher($routes, $context);
$parameters = $matcher->match($requestedRoute);

if (false === isset($parameters['_controller'])) {
    throw new Exception("Controller not found!");
}

$controllerClassName = $parameters['_controller'];

$controller = new $controllerClassName;

$request = json_decode($requestBody, true);

$controller->create($request);