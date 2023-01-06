<?php
declare(strict_types=1);
include_once( __DIR__ . '/header.php');
// require(__DIR__ . '/checkinput.php');
// require(__DIR__ . '/calendar/calendar.php');
?>
  <!-- <main>
    <section class="hero">
      <div class="hero-image">
        <img src="/images/psycho/hero.jpeg" alt="Bates Motel sign" srcset="" />
      </div>
      <article class="welcoming">
        <h1>Welcome to Bates Motel!</h1>
        <p>
          This cozy family run gem of a motel won't let you down with it's warm hospitality and care for details. Your host Norman Bates lives in the family-villa just a stone's throw from the main facilities and will be at your service before you even know you need it!
        </p>
      </article>
    </section>

    <section class="rooms">
      <h2>OUR ROOMS</h2> -->
      
      <!-- <div class="room-1">
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
          <?= $budget->draw(date('2023-01-01')); ?>
        </div>
      </article>
      </div> -->
<!-- 
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
          <?= $standard->draw(date('2023-01-01')); ?>
        </div>
      </article> -->

      <!-- </div>
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
          <?= $luxury->draw(date('2023-01-01')); ?>
        </div>
      </article>
      </div> -->
    </section>

    <section class="booking-form">
      <h2> RESERVATION </h2>
      <form action="/index.php" method="post">
        
        <label for="name">Your Name</label>
        <input type="text" name="name" required> <!-- Field must be filled in, otherwise an error-message will be displayed -->
        
        <label for="transfer-code">Transfer-code</label>
        <input type="text" name="transfer-code" required> <!-- Field must be filled in, otherwise an error-message will be displayed -->
        
        <label for="arrival">Arrival</label>
        <input type="date" name="arrival" class="form-input" min="2023-01-01" max="2023-01-31">
       
        <label for="departure">Departure</label>
        <input type="date" name="departure" class="form-input" min="2023-01-01" max="2023-01-31">
       
        <label for="room">Choose Room</label>
        <select name="room" class="form-input">
          <option value="1">Budget</option>
          <option value="2">Standard</option>
          <option value="3">Luxury</option>
        </select><br>
                
        <button type="submit" name="submit">Make a reservation</button>        
      </form>
      <!-- RUNS CHECK-UP ON SUBMITTED FORM AND DISPLAYS EITHER ERROR MESSAGE OR BOOKING CONFIRMATION WHEN SUBMITTING -->
      <div class="check-input">
      <?php checkInput();?> 
      </div>
    </section>
  </main>
  <script src="/javascript/yrgopelago.js"></script>
</body>
<footer></footer>
</html>