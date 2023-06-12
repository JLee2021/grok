<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>USWDS</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/assets/css/styles.css">
    </head>
    <body>
        <section id="test-section-id" class="usa-section">
            <div class="grid-container">
        <div class="mobile-lg:grid-col-4 margin-top-4 mobile-lg:margin-top-0">
    <h1 class="site-preview-heading margin-0">Start Haul</h1>
      
    <h3 class="site-preview-heading margin-0">End Datetime</h3>
    <div class="usa-form-group">
  <label class="usa-label" id="appointment-date-label" for="appointment-date">End date</label>
  <div class="usa-hint" id="appointment-date-hint">mm/dd/yyyy</div>
  <div class="usa-date-picker">
    <input
      class="usa-input"
      id="appointment-date"
      name="appointment-date"
      aria-labelledby="appointment-date-label"
      aria-describedby="appointment-date-hint"
    />
  </div>
</div>
<div class="usa-form-group">
  <label class="usa-label" id="appointment-time-label" for="appointment-time">End time</label>
  <div class="usa-hint" id="appointment-time-hint">hh:mm</div>
  <div class="usa-time-picker">
    <input
      class="usa-input"
      id="appointment-time"
      name="appointment-time"
      aria-describedby="appointment-time-label appointment-time-hint"
    />
  </div>
</div>
          <br><br><br>
    <h3 class="site-preview-heading margin-0">End GPS</h3>
    <p>GPS: </p>
          <label class="usa-label" for="input-type-text">Lat:</label><input class="usa-input" id="input-type-text" name="input-type-text" />
          <label class="usa-label" for="input-type-text">Lon:</label><input class="usa-input" id="input-type-text" name="input-type-text" />

          <br><br>
        <button type="button" class="usa-button usa-button--big">Start Trip</button> <br><br>
  
   
  </div>
        </div>
    </section>
        
      <script src="/assets/uswds/js/uswds.min.js"></script>
    </body>
</html>