<!DOCTYPE html>
<html>
<head>
  <title>Trip List</title>
  <button class="online" id="online">ONLINE</button>
  <button class="offline" id="offline">OFFLINE</button>
</head>

<body>

  <p>Trip list:</p>
  <ul id="results"></ul>
  <script>
    let results = [];
    let openDbRequest = indexedDB.open('grokDb', 1);
    openDbRequest.onsuccess = function(e) {
      console.log('success!');
      let db = e.target.result;
      let tran2 = db.transaction("trips");
      tran2.objectStore("trips").openCursor().onsuccess = function(e) {
        var cursor = e.target.result;
        if (cursor) {
          console.log(cursor.value);
          results.push(cursor.value);
          cursor.continue();
        };
      };
    };

    console.log(results);
  </script>
  <script>
    window.addEventListener("offline", (event) => {
      console.log("The network connection has been lost.");
      document.getElementById("offline").style.display = "block";
      document.getElementById("online").style.display = "none";
    });

    window.addEventListener("online", (event) => {
      console.log("You are now connected to the network.");
      document.getElementById("offline").style.display = "none";
      document.getElementById("online").style.display = "block";
    });
  </script>
</body>

</html>o