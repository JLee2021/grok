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


                            <input class="usa-button" type="submit" value="Start Trip" />

                        </fieldset>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script>
        const request = indexedDB.open('tripsDatabase', 1);

        //upgrade event
        request.onupgradeneeded = () => {
            alert("upgrade needed")
        }

        //on success
        request.onsuccess = () => {
            alert("success is called")
        }
    </script>
</body>

</html>