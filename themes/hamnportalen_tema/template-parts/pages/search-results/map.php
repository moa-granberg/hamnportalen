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

const getPortField = (port, key) => {
  let result = port.find(obj => obj.meta_key === key).meta_value;
  if (key === 'lat' || key === 'long') {
    return Number(result);
  } else {
    return result;
  }
}

const generateInfoWindow = (port) => {
  if (viewWidth > 500)
  return (
    `<div>${port.price}</div>`
  )
}

const mapContainer = document.querySelector('.map')
const results = document.querySelector('.results')

// Initialize and add the map
async function initMap() {
  let ports = await getPorts();
  const center = { lat: getPortField(ports[0], 'lat'), lng: getPortField(ports[0], 'long') };

  const map = new google.maps.Map(mapContainer, {
    zoom: 14,
    center: center,
  });
  console.log(ports);
  const features = ports.map(port => {
    return {
      position: new google.maps.LatLng(getPortField(port, 'lat'), getPortField(port, 'long')),
      map: map,
      title: getPortField(port, 'name'),
      price: getPortField(port, 'price'),
      description: getPortField(port, 'description'),
    }
  })
  // The marker
  features.forEach(mark => {
    const marker = new google.maps.Marker({
      position: mark.position,
      map: map,
    })
    const infowindow = new google.maps.InfoWindow({
      content: generateInfoWindow(mark), 
    });
    marker.addListener("click", () => {
      infowindow.open(marker.get("map"), marker)
    });
  });
}

// var markers = [];//some array
// var bounds = new google.maps.LatLngBounds();
// for (var i = 0; i < markers.length; i++) {
//  bounds.extend(markers[i]);
// }

// map.fitBounds(bounds);

</script>