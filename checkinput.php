<?php

declare(strict_types=1);
require __DIR__ . '/hotelFunctions.php';
require __DIR__ . '/functions.php';


function checkInput()
{
    // If all the fields in the form are set:
    if (isset($_POST['name'], $_POST['transfer-code'], $_POST['arrival'], $_POST['departure'], $_POST['room'])) {

        // Create variables of all input-values and sanitize them
        $name = trim(htmlspecialchars($_POST['name'], ENT_QUOTES));
        $transferCode = trim(htmlspecialchars($_POST['transfer-code'], ENT_QUOTES));
        $arrival = trim(htmlspecialchars($_POST['arrival'], ENT_QUOTES));
        $departure = trim(htmlspecialchars($_POST['departure'], ENT_QUOTES));
        $room = intval(filter_var($_POST['room'], FILTER_SANITIZE_NUMBER_INT));

        if (availability()) {

            // Check if transfercode is valid.
            if (isValidUuid($transferCode)) {

                $total_fee = totalFee($room, $arrival, $departure);

                $isTransferCodeTrue = checkTransfercode($transferCode, $total_fee);

                if ($isTransferCodeTrue) {

                    insertIntoDb($name, $transferCode, $arrival, $departure, $room, $total_fee);

                } else {
                    echo "Sorry, you don't have enough credit.";
                }
            } else {
                echo "Sorry, your Transfer Code is not valid, try again.";
            }
        } else {
            echo "Sorry, the dates you have chosen are not available. Please choose other dates for your stay.";
        }
    };
};
