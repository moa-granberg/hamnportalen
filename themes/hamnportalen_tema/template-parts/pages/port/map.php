<?php
  require_once(realpath( __DIR__ ).'/../search-results/.env.php' );
?>

<article class="port-map port-article" data-value="<?php echo $portData['name'] ?>"></article>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo $apiKey ?>&callback=initMap" type="text/javascript"></script>
<script async type="text/javascript">

  const mapContainer = document.querySelector('.port-map');

  const getPort = async (portName) => {
    const url = `${window.location.href.split('/blog/')[0]}/wp-json/mapsearch/search/${portName}/`;
    const results = await fetch(url).then(response => response.json());
    return results[0];
  }

  async function initMap() {  
    const port = await getPort(mapContainer.getAttribute('data-value'));

    const map = new google.maps.Map(mapContainer, {
      zoom: 10,
      center: { lat: port.lat, lng: port.long },
    });

    new google.maps.Marker({
      position: { lat: port.lat, lng: port.long },
      icon: 'https://maps.google.com/mapfiles/ms/micons/marina.png',
      map
    });
  }

</script>