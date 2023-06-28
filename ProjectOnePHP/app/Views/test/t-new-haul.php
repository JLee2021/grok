<section id="test-section-id" class="usa-section">
  <div class="grid-container">
    <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
      <form class="usa-form" id="new_haul" onsubmit="event.preventDefault();">
        <fieldset class="usa-fieldset">

          <legend class="usa-legend usa-legend--large">New Haul</legend>
          <!--trip_id -->
          <input type="hidden" id="trip_id" name="trip_id" value="<?php echo $trip_id; ?>" />

          <!--haul_num -->
          <label class="usa-label" for="haul_num">Haul Num</label>
          <select class="usa-select" name="haul_num" id="haul_num">
            <option value='001' selected>001</option>
            <option value='002'>002</option>
            <option value='002'>003</option>
          </select>

          <!--gear -->
          <label class="usa-label" for="accsp_gear_category">Gear Category</label>
          <select class="usa-select" name="accsp_gear_category" id="accsp_gear_category">
            <option selected="" disabled>- Select -</option>
            <?php
            foreach ($gear as $g) {
              $option  = '                        <option value="' . $g->value . '" title="' . $g->name . '"';
              $option .= ' >' . $g->descr . '</option>';
              echo $option;
            }
            ?>
          </select>

          <label class="usa-label" id="appointment-date-label" for="haul_start_date">Haul start date</label>
          <div class="usa-hint" id="haul_start_date-hint">mm/dd/yyyy</div>
          
            <input class="usa-input" name="haul_start_date" id="haul_start_date" />
          
    </div>
    <div class="usa-form-group">
      <label class="usa-label" id="haul_start_time-label" for="haul_start_time">Haul start time</label>
      <div class="usa-hint" id="haul_start_time-hint">hh:mm</div>
      <input class="usa-input--xs" id="haul-time" name="appointment-time" aria-describedby="appointment-time-label appointment-time-hint" />
    </div>
    <label class="usa-label" for="haul_start_lat">Haul start lat:</label>
    <input class="usa-input" id="haul_start_lat" name="haul_start_lat" />
    <label class="usa-label" for="haul_start_lon">Haul start lon:</label>
    <input class="usa-input" id="haul_start_lon" name="haul_start_lon" />

    <br><br>
    <button type="submit" class="usa-button">Start Haul</button> <br><br>


    </form>
  </div>
</section>

<script>
  let haulForm = document.getElementById("new_haul");

  haulForm.addEventListener("submit", (e) => {
    e.preventDefault();

    let halt = false; //todo: validate form

    if (halt) {
      alert("Ensure you input a value in all fields!");
    } else {
      insert_haul();
    }
  });

  function insert_haul() {
    let haulForm = document.getElementById("new_haul");
    let formData = new FormData(haulForm);

    //let data = {};
    //    data['trip_id'] = document.getElementById('trip_id').value;
    //    data['hauls'] = [];
    let haul = {};
    for (const pair of formData.entries()) {
      haul[pair[0]] = pair[1];
    }
    //data['hauls'][haul['haul_num']] = haul;
    let openRequest = indexedDB.open('grok', 1);

    openRequest.onupgradeneeded = function() {
      // triggers if the client had no database
      // ...perform initialization...
      let db = openRequest.result;
      if (!db.objectStoreNames.contains('trips')) { // if there's no "trips" store
        db.createObjectStore('trips', {
          keyPath: 'trip_id'
        }); // create it
      }
    };

    openRequest.onerror = function() {
      console.error("Error", openRequest.error);
    };

    openRequest.onsuccess = function() {
      let db = openRequest.result;
      // continue working with database using db object

      try {
        let trip_id = haul['trip_id'];
        let tx = db.transaction('trips', 'readwrite');
        let tripsStore = tx.objectStore('trips');
        let trips = tripsStore.get(trip_id);
        trips.onsuccess = function() {
          if (trips.result !== undefined) {
            let data = trips.result;
            let hauls = data['hauls'];
            hauls.push(haul);

            data.hauls = hauls;

            tripsStore.delete(trip_id);

            tx.objectStore('trips').add(data);

            tx.complete;

          } else {
            console.log("some problem");
          }
        };
        window.location.assign("<?php echo site_url('/test/dashboard_trip/' . $trip_id); ?>");
      } catch (err) {
        console.log('ERROR');
        if (err.name == 'ConstraintError') {
          alert("Trip exists already");
        } else {
          throw err;
        }
      }


    };


  }


  const options = {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0,
  };

  function success(pos) {
    const crd = pos.coords;

    var lat = crd.latitude;
    var lon = crd.longitude;
    document.getElementById("haul_start_lat").value = lat;
    document.getElementById("haul_start_lon").value = lon;

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
  var date = new Date().toLocaleDateString();
  document.getElementById("haul_start_date").value = date;
  console.log(date); 

  const currentDate = new Date();
  const currentHour = currentDate.getHours();
  const currentMinute = currentDate.getMinutes();
  const time = `${currentHour}:${currentMinute}`;
  document.getElementById("haul-time").value = time;
  console.log(`Current time - ${currentHour}:${currentMinute}`);
</script>


<script>
  /*    let tripForm = document.getElementById("new_haul");

    tripForm.addEventListener("submit", (e) => {
        e.preventDefault();

        let h_date = document.getElementById("haul-date");
        let h_time = document.getElementById("haul-time");
        let lat = document.getElementById("lat");
        let lon = document.getElementById("lon");

        if (h_date.value == "" || h_time.value == "" || lat.value == "" || lon.value == "") {
        alert("Ensure you input a value in all fields!");
        }
        else {
            // perform operation with form input
            alert("This form has been successfully submitted!");
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
*/
</script>