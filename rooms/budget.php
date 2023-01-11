<?php

declare(strict_types=1);
include_once(__DIR__ . '/../header.php');
require(__DIR__ . '/../checkinput.php');
require(__DIR__ . '/../calendar/calendar.php');
?>

<div class="room-1">
    <article class="room budget">
        <div class="room-wrapper">
            <img class="room-img" src="./images/budget.png" alt="budget motel-room" />
            <p class="room-details">FEE 1💰 / night</p>
            <p class="room-description">
                consectetur adipisicing elit.
                Consequuntur ex iure dolorum maiores nihil ipsam ipsum hic autem
                ea consequatur, non dolor asperiores adipisci assumenda
                dignissimos? Nisi tenetur molestias dolores.
            </p>
        </div>
        <!-- DISPLAY CALENDAR FOR BUDGET-ROOM -->
        <div class="calendar-wrapper">
            <?= $budget->draw(date('2023-01-01')); ?>
        </div>
    </article>
</div>
<?php require(__DIR__ . '/../form.php') ?>