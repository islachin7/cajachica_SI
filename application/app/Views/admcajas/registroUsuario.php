<?php
 echo view("admcajas/cabecera");
 echo view("admcajas/barraLateralDashboard");
 echo view("admcajas/barraLateralMovilDashboard");
 echo view("admcajas/navbar");
?>

<button id="errorsito" data-toast data-toast-type="danger" data-toast-position="topRight" data-toast-icon="fas fa-times" data-toast-title="Error" data-toast-message="al agregar" hidden="true">
</button>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-2 py-5">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="padding-top-3x hidden-md-up"></div>
            <h3 class="margin-bottom-1x">Registro de Nuevo Usuario:</p>
            <form class="row" method="post" action="<?= base_url() ?>/usuario/registrarUsuario">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-pass">Nombre:</label>
                  <input autocomplete="off" class="form-control" type="text" id="transfe"  name="nombre">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-pass">Apellido:</label>
                  <input autocomplete="off" class="form-control" type="text" id="transfe"  name="apellido" >
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-pass">Celular:</label>
                  <input autocomplete="off" class="form-control" type="text" id="transfe"  name="celular" >
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-pass">Tipo de Usuario:</label>
                  <select id="inputState" class="form-control" name="tipousuario">
                    <option value="0" selected>Seleccionar:</option>
                  <?php  if (isset($tipos)): ?>
                    <?php foreach ($tipos as $row){ ?>
                      <option value="<?=$row->id?>"><?=$row->nombre?></option>
                  <?php } ?>
                  <?php endif; ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-pass">Correo (no colocar correos con ñ o tilde):</label>
                  <input autocomplete="off" class="form-control" type="text" id="transfe"  name="correo" >
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-pass">Contraseña:</label>
                  <input autocomplete="off" class="form-control" type="password" id="transfe"  name="password" >
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-pass">Confirmar Contraseña:</label>
                  <input autocomplete="off" class="form-control" type="password" id="transfe"  name="confirmar_password" >
                </div>
              </div>
              <div class="col-12 text-center text-sm-right">
                <input id="botonregistrar" class="btn btn-primary margin-bottom-none" type="submit" value="Registrar">
                <a href="<?=base_url()?>/usuario" class="btn btn-danger margin-bottom-none">Cancelar</a>
              </div>
            </form>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
      
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <?php if(isset($validation)):?>
    <?php if($validation->getError('nombre')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('nombre'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>
        <?php if($validation->getError('apellido')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('apellido'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>
    <?php if($validation->getError('correo')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('correo'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>
    <?php if($validation->getError('celular')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('celular'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>
    <?php if($validation->getError('tipousuario')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('tipousuario'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>
    <?php if($validation->getError('password')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('password'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>
    <?php if($validation->getError('confirmar_password')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('confirmar_password'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>
  <?php endif; ?>

<?php
 echo view("admcajas/footer");
?>

</body>
</html>
