<?php
declare(strict_types=1);
include_once 'calendar.php';
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
            <img
              class="room-img"
              src="./images/economy.jpg"
              alt="economy motel-room"
            />
            <p class="room-description">
            consectetur adipisicing elit.
              Consequuntur ex iure dolorum maiores nihil ipsam ipsum hic autem
              ea consequatur, non dolor asperiores adipisci assumenda
              dignissimos? Nisi tenetur molestias dolores.
            </p>
          </div>
          <h3>VACANCIES</h3>
          <div class="calendar">
            <?=$calendar->draw(date('2023-01-01'));?>
          </div>
        </article>

        <article class="standard">
          <h2>STANDARD</h2>
          <div class="room-wrapper">
            <img
              class="room-img"
              src="./images/standard.jpeg"
              alt="standard motel-room"
            />
            <p class="room-description">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Consequuntur ex iure dolorum maiores nihil ipsam ipsum hic autem
              ea consequatur, non dolor asperiores adipisci assumenda
              dignissimos? Nisi tenetur molestias dolores.
            </p>
          </div>
          <h3>VACANCIES</h3>
          <div class="calendar"><?=$calendar->draw(date('2023-01-01'));?></div>
        </article>

        <article class="luxury">
          <h2>LUXURY</h2>
          <div class="room-wrapper">
            <img
              class="room-img"
              src="./images/luxury.jpeg"
              alt="luxury motel-room"
            />
            <p class="room-description">
              Lorem ipsum dolor sit, amet consectetur adipisicing elit.
              Consequuntur ex iure dolorum maiores nihil ipsam ipsum hic autem
              ea consequatur, non dolor asperiores adipisci assumenda
              dignissimos? Nisi tenetur molestias dolores.
            </p>
          </div>
          <h3>VACANCIES</h3>
          <div class="calendar"><?=$calendar->draw(date('2023-01-01'));?></div>
        </article>
      </section>
    </main>
  </body>
</html>
