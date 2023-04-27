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


session_start(); 

$lat = $_SESSION['latitude'];
$lon = $_SESSION['longitude'];
$nom = $_SESSION['nom'];
$country = $_SESSION['country'];


$client = new Client([
    'base_uri' => 'https://rapidapi.com/aedbx-aedbx/api/aerodatabox',
    'verify' => false,
    'headers' => [
        'X-RapidAPI-Host' => 'aerodatabox.p.rapidapi.com',
		'X-RapidAPI-Key' => 'f8d25d98c0msh94988498d9f743bp1b6615jsne51e9f43df5d',
		'content-type' => 'application/octet-stream',
    ]
]);


// $response = $client->request('GET', 'https://aerodatabox.p.rapidapi.com/airports/search/location?lat=34.8973169&lon=-1.4&radiusKm=20&limit=10&withFlightInfoOnly=false', [
// 	'headers' => [
// 		'X-RapidAPI-Host' => 'aerodatabox.p.rapidapi.com',
// 		'X-RapidAPI-Key' => 'f8d25d98c0msh94988498d9f743bp1b6615jsne51e9f43df5d',
// 		'content-type' => 'application/octet-stream',
// 	],
// ]);


$response = $client->get('https://aerodatabox.p.rapidapi.com/airports/search/location',["query" => ["lat" => $lat,"lon" => $lon, "radiusKm" => 20, "limit" => 1,"withFlightInfoOnly" => "false" ]]);
$code = $response->getStatusCode(); // 200
$body = $response->getBody()->__toString();
$json =json_decode($body, true);

$iata = $json['items'][0]['iata'];

$template = $twig->load('iata.html.twig');

$_SESSION['iata'] = $iata;

echo $template->render([
    "nom" => $nom,
    "iata" => $iata,
    "country" => $country
]);