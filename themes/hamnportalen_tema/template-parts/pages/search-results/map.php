<?php
?>
<main class="wrapper" style="width: 500px height: 500px" >
<div class="map" style="width: 50vw; height: 400px; border: 1px solid red;">Map goes here</div>
<div class="results"></div>
</main>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhZ_WbKFU-E6YCJuoB3dD0BWVTYuO8Km8&callback=initMap" type="text/javascript"></script>
<script async type="text/javascript">

function extractSearchParam() {
  const url = window.location.href;
  const regex = /params=(.*)/
  return url.match(regex)[1].split('').slice(0, this.length -1 ).join('');
}

const getPorts = async () => {
  const param = extractSearchParam();
  const url = `http://localhost/hamnportalen_new/wp-json/mapsearch/search/${param}`
  const result = await fetch(url).then(response => response.json());

  return result;
}

const getLong = (port) => {
  return Number(port.find(obj => obj.meta_key === 'long').meta_value);
}

const getLat = (port) => {
  return Number(port.find(obj => obj.meta_key === 'lat').meta_value);
}

const mapContainer = document.querySelector('.map')
const results = document.querySelector('.results')

// Initialize and add the map
async function initMap() {
  let ports = await getPorts();
  console.log(typeof getLat(ports[0]));
  const center = { lat: getLat(ports[0]), lng: getLong(ports[0]) };

  const map = new google.maps.Map(mapContainer, {
    zoom: 14,
    center: center,
  });

  const features = ports.map(port => {
    
    return {
      position: new google.maps.LatLng(getLat(port), getLong(port)),
      map: map,
      title: port.name
    }
  })
  // The marker
  features.forEach(mark => {
    const marker = new google.maps.Marker({
      position: mark.position,
      map: map,
    })
    const infowindow = new google.maps.InfoWindow({
      content: mark.title,
    });
    marker.addListener("click", () => {
      infowindow.open(marker.get("map"), marker)
    });
  });
}


</script>