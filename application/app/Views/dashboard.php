<?php
 echo view("estructuraDashboard/cabecera");
 echo view("estructuraDashboard/barraLateralDashboard");
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
 echo view("estructuraDashboard/barraLateralMovilDashboard");
 echo view("estructuraDashboard/navbar");
?>

      <section class="container padding-top-3x padding-bottom-3x">
        <div class="row d-flex justify-content-center ">

        <div class="col-lg-3 margin-bottom-1x" >
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

<!--         
            <div class="col-lg-3 margin-bottom-1x" >
              <div class="card text-center">
                <div class="card-body" style="height:230px;">
               <img class="d-block mx-auto rounded-circle mb-3 py-2" src="/plantilla/img/iconos/presoli.png" alt="Card image">
                </div>
               <div class="card-body d-block" style="height:80px;">
                 <h4 class="card-title">LISTA DE PRE-SOLICITUDES DE TRANSFERENCIA</h4>
               </div>
                <div class="card-body">
                  <a class="btn btn-outline-primary btn-sm" href="/solicitudesTransferenciac/presolicitudes">Entrar</a>
                </div>
              </div>
            </div>

            <div class="col-lg-3 margin-bottom-1x" >
                <div class="card text-center">
                  <div class="card-body" style="height:230px;">
                 <img class="d-block mx-auto rounded-circle mb-3 py-2" src="/plantilla/img/iconos/solicito.png" alt="Card image">
                  </div>
                 <div class="card-body d-block" style="height:80px;">
                   <h4 class="card-title">SOLICITUDES DE TRANSFERENCIA</h4>
                 </div>
                  <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="/solicitudesTransferenciac">Entrar</a>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 margin-bottom-1x" >
                <div class="card text-center">
                  <div class="card-body" style="height:230px;">
                 <img class="d-block mx-auto rounded-circle mb-3 py-2" src="/plantilla/img/iconos/cambio.png" alt="Card image">
                  </div>
                 <div class="card-body d-block" style="height:80px;">
                   <h4 class="card-title">TRANSFERENCIAS</h4>
                 </div>
                  <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="/solicitudesTransferenciac/transferenciasAceptadas">Entrar</a>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 margin-bottom-1x" >
                <div class="card text-center">
                  <div class="card-body" style="height:230px;">
                 <img class="d-block mx-auto rounded-circle mb-3 py-2" src="/plantilla/img/iconos/usuario.png" alt="Card image">
                  </div>
                 <div class="card-body d-block" style="height:80px;">
                   <h4 class="card-title">USUARIOS</h4>
                 </div>
                  <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="/usuario">Entrar</a>
                  </div>
                </div>
              </div>


              <div class="col-lg-3 margin-bottom-1x" >
                <div class="card text-center">
                  <div class="card-body" style="height:230px;">
                 <img class="d-block mx-auto rounded-circle mb-3 py-2" src="/plantilla/img/iconos/material.png" alt="Card image">
                  </div>
                 <div class="card-body d-block" style="height:80px;">
                   <h4 class="card-title">MATERIALES</h4>
                 </div>
                  <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="/material">Entrar</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 margin-bottom-1x" >
                <div class="card text-center">
                  <div class="card-body" style="height:230px;">
                 <img class="d-block mx-auto rounded-circle mb-3 py-2" src="/plantilla/img/iconos/almacen.png" alt="Card image">
                  </div>
                 <div class="card-body d-block" style="height:80px;">
                   <h4 class="card-title">ALMACENES</h4>
                 </div>
                  <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="/almacenc">Entrar</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 margin-bottom-1x" >
                <div class="card text-center">
                  <div class="card-body" style="height:230px;">
                 <img class="d-block mx-auto rounded-circle mb-3 py-2" src="/plantilla/img/iconos/proveedor.png" alt="Card image">
                  </div>
                 <div class="card-body d-block" style="height:80px;">
                   <h4 class="card-title">PROVEEDORES</h4>
                 </div>
                  <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="/proveedorc">Entrar</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 margin-bottom-1x" >
                <div class="card text-center">
                  <div class="card-body" style="height:230px;">
                 <img class="d-block mx-auto rounded-circle mb-3 py-2" src="/plantilla/img/iconos/proyecto.png" alt="Card image">
                  </div>
                 <div class="card-body d-block" style="height:80px;">
                   <h4 class="card-title">PROYECTOS</h4>
                 </div>
                  <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="/proyectoc">Entrar</a>
                  </div>
                </div>
              </div>
              <div class="col-lg-3 margin-bottom-1x" >
                <div class="card text-center">
                  <div class="card-body" style="height:230px;">
                 <img class="d-block mx-auto rounded-circle mb-3 py-2" src="/plantilla/img/iconos/compra.png" alt="Card image">
                  </div>
                 <div class="card-body d-block" style="height:80px;">
                   <h4 class="card-title">ORDENES DE COMPRA</h4>
                 </div>
                  <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="/ordenComprac">Entrar</a>
                  </div>
                </div>
              </div>

              <div class="col-lg-3 margin-bottom-1x" >
                <div class="card text-center">
                  <div class="card-body" style="height:230px;">
                 <img class="d-block mx-auto rounded-circle mb-3 py-2" src="/plantilla/img/iconos/baja.png" alt="Card image">
                  </div>
                 <div class="card-body d-block" style="height:80px;">
                   <h4 class="card-title">SOLICITUDES DE BAJA</h4>
                 </div>
                  <div class="card-body">
                    <a class="btn btn-outline-primary btn-sm" href="/material/solicitudesBaja">Entrar</a>
                  </div>
                </div>
              </div>
            </div>

-->
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
 echo view("estructuraDashboard/footer");
?>
</body>
</html>
