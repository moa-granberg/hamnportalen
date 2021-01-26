<?php
  global $wpdb;
  $table_name = $wpdb->prefix . "posts";
  
  $results = $wpdb->get_results(
    "SELECT * FROM $table_name 
    WHERE post_status = 'publish'
    AND post_type = 'event'
    LIMIT 4
    ");
?>
    
<article class="start-events start-article">
  <div class="start-article__header">
    <h2>Kommande event</h2>
  </div>

  <article class="hp-event-wrapper">
  <?php
    foreach ($results as $event){
      $event_id = $event->ID;
      $data = get_fields( $event_id );
      $port_url = $data['ports'][0]->guid;
  ?>
    <a href="<?php echo $port_url; ?>" class="hp-event-card-link">
      <article class="hp-event-card hp-event__wrapper">
        <div id="hp-event__info-wrapper">
          <h3><?php echo $data['ports'][0]->post_title ?></h3>
          <h4 class="hp-event-h4"><?php echo $data['title'] ?></h4>
          <p class="hp-event-date"><?php echo $data['date'] . '  |  ' . $data['time'];?></p>
          <div class="hp-event-description lineclamp"><p><?php echo $data['description'];?></p></div>
        </div>
        <div class="hp-event__img-wrapper">
          <img src="<?php echo $data['img_url']; ?>" alt="">
        </div>
      </article>
    </a>
  <?php };?>
  </article>
  
</article>
