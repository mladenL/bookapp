<?php

// Home page
// $app->get('/', function () use ($app) {
//     $books = $app['dao.book']->findAll();

$app->get('/', function () use ($app) {
    $books = $app['dao.book']->findAll();
    return $app['twig']->render('view.html.twig', array('books' => $books));


 //     ob_start();             // start buffering HTML output
 //     require '../views/view.php';
 //     $view = ob_get_clean(); // assign HTML output to $view
 //     return $view;
 //

});