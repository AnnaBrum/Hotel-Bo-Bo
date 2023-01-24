<?php

declare(strict_types=1);

session_start();

// Removes the signed in status on the admin page, and prints a message that confirms that the user is logged out. 
if (isset($_SESSION["authenticated"])) :
    unset($_SESSION["authenticated"]);

    $_SESSION["message"] = "You have logged out from the admin page.";
endif;

// Sends the user back to the admin page.
header("Location: /hotel-manager.php");