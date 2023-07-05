<!DOCTYPE html>
<html>

<head>
  <title>Trip List</title>
</head>

<body>

  <p>Trip list:</p>
  <ul id="note"></ul>
  <script>
    // Let us open our database
    const DBOpenRequest = window.indexedDB.open("grokDb", 4);

    DBOpenRequest.onsuccess = (event) => {
      note.innerHTML += "<li>Database initialized.</li>";

      // store the result of opening the database in the db variable.
      // This is used a lot below
      db = DBOpenRequest.result;

      // Run the getData() function to get the data from the database
      getData();
    };

    function getData() {
      // open a read/write db transaction, ready for retrieving the data
      const transaction = db.transaction(["trips"], "readwrite");

      // report on the success of the transaction completing, when everything is done
      transaction.oncomplete = (event) => {
        note.innerHTML += "<li>Transaction completed.</li>";
      };

      transaction.onerror = (event) => {
        note.innerHTML += `<li>Transaction not opened due to error: ${transaction.error}</li>`;
      };

      // create an object store on the transaction
      const objectStore = transaction.objectStore("trips");

      // Make a request to get a record by key from the object store
      const objectStoreRequest = objectStore.get("observer");

      objectStoreRequest.onsuccess = (event) => {
        // report the success of our request
        note.innerHTML += "<li>Request successful.</li>";
        
        console.log(objectStoreRequest);
        const myRecord = objectStoreRequest.result;
        note.innerHTML += "<li>" + myRecord + "</li>";
      };
    }
  </script>
</body>

</html>