<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use GuzzleHttp\Client;
use Laminas\Diactoros\Response;



require __DIR__ . '/../vendor/autoload.php';


$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/../templates');
$twig = new Twig\Environment($loader, [
     'cache' => false,
]);


$nom = $_POST['nom'];

session_start(); 



$client = new Client([
    'base_uri' => 'https://nominatim.openstreetmap.org',
    'verify' => false,
    'headers' => [
    ],

]);

$response = $client->get('https://nominatim.openstreetmap.org',["query" => ["q" => $nom,"addressdetails" => 1, "format" => "json", "limit" => 1 ]]);
$code = $response->getStatusCode(); // 200
$body = $response->getBody()->__toString();
$json =json_decode($body, true);

$lat = $json[0]['lat'] ;
$lon = $json[0]['lon'];

$_SESSION['latitude'] = $lat;
$_SESSION['longitude'] = $lon;
$_SESSION['nom'] = $nom;
$_SESSION['country'] = $country;

$country = $json[0]['address']['country'];

$template = $twig->load('details.html.twig');

echo $template->render([
    "nom" => $nom,
    "longitude" => $lon,
    "latitude" => $lat,
    "country" => $country
]);