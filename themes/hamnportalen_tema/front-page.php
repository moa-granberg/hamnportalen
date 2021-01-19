<?php
get_header();
?>

<section class="start-main-wrapper">
    <?php
    require_once(__DIR__ . '/template-parts/pages/start/hero.php');
    require_once(__DIR__ . '/template-parts/pages/start/events.php');
    require_once(__DIR__ . '/template-parts/pages/start/attractions.php');
    ?>
</section>

<?php
get_footer();
