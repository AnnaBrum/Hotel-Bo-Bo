<?php

declare(strict_types=1);
include_once __DIR__ . '/calendar/calendar.php';
require __DIR__ . '/dbconnection.php';
include_once __DIR__ . '/bookings.php';
require __DIR__ . '/validation.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="/style/style.css" />
  <link rel="stylesheet" href="/style/mediaqueries.css" />


  <title>Bates motel</title>
</head>

<body>
  <main>
    <section class="hero">
      <h1>BATES MOTEL</h1>
      <div class="hero-image">
        <img src="/images/psycho/hero.jpeg" alt="Bates Motel sign" srcset="" />
      </div>
      <article class="welcoming">
        <h2>Welcome to Bates Motel!</h2>
        <p>
          This cozy family run gem of a motel won't let you down with it's warm hospitality and care for details. Your host Norman Bates lives in the family-villa just a stone's throw from the main facilities and will be at your service before you even know you need it!
        </p>
      </article>
    </section>