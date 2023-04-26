<?php

use GuzzleHttp\Client;
require __DIR__ . '/vendor/autoload.php';



use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Laminas\Diactoros\Response;

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$router = new League\Route\Router;

$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/templates');
$twig = new Twig\Environment($loader, [
     'cache' => false,
]);

session_start();

$router->map('GET', '/', function (ServerRequestInterface $request) use ($twig): ResponseInterface {
    $template = $twig->load('base.html.twig');
    $html = $template->render([
        'title' => $_SESSION['access_token']
    ]);
    $response = new Response();
    $response->getBody()->write($html);

    return $response;
});

$router->map('GET', '/form', function (ServerRequestInterface $request) use ($twig): ResponseInterface {
    $template = $twig->load('form.html.twig');
    $html = $template->render([
        'title' => "Prenons l'envol ",$_SESSION['access_token']
    ]);
    $response = new Response();
    $response->getBody()->write($html);

    return $response;
});

$router->map('GET', '/connexion', function (ServerRequestInterface $request) use ($twig): ResponseInterface {
    $template = $twig->load('connexion.html.twig');
    $html = $template->render([
        'title' => 'Connecte toi', $_SESSION['access_token']
    ]);
    $response = new Response();
    $response->getBody()->write($html);

    return $response;
});


$router->map('GET', '/home', function (ServerRequestInterface $request) use ($twig): ResponseInterface {
    $template = $twig->load('home.html.twig');
    $html = $template->render([
        'title' => 'Connecte toi'
    ]);
    $response = new Response();
    $response->getBody()->write($html);

    return $response;
});


$response = $router->dispatch($request);

// send the response to the browser
(new Laminas\HttpHandlerRunner\Emitter\SapiEmitter)->emit($response);


// $response = $client->request('GET', 'accueil');
// $body = $response->getBody()->__toString();
// $code = $response->getStatusCode(); // 200
// $json =json_decode($body, true);

// $data = $json['data'];
// $loader = new Twig\Loader\FilesystemLoader(__DIR__.'/../templates');
// $twig = new Twig\Environment($loader, [
//     'cache' => false,
// ]);

// $template = $twig->load('home.html.twig');

// echo $template->render();
