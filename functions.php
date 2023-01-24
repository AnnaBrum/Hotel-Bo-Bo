<?php

declare(strict_types=1);
require(__DIR__ . '/vendor/autoload.php');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


// Calculates totalcost for booking
function totalFee(int $room, string $arrival, string $departure): int
{
    $db = connect('/yrgopelago.db');
    $statement = $db->prepare('SELECT fee FROM rooms WHERE id = :room_id');
    $statement->bindParam(':room_id', $room, PDO::PARAM_INT);
    $statement->execute();

    $fee = $statement->fetch(PDO::FETCH_ASSOC);
    $fee = $fee['fee'];

    //
    $total_fee = (((strtotime($departure) - strtotime($arrival)) / 86400) * $fee);

    return $total_fee;
}

// Checks if transferCode is correct relative to fee
function checkTransfercode(string $transferCode, int $total_fee):bool
{
    $client = new Client();


    $response = $client->request(
        'POST',
        'https://www.yrgopelago.se/centralbank/transferCode',
        [
            'form_params' => [
                'transferCode' => $transferCode,
                'totalcost' => $total_fee
            ]
        ]
    );

    if ($response->hasHeader('Content-Length')) {
        $transfer_code = json_decode($response->getBody()->getContents());
    }

    

    if (isset($transfer_code->error)) {
        return false;
    } else {
        return true;
    }
};

// Adds the amount from the Transfer Code to the Hotels account.
function deposit(string $transferCode):bool
{
    $client = new Client();

    $response = $client->request(
        'POST',
        'https://www.yrgopelago.se/centralbank/deposit',
        [
            'form_params' => [
                'user' => "Anna", /* Change when I have an account */
                'transferCode' => $transferCode
            ]
        ]
    );

    if ($response->hasHeader('Content-Length')) {
        $transfer_code = json_decode($response->getBody()->getContents());
    }

 
    // If a value is set for 'message' then the code runs.
    if (isset($transfer_code->message)) {
        return true;
    } else {
        return false;
    }
};


// Check if input-dates already exist in the database.
function availability()
{

    $db = connect('/yrgopelago.db');
    $statement = $db->prepare(
        'SELECT * FROM bookings
    WHERE
    room_id = :room_id
    AND
    (arrival_date <= :arrival_date
    or arrival_date < :departure_date)
    AND
    (departure_date > :arrival_date or
    departure_date > :departure_date)'
    );

    $arrival = trim(htmlspecialchars($_POST['arrival'], ENT_QUOTES));
    $departure = trim(htmlspecialchars($_POST['departure'], ENT_QUOTES));
    $room = filter_var($_POST['room'], FILTER_SANITIZE_NUMBER_INT);

    // Bind booking-parameters... 
    $statement->bindParam(':arrival_date', $arrival, PDO::PARAM_STR);
    $statement->bindParam(':departure_date', $departure, PDO::PARAM_STR);
    $statement->bindParam(':room_id', $room, PDO::PARAM_INT);
    //...and execute the database query.
    $statement->execute();

    // Fetch all bookings as an associative array.
    $bookings = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (empty($bookings) && $departure > $arrival) {
        return true;
    }
}

// Inserts input-values from form into database and prints out a confirmation to the hotel guest.
function insertIntoDb(string $name, string $transferCode, string $arrival, string $departure, int $room, int $total_fee)
    {

        $db = connect('./yrgopelago.db'); 

        $booking = 'INSERT INTO bookings (
        name,
        transfer_code,
        arrival_date,
        departure_date,
        room_id,
        total_fee
        ) VALUES (
        :name,
        :transfer_code,
        :arrival_date,
        :departure_date,
        :room_id,
        :total_fee)';

        $statement = $db->prepare($booking);

        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':transfer_code', $transferCode, PDO::PARAM_STR);
        $statement->bindParam(':arrival_date', $arrival, PDO::PARAM_STR);
        $statement->bindParam(':departure_date', $departure, PDO::PARAM_STR);
        $statement->bindParam(':room_id', $room, PDO::PARAM_INT);
        $statement->bindParam(':total_fee', $total_fee, PDO::PARAM_INT);


        $statement->execute();

        // Data that end up in bookings-file and displays as receipt
        $booking = [
            'island' => 'BO-BO-ISLAND',
            'hotel' => 'BO-BO HOTEL',
            'name' => $name,
            'arrival' => $arrival,
            'departure' => $departure,
            'total_fee' => $total_fee,
            'stars' => '1',
            'features' => '',
            'additional_info' => 'See You Soon!'
        ];

        // All receipts end up in the bookings-file
        $getReceipt = file_get_contents(__DIR__ . '/bookings.json');
        $receipt = json_decode($getReceipt, true);
        array_push($receipt, $booking);
        $json = json_encode($receipt);
        file_put_contents(__DIR__ . '/bookings.json', $json);

                // Confirmation
        echo "<div>" . "Thank You for your reservation at " . $booking['hotel'] . ", $name!" . "Here is your receipt:" . "</div>" . "<span>" . json_encode(end($receipt)) . "</span>";
    }

    // Inserts input-values from form into database and prints out a confirmation to the hotel guest.
function insertIntoDbFeaturesIncl(string $name, string $transferCode, string $arrival, string $departure, int $room, int $total_fee, $features)
{
    $extraFee = null;
    foreach ($features as $feature => $price) :
        $extraFee += $price;
    endforeach;

    $db = connect('./yrgopelago.db'); 

    $query = "INSERT INTO bookings (
        name,
        transfer_code,
        arrival_date,
        departure_date,
        room_id,
        extra_fee,
        total_fee";
    foreach ($features as $feature => $price) {
        $query .= ", " . $feature;
    } 
    $query .= ") VALUES (
        :name,
        :transfer_code,
        :arrival_date,
        :departure_date,
        :room_id,
        $extraFee,
        :total_fee";
    foreach ($features as $feature => $price) {
        $query .= ", 1";
    }
    $query .= ")";

    $total_fee += $extraFee;

    $statement = $db->prepare($query);
   
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':transfer_code', $transferCode, PDO::PARAM_STR);
    $statement->bindParam(':arrival_date', $arrival, PDO::PARAM_STR);
    $statement->bindParam(':departure_date', $departure, PDO::PARAM_STR);
    $statement->bindParam(':room_id', $room, PDO::PARAM_INT);
    $statement->bindParam(':total_fee', $total_fee, PDO::PARAM_INT); 

    $statement->execute();

    // Data that end up in bookings-file and displays as receipt
    $booking = [
        'island' => 'BO-BO-ISLAND',
        'hotel' => 'BO-BO HOTEL',
        'name' => $name,
        'arrival' => $arrival,
        'departure' => $departure,
        'total_fee' => "$".$total_fee,
        'stars' => '1',
        'features' => $features,
        'additional_info' => 'See You Soon!'
    ];

    // All receipts end up in the bookings-file
    $getReceipt = file_get_contents(__DIR__ . '/bookings.json');
    $receipt = json_decode($getReceipt, true);
    array_push($receipt, $booking);
    $json = json_encode($receipt);
    file_put_contents(__DIR__ . '/bookings.json', $json);

            // Confirmation
    echo "<div>" . "Thank You for your reservation at " . $booking['hotel'] . ", $name!" . "Here is your receipt:" . "</div>" . "<span>" . json_encode(end($receipt)) . "</span>";
}

