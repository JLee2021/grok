<!DOCTYPE html>
<html>

<head>
  <title>Trip List</title>
</head>

<body>

  <p>Trip list:</p>
  <p id="results"></p>
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
          console.log(cursor.value)
          listElem.innerHTML = "<li>" + cursor.value + "</li>";
        };
      };
    };

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

    const arr = [{
        "observer": "Z01",
        "vessel": "884512",
        "port": "220101",
        "tripId": "Z01002"
      },
      {
        "observer": "X97",
        "vessel": "885215",
        "port": "240403",
        "tripId": "Z01003"
      },
      {
        "observer": "Z01",
        "vessel": "991234",
        "port": "220101",
        "tripId": "Z01004"
      },
      {
        "observer": "Z01",
        "vessel": "880639",
        "port": "240403",
        "tripId": "Z01005"
      },
      {
        "observer": "Z01",
        "vessel": "884512",
        "port": "220101",
        "tripId": "Z01006"
      },
      {
        "observer": "Z01",
        "vessel": "884512",
        "port": "220101",
        "tripId": "Z01007"
      }
    ];
    results.forEach(element => console.log(element));

    let text = "Results: ";
    results.forEach(myFunction);
    document.getElementById("results").innerHTML = text;

    function myFunction(item, index) {
      text += index + ": " + item + "<br>";
    }
    // document.getElementById("results").value = results;

    // const obj = JSON.parse(results);
    // document.getElementById("demo").innerHTML = obj.observer + ", " + obj.port;
    // console.log(obj);
  </script>
</body>

</html>