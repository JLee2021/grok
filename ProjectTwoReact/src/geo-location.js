function getCurrentPosition() {
  const options = {
    enableHighAccuracy: true, // increased power consumption on mobile devices
    timeout: 10000, // 10 secs
    maximumAge: 0, // never use cached value
  };

  return new Promise((resolve, reject) => {
    navigator.geolocation.getCurrentPosition(resolve, reject, options);
  });
}

export async function showPosition() {
  if (navigator.geolocation) {
    var position = await getCurrentPosition(); // wait for getCurrentPosition to complete

    return position;
  } else {
    console.log("geolocation not supported");
  }
}

// position.coords.accuracy
// position.coords.altitude
// position.coords.altitudeAccuracy
// position.coords.heading
// position.coords.latitude
// position.coords.longitude
// position.coords.speed
