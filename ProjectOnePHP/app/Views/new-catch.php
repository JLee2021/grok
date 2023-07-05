<section id="test-section-id" class="usa-section">
  <div class="grid-container">
    <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
      <h1 class="site-preview-heading margin-0">New Catch</h1>

      <form class="usa-form" id="new_catch" onsubmit="event.preventDefault();">
            <fieldset class="usa-fieldset">
                <!--trip_id -->
                <input type="hidden" id="trip_id" name="trip_id" value="<?php echo $trip_id; ?>" />
                <!--haulnum -->
                <input type="hidden" id="haulnum" name="haulnum" value="<?php echo $haulnum; ?>" />
                <!-- species -->
                <label class="usa-label" for="species_itis">Species</label>
                <select class="usa-select" name="species_itis" id="species_itis">
                  <option selected="" disabled>- Select -</option>
                  <?php
                  foreach ($species as $value) {
                    echo '                        <option value="' . $value->value . '" title="' . $value->descr . '">' . $value->name . '</option>';
                  }
                  ?>
                </select>
            </fieldset>
            <!-- grade_code -->
            <fieldset class="usa-fieldset">
                <label class="usa-label" for="grade_code">Grade</label>
                <select class="usa-select" name="grade_code" id="grade_code">
                  <option selected="" disabled>- Select -</option>
                  <?php
                  foreach ($grade as $value) {
                    echo '                        <option value="' . $value->value . '" title="' . $value->name . '">' . $value->descr . '</option>';
                  }
                  ?>
                </select>
            </fieldset>
            <!-- disposition -->
            <fieldset class="usa-fieldset">
                <label class="usa-label" for="options2">Dispositon</label>
                <select class="usa-select" name="disposition_code" id="disposition_code">
                  <option selected="" disabled>- Select -</option>
                  <?php
                  foreach ($disposition as $value) {
                    echo '                        <option value="' . $value->value . '" title="' . $value->name . '">' . $value->descr . '</option>';
                  }
                  ?>
                </select>
            </fieldset>
            <!-- weight -->
            <fieldset class="usa-fieldset">
                <label class="usa-label" for="weight">Weight</label>
                <div class="usa-input-group usa-input-group--sm">
                    <input id="weight" name="weight" class="usa-input" pattern="[0-9]*" inputmode="numeric"/>
                    <!-- <div class="usa-input-suffix" aria-hidden="true">lbs.</div> -->
                </div>
                <label class="usa-label" for="weight_uom">Weight UOM</label>
                <select class="usa-select" name="weight_uom" id="weight_uom">
                  <option selected="" disabled>- Select -</option>
                  <?php
                  foreach ($weight_uom as $value) {
                    echo '                        <option value="' . $value->value . '" title="' . $value->name . '"';
                    if($value->value == 'LB') { echo ' selected'; };
                    echo '>' . $value->descr . '</option>';
                  }
                  ?>
                </select>
            </fieldset>

            <br><br>
            <button type="submit" class="usa-button">Save catch</button> <br><br>
      </form>

    </div>
  </div>

  <script>
    let catchForm = document.getElementById("new_catch");

    catchForm.addEventListener("submit", (e) => {
      e.preventDefault();

      let halt = false; //todo: validate form

      if (halt) {
          alert("Ensure you input a value in all fields!");
      } else {
          insert_catch();
      }
    });

    function insert_catch() {
        let catchForm = document.getElementById("new_catch");
        let formData = new FormData(catchForm);

        let thiscatch = {};
        for (const pair of formData.entries()) {
            thiscatch[pair[0]] = pair[1];
        }

        let openRequest = indexedDB.open('grok', 1);

        openRequest.onupgradeneeded = function() {
          // triggers if the client had no database
          // ...perform initialization...
          let db = openRequest.result;
          if (!db.objectStoreNames.contains('trips')) { // if there's no "trips" store
            db.createObjectStore('trips', {keyPath: 'trip_id'}); // create it
          }
        };

        openRequest.onerror = function() {
          console.error("Error", openRequest.error);
        };

        openRequest.onsuccess = function() {
          let db = openRequest.result;
          // continue working with database using db object

          try {
              let trip_id = thiscatch['trip_id'];
              let tx = db.transaction('trips', 'readwrite');
              let tripsStore = tx.objectStore('trips');
              let trips = tripsStore.get(trip_id);
              trips.onsuccess = function() {
                if (trips.result !== undefined) {
                    let data = trips.result;
                    let allcatch = data['catch'];
                        allcatch.push(thiscatch);

                        data.catch = allcatch;

                        tripsStore.delete(trip_id);

                        tx.objectStore('trips').add(data);

                        tx.complete;

                } else {
                  console.log("some problem");
                }
            };
            window.location.assign("<?php echo site_url('/home/dashboard_haul/'.$trip_id.'/'.$haulnum); ?>");
          } catch(err) {
              console.log('ERROR');
              if (err.name == 'ConstraintError') {
                alert("Trip exists already");
            } else {
                throw err;
            }
          }


        };


    }
  </script>
