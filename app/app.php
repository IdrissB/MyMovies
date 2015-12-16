<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Register services
$app['dao.movie'] = $app->share(function ($app) {
    return new MyMovies\DAO\MovieDAO($app['db']);
});
$app['dao.category'] = $app->share(function ($app) {
    $categoryDAO = new MyMovies\DAO\CategoryDAO($app['db']);
    $categoryDAO->setCategoryDAO($app['dao.movie']);
    return $categoryDAO;
});