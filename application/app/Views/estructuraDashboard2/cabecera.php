<?php
if(session('correo')==""){
   echo view('login');
   exit;
}elseif (session('tipo')==1 || session('tipo')==3) {
  echo view('dashboard');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Panel de Control
    </title><meta name="author" content="Victor Islachin">
    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Favicon and Apple Icons-->
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>/plantilla/favicon.ico">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/plantilla/favicon.png">
    <link rel="apple-touch-icon" href="touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="180x180" href="touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="167x167" href="touch-icon-ipad-retina.png">
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    >
    <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="<?= base_url() ?>/plantilla/css/vendor.min.css">
    <!-- Main Template Styles-->
    <link id="mainStyles" rel="stylesheet" media="screen" href="<?= base_url() ?>/plantilla/css/styles.min.css">
    <!-- Customizer Styles-->
    <link rel="stylesheet" media="screen" href="<?= base_url() ?>/plantilla/customizer/customizer.min.css">
            <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/c635f24a6a.js" crossorigin="anonymous"></script>

    <!-- Modernizr-->
    <script src="<?= base_url() ?>/plantilla/js/modernizr.min.js"></script>
  </head>
  <!-- Body-->
  <body>
