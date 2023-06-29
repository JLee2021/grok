<section id="test-section-id" class="usa-section">
    <div class="grid-container">
        <div class="mobile-lg:grid-col-8 margin-top-4 mobile-lg:margin-top-0">
            <h1 class="site-preview-heading margin-0">Update Vessels</h1>
            <h3>Network Connection: <span id="status"></span></h3>
            <div id="boats">
             <?php
                
                foreach($boats as $boat){
                    echo "<form class='usa-form' id='boat-name' action='" . site_url('/BoatController/update') . "' method='post'>";
                    csrf_field();
                    echo "<input type='hidden' readonly class='usa-input' value='" . $boat . "' id='original-name' name='original-name' />
                          <input class='usa-input' value='" . $boat . "' id='boat-name' name='boat-name' />
                    <button style='background-color: #1a4480; color:white; border-radius:5px; padding: 5px 7px;'>Update</button> " ;
                    echo "</form>";
                }
             ?>
            </div>
            <br>
            <a href="index"><button type="button" class="usa-button usa-button--base" id="button">Cancel</button></a> 
        </div>
    </div>
</section>

<script>
const checkOnlineStatus = async () => {
  try {
    const online = await fetch("https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/1pixel.png");
    return online.status >= 200 && online.status < 300; // either true or false
  } catch (err) {
    return false; 
  }
};

setInterval(async () => {
  const result = await checkOnlineStatus();
  const statusDisplay = document.getElementById("status");
  const buttonDisplay = document.getElementById("button")
  const boatsDisplay = document.getElementById("boats")
  statusDisplay.textContent = result ? "Online" : "Offline";
  statusDisplay.style.color = result ? "#005ea2" : "#d83933";
  buttonDisplay.style.display = result ? "" : "none";
  boatsDisplay.style.display = result ? "" : "none";
}, 3000); // probably too often, try 30000 for every 30 seconds

window.addEventListener("load", async (event) => {
  const statusDisplay = document.getElementById("status");
  const buttonDisplay = document.getElementById("button")
  statusDisplay.textContent = (await checkOnlineStatus())
    ? "Online"
    : "OFFline";

    
});
</script>