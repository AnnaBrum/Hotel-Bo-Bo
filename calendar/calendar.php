<?php

declare(strict_types=1);

require 'vendor/autoload.php';


use benhall14\phpCalendar\Calendar as Calendar;

$budget = new Calendar();
$standard = new Calendar();
$luxury = new Calendar();

$calendars = [
    ['room' => 1, 'calendar' => $budget],
    ['room' => 2, 'calendar' => $standard],
    ['room' => 3, 'calendar' => $luxury]
];

foreach ($calendars as $key => $calendar) {
    $calendar = $calendar['calendar'];

$calendar->useMondayStartingDate();

}

function bookedDates( array $calendars)
{

    $db = connect('/yrgopelago.db');

    $statement = $db->query('SELECT bookings.arrival_date, bookings.departure_date, bookings.room_id, rooms.room, rooms.fee FROM bookings INNER JOIN rooms ON rooms.id=bookings.room_id');

    $statement->execute();
    $booking = $statement->fetchAll(PDO::FETCH_ASSOC);
    if (!empty($booking)) {
        $mask = true;
    }
    foreach ($calendars as $calendar){

    foreach ($booking as $event) {

        if ($event['room_id'] === $calendar['room']) {
        $calendar['calendar']->addEvent($event['arrival_date'], $event['departure_date'], false, $mask, $event['fee']);
        }
    }
}
};

bookedDates($calendars);

$calendar->useMondayStartingDate();

