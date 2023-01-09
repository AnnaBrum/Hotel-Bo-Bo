<?php

declare(strict_types=1);
include_once('../header.php');
require('../checkinput.php');
require('../calendar/calendar.php');
?>

</div>
<div class="room-3">
    <!-- <h3>LUXURY</h3> -->
    <article class="room luxury">
        <div class="room-wrapper">
            <img class="room-img" src="../images/luxury.png" alt="luxury motel-room" />
            <p class="room-details">FEE 3💰/ night</p>
            <p class="room-description">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                Consequuntur ex iure dolorum maiores nihil ipsam ipsum hic autem
                ea consequatur, non dolor asperiores adipisci assumenda
                dignissimos? Nisi tenetur molestias dolores.
            </p>
        </div>
        <!-- DISPLAY CALENDAR FOR LUXURY-ROOM -->
        <div class="calendar-wrapper">
            <?= $luxury->draw(date('2023-01-01')); ?>
        </div>
    </article>
</div>
<?php require('../form.php') ?>