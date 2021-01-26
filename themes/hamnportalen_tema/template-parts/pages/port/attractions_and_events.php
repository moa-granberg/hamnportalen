<?php
  global $wpdb;
  $table_name = $wpdb->prefix . 'posts';

  //select all possible entries from db
  $allEntries = $wpdb->get_results(
    "SELECT * FROM $table_name
    WHERE (post_type = 'attraction' OR post_type = 'event')
    AND post_status = 'publish'"
  );

  //find entries whose ports matches current port & format output
  $data = [];
  foreach($allEntries as $entry) {
    $ports = get_field('ports', $entry->ID);
    foreach($ports as $port) {
      if ($port->post_title == $portData['name']) {
        $newEntry = new stdClass();
        $newEntry->title = $entry->post_title;
        $newEntry->description = get_field('description', $entry->ID);
        $newEntry->img_url = get_field('img_url', $entry->ID);
        $newEntry->type = $entry->post_type;

        if ($newEntry->type == 'event') {
          $newEntry->date = get_field('date', $entry->ID);
          $newEntry->time = get_field('time', $entry->ID);
        }

        array_push($data, $newEntry);
      }
    }
  }

  if (count($data)) { ?>
    <article class="port-attractions-and-events port-article">
      <div class="port-article__header">
        <h2>Sevärdheter & event</h2>
        <hr/>
      </div>

      <div class="port-attractions-and-events__card-wrapper">
        <?php 
          foreach($data as $entry) { ?>
            <div class="attraction-card">
              <img src="<?php echo $entry->img_url ?>"/>

              <div class="attraction-card__text-wrapper">
                <div class="attraction-card__heading <?php echo $entry->type == 'event' ? 'event' : ''; ?>">
                  <h3><?php echo $entry->title ?></h3>
                </div>

                <div class="attraction-card__inner-text-wrapper">
                  <p><?php echo $entry->description ?></p>
                </div>

                <?php
                if ($entry->type == 'event') {
                  ?>
                  <p class="event-card__info-paragraph"><?php echo $entry->date ?> | kl. <?php echo $entry->time ?></p>
                  <?php
                }
                ?>
              </div>
            </div>
            <?php
          }
        ?>
      </div>

      <div id="event-fader" class="event-fadeOff">
        <button class="secondary_btn"></button>
      </div>
    </article>

  <?php
  }
?>


<script type="text/javascript">
  const attrAndEventsWrapper = document.querySelector('.port-attractions-and-events__card-wrapper');
  const attrAndEventsFader = document.querySelector('#event-fader');
  const attrAndEventsFaderClickTarget = document.querySelector('#event-fader > button');

  if (attrAndEventsWrapper.childElementCount > 2) {
    setStyleAttractionsAndEvent(attrAndEventsWrapper, '500px', 'hidden');
    attrAndEventsFader.classList.remove('event-fadeOff');
    attrAndEventsFader.classList.add('event-fadeOn');
    attrAndEventsFaderClickTarget.innerHTML = 'se mer';
    attrAndEventsFaderClickTarget.addEventListener('click', handleReadMoreAttractionsAndEvent);
  } else {
    attrAndEventsFader.remove(attrAndEventsFaderClickTarget);
  }

  function setStyleAttractionsAndEvent(elem, height, overflow) {
    elem.style.height = height;
    elem.style.overflow = overflow;
  }

  function handleReadMoreAttractionsAndEvent() {
    setStyleAttractionsAndEvent(attrAndEventsWrapper, 'auto', 'none')
    attrAndEventsFader.classList.remove('event-fadeOn');
    attrAndEventsFader.classList.add('event-fadeOff');
    attrAndEventsFaderClickTarget.innerHTML = 'se mindre';

    attrAndEventsFaderClickTarget.removeEventListener('click', handleReadMoreAttractionsAndEvent);
    attrAndEventsFaderClickTarget.addEventListener('click', handleReadLessAttractionsAndEvent);
  }

  function handleReadLessAttractionsAndEvent() {
    setStyleAttractionsAndEvent(attrAndEventsWrapper, '500px', 'hidden');
    attrAndEventsFader.classList.remove('event-fadeOff');
    attrAndEventsFader.classList.add('event-fadeOn');
    attrAndEventsFaderClickTarget.innerHTML = 'se mer';

    attrAndEventsFaderClickTarget.removeEventListener('click', handleReadLessAttractionsAndEvent);
    attrAndEventsFaderClickTarget.addEventListener('click', handleReadMoreAttractionsAndEvent);
  }

</script>
