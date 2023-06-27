<section id="test-section-id" class="usa-section">
    <div class="grid-container">
        <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
            <h1 class="site-preview-heading margin-0" id="status"></h1>
        </div>
    </div>
</section>
<script>
/*  ********** Online / Offline Detection **********  */

// Request a small image at an interval to determine status
// ** Get a 1x1 pixel image here: http://www.1x1px.me/
// ** Use this code with an HTML element with id="status"

const checkOnlineStatus = async () => {
  try {
    const online = await fetch("https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/1pixel.png");
    return online.status >= 200 && online.status < 300; // either true or false
  } catch (err) {
    return false; // definitely offline
  }
};

setInterval(async () => {
  const result = await checkOnlineStatus();
  const statusDisplay = document.getElementById("status");
  statusDisplay.textContent = result ? "Online" : "Offline";
  statusDisplay.style.color = result ? "#005ea2" : "#d83933";
}, 3000); // probably too often, try 30000 for every 30 seconds

// forgot to include async load event listener in the video! 
window.addEventListener("load", async (event) => {
  const statusDisplay = document.getElementById("status");
  statusDisplay.textContent = (await checkOnlineStatus())
    ? "Online"
    : "OFFline";
});
</script>