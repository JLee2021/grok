<section id="test-section-id" class="usa-section">
    <div class="grid-container">
        <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
            <h1 class="site-preview-heading margin-0">Vessels</h1>
            <!-- <h3>Network Connection: <span id="status"></span></h3> -->
            <ul class="usa-list usa-list--unstyled">
             <?php              
                foreach($boats as $boat){
                    echo "<li>" . $boat . "</li>";
                }
             ?>
            </ul>
            <br>
            <a href="create"><button type="button" class="usa-button" id="btn1">Add</button></a>
            <a href="edit"><button type="button" class="usa-button" id="btn2">Update</button></a>
            <a href="delete"><button type="button" class="usa-button usa-button--secondary" id="btn3">Delete</button></a>
        </div>
    </div>
</section>

<script>
// const checkOnlineStatus = async () => {
//   try {
//     const online = await fetch("https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/1pixel.png");
//     return online.status >= 200 && online.status < 300; // either true or false
//   } catch (err) {
//     return false; 
//   }
// };

// setInterval(async () => {
//   const result = await checkOnlineStatus();
//   const statusDisplay = document.getElementById("status");
//   const btn1Display = document.getElementById("btn1")
//   const btn2Display = document.getElementById("btn2")
//   const btn3Display = document.getElementById("btn3")
//   statusDisplay.textContent = result ? "Online" : "Offline";
//   statusDisplay.style.color = result ? "#005ea2" : "#d83933";
//   btn1Display.style.display = result ? "" : "none";
//   btn2Display.style.display = result ? "" : "none";
//   btn3Display.style.display = result ? "" : "none";
  
// }, 3000); // probably too often, try 30000 for every 30 seconds

// window.addEventListener("load", async (event) => {
//   const statusDisplay = document.getElementById("status");
//   const buttonDisplay = document.getElementById("button")
//   statusDisplay.textContent = (await checkOnlineStatus())
//     ? "Online"
//     : "OFFline";

    
// });
</script>