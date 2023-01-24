<?php

declare(strict_types=1);
require __DIR__ . '/hotelFunctions.php';
require __DIR__ . '/functions.php';


function checkInput()
{
    // If all the fields in the form are set:
    if (isset($_POST['name'], $_POST['transfer-code'], $_POST['arrival'], $_POST['departure'], $_POST['room'])) {

        // Create variables of all input-values and sanitize them.
        $name = trim(htmlspecialchars($_POST['name'], ENT_QUOTES));
        $transferCode = trim(htmlspecialchars($_POST['transfer-code'], ENT_QUOTES));
        $arrival = trim(htmlspecialchars($_POST['arrival'], ENT_QUOTES));
        $departure = trim(htmlspecialchars($_POST['departure'], ENT_QUOTES));
        // intval changes the variable room to be of type: integer.
        $room = intval(filter_var($_POST['room'], FILTER_SANITIZE_NUMBER_INT));

        if (isset($_POST["features"])) :
            $features = $_POST["features"];
        endif;
         
        if (availability()) {

            // Checks so the name-field contains actual letters and not only blank spaces.
            if (empty($name)) {
                echo "Enter your name, please!";
                return false;
            }

            // Check if transfercode is written correctly.
            if (isValidUuid($transferCode)) {

                // Runs the function totalFee, which calculates the cost for the visit.
                $total_fee = totalFee($room, $arrival, $departure);

                // Checks that the Transfer Code corresponds to the fee.
                $isTransferCodeTrue = checkTransfercode($transferCode, $total_fee);
                // Transfers money from guest to hotel.
                $depositToHotel = deposit($transferCode);
                
                if ($isTransferCodeTrue && $depositToHotel) {
                    // execute booking and add it to database.

                    // Calls insertIntoDbFeaturesIncl() instead of insertIntoDb if features are included in the booking.
                    if (isset($features)) {
                        insertIntoDbFeaturesIncl($name, $transferCode, $arrival, $departure, $room, $total_fee, $features);
                    } else {
                    insertIntoDb($name, $transferCode, $arrival, $departure, $room, $total_fee);
                    }
                } else {
                    echo "Sorry, either you don't have enough credit or something is wrong with your Transfer Code.";
                }
            } else {
                echo "Sorry, your Transfer Code is not written in a valid format, try again.";
            }
        } else {
            echo "Sorry, the dates you have chosen are not available. Please choose other dates for your stay.";
        }
    };
};
