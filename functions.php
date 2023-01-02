<?php

declare(strict_types=1);
require(__DIR__ . '/vendor/autoload.php');

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;


// Calculates totalcost for booking
function totalFee(int $room, string $arrival, string $departure)
{
    $db = connect('/yrgopelago.db');
    $statement = $db->prepare('SELECT fee FROM rooms WHERE id = :room_id');
    $statement->bindParam(':room_id', $room, PDO::PARAM_INT);
    $statement->execute();

    $fee = $statement->fetch(PDO::FETCH_ASSOC);
    $fee = $fee['fee'];

    $total_fee = (((strtotime($departure) - strtotime($arrival)) / 86400) * $fee);

    return $total_fee;
}

// Checks if transferCode is correct relative to fee
function checkTransfercode(string $transferCode, int $total_fee)
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
}

// Check if input-dates already exist in the database
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

    if (empty($bookings)) {
        return true;
    }
}

// Inserts input-values from form into database and prints out a confirmation to the hotel guest.
function insertIntoDb(string $name, string $transferCode, string $arrival, string $departure, int $room, int $total_fee)
    {

        $db = connect('/yrgopelago.db');

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
            'island' => 'Psycho-Island',
            'hotel' => 'Bates Motel',
            'name' => $name,
            'arrival' => $arrival,
            'departure' => $departure,
            'total_fee' => $total_fee,
            'stars' => '1'
        ];

        // Confirmation
        echo "Thank You for your reservation at our " . $booking['stars'] . "-Star " . $booking['hotel'] . ", $name!" . "<br>" . "Your arrival date is " . "$arrival " . "<br>" . "and your departure date is " . "$departure." . "<br>" . "The total fee for your stay is " . $booking['total_fee'] . "." . "<br>" . "We are looking forward seeing You!";

        // All receipts end up in the bookings-file
        $getData = file_get_contents(__DIR__ . '/bookings.json');
        $data = json_decode($getData, true);
        array_push($data, $booking);
        $json = json_encode($data);
        file_put_contents(__DIR__ . '/bookings.json', $json);
    }

