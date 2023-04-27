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

if($_SESSION['iata']){
    $nom = $_SESSION['iata'];
}

$client = new Client([
    'base_uri' => 'https://test.api.amadeus.com',
    'verify' => false,
    'headers' => [
        'Authorization' => 'Bearer ' . $_SESSION['access_token']
    ],
    'verify' => false   

]);



try {
    $response = $client->get('https://test.api.amadeus.com/v1/airport/direct-destinations',['query' => ['departureAirportCode' => $nom]]);
} catch (GuzzleHttp\Exception\ClientException $e) {
    if($e->getResponse()->getStatusCode()===400){
        $template = $twig->load('insert.html.twig');
        $html = $template->render([
            'title' => 'Connecte toi'
        ]);
        
        echo $template->render([
            "error_message" => "La syntaxe khoya. Tu n's pas lu le petit texte en dessous !"
        ]); 
    }
    else{
        $template = $twig->load('token.html.twig');
        $html = $template->render([
            'title' => 'Connecte toi'
        ]);
        
        echo $template->render([
            "error_message" => "Il faut se reconnecter, il faut être plus vif"
        ]); 
    }
    
    }


$response = $client->get('https://test.api.amadeus.com/v1/airport/direct-destinations',['query' => ['departureAirportCode' => $nom]]);
$code = $response->getStatusCode(); // 200
$body = $response->getBody()->__toString();

$json =json_decode($body, true);

$data = $json['data'];
$meta = $json['meta'];
$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/../templates');
$twig = new Twig\Environment($loader, [
    'cache' => false,
]);

$template = $twig->load('index.twig');

echo $template->render([
    'meta'=>$meta,
    'data' => $data,
    'nom' => $nom,
    'title' => "Liste des aéroports desservis"
]);