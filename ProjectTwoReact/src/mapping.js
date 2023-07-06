function getMap() {
  let lat = 41.572464;
  let lon = -69.48757;

  var map = L.map("map", {
    center: [lat, lon],
    zoom: 10,
  });

  // create marker
  var marker = new L.Marker([lat, lon]);
  marker.bindPopup("41.57, -69.48, additional haul info here").openPopup();
  marker.addTo(map); // add marker

  var layer = new L.TileLayer(
    "http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
  );

  map.addLayer(layer);

  return map;
}

export { getMap };
