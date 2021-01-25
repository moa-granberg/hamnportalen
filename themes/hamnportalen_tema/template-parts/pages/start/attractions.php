<?php
  global $wpdb;
  $table_name = $wpdb->prefix . 'posts';

  $attractions = $wpdb->get_results(
    "SELECT * FROM $table_name
    WHERE post_type = 'attraction'
    AND post_status = 'publish'
    LIMIT 4"
  );

  function get_close_ports_string ($ports) {
    $port_titles = [];

    foreach($ports as $port) {
      array_push($port_titles, $port->post_title);
    }

    return implode(', ', $port_titles);
  }

?>

<article class="start-attractions start-article">
  <div class="start-article__header">
    <h2>Sevärdheter</h2>
  </div>

  <div class="start-attractions__content-wrapper">
    <?php
      foreach($attractions as $attraction) {
        $attraction_data = get_fields($attraction->ID);
    ?>
      <div class="attraction-card">
        <img src="<?php echo $attraction_data['img_url'] ?>"/>
        <div class="attraction-card__text-wrapper">
          <div class="attraction-card__heading">
            <h3><?php echo $attraction->post_title ?></h3>
          </div>
          <div class="attraction-card__inner-text-wrapper">
            <h4><?php echo get_close_ports_string($attraction_data['ports']) ?></h4>
            <p><?php echo $attraction_data['description'] ?></p>
          </div>
        </div>
      </div>
    <?php
      }
    ?>
  </div>
</article>