<?php declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use GuzzleHttp\Client;


require __DIR__ . '/vendor/autoload.php';



// Créer une instance de Twig
$loader = new Twig\Loader\FilesystemLoader('templates');
$twig = new Twig\Environment($loader, [
    'cache' => false,
]);

// Charger et afficher un template
//$template = $twig->load('index.twig');
$template = $twig->load('form.twig');

echo $template->render();