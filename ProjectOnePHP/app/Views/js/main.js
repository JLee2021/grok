function new_trip() {

    let tripForm = document.getElementById("new_trip");

    tripForm.addEventListener("submit", (e) => {
        e.preventDefault();
      
        let observerid = document.getElementById("obsid");
        let tripNumber = document.getElementById("tripNumber");
      
        if (observerid.value == "" || tripNumber.value == "") {
          alert("Ensure you input a value in both fields!");
        } else {
          // perform operation with form input
          alert("This form has been successfully submitted!");
          console.log(
            `This form has a username of ${observerid.value} and password of ${tripNumber.value}`
          );
      
          username.value = "";
          password.value = "";
        }
    });
}