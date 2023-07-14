
<section id="test-section-id" class="usa-section">
  <div class="grid-container">
    <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
        <!-- trip list cards -->
        <div id="grok_trip_list"></div>
        <!-- new trip button -->
        <div style="padding: 10px 10px 10px;"><a href="new_trip"><button type="button" class="usa-button usa-button--big">Add New Trip</button></a></div>
<!-- DEV delete button
        <div class="usa-card__container">
          <div class="usa-card__header">
            <h2 class="usa-card__heading">Delete All Trips</h2>
          </div>
          <div class="usa-card__body">
            <p>Use this button to delete the local indexDB database and start over.</p>
          </div>
          <div class="usa-card__footer">
            <a href="" class="usa-button usa-button--outline" onclick="delete_all();">DELETE</a><br>
          </div>
        </div>
 DEV delete button -->
    </div>
  </div>
</section>

    <script>
        function submit_trip(trip_id) {
            console.log('submit_trip: '+trip_id);
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
              let tx = db.transaction('trips');
              let tripsStore = tx.objectStore('trips');

              let trips = tripsStore.get(trip_id);

              trips.onsuccess = function() {
                if (trips.result !== undefined) {
                  alert(JSON.stringify(trips.result, null, 2));
                } else {
                  console.log("No such trips");
                }
              }
          };
        }
        function make_button(obj) {
            let card = document.createElement('div');
                card.classList.add('usa-card__container');
            let card_head = document.createElement('div');
                card_head.classList.add('usa-card__header');
            let card_title = document.createElement('h2');
                card_title.classList.add('usa-card__heading');
                card_title.innerHTML = obj.trip_id;
                card_head.append(card_title);
            let card_bod = document.createElement('div');
                card_bod.classList.add('usa-card__body');
                card_bod.innerHTML = '<p>'+obj.vessel_name+' '+obj.sail_date+'</p>';
            let card_foot = document.createElement('div');
                card_foot.classList.add('usa-card__footer');
                card_foot.innerHTML = '<p><a href="dashboard_trip/'+obj.trip_id+'" class="usa-button">Edit</a>';
                card_foot.innerHTML += '<a href="" class=" usa-button usa-button--outline" data-tripid = '+obj.trip_id+' onClick="delete_trip(this.dataset.tripid); return false;">Delete</a>';
                card_foot.innerHTML += '</p><p><a href="" class=" usa-button usa-button--accent-warm" data-tripid = '+obj.trip_id+' onClick="submit_trip(this.dataset.tripid); return false;">Submit</a></p>';
            card.append(card_head);
            card.append(card_bod);
            card.append(card_foot);
            document.getElementById('grok_trip_list').append(card);

        }
        async function list(db) {
            let tx = db.transaction('trips');
            let tripsStore = tx.objectStore('trips');

            let trips = await tripsStore.getAll();

            trips.onsuccess = function() {
              if (trips.result !== undefined) {
                trips.result.forEach(make_button);
              } else {
                console.log("No such trips");
              }
            };

        }

        function init() {
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
              list(db);
            };
        }

        function delete_trip(trip_id) {
            console.log('delete_trip: '+trip_id);
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
              let tx = db.transaction('trips', 'readwrite');
              let tripsStore = tx.objectStore('trips');
              tripsStore.delete(trip_id);
              location.reload();
            };
        }

        function delete_all() {
            let deleteRequest = indexedDB.deleteDatabase('grok');
            if(deleteRequest) {
                location.reload();
            }else {
                alert('Something went wrong');
            }
        }

        window.onload = function() {
            //alert('Page loaded');
            console.log('Page Loaded');
            //let deleteRequest = indexedDB.deleteDatabase('grok');
            init();


        };
