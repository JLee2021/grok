<section id="test-section-id" class="usa-section">
    <div class="grid-container">
        <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
            <h1 class="site-preview-heading margin-0">Boats</h1>
            <ul class="usa-list usa-list--unstyled">
             <?php
                // var_dump($boats);
                $i = 1;
                foreach($boats as $boat){
                    echo "<form class='usa-form' id='boat-name' action='" . site_url('/BoatController/remove') . "' method='post'>";
                    csrf_field();
                    echo "<li><input value='" . $boat . "' type='hidden' id='boat-name' name='boat-name' />
                    <button><span style='color:red'>X</span></button> " . $boat . " </li>";
                    echo "</form>";
                }
             ?>
            </ul>
            <br>
            <a href="index"><button type="button" class="usa-button usa-button--base">Cancel</button></a> 
        </div>
    </div>
</section>