<?php

declare(strict_types=1);
require(__DIR__ . '/vendor/autoload.php');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

$client = new Client();

if (isset($_POST['transfer-code'], $_POST['arrival'], $_POST['departure'], $_POST['room'])) {

    // Create variables of all input-values and sanitize them
    $transferCode = trim(htmlspecialchars($_POST['transfer-code'], ENT_QUOTES));
    $arrival = trim(htmlspecialchars($_POST['arrival'], ENT_QUOTES));
    $departure = trim(htmlspecialchars($_POST['departure'], ENT_QUOTES));
    $room = filter_var($_POST['room'], FILTER_SANITIZE_NUMBER_INT);


    $totalCost = (($room) * (strtotime($departure) - strtotime($arrival)) / 86400);

    $response = $client->request(
        'POST',
        'https://www.yrgopelago.se/centralbank/transferCode',
        [
            'form_params' => [
                'transferCode' => $transferCode,
                'totalcost' => $totalCost 
            ]
        ]
    );



if ($response->hasHeader('Content-Length')) {
    $transfer_code = json_decode($response->getBody()->getContents());
    // var_dump($transfer_code);

    // redirect
        // Overwrite your .env file with only the value, not the key from the response.
       // file_put_contents(__DIR__ . '/.env', 'API_KEY=' . $api_key->password);
}
}