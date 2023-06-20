<section id="test-section-id" class="usa-section">
    <div class="grid-container">
        <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
            <form class="usa-form" id="new_trip" onsubmit="event.preventDefault();">
                <fieldset class="usa-fieldset">
                    <legend class="usa-legend usa-legend--small">New Trip</legend>
                    <legend class="usa-legend usa-legend--large">Atlas Data Entry</legend>
<!--obsid -->
                    <label class="usa-label" for="obsid">Observer ID</label>
                    <select class="usa-select" name="obsid" id="obsid">
                        <option selected="" disabled>- Select -</option>
<?php
    foreach($observer as $obs)
    {
        $option  = '                        <option value="'.$obs->value.'" title="'.$obs->name.'"';
        if($obs->name == $username) { $option .= ' selected' ; };
        $option .= ' disabled>'.$obs->descr.'</option>';
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
        echo '                        <option value="'.$ves->name.'" title="'.$ves->descr.'">'.$ves->name.'</option>';
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
        echo '                        <option value="'.$port->name.'" title="'.$port->descr.'">'.$port->name.'</option>';
    }
?>
                    </select>

                    <label class="usa-label" for="trip_number">Trip Number</label>
                    <input class="usa-input" id="trip_number" name="trip_number" type="text" autocapitalize="off" autocorrect="off" required />


                    <input class="usa-button" type="submit" value="Start Trip" />

                </fieldset>
            </form>
        </div>
    </div>
</section>

<script>
    let tripForm = document.getElementById("new_trip");

    tripForm.addEventListener("submit", (e) => {
        e.preventDefault();

        let halt = get_form_data();

        if (halt) {
          alert("Ensure you input a value in both fields!");
        }
        else {
            // perform operation with form input
            alert("This form has been successfully submitted!");
            console.log(
                `This form has a Observer ID of ${observerid.value} and Trip Number of ${tripNumber.value}`
            );
        }
    });

    function get_form_data() {
      let form = document.querySelector('#new_trip');
      let data = new FormData(form);
      let halt = false;
      for (let [key, value] of data) {
          console.log(key, value);
          if(value.length==0) {
              halt = true;
        }
      }
      return halt;
    }

</script>
