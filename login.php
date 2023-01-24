<?php

declare(strict_types=1);

session_start();

/* $password = "e25909e0-d568-4853-808d-88198293dd37"; */

// Saves the user's input values and passes the saved inputs as arguments in the verify function.
if (isset($_POST["username"], $_POST["password"])) :
    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];

    verify($username, $password);
endif;

// The function compares the passed values with the values in the $user array. If the username and password are correct the user gets a welcome message. If incorrect the user gets an error message. 
function verify($username, $password)
{
    $user = [
        "name" => "Anna",
        "password" => '$2y$10$Kl/xtsrgJ8tTaxNZc1ooEODqRD4kwSgN2sR92zUHSEUtA./pHFnl.'
    ];

    if ($username === $user["name"] && password_verify($password, $user["password"])) :
        $_SESSION["message"] = "Welcome $user[name]! You are now signed in to the admin page.";

        $_SESSION["authenticated"] = true;
    else :
        $_SESSION["message"] = "Something went terribly, terribly wrong. Please try again.";
    endif;
}

// Sends the user back to the admin page.
header("Location: /hotel-manager.php");