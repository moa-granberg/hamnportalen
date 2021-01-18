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
    `<a class="map-info map-info__card-wrapper" href="${port.url}">
      <div class="map-info__img-wrapper">
        <img src=${port.img}>
      </div>
      <h3 class="map-info__title">${port.title}</h3>
      <h4 class="map-info__price">${port.price} kr/dygn</h4>
    </a>`
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

  const bounds = new google.maps.LatLngBounds();

  const map = new google.maps.Map(mapContainer, {
    center,
  });

  const features = ports.map(port => {
    return {
      position: new google.maps.LatLng(port.lat, port.long),
      map: map,
      title: port.name,
      price: port.price,
      img: port.img_url,
      url: port.url,
    }
  })
  // The marker
  features.forEach(mark => {
    const marker = new google.maps.Marker({
      position: mark.position,
      icon: 'https://maps.google.com/mapfiles/ms/micons/marina.png',
      map: map,
    })
    const infowindow = new google.maps.InfoWindow({
      content: generateInfoWindow(mark), 
    });
    marker.addListener("click", () => {
      infowindow.open(marker.get("map"), marker)
    });
    bounds.extend(marker.position);
  });

  if (ports.length === 1) {
    map.setZoom(14);
  } else {
    map.fitBounds(bounds);
  }
}

</script>