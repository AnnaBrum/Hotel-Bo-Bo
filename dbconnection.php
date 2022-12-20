<?php
declare(strict_types=1);
require __DIR__ . '/hotelFunctions.php';

$db = connect('/yrgopelago.db');
$statement = $db->query('SELECT * FROM bookings');
$bookings = $statement->fetchAll(PDO::FETCH_ASSOC);


if (isset($_POST['name'], $_POST['transfer-code'], $_POST['arrival'], $_POST['departure'], $_POST['room'])) {

    $name = htmlspecialchars($_POST['name'],ENT_QUOTES);
    $transferCode = trim(htmlspecialchars($_POST['transfer-code'],ENT_QUOTES));
    $arrival = trim(htmlspecialchars($_POST['arrival'],ENT_QUOTES));
    $departure = trim(htmlspecialchars($_POST['departure'],ENT_QUOTES));
    $room = trim(htmlspecialchars($_POST['room'],ENT_QUOTES));

    function availability(string $arrival, string $departure, int $room) {
        $db = connect('/yrgopelago.db');

        $statement = $db->query('SELECT * FROM bookings WHERE ');

    };

    $query = 'INSERT INTO bookings (
        name,
        transfer_code,
        arrival_date,
        departure_date,
        room_id
        )
        VALUES (
            :name,
            :transfer_code,
            :arrival_date,
            :departure_date,
            :room_id
        )';

    $statement = $db->prepare($query);

    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':transfer_code', $transferCode, PDO::PARAM_STR);
    $statement->bindParam(':arrival_date', $arrival, PDO::PARAM_STR);
    $statement->bindParam(':departure_date', $departure, PDO::PARAM_STR);
    $statement->bindParam(':room_id', $room, PDO::PARAM_STR);

    $statement->execute();


}



// print_r($bookings);
