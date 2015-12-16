<?php

use Symfony\Component\HttpFoundation\Request;
use MyMovies\Domain\Category;

// Home page
$app->get('/', function () use ($app) {
    $movies = $app['dao.movie']->findAll();
    return $app['twig']->render('index.html.twig', array('movies' => $movies));
})->bind('home');
