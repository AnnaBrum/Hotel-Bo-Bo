<?php

declare(strict_types=1);
include_once __DIR__ . '/calendar.php';
require __DIR__ . '/dbconnection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" type="text/css" href="/calendar.css">


  <title>Bates motel</title>
</head>

<body>
  <main>
    <section class="hero">
      <div class="hero-image">
        <!-- <img src="/images/hero.jpeg" alt="Bates Motel sign" srcset="" /> -->
      </div>
      <article class="welcoming">
        <h1>Welcome to Bates Motel!</h1>
        <p>
          This cozy family run gem of a motel won't let you down with it's warm hospitality and care for details. Your host Norman Bates lives in the family-villa just a stone's throw from the main facilities and will be at your service before you even know you need it!
        </p>
      </article>
    </section>

    <section class="rooms">
      <article class="economy">
        <h2>ECONOMY</h2>
        <div class="room-wrapper">
          <img class="room-img" src="./images/economy.jpg" alt="economy motel-room" />
          <p class="room-description">
            consectetur adipisicing elit.
            Consequuntur ex iure dolorum maiores nihil ipsam ipsum hic autem
            ea consequatur, non dolor asperiores adipisci assumenda
            dignissimos? Nisi tenetur molestias dolores.
          </p>
        </div>
        <h3>VACANCIES</h3>
        <div class="calendar">
          <?= $calendar->draw(date('2023-01-01')); ?>
        </div>
      </article>

      <article class="standard">
        <h2>STANDARD</h2>
        <div class="room-wrapper">
          <img class="room-img" src="./images/standard.jpeg" alt="standard motel-room" />
          <p class="room-description">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit.
            Consequuntur ex iure dolorum maiores nihil ipsam ipsum hic autem
            ea consequatur, non dolor asperiores adipisci assumenda
            dignissimos? Nisi tenetur molestias dolores.
          </p>
        </div>
        <h3>VACANCIES</h3>
        <div class="calendar"><?= $calendar->draw(date('2023-01-01')); ?></div>
      </article>

      <article class="luxury">
        <h2>LUXURY</h2>
        <div class="room-wrapper">
          <img class="room-img" src="./images/luxury.jpeg" alt="luxury motel-room" />
          <p class="room-description">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit.
            Consequuntur ex iure dolorum maiores nihil ipsam ipsum hic autem
            ea consequatur, non dolor asperiores adipisci assumenda
            dignissimos? Nisi tenetur molestias dolores.
          </p>
        </div>
        <h3>VACANCIES</h3>
        <div class="calendar"><?= $calendar->draw(date('2023-01-01')); ?></div>
      </article>
    </section>

    <section class="booking-form">
      <div class="booking-wrapper">
        <form action="/index.php" method="post">
          <!-- transfer-code -->
          <label for="name">Your Name</label>
          <input type="text" name="name">
          <!-- transfer-code -->
          <label for="transfer-code">Transfer-code</label>
          <input type="text" name="transfer-code">
          <!-- arrival-date -->
          <label for="arrival" class="form-input">Arrival</label>
          <input type="date" name="arrival" class="form-input">
          <!-- departure-date -->
          <label for="departure">Departure</label>
          <input type="date" name="departure" class="form-input">
          <!-- choose room -->
          <label for="room">Choose Room</label>
          <select name="room" class="form-input">
            <option value="1">Budget</option>
            <option value="2">Standard</option>
            <option value="3">Luxury</option>
          </select><br>
          <!-- features -->
          <!-- <input type="radio" id="html" name="fav_language" value="HTML">
          <label for="html">HTML</label><br>
          <input type="radio" id="css" name="fav_language" value="CSS">
          <label for="css">CSS</label><br>
          <input type="radio" id="javascript" name="fav_language" value="JavaScript">
          <label for="javascript">JavaScript</label> -->
          <!-- submit -->
          <button type="submit">Make a reservation</button>
        </form>
      </div>
    </section>
  </main>
</body>

</html>
