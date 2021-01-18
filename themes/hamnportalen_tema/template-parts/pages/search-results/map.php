<?php
?>
<div class="search-result-map-wrapper"></div>


<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhZ_WbKFU-E6YCJuoB3dD0BWVTYuO8Km8&callback=initMap" type="text/javascript"></script>
<script async type="text/javascript">

function extractSearchParam() {
  const url = window.location.href;
  const regex = /params=(.*)/
  return url.match(regex)[1].split('').slice(0, this.length -1 ).join('');
}

const getPorts = async () => {
  const param = extractSearchParam();
  const url = `${window.location.href.split('/search-results/')[0]}/wp-json/mapsearch/search/${param}/`;
  const result = await fetch(url).then(response => response.json());
  return result;
}

const generateInfoWindow = (port) => {
  return (
    `<div class="map-info map-info__card-wrapper">
      <div class="map-info__img-wrapper">
        <img src=${port.img}>
      </div>
      <h3>${port.title}</h3>
      <h4>${port.price} kr per dygn</h4>
    </div>`
  )
}

const getCenter = (list) => {
  const getMedian = (arr) => {
    arr.sort((a, b) => a-b);
    const half = Math.floor(arr.length / 2);

    if (arr.length % 2) {
      return arr[half];
    }

    return (arr[half - 1] + arr[half]) / 2.0;
  }

  const lat = parseFloat(getMedian(list.lat).toFixed(6));
  const lng = parseFloat(getMedian(list.lng).toFixed(6));
  return { lat, lng };
}

const mapContainer = document.querySelector('.search-result-map-wrapper')

// Initialize and add the map
async function initMap() {
  let ports = await getPorts();

  const center = getCenter( {
    lat: ports.map(port => port.lat),
    lng: ports.map(port => port.long),
  });

  const map = new google.maps.Map(mapContainer, {
    zoom: 14,
    center,
  });

  const features = ports.map(port => {
    return {
      position: new google.maps.LatLng(port.lat, port.long),
      map: map,
      title: port.name,
      price: port.price,
      img: port.img_url
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