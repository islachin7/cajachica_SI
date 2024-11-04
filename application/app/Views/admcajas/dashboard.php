<?php
 echo view("admcajas/cabecera");
 echo view("admcajas/barraLateralDashboard");
?>

    <div class="modal fade" id="noticiasss" tabindex="-1">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">LISTA DE CAMBIOS DEL SISTEMA</h4>
            <button id="cerr" class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <nav>
              <li>Se agregó el campo de Factura en las ordenes de Compra.</li>
              <li>Se agregó en el reporte ordenes de Compra el signo de S/ y el subtotal.</li>
              <li>Se agrego el reporte de Stock de Almacenes por Categoría para administradores, gerencia y auditor.</li>
              <li>Se cambio el signo en los inventarios realizados (auditor).</li>
              <li>Se cambio el reporte de inventarios (auditor).</li>
            </nav>
          </div>
        </div>
          </div>
        </div>
      </div>
    </div>
    
<?php
 echo view("admcajas/barraLateralMovilDashboard");
 echo view("admcajas/navbar");
?>

<section class="container padding-top-3x padding-bottom-3x">

<div class="row d-flex justify-content-center ">

  <div class="col-lg-3 margin-bottom-1x" id="tut-modu1">
    <div class="card text-center">
      <div class="card-body" style="height:230px;">
        <img class="d-block mx-auto rounded-circle mb-3 py-2" src="<?= base_url() ?>/plantilla/img/iconos/caja.png" alt="Card image">
      </div>
      <div class="card-body d-block" style="height:80px;">
        <h4 class="card-title">CAJA CHICA</h4>
      </div>
      <div class="card-body">
        <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>/cajaChicac">Entrar</a>
      </div>
    </div>
  </div>

  <div class="col-lg-3 margin-bottom-1x" id="tut-modu2">
    <div class="card text-center">
      <div class="card-body" style="height:230px;">
      <img class="d-block mx-auto rounded-circle mb-3 py-2" src="<?= base_url() ?>/plantilla/img/iconos/usuario.png" alt="Card image">
      </div>
      <div class="card-body d-block" style="height:80px;">
        <h4 class="card-title">USUARIOS</h4>
      </div>
      <div class="card-body">
        <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>/usuario">Entrar</a>
      </div>
    </div>
  </div>

</div>

<a  id="noticia" data-toggle="modal" data-target="#noticiasss" hidden></a>
      </section>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      
      <?php if(isset($msj)):?>
      <script>
        toastr.success('<?php echo $msj; ?>','Notificación',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      </script>
      <?php endif; ?>

      <?php if(session()->getFlashdata('success')!=""):?>
          <script>
            $(document).ready(function(){
            //  $("#noticia").click();
            });
            toastr.success('<?php echo session()->getFlashdata('success'); ?>','Notificación',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
          </script>
          <?php endif; ?>
          <?php if(isset($mensaje)):?>
          <script>
            toastr.info('<?php echo $mensaje; ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
          </script>
          <?php endif; ?>

<?php
 echo view("admcajas/footer");
 ?>

 <script>
/*
const driver = window.driver.js.driver;

const driverObj = driver({
  showProgress: true,
  steps: [
    { popover: { title: 'Bienvenidos a Mi Empresa', description: 'Este Software fue diseñado para apoyar en las actividades de su empresa.' } },
    { element: '#tut-modu1', popover: { title: 'Módulo de Caja Chica', description: 'Administración de Caja Chica asignadas a diferentes usuarios', side: "left", align: 'start' }},
    { element: '#tut-modu2', popover: { title: 'Módulo de Usuario', description: 'Administración de usuarios', side: "left", align: 'start' }},
    { element: 'a[href="#shop-categories"]', popover: { title: 'Menú', description: 'Menú de opciones del sistema', side: "bottom", align: 'start' }}
  ]
});

driverObj.drive();
*/
/*
const driverObj = driver();
driverObj.highlight({
  showProgress: true,
    steps: [
      { element: '#tut-modulos', popover: { title: 'Animated Tour Example', description: 'Here is the code example showing animated tour. Let\'s walk you through it.', side: "left", align: 'start' }},
      { element: 'a[href="shop-categories"]', popover: { title: 'Import the Library', description: 'It works the same in vanilla JavaScript as well as frameworks.', side: "bottom", align: 'start' }},
    ]
});*/

 </script>
 

</body>
</html>
