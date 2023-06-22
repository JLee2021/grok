<section id="test-section-id" class="usa-section">
    <div class="grid-container">
        <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
            <h1 class="site-preview-heading margin-0">New Boat</h1>

            <form class="usa-form" id="new_boat" action=<?= site_url("/BoatController/store"); ?> method="post">
            <?= csrf_field() ?>

                <label class="usa-label" for="boat-name">Boat Name</label>
                <input class="usa-input" id="boat-name" name="boat-name" />

                
                <button type="submit" class="usa-button usa-button--big">Create Boat</button>
            </form>
        
        
        </div>
    </div>
</section>