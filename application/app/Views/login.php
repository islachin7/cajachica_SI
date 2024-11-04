<?php
if(session('correo')!="" && session('tipo')==1){
   echo view('dashboard');
   exit;
}elseif (session('tipo')==2) {
  echo view('jefeproyecto/dashboard');
  exit;
}elseif (session('tipo')==8) {
  echo view('residente/dashboard');
  exit;
}elseif (session('tipo')==9) {
  echo view('adminproyecto/dashboard');
  exit;
}elseif (session('tipo')==5) {
  echo view('auditor/dashboard');
  exit;
}elseif (session('tipo')==7) {
  echo view('prevencionista/dashboard');
  exit;
}elseif (session('tipo')==10) {
  echo view('gerencia/dashboard');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login
    </title>
    <meta name="author" content="Victor Islachin">
    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Favicon and Apple Icons-->
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>/plantilla/icono2.ico">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/plantilla/favicon.png">
    <link rel="apple-touch-icon" sizes="194x194" href="<?= base_url() ?>/plantilla/favicon2.png" type="image/png">

    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="<?= base_url() ?>/plantilla/css/vendor.min.css">
    <!-- Main Template Styles-->
    <link id="mainStyles" rel="stylesheet" media="screen" href="<?= base_url() ?>/plantilla/css/styles.min.css">
    <!-- Customizer Styles-->
    <link rel="stylesheet" media="screen" href="<?= base_url() ?>/plantilla/customizer/customizer.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <!-- Modernizr-->
    <script src="<?= base_url() ?>/plantilla/js/modernizr.min.js"></script>
  </head>
  <!-- Body-->
  <body>




    <!-- Off-Canvas Wrapper-->
    <div class="offcanvas-wrapper" style="background-image: linear-gradient(to bottom, #03537d 0%, #03537d 50%, #e5e7eb 50%, #e5e7eb 100%) !important;">
      <!-- Page Title
      <div class="page-title" style="padding:1% 0; background-color:#03537d; border-color:#03537d;">
      </div>-->
      <!-- Page Content-->
      <div class="container">
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-6" style="display:flex; align-items:center; justify-content:center; min-height:100vh;">
            <form class="login-box" method="post" action="<?= base_url() ?>/auth/login" style="background-color:#fff;">

              <div class="row">
                <div class="col-2 col-md-4"></div>
                <div class="col-10 col-md-4">
                  <img class="site-logo" src="<?= base_url() ?>/plantilla/logoEmpresa.png" alt="Logo de Empresa" />
                </div>
                <div class="col-md-4"></div>
              </div>
              <h4 class="margin-bottom-1x text-center py-2">Login</h4>
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
              <div class="form-group input-group">
                <input autocomplete="off" class="form-control" name="correo" type="email" placeholder="correo" required><span class="input-group-addon"><i class="icon-mail"></i></span>
              </div>

              <div class="form-group input-group">
                <input autocomplete="off" class="form-control" name="password" type="password" placeholder="contraseña" ><span class="input-group-addon"><i class="icon-lock"></i></span>
              </div>
                </div>
                <div class="col-md-2"></div>
              </div>

              <style type="text/css">
                .btn-black{background-color:#000;color: #FFF;}
                .btn-black:hover{background-color:#303030;color:#FFF; }
              </style>

              <div class="text-center text-sm-center">
                <button class="btn btn-black margin-bottom-none" type="submit">Login</button>
              </div>
            </form>
          </div>
          <div class="col-md-3"></div>
        </div>
      </div>


    </div>
    <!-- Back To Top Button--><a class="scroll-to-top-btn" href="#"><i class="icon-arrow-up"></i></a>
    <!-- Backdrop-->
    <div class="site-backdrop"></div>
    <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
    <script src="<?= base_url() ?>/plantilla/js/vendor.min.js"></script>
    <script src="<?= base_url() ?>/plantilla/js/scripts.min.js"></script>
    <!-- Customizer scripts-->
    <script src="<?= base_url() ?>/plantilla/customizer/customizer.min.js"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

            <?php  if (session()->get('success')): ?>
              <script>
                toastr.success('Registro Exitoso','Alerta',{
                                                "closeButton": false,
                                                "debug": false,
                                                "newestOnTop": false,
                                                "progressBar": true,
                                                "positionClass": "toast-bottom-right",
                                                "preventDuplicates": false,
                                                "onclick": null,
                                                "showDuration": "300",
                                                "hideDuration": "1000",
                                                "timeOut": "5000",
                                                "extendedTimeOut": "1000",
                                                "showEasing": "swing",
                                                "hideEasing": "linear",
                                                "showMethod": "fadeIn",
                                                "hideMethod": "fadeOut"
                });
              </script>
                <?php  endif; ?>


              <?php if(isset($validation)):?>
                <?php if($validation->getError('correo')!=""):?>

                  <script>
                toastr.error('<?php echo $validation->getError('correo'); ?>','Alerta',{
                                                                      "closeButton": true,
                                                                      "debug": false,
                                                                      "newestOnTop": false,
                                                                      "progressBar": true,
                                                                      "positionClass": "toast-top-right",
                                                                      "preventDuplicates": false,
                                                                      "onclick": null,
                                                                      "showDuration": "500",
                                                                      "hideDuration": "5000",
                                                                      "timeOut": "5000",
                                                                      "extendedTimeOut": "1000",
                                                                      "showEasing": "swing",
                                                                      "hideEasing": "linear",
                                                                      "showMethod": "fadeIn",
                                                                      "hideMethod": "fadeOut"
                });
              </script>
              <?php endif; ?>
                 <?php if($validation->getError('password')!=""):?>
              <script>
                toastr.error('<?php echo $validation->getError('password'); ?>','Alerta',{
                                                                    "closeButton": true,
                                                                    "debug": false,
                                                                    "newestOnTop": false,
                                                                    "progressBar": true,
                                                                    "positionClass": "toast-top-right",
                                                                    "preventDuplicates": false,
                                                                    "onclick": null,
                                                                    "showDuration": "500",
                                                                    "hideDuration": "5000",
                                                                    "timeOut": "5000",
                                                                    "extendedTimeOut": "1000",
                                                                    "showEasing": "swing",
                                                                    "hideEasing": "linear",
                                                                    "showMethod": "fadeIn",
                                                                    "hideMethod": "fadeOut"
                });
              </script>
              <?php endif; ?>
                <?php endif; ?>


          <?php  if (isset($mensaje)): ?>
              <script>
                toastr.error('<?php echo $mensaje; ?>','Alerta',{
                                                      "closeButton": true,
                                                      "debug": false,
                                                      "newestOnTop": false,
                                                      "progressBar": true,
                                                      "positionClass": "toast-top-right",
                                                      "preventDuplicates": false,
                                                      "onclick": null,
                                                      "showDuration": "500",
                                                      "hideDuration": "5000",
                                                      "timeOut": "5000",
                                                      "extendedTimeOut": "1000",
                                                      "showEasing": "swing",
                                                      "hideEasing": "linear",
                                                      "showMethod": "fadeIn",
                                                      "hideMethod": "fadeOut"
                });
              </script>
                <?php  endif; ?>


  </body>

</html>
