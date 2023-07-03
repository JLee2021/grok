<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NOAA - Atlas Data Entry</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/styles.css'); ?>">
</head>

<body>
    <div class="grid-container">
        <h1>Create a New Trip</h1>

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
                                foreach ($observer as $obs) {
                                    $option  = '                        <option value="' . $obs->value . '" title="' . $obs->name . '"';
                                    if ($obs->name == $username) {
                                        $option .= ' selected';
                                    };
                                    $option .= ' >' . $obs->descr . '</option>';
                                    echo $option;
                                }
                                ?>
                            </select>
                            <!--vessel_permit_num -->
                            <label class="usa-label" for="vessel_permit_num">Vessel</label>
                            <select class="usa-select" name="vessel_permit_num" id="vessel_permit_num">
                                <option selected="" disabled>- Select -</option>
                                <?php
                                foreach ($vessels as $ves) {
                                    echo '                        <option value="' . $ves->value . '" title="' . $ves->descr . '">' . $ves->name . '</option>';
                                }
                                ?>
                            </select>

                            <!--port -->
                            <label class="usa-label" for="port">Port</label>
                            <select class="usa-select" name="port" id="port" required>
                                <option selected="" disabled>- Select -</option>
                                <?php
                                foreach ($ports as $port) {
                                    echo '                        <option value="' . $port->value . '" title="' . $port->descr . '">' . $port->name . '</option>';
                                }
                                ?>
                            </select>

                            <label class="usa-label" for="trip_id">Trip ID</label>
                            <input class="usa-input" id="trip_id" name="trip_number" type="text" title="Trip ID" placeholder="A99001" pattern="[A-Z]\d\d\d\d\d" autocapitalize="off" autocorrect="off" required />


                            <input  onclick="addTrip();" class="usa-button" type="submit" value="Start Trip" />

                        </fieldset>
                    </form>
                </div>
                <ul id="tripList">

                </ul>
            </div>
        </section>
    </div>

    <script>
        const dbName = "grokDb";
        const request = window.indexedDB.open(dbName, 1);

        request.onerror = (event) => {
            console.error("Error: ", request.error);
        };
        request.onsuccess = (event) => {
            db = event.target.result;
            console.log("Success! ", request.result);
        };

        request.onupgradeneeded = (event) => {
            const db = event.target.result;

            // Create an objectStore to hold information about our trips. We're
            // going to use "observer" as our key path because it's 
            // unique 
            const objectStore = db.createObjectStore("trips", {
                autoIncrement: true
            });

            objectStore.createIndex("observer", "observer", {
                unique: false
            });
            objectStore.createIndex("vessel", "vessel", {
                unique: false
            });
            objectStore.createIndex("port", "port", {
                unique: false
            });
            objectStore.createIndex("tripId", "tripId", {
                unique: false
            });

            // Use transaction oncomplete to make sure the objectStore creation is
            // finished before adding data into it.
            objectStore.transaction.oncomplete = (event) => {
            
                // Store values in the newly created objectStore.
                const customerObjectStore = db
                    .transaction("trips", "readwrite")
                    .objectStore("trips");
                tripData.forEach((trip) => {
                    tripObjectStore.add(trip);
                });  
            };
        };

        async function addTrip() {
            let observer = document.getElementById('obsid').value;
            let vessel = document.getElementById('vessel_permit_num').value;
            let port = document.getElementById('port').value;
            let tripId = document.getElementById('trip_id').value;
            
            let tx = db.transaction('trips', 'readwrite');
            try {
                await tx.objectStore('trips')
                    .add({
                        observer,
                        vessel,
                        port,
                        tripId
                    });
                await list();
            } catch (err) {
                if (err.name == 'ConstraintError') {
                    alert("Such trips exists already");
                    await addLesson();
                } else {
                    throw err;
                }
            }
        }


    </script>




</body>

</html>