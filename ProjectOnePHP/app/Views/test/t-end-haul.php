<section id="test-section-id" class="usa-section">
  <div class="grid-container">
    <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
      <h1 class="site-preview-heading margin-0">End Haul</h1>

      <form class="usa-form" id="end_haul" onsubmit="event.preventDefault();">
        <label class="usa-label" id="appointment-date-label" for="appointment-date">End date</label>
        <input class="usa-input--small" id="haul-date" name="appointment-date"  />

    </div>
    <div class="usa-form-group">
      <label class="usa-label" id="appointment-time-label" for="appointment-time">End time</label>
      <input class="usa-input--small" id="haul-time" name="appointment-time"  />
      
    </div>
    <br><br><br>
    <h3 class="site-preview-heading margin-0">End GPS</h3>
    <label class="usa-label" for="input-type-text">Latitude:</label>
    <input class="usa-input" id="lat" name="input-type-text" />
    <label class="usa-label" for="input-type-text">Longitude:</label>
    <input class="usa-input" id="lon" name="input-type-text" />

    <br><br>
    <button type="submit" class="usa-button usa-button--big">End Haul</button> <br><br>


    </form>
  </div>
</section>

<script>
  const options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0,
  };

  function success(pos) {
    const crd = pos.coords;

    var lat = crd.latitude;
    var lon = crd.longitude;
    document.getElementById("lat").value = lat;
    document.getElementById("lon").value = lon;

    console.log("Your current position is:");
    console.log(`Latitude : ${crd.latitude}`);
    console.log(`Longitude: ${crd.longitude}`);
    console.log(`More or less ${crd.accuracy} meters.`);
  }

  function error(err) {
    console.warn(`ERROR(${err.code}): ${err.message}`);
  }

  navigator.geolocation.getCurrentPosition(success, error, options);
</script>

<script>
  let tripForm = document.getElementById("end_haul");

  tripForm.addEventListener("submit", (e) => {
    e.preventDefault();

    let h_date = document.getElementById("haul-date");
    let h_time = document.getElementById("haul-time");
    let lat = document.getElementById("lat");
    let lon = document.getElementById("lon");

    if (h_date.value == "" || h_time.value == "" || lat.value == "" || lon.value == "") {
      alert("Ensure you input a value in all fields!");
    } else {
      // perform operation with form input
      alert(`This form has a haul date of ${h_date.value} , a haul time of ${h_time.value} , 
                a latitude of ${lat.value} and a longitude of ${lon.value} `);
      console.log(
        `This form has a haul date of ${h_date.value} , a haul time of ${h_time.value} , 
                a latitude of ${lat.value} and a longitude of ${lon.value} `
      );

      h_date.value = "";
      h_time.value = "";
      lat.value = "";
      lon.value = "";
    }
  });
</script>

<script>
  const date = new Date().toLocaleDateString();
  document.getElementById("haul-date").value = date;
  console.log(date);

  var d = new Date();
  var time = d.toLocaleTimeString();
  document.getElementById("haul-time").value = time;
  console.log(`Current time - ${currentHour}:${currentMinute}`);
</script>