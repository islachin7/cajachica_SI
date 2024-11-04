  <?php
 echo view("estructuraDashboard2/cabecera");
?>
  <?php
 echo view("estructuraDashboard2/barraLateralDashboard");
?>
  <?php
 echo view("estructuraDashboard2/barraLateralMovilDashboard");
?>
<?php
 echo view("estructuraDashboard2/navbar");
?>

      <section class="container padding-top-3x padding-bottom-3x">
<div class="row d-flex justify-content-center ">
  <div class="col-lg-3 margin-bottom-1x" >
    <div class="card text-center">
      <div class="card-body" style="height:230px;">
     <img class="d-block mx-auto rounded-circle mb-3 py-2" src="<?= base_url() ?>/plantilla/img/iconos/usuario.png" alt="Card image">
      </div>
     <div class="card-body d-block" style="height:80px;">
       <h4 class="card-title">MI CUENTA</h4>
     </div>
      <div class="card-body">
        <a class="btn btn-outline-primary btn-sm" href="<?=base_url()?>/dashboard/actuUsuario?id=<?=session("idUsuario")?>">Entrar</a>
      </div>
    </div>
  </div>
  <div class="col-lg-3 margin-bottom-1x" >
    <div class="card text-center">
      <div class="card-body" style="height:230px;">
     <img class="d-block mx-auto rounded-circle mb-3 py-2" src="<?= base_url() ?>/plantilla/img/iconos/solicito.png" alt="Card image">
      </div>
     <div class="card-body d-block" style="height:80px;">
       <h4 class="card-title">SOLICITUDES DE TRANSFERENCIA</h4>
     </div>
      <div class="card-body">
        <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>/dashboard/transferencia2">Entrar</a>
      </div>
    </div>
  </div>
  <div class="col-lg-3 margin-bottom-1x" >
    <div class="card text-center">
      <div class="card-body" style="height:230px;">
     <img class="d-block mx-auto rounded-circle mb-3 py-2" src="<?= base_url() ?>/plantilla/img/iconos/cambio.png" alt="Card image">
      </div>
     <div class="card-body d-block" style="height:80px;">
       <h4 class="card-title">TRANSFERENCIAS</h4>
     </div>
      <div class="card-body">
        <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>/dashboard/transferenciasAceptadas2">Entrar</a>
      </div>
    </div>
  </div>
  <div class="col-lg-3 margin-bottom-1x" >
    <div class="card text-center">
      <div class="card-body" style="height:230px;">
     <img class="d-block mx-auto rounded-circle mb-3 py-2" src="<?= base_url() ?>/plantilla/img/iconos/proyecto.png" alt="Card image">
      </div>
     <div class="card-body d-block" style="height:80px;">
       <h4 class="card-title">PROYECTOS</h4>
     </div>
      <div class="card-body">
        <a class="btn btn-outline-primary btn-sm" href="<?= base_url() ?>/dashboard/proyectos2">Entrar</a>
      </div>
    </div>
  </div>


</div>
      </section>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


      <?php if(isset($msj)):?>
      <script>
        toastr.success('<?php echo $msj; ?>','Notificación',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      </script>
      <?php endif; ?>

      <?php if(session()->getFlashdata('success')!=""):?>
              <script>
                toastr.success('<?php echo session()->getFlashdata('success'); ?>','Notificación',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
              </script>
              <?php endif; ?>

              <?php if(isset($mensaje)):?>
              <script>
                toastr.info('<?php echo $mensaje; ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
              </script>
              <?php endif; ?>

   <?php
 echo view("estructuraDashboard2/footer");
?>
