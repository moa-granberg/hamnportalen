<article class="port-personnel port-article">
  <div class="port-article__header">
    <h2>Vi som jobbar här</h2>
    <hr/>    
  </div>

    <?php

    $staffOneName = $portData["staff_name_1"];
    $staffTwoName = $portData["staff_name_2"];
    $staffThreeName = $portData["staff_name_3"];
    $staffOneImageUrl = $portData["staff_img_1"];
    $staffTwoImageUrl = $portData["staff_img_2"];
    $staffThreeImageUrl = $portData["staff_img_3"];
    
    echo "
    <div class='personnel-card-wrapper'>
      <div class='personnel-card'>
        <img src='$staffOneImageUrl'>
        <h4>$staffOneName</h4>
      </div>
      <div class='personnel-card'>
        <img src='$staffTwoImageUrl'>
        <h4>$staffTwoName</h4>
      </div>
      <div class='personnel-card'>
        <img src='$staffThreeImageUrl'>
        <h4>$staffThreeName</h4>
      </div>
    </div>
    "
  
    ?>
</article>

