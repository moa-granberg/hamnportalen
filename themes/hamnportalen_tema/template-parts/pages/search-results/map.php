<?php
?>
<main class="wrapper">
<div class="map" style="width: 100%; height: 400px; border: 1px solid red;">Map goes here</div>
<div class="results"></div>
</main>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhZ_WbKFU-E6YCJuoB3dD0BWVTYuO8Km8&callback=initMap" type="text/javascript"></script>
<script async type="text/javascript">

function extractSearchParam() {
  const url = window.location.href;
  const regex = /params=(.*)/
  return url.match(regex)[1].split('').slice(0, this.length -1 ).join('')
}

const list = async () => {
  const param = extractSearchParam()
  const url = `http://localhost/hamnportalen_new/wp-json/mapsearch/search/${param}`
  const result = await fetch(url).then(response => response.json())
  console.log('result: ', result);
  return result
}

list()

// const api = 'AIzaSyAhZ_WbKFU-E6YCJuoB3dD0BWVTYuO8Km8'
const mapContainer = document.querySelector('.map')
const results = document.querySelector('.results')

let map;
const ports = [
  {
    lat: 59.822594,
    long: 18.994963,
    name: 'Vätö'
  },
  {
    lat: 59.753282,
    long: 18.720171,
    name: 'Norrtälje hamn'
  },
  {
    lat: 60.399610,
    long: 18.478808,
    name: 'Gräsö hamn'
  }
]

// Initialize and add the map
function initMap() {

  const center = { lat: ports[0].lat, lng: ports[0].long };

  const map = new google.maps.Map(mapContainer, {
    zoom: 8,
    center: center,
  });

  const features = ports.map(port => {
    return {
      position: new google.maps.LatLng(port.lat, port.long),
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