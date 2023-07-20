<!DOCTYPE html>
<!--[if lt IE 9]><html class="lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->
  <head>
    <!-- Basic Page Needs
================================================== -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Specific Metas
================================================== -->
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Title and meta description
================================================== -->
    <title>COMPASS</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="https://nefsctest.nmfs.local/grok/html/ProjectOnePHP/public/manifest.webmanifest">

    <!-- CSS
    ================================================== -->
    <!-- env: dev -->

        <link rel="stylesheet" href="<?php echo base_url('/assets/uswds/uswds/css/styles.css'); ?>">

    <!-- USWDS INIT
    ================================================== -->
    <script src="<?php echo base_url('/assets/uswds/uswds/js/uswds-init.min.js'); ?>"></script>
    <link rel="preload" href="<?php echo base_url('/assets/uswds/uswds/js/uswds.min.js'); ?>" as="script">

</head>

<body class="page-authentication-pages layout-styleguide ">
    <a class="usa-skipnav" href="#main-content">Skip to main content</a>
<section class="usa-banner site-banner" aria-label="Official website of the United States government,,,,,,">
  <div class="usa-accordion">
    <header class="usa-banner__header">
      <div class="usa-banner__inner">
        <div class="grid-col-auto">
          <img aria-hidden="true" class="usa-banner__header-flag" src="<?php echo base_url('/assets/uswds/uswds/img/us_flag_small.png'); ?>" alt="U.S. flag" width="16" height="11">
        </div>
        <div class="grid-col-fill tablet:grid-col-auto" aria-hidden="true">
          <p class="usa-banner__header-text">An official website of the United States government</p>
          <p class="usa-banner__header-action">Here’s how you know</p>
        </div>
        <button
          type="button"
          class="usa-accordion__button usa-banner__button"
          aria-expanded="false"
          aria-controls="gov-banner"
        >
          <span class="usa-banner__button-text">Here’s how you know</span>
        </button>
      </div>
    </header>
    <div class="usa-banner__content usa-accordion__content" id="gov-banner">
      <div class="grid-row grid-gap-lg">
        <div class="usa-banner__guidance tablet:grid-col-6">
          <img class="usa-banner__icon usa-media-block__img" src="<?php echo base_url('/assets/uswds/uswds/img/icon-dot-gov.svg'); ?>" role="img" alt="" aria-hidden="true">
          <div class="usa-media-block__body">
            <p>
              <strong>Official websites use .gov</strong>
              <br>
              A <strong>.gov</strong> website belongs to an official government organization in the United States.
            </p>
          </div>
        </div>
        <div class="usa-banner__guidance tablet:grid-col-6">
          <img class="usa-banner__icon usa-media-block__img" src="<?php echo base_url('/assets/uswds/uswds/img/icon-https.svg'); ?>" role="img" alt="" aria-hidden="true">
          <div class="usa-media-block__body">
            <p>
              <strong>Secure .gov websites use HTTPS</strong>
              <br>
              A <strong>lock</strong> ( <span class="icon-lock"><svg xmlns="http://www.w3.org/2000/svg" width="52" height="64" viewBox="0 0 52 64" class="usa-banner__lock-image" role="img" aria-labelledby="banner-lock-description" focusable="false"><title id="banner-lock-title">Lock</title><desc id="banner-lock-description">Locked padlock</desc><path fill="#000000" fill-rule="evenodd" d="M26 0c10.493 0 19 8.507 19 19v9h3a4 4 0 0 1 4 4v28a4 4 0 0 1-4 4H4a4 4 0 0 1-4-4V32a4 4 0 0 1 4-4h3v-9C7 8.507 15.507 0 26 0zm0 8c-5.979 0-10.843 4.77-10.996 10.712L15 19v9h22v-9c0-6.075-4.925-11-11-11z"/></svg></span> ) or <strong>https://</strong> means you’ve safely connected to the .gov website. Share sensitive information only on official, secure websites.

            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<header class="usa-header usa-header--extended site-header site-header--dark" role="banner">
  <div class="usa-navbar site-header__navbar">
    <div class="usa-logo site-logo" id="logo">
      <em class="usa-logo__text site-logo__text">
        <a href="/" title="NEFSC Skunkworks Project App (COMPASS) Home">
          <span aria-hidden="true" class="site-title--short">USWDS</span>
          <span class="site-title--long">NEFSC Skunkworks Project App (COMPASS)</span>
        </a>
      </em>
    </div>
    <button type="button" class="usa-menu-btn">Menu</button>
  </div>
</header>
