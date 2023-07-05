<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>NOAA - Atlas Data Entry</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo base_url('/assets/css/styles.css'); ?>">
        <link rel="manifest" href="<?php echo base_url('/manifest.webmanifest'); ?>">
    </head>
    <body>
      <div class="grid-container">
          <nav class="usa-breadcrumb" aria-label="Breadcrumbs,,">
            <ol class="usa-breadcrumb__list">
<?php
    foreach($nav as $breadcrumb)
    {
        if(is_null($breadcrumb['url']))
        {
            $html = '              <li class="usa-breadcrumb__list-item usa-current" aria-current="page"><span>'.$breadcrumb['name'].'</span></li>'."\n";
        }else {
            $html = '              <li class="usa-breadcrumb__list-item"><a href="'.site_url($breadcrumb['url']).'" class="usa-breadcrumb__link"><span>'.$breadcrumb['name'].'</span></a></li>'."\n";
        }
        echo $html;
    }
?>
            </ol>
          </nav>
      </div>
