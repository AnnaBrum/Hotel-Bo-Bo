<?php

declare(strict_types=1);
include_once(__DIR__ . '/header.php');
require(__DIR__ . '/checkinput.php');
require(__DIR__ . '/calendar/calendar.php');
?>
<section class="hero">
<img src="/Yrgopelago/images/front.svg" alt="Hotel front">
</section>

<section class="rooms">
    <a id="BUDGET">
        <div id="budget">
            <article class="room budget">
                <div class="room-wrapper">
                    <img class="room-img" src="./images/budget.png" alt="budget motel-room" />
                    <p class="room-details">FEE $1 night</p>
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
    </a>
    <a id="STANDARD">
        <div id="standard">

            <article class="room standard">
                <div class="room-wrapper">
                    <img class="room-img" src="./images/standard.png" alt="standard motel-room" />
                    <p class="room-details">FEE $2 night</p>
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
    </a>
    <a id="LUXURY">
        <div id="luxury">
            <article class="room luxury">
                <div class="room-wrapper">
                    <img class="room-img" src="./images/luxury.png" alt="luxury motel-room" />
                    <p class="room-details">FEE $3 night</p>
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
    </a>
</section>
<?php require(__DIR__ . '/form.php') ?>

</main>
<script src="./javascript/yrgopelago.js"></script>
</body>