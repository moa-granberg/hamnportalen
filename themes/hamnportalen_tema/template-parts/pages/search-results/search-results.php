<?php
$listClass = "show-search-result-mobile";
$mapClass = "hide-search-result-mobile";

if (isset($_POST["map"])) {
  $mapClass = "show-search-result-mobile";
  $listClass = "hide-search-result-mobile";
}
if (isset($_POST["list"])) {
  $listClass = "show-search-result-mobile";
  $mapClass = "hide-search-result-mobile";
}

?>
<section class="search-results-main-wrapper">
  <div class="<?php echo $mapClass ?>">
    <?php require_once(__DIR__ . '/map.php'); ?>
  </div>
  <div class="<?php echo $listClass ?>">
    <?php require_once(__DIR__ . '/list.php'); ?>
  </div>
</section>

<form class="<?php echo $listClass ?>" action="" method="POST">
  <input type="submit" value="Karta" name="map" class="primary_btn">
</form>
<form class="<?php echo $mapClass ?>" action="" method="POST">
  <input type="submit" value="Lista" name="list" class="primary_btn">
</form>
