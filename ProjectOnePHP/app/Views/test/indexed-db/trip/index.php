<!DOCTYPE html>
<html>

<head>
  <title>Trip List</title>
  <div id="results"></div>
<p id="demo"></p>
</head>

<body>

  <p>Trip list:</p>
  <ul id="listElem"></ul>
  <script>
    let results = [];
    let openDbRequest = indexedDB.open('grokDb', 1);
    openDbRequest.onsuccess = function(e) {
      let db = e.target.result;
      let tran2 = db.transaction("trips");
      tran2.objectStore("trips").openCursor().onsuccess = function(e) {
        var cursor = e.target.result;
        if (cursor) {
          results.push(cursor.value)
          cursor.continue();
        };
      };
    };

    document.getElementById("results").value = results;

    async function list() {
      let tx = db.transaction('trips');
      let tripsStore = tx.objectStore('trips');
      let trips = await tripsStore.getAll();
      if (trips.length) {
        listElem.innerHTML = trips.map(trip => `<li>
              observer: ${trip.observer}
            </li>`)
          .join('');
      } else {
        listElem.innerHTML = '<li>No lessons yet. Please add lessons.</li>'
      }
    }
    console.log(results);

    // const obj = JSON.parse(results);
    // document.getElementById("demo").innerHTML = obj.observer + ", " + obj.port;
    // console.log(obj);
  </script>
</body>

</html>