<!DOCTYPE html>
<html>

<head>
  <title>Trip List</title>
  <div id="results"></div>

</head>

<body>

  <p>Trip list:</p>
  <ul id="listElem"></ul>
  <script>
    let results = [];
    let openDbRequest = indexedDB.open('grokDb');
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
    console.log(results);
    
  </script>
</body>

</html>