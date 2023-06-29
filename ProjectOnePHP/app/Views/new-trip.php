<section id="test-section-id" class="usa-section">
    <div class="grid-container">
        <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
            <form class="usa-form" id="new_trip" onsubmit="event.preventDefault();">
                <fieldset class="usa-fieldset">
                    <legend class="usa-legend usa-legend--small">New Trip</legend>
                    <legend class="usa-legend usa-legend--large">Atlas Data Entry</legend>

                    <!--obsid -->
                    <label class="usa-label" for="obsid">Observer</label>
                    <select class="usa-select" name="obsid" id="obsid">
                        <option selected="" disabled>- Select -</option>
<?php
    foreach($observer as $obs)
    {
        $option  = '                        <option value="'.$obs->value.'" title="'.$obs->name.'"';
        if($obs->name == $username) { $option .= ' selected' ; };
        $option .= ' >' . $obs->descr . ' ( ' . $obs->value . ' )</option>';

        echo $option;
    }
?>
                    </select>
                    <!--vessel_permit_num -->
                    <label class="usa-label" for="vessel_permit_num">Vessel</label>
                    <select class="usa-select" name="vessel_permit_num" id="vessel_permit_num">
                        <option selected="" disabled>- Select -</option>
<?php
    foreach($vessels as $ves)
    {
        echo '                        <option value="'.$ves->value.'" title="'.$ves->descr.'">'.$ves->name.'</option>';
    }
?>
                    </select>

                    <!--port -->
                    <label class="usa-label" for="port">Port</label>
                    <select class="usa-select" name="port" id="port" required>
                        <option selected="" disabled>- Select -</option>
<?php
    foreach($ports as $port)
    {
        echo '                        <option value="'.$port->value.'" title="'.$port->descr.'">'.$port->name.'</option>';
    }
?>
                    </select>

                    <!-- sail_date -->
                    <div class="usa-form-group">
                      <label class="usa-label" id="sail_date-label" for="sail_date"
                        >Sail date</label
                      >
                      <!--<div class="usa-hint" id="appointment-date-hint">mm/dd/yyyy</div>-->
                      <div class="usa-date-picker">
                        <input
                          class="usa-input"
                          id="sail_date"
                          name="sail_date"
                          aria-labelledby="sail_date-label"
                          aria-describedby="sail_date-hint"
                        />
                      </div>
                    </div>

                    <label class="usa-label" for="trip_id">Trip ID</label>
                    <input class="usa-input" id="trip_id" name="trip_id" type="text" title="Trip ID" placeholder="A99001" pattern="[A-Z]\d\d\d\d\d" autocapitalize="off" autocorrect="off" required />


                    <input class="usa-button" type="submit" value="Start Trip" /> <br><br>

                </fieldset>
            </form>
        </div>
    </div>
</section>

<script>
    let tripForm = document.getElementById("new_trip");

    tripForm.addEventListener("submit", (e) => {
        e.preventDefault();

        let halt = get_form_data(tripForm);

        if (halt) {
            alert("Ensure you input a value in both fields!");
        } else {
            // perform operation with form input
            //console.log(
            //    `This form has a Observer ID of ${observerid.value} and Trip Number of ${tripNumber.value}`
            //);

            insert_trip();
            //window.location.assign("<?php echo site_url('/home/dashboard_trip/'); ?>" + document.getElementById('trip_id').value);
        }
    });

    function get_form_data(form) {
        let data = new FormData(form);
        let halt = false;
        console.log(data.length);
        for (const [key, value] of data) {
            console.log(key, value);
            if (value.length == 0) {
                halt = true;
            }
        }
        return halt;
    }

    async function addTrip() {

    }
    function insert_trip() {
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
          let tripForm = document.getElementById("new_trip");
          let formData = new FormData(tripForm);

          let data = {};
          for (const pair of formData.entries()) {
              data[pair[0]] = pair[1];
          }
          let v = document.getElementById('vessel_permit_num');
          data['vessel_name'] = v.options[v.selectedIndex].text;
          data['hauls'] = [];
          data['catch'] = [];

          try {
              let tx = db.transaction('trips', 'readwrite');
              tx.objectStore('trips').add(data);
              console.log('got to here');
              window.location.assign("<?php echo site_url('/home/dashboard'); ?>");

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
<script>
