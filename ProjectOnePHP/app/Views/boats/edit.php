<section id="test-section-id" class="usa-section">
    <div class="grid-container">
        <div class="mobile-lg:grid-col-8 margin-top-4 mobile-lg:margin-top-0">
            <h1 class="site-preview-heading margin-0">Update Boats</h1>
            
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
            
            <br>
            <a href="index"><button type="button" class="usa-button usa-button--base">Cancel</button></a> 
        </div>
    </div>
</section>