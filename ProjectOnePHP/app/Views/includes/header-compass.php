<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>NOAA - Atlas Data Entry</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/styles.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/css/custom.css'); ?>">
    <link rel="manifest" href="https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/manifest.webmanifest">

<!-- Start jQUery Menu -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    
        <script>
	$( function() {
		$( "#menu" ).menu();
	} );
	</script>
    <!-- End jQuery Menu -->
    <style>
        .ui-menu { width: 150px; }

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

        /* Dropdown Button */
.dropbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color: #3e8e41;}





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
            <button disabled class="circle online" id="online">ONLINE</button>
            <button disabled class="circle offline" id="offline">OFFLINE</button>
        </div>
    </div>

