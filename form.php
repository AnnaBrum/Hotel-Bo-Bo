<?php

declare(strict_types=1);
// include_once('header.php');
?>
<a id="BOOKING">
  <section class="booking-form">
    <h2> BOOK YOUR ROOM </h2>
    <form action="/index.php" method="post" class="booking">

      <label for="name">Your Name</label>
      <input type="text" name="name" required> <!-- Field must be filled in, otherwise an error-message will be displayed -->

      <label for="transfer-code">Transfer-code</label>
      <input type="text" name="transfer-code" required>

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

      <!-- Shows features if there are any. -->
      <?php 
      $featureList = file_get_contents("features.json");
      $featureList = json_decode($featureList, TRUE);

      if (!is_null($featureList)) : 
        $newArr = [];

        foreach ($featureList as $features) :
          $newArr[$features["feature"]] = $features["featurePrice"];
        endforeach;

        $features = $newArr;
          ?> <div class="features"> <?php
          foreach ($features as $feature => $featurePrice) : ?>
            <div class="feature">
              <label for="<?= $feature; ?>"><?= ucfirst($feature); ?> ($<?= $featurePrice; ?>)</label>
              <input type="checkbox" id="<?= $feature; ?>" name="features[<?= $feature; ?>]" value="<?= $featurePrice; ?>">
            </div>

          <?php endforeach; ?>
        </div> <?php
      endif; ?>

      <button type="submit" name="submit">Make a reservation</button>
    </form>

    <!-- RUNS CHECK-UP ON SUBMITTED FORM AND DISPLAYS EITHER ERROR MESSAGE OR BOOKING CONFIRMATION WHEN SUBMITTING -->
    <div class="check-input">
      <?php checkInput(); ?>
    </div>
  </section>
</a>



