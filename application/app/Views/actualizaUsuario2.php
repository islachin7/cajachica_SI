<?php
 echo view("estructuraDashboard/cabecera");
 echo view("estructuraDashboard/barraLateralDashboard");
 echo view("estructuraDashboard/barraLateralMovilDashboard");
 echo view("estructuraDashboard/navbar");
?>


<button id="errorsito" data-toast data-toast-type="danger" data-toast-position="topRight" data-toast-icon="fas fa-times" data-toast-title="Error" data-toast-message="al agregar" hidden="true">
</button>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-2 py-5">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-8">
            <div class="padding-top-3x hidden-md-up"></div>
            <h3 class="margin-bottom-1x">Editar Mi Usuario:</p>
            <form class="row" method="post" action="<?= base_url() ?>/usuario/actualizarUsuario">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-pass">Nombre:</label>
                  <input class="form-control" type="text" id="transfe"  name="id" value="<?=$usuario['id']?>" hidden>
                  <input class="form-control" type="text" id="transfe"  name="nombre" value="<?=$usuario['nombre']?>">
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-pass">Apellido:</label>
                  <input class="form-control" type="text" id="transfe"  name="apellido" value="<?=$usuario['apellido']?>" >
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-pass">Celular:</label>
                  <input class="form-control" type="text" id="transfe"  name="celular" value="<?=$usuario['celular']?>" >
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-pass">Tipo de Usuario:</label>
                  <input class="form-control" type="text"  name="tipousuario" value="<?=$usuario['tipousuario']?>" hidden>
                  <?php  if (isset($tipos)): ?>
                    <?php foreach ($tipos as $row){ if($usuario['tipousuario']==$row->id){?>
                      <input class="form-control" type="text" value="<?=$row->nombre?>" readonly>
                  <?php }} ?>
                  <?php endif; ?>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-pass">Correo:</label>
                  <input class="form-control" type="text" id="transfe"  name="correo" value="<?=$usuario['correo']?>" >
                </div>
              </div>
              <div class="col-sm-4">
                <div class="custom-control custom-checkbox d-flex flex-wrap justify-content-between align-items-center">
                <input class="custom-control-input" type="checkbox" name="cambiar" id="cambio">
                <label class="custom-control-label" for="cambio" >¿Desea Cambiar la Contraseña?</label>
                </div>
                </div>
              <div class="col-sm-8"></div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-pass" id="labelcontra1" hidden="">Nueva Contraseña:</label>
                  <input class="form-control" type="password" id="contra1"  name="password" hidden="" >
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-pass" id="labelcontra2" hidden="">Confirmar Contraseña:</label>
                  <input class="form-control" type="password" id="contra2"  name="confirmar_password" hidden="" >
                </div>
              </div>
              <div class="col-12 text-center text-sm-right">
                <input id="botonregistrar" class="btn btn-success margin-bottom-none" type="submit" value="Actualizar">
                <a href="<?=base_url()?>/dashboard/" class="btn btn-danger margin-bottom-none">Cancelar</a>
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

      <script type="text/javascript">
        $("#tipoo").val('<?=$usuario['tipousuario']?>');
        $('input[type=checkbox]').on('change', function() {
          if ($(this).is(':checked') ) {
            $("#labelcontra1").removeAttr('hidden');
            $("#contra1").removeAttr('hidden');
            $("#labelcontra2").removeAttr('hidden');
            $("#contra2").removeAttr('hidden');
            $("#cambio").attr('value',"si");
          } else {
            $("#labelcontra1").attr('hidden',"");
            $("#labelcontra2").attr('hidden',"");
            $("#contra1").attr('hidden',"");
            $("#contra2").attr('hidden',"");
            $("#cambio").attr('value',"no");
          }
        });
      </script>

<?php
 echo view("estructuraDashboard/footer");
?>
