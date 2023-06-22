<section id="test-section-id" class="usa-section">
    <div class="grid-container">
        <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
            <h1 class="site-preview-heading margin-0">Boats</h1>
            <ul class="usa-list usa-list--unstyled">
             <?php
                // var_dump($boats);
                
                foreach($boats as $boat){
                    echo "<li>" . $boat . "</li>";
                }
             ?>
            </ul>
            <br>
            <a href="create"><button type="button" class="usa-button">Add Boat</button></a> <a href="delete"><button type="button" class="usa-button usa-button--secondary">Delete Boat</button></a>
        </div>
    </div>
</section>