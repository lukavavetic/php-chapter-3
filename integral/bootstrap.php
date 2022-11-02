<?php

use App\Presentation\PostController;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\Dotenv\Dotenv;

require __DIR__.'/../vendor/autoload.php';

// php index.php /post.create '{"title":"PHP Chapter", "description":"Testing, testing!", "userId":1}'

(new Dotenv())->usePutenv()->bootEnv(__DIR__.'/../.env');

$containerBuilder = new ContainerBuilder();
$containerBuilder->register('DB', \App\Data\DB::class);
$containerBuilder->register('PostRepository', \App\Data\PostRepository::class)->addArgument(new Reference('DB'));
$containerBuilder->register('PostService', \App\Domain\PostService::class)->addArgument(new Reference('PostRepository'));
$containerBuilder->register(\App\Presentation\PostController::class, \App\Presentation\PostController::class)->addArgument(new Reference('PostService'));

if (true === isset($argv[1])) {
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
}
