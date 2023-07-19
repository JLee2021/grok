<div class="grid-container">
    <legend class="usa-legend usa-legend--large">Trips</legend>
    <ul class="usa-button-group">
        <li class="usa-button-group__item">
            <button type="button" class="usa-button">View Trips</button>
        </li>
    </ul>
</div>

function show_page(page) {
let sections = document.getElementsByClassName('grok_page_section');
for (let i = 0; i < sections.length; i++) { if(sections[i].id !==page) { sections[i].style.display='none' ; }else { sections[i].style.display='block' ; document.getElementsByClassName('usa-current')[0].innerHTML='<span>' +page+'</span>';
    if(page == 'page_new-haul') {

    }
    }
    }

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
    list_trips(db);
    show_page('page_dashboard-user');

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
    card_foot.innerHTML = '<p><a href="" class="usa-button" data-tripid='+obj.trip_id+' onClick="show_trip(this.dataset.tripid); return false;">Edit</a>';
        card_foot.innerHTML += '<a href="" class=" usa-button usa-button--outline" data-tripid='+obj.trip_id+' onClick="delete_trip(this.dataset.tripid); return false;">Delete</a>';
        card_foot.innerHTML += '</p>
    <p><a href="" class=" usa-button usa-button--accent-warm" data-tripid='+obj.trip_id+' onClick="submit_trip(this.dataset.tripid); return false;">Submit</a></p>';
    card.append(card_head);
    card.append(card_bod);
    card.append(card_foot);
    document.getElementById('grok_trip_list').append(card);

    }
    async function list_trips(db) {
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
    function delete_all() {
    let deleteRequest = indexedDB.deleteDatabase('grok');
    if(deleteRequest) {
    location.reload();
    }else {
    alert('Something went wrong');
    }
    }
    async function build_trip_info(db, trip_id) {
    document.getElementById('grok_trip_id').innerHTML = trip_id;
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
    div.innerHTML = '';
    let sail_date = document.createElement('span');
    sail_date.innerHTML = ' '+obj.sail_date;
    let vessel = document.createElement('p');
    vessel.innerHTML = obj.vessel_name;
    vessel.appendChild(sail_date);
    div.appendChild(vessel);

    }
    async function build_hauls_list(db, trip_id) {
    document.getElementById('grok_trip_id').innerHTML = trip_id;
    let tx = db.transaction('trips');
    let tripsStore = tx.objectStore('trips');

    let trip = tripsStore.get(trip_id);

    trip.onsuccess = await function() {
    if (trip.result !== undefined) {
    //trip.result.forEach(grok_haul_card(trip.result.hauls));
    grok_hauls_list(trip.result.hauls);

    } else {
    console.log("No such trip");
    }
    };

    }
    function grok_hauls_list(array) {
    document.getElementById('grok_hauls_list').innerHTML = '';
    array.forEach(grok_haul_card);
    }
    function grok_haul_card(obj) {
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
    card_bod.innerHTML = '<p style="margin-bottom:0px;">gear_cat: '+obj.accsp_gear_category+'<br>';
        card_bod.innerHTML += ' haul_start_date: '+obj.haul_start_date+'</p>';
    card_bod.innerHTML += '<p><a href="" data-trip_id='+obj.trip_id+' data-haulnum='+obj.haul_num+' onclick="show_haul(this.dataset.trip_id, this.dataset.haulnum); return false;" class="usa-button">Catch</a></p>';
    //let card_foot = document.createElement('div');
    // card_foot.classList.add('usa-card__footer');
    // card_foot.innerHTML = '<p><a href="dashboard_catch/'+obj.trip_id+'/'+obj.haul_num+'" class="usa-button">Catch</a>';
        // card_foot.innerHTML += '<a href="" class=" usa-button usa-button--outline" data-tripid='+obj.trip_id+' onClick="delete_trip(this.dataset.tripid); return false;">Delete</a>';
        // card_foot.innerHTML += '</p>
    <p><a href="" class=" usa-button usa-button--accent-warm" data-tripid='+obj.trip_id+' onClick="submit_trip(this.dataset.tripid); return false;">Submit</a></p>';
    card.append(card_head);
    card.append(card_bod);
    //card.append(card_foot);
    document.getElementById('grok_hauls_list').append(card);
    }
    function show_trip(trip_id) {
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
    build_trip_info(db, trip_id);
    build_hauls_list(db, trip_id);
    show_page('page_dashboard-trip');
    };
    }
    async function build_trip_haul_info(db, trip_id, haulnum) {
    document.getElementById('grok_haul_trip_id').innerHTML = trip_id;
    document.getElementById('grok_haul_haulnum').innerHTML = haulnum;
    let tx = db.transaction('trips');
    let tripsStore = tx.objectStore('trips');

    let trip = tripsStore.get(trip_id);

    trip.onsuccess = await function() {
    if (trip.result !== undefined) {
    //trip.result.forEach(make_info_section(trip.result));
    make_haul_info_section(trip.result, trip_id, haulnum);
    } else {
    console.log("No such trip");
    }
    };

    }
    function make_haul_info_section(obj, trip_id, haulnum) {
    //document.getElementById('grok_haul_haulnum').innerHTML = haulnum;
    document.getElementById('grok_haul_trip_id').innerHTML = trip_id
    let div = document.getElementById('grok_haul_trip_info');
    div.innerHTML = '';
    let sail_date = document.createElement('span');
    sail_date.innerHTML = ' '+obj.sail_date;
    let vessel = document.createElement('p');
    vessel.innerHTML = obj.vessel_name;
    vessel.appendChild(sail_date);
    div.appendChild(vessel);

    }
    async function build_catch_list(db, trip_id, haulnum) {
    document.getElementById('grok_haul_trip_id').innerHTML = trip_id;
    document.getElementById('grok_haul_haulnum').innerHTML = haulnum;
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
    if(obj.haulnum==document.getElementById('grok_haul_haulnum').innerHTML) {
    let card = document.createElement('div');
    card.classList.add('usa-card__container');
    let card_head = document.createElement('div');
    card_head.classList.add('usa-card__header');
    let card_title = document.createElement('h2');
    card_title.classList.add('usa-card__heading');
    card_title.innerHTML = obj.common_name;
    card_head.append(card_title);
    let card_bod = document.createElement('div');
    card_bod.classList.add('usa-card__body');
    card_bod.innerHTML = '<p style="margin-bottom:0px;">';
        card_bod.innerHTML += ' species_itis: '+obj.species_itis+'<br>';
        card_bod.innerHTML += ' grade: '+obj.grade_code+'<br>';
        card_bod.innerHTML += ' disposition: '+obj.disposition_code+'<br>';
        card_bod.innerHTML += ' weight: '+obj.weight+' '+obj.weight_uom+'<br>';
        card_bod.innerHTML +='</p>';
    //card_bod.innerHTML += '<p><a href="dashboard_catch/'+obj.trip_id+'/'+obj.haul_num+'" class="usa-button">Catch</a></p>';
    //let card_foot = document.createElement('div');
    // card_foot.classList.add('usa-card__footer');
    // card_foot.innerHTML = '<p><a href="dashboard_catch/'+obj.trip_id+'/'+obj.haul_num+'" class="usa-button">Catch</a>';
        // card_foot.innerHTML += '<a href="" class=" usa-button usa-button--outline" data-tripid='+obj.trip_id+' onClick="delete_trip(this.dataset.tripid); return false;">Delete</a>';
        // card_foot.innerHTML += '</p>
    <p><a href="" class=" usa-button usa-button--accent-warm" data-tripid='+obj.trip_id+' onClick="submit_trip(this.dataset.tripid); return false;">Submit</a></p>';
    card.append(card_head);
    card.append(card_bod);
    //card.append(card_foot);
    document.getElementById('grok_catch_list').append(card);
    }
    }
    function show_haul(trip_id, haulnum) {
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
    build_trip_haul_info(db, trip_id, haulnum);
    build_catch_list(db, trip_id, haulnum);
    show_page('page_dashboard-haul');
    };
    }
    function insert_haul() {
    let haulForm = document.getElementById("new_haul");
    let formData = new FormData(haulForm);

    //let data = {};
    // data['trip_id'] = document.getElementById('trip_id').value;
    // data['hauls'] = [];
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
    show_trip(trip_id);

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
    function make_new_haul() {
    let trip_id = document.getElementById('grok_trip_id').innerHTML;
    document.getElementById('new_haul-trip_id').value = trip_id;
    show_page('page_new-haul');
    }
    function make_new_catch() {
    let trip_id = document.getElementById('grok_haul_trip_id').innerHTML;
    let haulnum = document.getElementById('grok_haul_haulnum').innerHTML;
    document.getElementById('new_catch-trip_id').value = trip_id;
    document.getElementById('new_catch-haulnum').value = haulnum;
    show_page('page_new-catch');
    }
    function insert_catch() {
    let catchForm = document.getElementById("new_catch");
    let formData = new FormData(catchForm);

    let thiscatch = {};
    for (const pair of formData.entries()) {
    thiscatch[pair[0]] = pair[1];
    }
    let s = document.getElementById('species_itis');
    thiscatch['common_name'] = s.options[s.selectedIndex].text;

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
    show_haul(thiscatch['trip_id'], thiscatch['haulnum']);
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

    window.onload = function() {
    /* INDEXDB INIT STUFF HERE */
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
    list_trips(db);
    };
    show_page('page_dashboard-user');

    };