<?php

declare(strict_types=1);
require(__DIR__ . '/vendor/autoload.php');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


$client = new Client();

$response = $client->request(
    'POST',
    'https://www.yrgopelago.se/centralbank/transferCode',
    [
        'form_params' => [
            'transferCode' => 'f6fc5ccd-b4fd-41e8-9490-1eb322709b3f', // uuid
            'totalcost' => 20 // 
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
