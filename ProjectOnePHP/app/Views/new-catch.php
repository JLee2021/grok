<section id="test-section-id" class="usa-section">
  <div class="grid-container">
    <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
      <h1 class="site-preview-heading margin-0">New Catch</h1>

      <form class="usa-form" id="new-catch" onsubmit="event.preventDefault();">
        <label class="usa-label" for="options1">Species Name</label>
        <select class="usa-select" name="species-name" id="species-name">
          <option selected="">- Select -</option>
          <option>Option A</option>
          <option>Option B</option>
          <option>Option C</option>
        </select>
     

      
        <label class="usa-label" for="options2">Dispositon Code</label>
        <select class="usa-select" name="disposition-code" id="disposition-code">
          <option selected="">- Select -</option>
          <option>555001</option>
          <option>555002</option>
          <option>555003</option>
        </select>

        <input class="usa-button" type="submit" value="New Catch" />
      </form>

    </div>
  </div>

  <script>
    let tripForm = document.getElementById("new-catch");

    tripForm.addEventListener("submit", (e) => {
        e.preventDefault();
    
        let species = document.getElementById("species-name");
        let disposition = document.getElementById("disposition-code");
    
        if (species.value == "" || disposition.value == "") {
        alert("Ensure you input a value in both fields!");
        } 
        else {
            // perform operation with form input
            alert("This form has been successfully submitted!");
            console.log(
                `This form has a species name of ${species.value} and disposition code of ${disposition.value}`
            );
        
            species.value = "";
            disposition.value = "";
        }
    });

</script>