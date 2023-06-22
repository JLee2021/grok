<section id="test-section-id" class="usa-section">
    <div class="grid-container">
        <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
            <h1 class="site-preview-heading margin-0">Trip ID: <span><?php echo $trip_id; ?></span></h1>
            <div id="grok_trip_info"></div>
            <div id="grok_hauls_list"></div>
            <ul class="usa-list usa-list--unstyled">
                <li>Haul<span>03</span>, <span>datetime</span>, GPS:<span></span></li>
                <li>Haul<span>02</span>, <span>datetime</span>, GPS:<span></span></li>
                <li>Haul<span>01</span>, <span>datetime</span>, GPS:<span></span></li>
            </ul>
            <a href="new_haul"><button type="button" class="usa-button usa-button--big">Add New Haul</button></a> <br><br>

        </div>
    </div>
</section>

<script>
    function build_trip_info() {
        let div = document.getElementById('grok_trip_info');
        let vessel = document.createElement('p');
            vessel.innerHTML = 'Mary Lu II';
        div.appendChild(vessel);
        let sail_date = document.createElement('span');
            sail_date.innerHTML = '6 June 2023';
        div.appendChild(sail_date);
    }
    function grok_hauls_list() {
        let div = document.getElementById('grok_hauls_list');
        let haul = document.createElement('a');
            haul.type = 'button';
            haul.classList.add('usa-button');
            //haul.classList.add('usa-button');
            haul.title = 'Haul 001';
        div.appendChild(haul);

    }

</script>
