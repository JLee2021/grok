<section id="test-section-id" class="usa-section">
    <div class="grid-container">
        <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
            <form class="usa-form" id="new_trip" onsubmit="event.preventDefault();">
                <fieldset class="usa-fieldset">
                    <legend class="usa-legend usa-legend--large">Atlas Data Entry</legend>
                    <label class="usa-label" for="obisd">Observer ID</label>
                    <input class="usa-input" id="obsid" name="obsid" type="text" autocapitalize="off" autocorrect="off" required />
                    <label class="usa-label" for="obisd">Trip Number</label>
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
    
        let observerid = document.getElementById("obsid");
        let tripNumber = document.getElementById("trip_number");
    
        if (observerid.value == "" || tripNumber.value == "") {
        alert("Ensure you input a value in both fields!");
        } 
        else {
            // perform operation with form input
            alert("This form has been successfully submitted!");
            console.log(
                `This form has a Observer ID of ${observerid.value} and Trip Number of ${tripNumber.value}`
            );
        
            observerid.value = "";
            tripNumber.value = "";
        }
    });

</script>