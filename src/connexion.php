<?php

require __DIR__ . '/../vendor/autoload.php';

use GuzzleHttp\Client;

session_start(); // Démarrer la session

$client = new Client([
    'base_uri' => 'https://test.api.amadeus.com/v1/security/oauth2/token',
    'verify' => false
]);

$response = $client->request('POST', 'https://test.api.amadeus.com/v1/security/oauth2/token', [
    'form_params' => [
        'grant_type' => 'client_credentials',
        'client_id' => 'BfuWLbGISNtFLovJWre2Qn1n9AYfAFVj',
        'client_secret' => 'Dc64plXExRNzTmGU',
    ],
]);

$data = json_decode($response->getBody()->getContents(), true);

$access_token = $data['access_token'];

$_SESSION['access_token'] = $access_token; // Stocker l'access token dans la session

$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/../templates');
$twig = new Twig\Environment($loader, [
    'cache' => false,
]);

// Charger et afficher un template
//$template = $twig->load('index.twig');

$template = $twig->load('connected.html.twig');

echo $template->render();


