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
    <link rel="manifest" href="https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/manifest.webmanifest">
    <style>
        .online {
            display: block;
            padding: 9px 12px;
            color: white;
            background-color: #006400;
            border: none;
        }

        .offline {
            display: none;
            padding: 9px 12px;
            color: white;
            background-color: #d83933;
            border: none;
        }

        .float-right {
            float: right;
        }
    </style>
    <script>
        window.addEventListener("offline", (event) => {
            console.log("The network connection has been lost.");
            document.getElementById("offline").style.display = "block";
            document.getElementById("online").style.display = "none";
        });

        window.addEventListener("online", (event) => {
            console.log("You are now connected to the network.");
            document.getElementById("offline").style.display = "none";
            document.getElementById("online").style.display = "block";
        });
    </script>
</head>

<body>
    <div class="grid-container">
        <nav class="usa-breadcrumb" aria-label="Breadcrumbs,,">
            <ol class="usa-breadcrumb__list">
                <?php
                foreach ($nav as $breadcrumb) {
                    if (is_null($breadcrumb['url'])) {
                        $html = '              <li class="usa-breadcrumb__list-item usa-current" aria-current="page"><span>' . $breadcrumb['name'] . '</span></li>' . "\n";
                    } else {
                        $html = '              <li class="usa-breadcrumb__list-item"><a href="' . site_url($breadcrumb['url']) . '" class="usa-breadcrumb__link"><span>' . $breadcrumb['name'] . '</span></a></li>' . "\n";
                    }
                    echo $html;
                }
                ?>
            </ol>
        </nav>
        <div class="float-right">
        <button class="online" id="online">ONLINE</button>
        <button class="offline" id="offline">OFFLINE</button>
    </div>
    </div>

    