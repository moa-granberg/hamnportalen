<?php 
 $allFacilities = [
  "Diesel",
  "Bensin",
  "Gasol",
  "Färskvatten",
  "Toalett",
  "Dusch",
  "Bastu",
  "Tvättstuga",
  "Internet",
  "Eluttag",
  "Trailerramp",
  "Miljöstation",
  "Latrinvask",
  "Septiksug",
  "Kran/Truck",
  "Mastkran",
  "Båtvarv",
  "Motorservice",
  "Restaurang",
  "Badplats",
  "Livsmedel",
  "Handikappsanpassat",
  "Vinteröppet",
  "Ställplatser",
  "Läkare",
  "Apotek",
  "Tandläkare",
  "Veterinär",
  "Turistbyrå",
  "Buss/Tåg/Färja" 
  ];
  
  function renderFacility($facility, $portFacilities) {
    $imageUri = in_array($facility, $portFacilities) ? 
      get_theme_file_uri('/assets/images/check.svg') : 
      get_theme_file_uri('/assets/images/cross.svg');
    
    return "
      <div class='port-facilities__facility'>
        <img src='$imageUri' />
        <p>$facility</p>
      </div>
    ";
  }
?>

<article class="port-facilities port-article">
  <div class="port-article__header">
    <h2>Faciliteter</h2>
    <hr/>
  </div>

  <div class="port-facilities__facilities-wrapper">
    <?php 
    foreach ($allFacilities as $facility) { 
      echo renderFacility($facility, $portData['facilities']);
    }
    ?>
  </div>
</article>
