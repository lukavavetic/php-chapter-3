<?php

use App\Presentation\PostController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

// php index.php /post.create '{"title":"PHP Chapter", "description":"Testing, testing!", "userId":1}'

if (false === isset($argv[1])) {
    throw new Exception("Route missing!");
}

$containerBuilder = new ContainerBuilder();
$containerBuilder->register('PostRepository', \App\Data\PostRepository::class);
$containerBuilder->register('PostService', \App\Domain\PostService::class)->addArgument(new Reference('PostRepository'));
$containerBuilder->register(\App\Presentation\PostController::class, \App\Presentation\PostController::class)->addArgument(new Reference('PostService'));

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

$controller = $containerBuilder->get($parameters['_controller']);

$request = json_decode($requestBody, true);

$controller->create($request);