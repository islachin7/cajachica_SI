<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Registro
    </title>
    <meta name="author" content="Victor Islachin">
    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- Favicon and Apple Icons-->
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>/plantilla/favicon2.ico">
    <link rel="icon" type="image/png" href="<?= base_url() ?>/plantilla/favicon2.png">
    <link rel="apple-touch-icon" href="touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="180x180" href="touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="167x167" href="touch-icon-ipad-retina.png">

    <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="<?= base_url() ?>/plantilla/css/vendor.min.css">
    <!-- Main Template Styles-->
    <link id="mainStyles" rel="stylesheet" media="screen" href="<?= base_url() ?>/plantilla/css/styles.min.css">

    <!-- Customizer Styles-->
    <link rel="stylesheet" media="screen" href="<?= base_url() ?>/plantilla/customizer/customizer.min.css">

    <!-- Modernizr-->
    <script src="<?= base_url() ?>/plantilla/js/modernizr.min.js"></script>
    <script src="https://kit.fontawesome.com/c635f24a6a.js" crossorigin="anonymous"></script>
  </head>
  <!-- Body-->
  <body>

    <!-- Off-Canvas Wrapper-->
    <div class="offcanvas-wrapper">
      <!-- Page Title-->
      <div class="page-title" style="padding:3px 0;">
          <a class="site-logo" href="index.html"><img src="<?= base_url() ?>/plantilla/img/logo/logoNaty.pn" alt="Logo"></a>
      </div>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-2">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="padding-top-3x hidden-md-up"></div>
            <h3 class="margin-bottom-1x">Solicitud de transferencia de Existencias</h3>
            <p>Llene todos los campos con la información requerida.</p>
            <form class="row" method="post" action="<?= base_url() ?>/">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-fn">Almacen origen</label>
                  <select id="inputState" class="form-control">
                  <option selected>Almacen Central</option>
                  <option>Almacen Proyecto 1</option>
                  <option>Almacen Proyecto 2</option>
                  <option>Almacen Proyecto 3</option>
                  <option>Almacen Proyecto 4</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-1 col-xs-1 col-1 d-flex align-items-center">
                <div class="form-group">
                  <label for="reg-ln"></label>
                  <i class="fas fa-exchange-alt form-control align-middle d-flex align-items-center text-sm-center text-xs-center"></i>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-ln">Almacen destino</label>
                  <select id="inputState" class="form-control">
                  <option selected>Almacen Desecho</option>
                  <option>Almacen Proyecto 1</option>
                  <option>Almacen Proyecto 2</option>
                  <option>Almacen Proyecto 3</option>
                  <option>Almacen Proyecto 4</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="reg-email">Fecha</label>
                  <input class="form-control" type="date" id="reg-email" name="correo" required>
                </div>
              </div>
              <div class="col-sm-7">
                <div class="form-group">
                  <label for="reg-phone">Resposable</label>
                  <select id="inputState" class="form-control">
                  <option selected>Seleccionar:</option>
                  <option>Victor Islachin</option>
                  <option>Antonio Ravenna</option>
                  </select>
                </div>
              </div>
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="reg-pass">Tipo de Transferencia</label>
                  <input class="form-control" type="text" id="reg-pass" value="Transferencia Interna" name="password" readonly>
                </div>
              </div>
              <div class="col-sm-8">
                <div class="form-group">
                  <label for="reg-pass-confirm">Material o Equipo</label>
                  <input class="form-control" type="text" id="reg-pass-confirm" name="confirmar_pasword" placeholder="Buscar por código o descripción">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-pass-confirm"></label>
                  <a href="#" class="btn btn-success form-control">Agregar</a>
                </div>
              </div>

              <table class="table table-hover">
  <thead class="table-success">
    <tr>
      <th scope="col">Código</th>
      <th scope="col">Descripción</th>
      <th scope="col">stock</th>
      <th scope="col">Cantidad</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Casco de Capataz</td>
      <td>8</td>
      <td>
        <input type="text" name="" class="form-control" size="2">
      </td>
    </tr>
    <tr>
     <th scope="row">2</th>
      <td>Arena</td>
      <td>8</td>
      <td>
        <input type="text" name="" class="form-control" size="2">
      </td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Camillas</td>
      <td>10</td>
      <td>
        <input type="text" name="" class="form-control" size="2">
      </td>
    </tr>
  </tbody>
</table>



              <?php if (isset($validation)): ?>
                <div class="col-sm-12">
                  <div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x">
                   <?= $validation->listErrors() ?>
                  </div>
                </div>
              <?php endif; ?>

              <div class="col-12 text-center text-sm-right">
                <input class="btn btn-primary margin-bottom-none" type="submit" value="Registrar">
              </div>
            </form>
          </div>
          <div class="col-md-1"></div>
        </div>
      </div>
      <!-- Site Footer-->
      <footer class="site-footer">
        <div class="container">
          <div class="row">

            <div class="col-lg-2 col-md-6">

            </div>
            <div class="col-lg-8 col-md-6">
              <!-- Contact Info-->
              <section class="widget widget-light-skin text-center">
                <h3 class="widget-title">Get In Touch With Us</h3>
                <p class="text-white">Phone: 00 33 169 7720</p>
                <ul class="list-unstyled text-sm text-white">
                  <li><span class="opacity-50">Monday-Friday:</span>9.00 am - 8.00 pm</li>
                  <li><span class="opacity-50">Saturday:</span>10.00 am - 6.00 pm</li>
                </ul>
                <p><a class="navi-link-light" href="#">support@unishop.com</a></p>
                <a class="social-button shape-circle sb-facebook sb-light-skin" href="#"><i class="socicon-facebook"></i></a>
                <a class="social-button shape-circle sb-twitter sb-light-skin" href="#"><i class="socicon-twitter"></i></a>
                <a class="social-button shape-circle sb-instagram sb-light-skin" href="#"><i class="socicon-instagram"></i></a>
              </section>
            </div>
            <div class="col-lg-2 col-md-6">

            </div>
          </div>
          <hr class="hr-light mt-2 margin-bottom-2x">
          <!-- Copyright-->
          <p class="footer-copyright text-center">© Desarrollado por Victor Islachin</p>
        </div>
      </footer>
    </div>
    <!-- Back To Top Button--><a class="scroll-to-top-btn" href="#"><i class="icon-arrow-up"></i></a>
    <!-- Backdrop-->
    <div class="site-backdrop"></div>
    <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
    <script src="<?= base_url() ?>/plantilla/js/vendor.min.js"></script>
    <script src="<?= base_url() ?>/plantilla/js/scripts.min.js"></script>
    <!-- Customizer scripts-->
    <script src="<?= base_url() ?>/plantilla/customizer/customizer.min.js"></script>


  </body>

</html>
