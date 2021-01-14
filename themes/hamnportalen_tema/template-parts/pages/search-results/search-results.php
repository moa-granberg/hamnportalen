<?php
$listClass = "show-search-button";
$mapClass = "hide-search-button";

if (isset($_POST["map"])) {
  $mapClass = "show-search-button";
  $listClass = "hide-search-button";
}
if (isset($_POST["list"])) {
  $listClass = "show-search-button";
  $mapClass = "hide-search-button";
}

?>
<section class="search-results-main-wrapper">
  <?php require_once(__DIR__ . '/map.php'); ?>
  <?php require_once(__DIR__ . '/list.php'); ?>
</section>

<form class="<?php echo $listClass ?>" action="" method="POST">
  <input type="submit" value="Karta" name="map">
</form>
<form class="<?php echo $mapClass ?>" action="" method="POST">
  <input type="submit" value="Lista" name="list">
</form>
