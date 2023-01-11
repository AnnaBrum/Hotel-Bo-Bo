<?php

declare(strict_types=1);
include_once('../header.php');
require('../checkinput.php');
require('../calendar/calendar.php');
?>


<div class="room-2">
    <!-- <h3>STANDARD</h3> -->
    <article class="room standard">
        <div class="room-wrapper">
            <img class="room-img" src="../images/standard.png" alt="standard motel-room" />
            <p class="room-details">FEE 2💰/ night</p>
            <p class="room-description">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                Consequuntur ex iure dolorum maiores nihil ipsam ipsum hic autem
                ea consequatur, non dolor asperiores adipisci assumenda
                dignissimos? Nisi tenetur molestias dolores.
            </p>
        </div>
        <!-- DISPLAY CALENDAR FOR STANDARD-ROOM -->
        <div class="calendar-wrapper">
            <?= $standard->draw(date('2023-01-01')); ?>
        </div>
    </article>
</div>
<?php require('../form.php') ?>