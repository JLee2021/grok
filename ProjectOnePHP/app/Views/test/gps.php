<section id="test-section-id" class="usa-section">
    <div class="grid-container">
        <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
            <h1 class="site-preview-heading margin-0">GPS</h1>
            <label class="usa-label" for="input-type-text">Latitude:</label>
    <input class="usa-input" id="lat" name="input-type-text" />
    <label class="usa-label" for="input-type-text">Longitude:</label>
    <input class="usa-input" id="lon" name="input-type-text" />
        </div>
    </div>
</section>
<script>
    const options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0,
    };

    function success(pos) {
        
        const crd = pos.coords;
        const lat = crd.latitude;
        const lon = crd.longitude;
        document.getElementById("lat").value = lat;
        document.getElementById("lon").value = lon;
        console.log("Your current position is:");
        console.log(`Latitude : ${crd.latitude}`);
        console.log(`Longitude: ${crd.longitude}`);
        console.log(`More or less ${crd.accuracy} meters.`);
    }

    function error(err) {
        console.warn(`ERROR(${err.code}): ${err.message}`);
    }

    navigator.geolocation.getCurrentPosition(success, error, options);
</script>