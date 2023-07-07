<section id="test-section-id" class="usa-section">
    <div class="grid-container">
        <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
            <h1 class="site-preview-heading margin-0">For Current Location, Check Console</h1>
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