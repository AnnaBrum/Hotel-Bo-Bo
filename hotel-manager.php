<?php

declare(strict_types=1);

session_start();

$message = $_SESSION["message"] ?? "";
unset($_SESSION["message"]);
$authenticated = $_SESSION["authenticated"] ?? false;

// Saves the room and price input and passes the inputs as parameters to the changePrice function.
if (isset($_POST["room"], $_POST["price"])) :
    $room = $_POST["room"];
    $price = $_POST["price"];
   
    changePrice($price, $room);
endif;

// Function that updates the price for the specific room in the database.
function changePrice($price, $room) {
    $db = new PDO("sqlite:yrgopelago.db");
    $statement = $db->prepare("UPDATE rooms SET fee = :price WHERE id = :room;");
    $statement->bindParam(":room", $room, PDO::PARAM_INT);
    $statement->bindParam(":price", $price, PDO::PARAM_INT);
    $statement->execute();

    if ($room === 1) :
        $room = "budget";
    elseif ($room === 2) :
        $room = "standard";
    elseif ($room === 3) :
        $room = "luxury";
    endif; ?>
    <p class="admin-message"><?= "You have succesfully changed the price of the $room room to $$price."; ?></p> <?php
}

// Saves the new feature and passes the inputs as parameters to the addNewFeature function.
if (isset($_POST["feature"], $_POST["featurePrice"])) :
    $feature = $_POST["feature"];
    $featurePrice = $_POST["featurePrice"];
    
    addNewFeature($feature);

    // Save new feature in json format in features.json in order to retrieve it and show it in the booking section on the front page.
    $featureArray = [ 
        "feature" => $feature, 
        "featurePrice" => $featurePrice,
    ];
    
    $featuresJson = file_get_contents("features.json");
    $featuresJson = json_decode($featuresJson, TRUE);
    $featuresJson[] = $featureArray;
    $featuresJson = json_encode($featuresJson);
    file_put_contents("features.json", $featuresJson);
endif;

// Function that adds the new feature to the database.
function addNewFeature($feature) {
    $feature = $feature;
    $db = new PDO("sqlite:yrgopelago.db");
    $db->exec("ALTER TABLE bookings ADD $feature BOOLEAN"); ?>
    <p class="admin-message"><?= "The feature '$feature' has been added!"; ?></p> <?php
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="/style/style.css" rel="stylesheet">
    <link href="/style/mediaqueries.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <a class="admin-link" href="/index.php">Home page</a>

        <!-- Prints message if there is something to print. -->
        <?php if ($message !== "") : ?>
            <p class="admin-message"><?= $message; ?></p>
        <?php endif; 

        if ($authenticated) : ?>
            <a class="sign-out" href="/logout.php">Sign out admin</a>
        <?php else : ?>

            <!-- The login form. Shows up if admin is logged out. -->
            <form class="admin-login" action="login.php" method="post">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" required>

                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>

                <button type="submit">Sign in</button>
            </form>
        <?php endif; 
        
        if ($authenticated) : ?>
            <!-- Change price section -->
            <section class="booking-price-section">
                <form method="post" action="hotel-manager.php">
                    <h2>Update the price for a specific room</h2>

                    <label for="room">Choose room</label>
                    <select name="room" class="form-input">
                        <option value="1">Budget</option>
                        <option value="2">Standard</option>
                        <option value="3">Luxury</option>
                    </select><br>
                    
                    <label for="price">Choose new price</label>
                    <input id="price" name="price" type="number" min="1" step="1" required>

                    <button type="submit">Confirm new price</button>
                </form>
            </section>
            <hr>
            <!-- Add feature section -->
            <section class="feature-section">
                <form method="post" action="hotel-manager.php">
                    <h2>Add a feature</h2>
                    
                    <label for="feature">Choose feature name</label>
                    <input id="feature" name="feature" type="text" required>

                    <label for="featurePrice">Choose price of new feature</label>
                    <input id="featurePrice" name="featurePrice" type="number" min="1" step="1" required>

                    <button type="submit">Confirm new feature</button>
                </form>
            </section>
        <?php endif; ?>
    </main>
</body>

</html>