<article class="port-hero port-article">
  <div class="slider-container">

  <?php
  
  $arrowLeftUrl = get_theme_file_uri('/assets/images/arrow-left-white.svg');
  $arrowRightUrl = get_theme_file_uri('/assets/images/arrow-right-white.svg');
  $fields = get_field_objects();

  echo "
  <div id='arrow-left' class='arrow'>
    <img src=$arrowLeftUrl alt='arrow left'>
  </div>
  ";
  
  foreach ($fields as $field) {
    $label = $field["label"];
    $imageUrl = $field["value"];
    if (strpos($label, 'Hero IMG') === 0 && (gettype($imageUrl) === "string")) {
      echo "
        <div class='slide'>
          <div class='slide-content'>
            <img src=$imageUrl alt='port image'>
          </div>
        </div>
      ";
    }
  }

  echo "
  <div id='arrow-right' class='arrow'>
    <img src=$arrowRightUrl alt='arrow right'>
  </div>
  ";
  
  ?>
  
  </div>
</article>

<script>

const sliderImages = document.querySelectorAll(".slide");
const arrowRight = document.querySelector("#arrow-right");
const arrowLeft = document.querySelector("#arrow-left");
let current = 0;

const reset = () => {
  for(let i = 0; i < sliderImages.length; i++) {
    sliderImages[i].style.display = "none";
  }
}

const startSlide = () => {
  reset();
  sliderImages[0].style.display = "block";
}

const slideLeft = () => {
  reset();
  sliderImages[current - 1].style.display = "block";
  current--;
}

const slideRight = () => {
  reset();
  sliderImages[current + 1].style.display = "block";
  current++;
}

arrowLeft.addEventListener("click", () => {
  if(current === 0) {
    current = sliderImages.length;
  }
  slideLeft();
})

arrowRight.addEventListener("click", () => {
  if(current === sliderImages.length - 1) {
    current = -1;
  }
  slideRight();
})

startSlide();

</script>