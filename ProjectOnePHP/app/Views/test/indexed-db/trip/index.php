<!DOCTYPE html>
<html>

<head>
  <title>Trip List</title>
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
</body>

</html>