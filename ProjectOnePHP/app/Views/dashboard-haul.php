<section id="test-section-id" class="usa-section">
    <div class="grid-container">
        <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
            <h1 class="site-preview-heading margin-0">Trip ID: <span id="grok_trip_id"><?php echo $trip_id; ?></span></h1>
            <div id="grok_trip_info"></div>
            <h3 class="site-preview-heading margin-0">Haul Num: <span id="grok_haulnum"><?php echo $haulnum; ?></span></h3>
            <div id="grok_catch_list"></div>

            <a href="<?php echo site_url('/home/new_catch/'.$trip_id.'/'.$haulnum); ?>"><button type="button" class="usa-button usa-button--big">Add Catch</button></a> <br><br>

        </div>
    </div>
</section>

<script>
    async function build_trip_info(db) {
        let trip_id = document.getElementById('grok_trip_id').innerHTML;
        let tx = db.transaction('trips');
        let tripsStore = tx.objectStore('trips');

        let trip = tripsStore.get(trip_id);

        trip.onsuccess = await function() {
          if (trip.result !== undefined) {
              //trip.result.forEach(make_info_section(trip.result));
              make_info_section(trip.result);
          } else {
            console.log("No such trip");
          }
        };

    }
    function make_info_section(obj) {
        let div = document.getElementById('grok_trip_info');
        let sail_date = document.createElement('span');
            sail_date.innerHTML = ' '+obj.sail_date;
        let vessel = document.createElement('p');
            vessel.innerHTML = obj.vessel_name;
        vessel.appendChild(sail_date);
        div.appendChild(vessel);

    }
    async function build_catch_list(db) {
        let trip_id = document.getElementById('grok_trip_id').innerHTML;
        let haulnum = document.getElementById('grok_haulnum').innerHTML;
        let tx = db.transaction('trips');
        let tripsStore = tx.objectStore('trips');

        let trip = tripsStore.get(trip_id);

        trip.onsuccess = await function() {
          if (trip.result !== undefined) {
              //grok_hauls_list(trip.result.hauls);
              grok_catch_list(trip.result.catch);

          } else {
            console.log("No such trip");
          }
        };

    }
    function grok_catch_list(array) {
        array.forEach(grok_catch_card);
    }
    function grok_catch_card(obj) {
        let card = document.createElement('div');
            card.classList.add('usa-card__container');
        let card_head = document.createElement('div');
            card_head.classList.add('usa-card__header');
        let card_title = document.createElement('h2');
            card_title.classList.add('usa-card__heading');
            card_title.innerHTML = 'haul_num: '+obj.haul_num;
            card_head.append(card_title);
        let card_bod = document.createElement('div');
            card_bod.classList.add('usa-card__body');
            card_bod.innerHTML  = '<p style="margin-bottom:0px;">gear_cat: '+obj.accsp_gear_category+'<br>';
            card_bod.innerHTML += '   haul_start_date: '+obj.haul_start_date+'</p>';
            card_bod.innerHTML += '<p><a href="dashboard_catch/'+obj.trip_id+'/'+obj.haul_num+'" class="usa-button">Catch</a></p>';
        //let card_foot = document.createElement('div');
        //    card_foot.classList.add('usa-card__footer');
        //    card_foot.innerHTML = '<p><a href="dashboard_catch/'+obj.trip_id+'/'+obj.haul_num+'" class="usa-button">Catch</a>';
        //    card_foot.innerHTML += '<a href="" class=" usa-button usa-button--outline" data-tripid = '+obj.trip_id+' onClick="delete_trip(this.dataset.tripid); return false;">Delete</a>';
        //    card_foot.innerHTML += '</p><p><a href="" class=" usa-button usa-button--accent-warm" data-tripid = '+obj.trip_id+' onClick="submit_trip(this.dataset.tripid); return false;">Submit</a></p>';
        card.append(card_head);
        card.append(card_bod);
        //card.append(card_foot);
        document.getElementById('grok_hauls_list').append(card);





    }
    function get_trip_db() {
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
          build_trip_info(db);
          build_hauls_list(db);
        };
    }

    function init() {
        get_trip_db();

    }
    window.onload = function() {
        console.log('Page Loaded');
        init();
    };

</script>
