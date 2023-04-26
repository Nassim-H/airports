<?php declare(strict_types=1);

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use GuzzleHttp\Client;


require __DIR__ . '/vendor/autoload.php';

$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://test.api.amadeus.com',
    'verify' => false,
    'headers' => [
        'Authorization' => 'Bearer ' . 'ACFyFTWQ9E0eZyDtSG5GLEX0YtBP'
    ],
    'verify' => false

]);





$response = $client->get('https://test.api.amadeus.com/v1/airport/direct-destinations',['query' => ['departureAirportCode' => 'TLM']]);
$body = $response->getBody()->__toString();
$code = $response->getStatusCode(); // 200
$json =json_decode($body, true);

$data = $json['data'];


// Créer une instance de Twig
$loader = new Twig\Loader\FilesystemLoader('templates');
$twig = new Twig\Environment($loader, [
    'cache' => false,
]);

// Charger et afficher un template
//$template = $twig->load('index.twig');
$template = $twig->load('home.html.twig');

echo $template->render();

//echo $template->render([
//    'data' => $data
//]);
$button = $_GET['button'];

// afficher le template correspondant
if ($button == 'form') {
  echo $twig->render('form.html.twig');
} elseif ($button == 'index.php?button=form') {
  echo $twig->render('connexion.html.twig');
}
