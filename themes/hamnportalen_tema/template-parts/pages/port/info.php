<?php
  $rating = $portData["rating"];
  $price = $portData["price"];
  $long = $portData["long"];
  $lat = $portData["lat"];
  $sea_chart = $portData["sea_chart"];
  $guests = $portData["max_guests"];
  $anchoring = $portData["anchoring"]; // array
  $description = $portData["description"];
  $description_headline = $portData["description_headline"];
?>

<article class="port-info port-article">

  <div class="port-article__header">
    <h1 class="port-article__name"> <?php echo $portData["name"]; ?> </h1>
    <div class="port-rating">  
      <?php for ($i = 0; $i < $rating; $i++) { ?>
         <img src="<?php echo get_template_directory_uri(); ?>/assets/images/star.svg" alt="star rating symbol" >
      <?php } ?>
    </div>
    <h4 class="port-price"><?php echo $price; ?> kr / dygn </h4>

    <div class="port-article__details">
    <?php echo "<b>Longitud:</b> $long, <b>latitud:</b> $lat | <b>Sjökort:</b> $sea_chart | <b>Gästplatser:</b> $guests | <b>Förtöjning:</b> "; 
      for ($j = 0; $j < count($anchoring); $j++) 
        if ($j != count($anchoring) - 1) {
          echo $anchoring[$j] . " / ";
        } else {
          echo $anchoring[$j];
        }
    ?>
    </div>
  </div>

  <section class="port-article__description">
    <h2> <?php echo $description_headline; ?></h2>
    <p class="port-article__text"> <?php echo $description; ?> </p>
    <div class="fader fadeOff"><p></p></div>
  </section>

</article>

<script type="text/javascript">
  let textElement = document.querySelector('.port-article__text');
  let fader = document.querySelector('.fader');
  let faderClickTarget = document.querySelector('.fader p');

  if (textElement.clientHeight > 250) {
    setStyle(textElement, '250px', 'hidden');
    fader.classList.remove('fadeOff');
    fader.classList.add('fadeOn');
    faderClickTarget.innerHTML = 'läs mer';
    faderClickTarget.addEventListener('click', handleReadMore);
  } else {
    faderClickTarget.innerHTML = '';
  }

  function setStyle(elem, height, overflow) {
    elem.style.height = height;
    elem.style.overflow = overflow;
  }

  function handleReadMore() {
    setStyle(textElement, 'auto', 'none')
    fader.classList.add('fadeOff');
    faderClickTarget.innerHTML = 'läs mindre';

    faderClickTarget.removeEventListener('click', handleReadMore);
    faderClickTarget.addEventListener('click', handleReadLess);
  }

  function handleReadLess() {
    setStyle(textElement, '250px', 'hidden');
    fader.classList.remove('fadeOff');
    fader.classList.add('fadeOn');
    faderClickTarget.innerHTML = 'läs mer';

    faderClickTarget.removeEventListener('click', handleReadLess);
    faderClickTarget.addEventListener('click', handleReadMore);
  }

</script>