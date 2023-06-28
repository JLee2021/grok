<section id="test-section-id" class="usa-section">
    <div class="grid-container">
        <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
            <h1 class="site-preview-heading margin-0">New Vessel</h1>
            <h3>Network Connection: <span id="status"></span></h3>

            <form class="usa-form" id="new_boat" action=<?= site_url("/BoatController/store"); ?> method="post">
            <?= csrf_field() ?>

                <label class="usa-label" for="boat-name">Vessel Name</label>
                <input class="usa-input" id="boat-name" name="boat-name" />

                
                <button type="submit" class="usa-button usa-button--big" id="button">Create Vessel</button>
            </form>
        
        
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
  statusDisplay.textContent = result ? "Online" : "Offline";
  statusDisplay.style.color = result ? "#005ea2" : "#d83933";
  buttonDisplay.style.display = result ? "" : "none";
}, 3000); // probably too often, try 30000 for every 30 seconds

window.addEventListener("load", async (event) => {
  const statusDisplay = document.getElementById("status");
  const buttonDisplay = document.getElementById("button")
  statusDisplay.textContent = (await checkOnlineStatus())
    ? "Online"
    : "OFFline";

    
});
</script>