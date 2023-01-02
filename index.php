<?php
declare(strict_types=1);
require __DIR__ . '/header.php';
?>
    <section class="rooms">
      <h2>OUR ROOMS</h2>
      
      <div class="room-1">
      <h3>BUDGET</h3>
      <article class="room budget">      
        <div class="room-wrapper">        
          <img class="room-img" src="./images/psycho/economy.jpg" alt="budget motel-room" />
          <p class="room-details">FEE 1💰 / night</p>
          <p class="room-description">
            consectetur adipisicing elit.
            Consequuntur ex iure dolorum maiores nihil ipsam ipsum hic autem
            ea consequatur, non dolor asperiores adipisci assumenda
            dignissimos? Nisi tenetur molestias dolores.
          </p>
        </div>
        <div class="calendar-wrapper">
          <?= $calendar->draw(date('2023-01-01')); ?>
        </div>
      </article>
      </div>
      <div class="room-2">
      <h3>STANDARD</h3>
      <article class="room standard">
        <div class="room-wrapper">
          <img class="room-img" src="./images/psycho/standard.jpeg" alt="standard motel-room" />
          <p class="room-details">FEE 2💰/ night</p>
          <p class="room-description">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit.
            Consequuntur ex iure dolorum maiores nihil ipsam ipsum hic autem
            ea consequatur, non dolor asperiores adipisci assumenda
            dignissimos? Nisi tenetur molestias dolores.
          </p>
        </div>
        <div class="calendar-wrapper">
          <?= $calendar->draw(date('2023-01-01')); ?>
        </div>
      </article>
      </div>
      <div class="room-3">
      <h3>LUXURY</h3>
      <article class="room luxury">
        <div class="room-wrapper">
          <img class="room-img" src="./images/psycho/luxury.jpeg" alt="luxury motel-room" />
          <p class="room-details">FEE 3💰/ night</p>
          <p class="room-description">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit.
            Consequuntur ex iure dolorum maiores nihil ipsam ipsum hic autem
            ea consequatur, non dolor asperiores adipisci assumenda
            dignissimos? Nisi tenetur molestias dolores.
          </p>
        </div>
        <div class="calendar-wrapper">
          <?= $calendar->draw(date('2023-01-01')); ?>
        </div>
      </article>
      </div>
    </section>

    <section class="booking-form">
      <h2> RESERVATION </h2>
      <!-- skicka till annan sida med kvitto -->
      <form action="/index.php" method="post">
        <!-- transfer-code -->
        <label for="name">Your Name</label>
        <input type="text" name="name">
        <!-- transfer-code -->
        <label for="transfer-code">Transfer-code</label>
        <input type="text" name="transfer-code">
        <!-- arrival-date -->
        <label for="arrival">Arrival</label>
        <input type="date" name="arrival" class="form-input" min="2023-01-01" max="2023-01-31">
        <!-- departure-date -->
        <label for="departure">Departure</label>
        <input type="date" name="departure" class="form-input" min="2023-01-01" max="2023-01-31">
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
        <button type="submit" name="submit">Make a reservation</button>        
      </form>
      <div class="availability">
      <?php checkInput();?> 
      </div>
    </section>
  </main>
  <script src="/javascript/yrgopelago.js"></script>
</body>
<footer></footer>
</html>