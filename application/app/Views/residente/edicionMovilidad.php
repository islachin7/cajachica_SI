<?php
echo view("residente/cabecera");
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"/>

<style>
.pagination{display:flex;padding-left:0;list-style:none}
.page-link{position:relative;display:block;color:#0d6efd;text-decoration:none;background-color:#fff;border:1px solid #dee2e6;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out}@media (prefers-reduced-motion:reduce){
.page-link{transition:none}}
.page-link:hover{z-index:2;color:#0a58ca;background-color:#e9ecef;border-color:#dee2e6}
.page-link:focus{z-index:3;color:#0a58ca;background-color:#e9ecef;outline:0;box-shadow:0 0 0 .25rem rgba(13,110,253,.25)}
.page-item:not(:first-child) .page-link{margin-left:-1px}
.page-item.active .page-link{z-index:3;color:#fff;background-color:#0d6efd;border-color:#0d6efd}
.page-item.disabled .page-link{color:#6c757d;pointer-events:none;background-color:#fff;border-color:#dee2e6}
.page-link{padding:.375rem .75rem}
.page-item:first-child .page-link{border-top-left-radius:.25rem;border-bottom-left-radius:.25rem}
.page-item:last-child .page-link{border-top-right-radius:.25rem;border-bottom-right-radius:.25rem}
</style>

  <div class="modal fade" id="creacion_proye" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Crear Proyecto</h4>
          <button id="cerr" class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-12 row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                  <div class="form-group">
                    <label>Nombre del Proyecto:</label>
                    <input class="form-control" type="text" id="descrip_proye">
                  </div>
                </div>
                <div class="col-sm-1"></div>

                <div class="col-sm-4"></div>
                <div class="col-sm-4 text-center">
                  <a  class="btn btn-success" id="regis_proye">REGISTRAR</a>
                </div>
                <div class="col-sm-4 "></div>
            </div>

            <div class="col-12 pt-3">

              <table id="tabla_proye" class="table table-responsive table-hover" style="border-radius:20px" >
              <thead class="table-primary">
                <tr>
                  <th scope="col" WIDTH="800" class="align-middle text-left">Nombre del Proyecto</th>
                </tr>
              </thead>
                <tbody>
                  <?php foreach ($proyectos as $row){ ?>
                      <tr>
                        <td class="align-middle text-left"><?=$row->descripcion?></td>
                      </tr>
                  <?php } ?>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php
echo view("residente/barraLateralDashboard");
echo view("residente/barraLateralMovilDashboard");
echo view("residente/navbar");
?>

<button id="errorsito" data-toast data-toast-type="danger" data-toast-position="topRight" data-toast-icon="fas fa-times" data-toast-title="Error" data-toast-message="al agregar" hidden="true">
</button>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-2 py-5">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="padding-top-3x hidden-md-up"></div>
            <h3 class="margin-bottom-1x">Edición de Movilidad</h3>
            <p>Llene todos los campos con la información requerida.</p>
            <form class="row" method="post" action="<?= base_url() ?>/cajaChicac/editarMovilidad">

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-phone">Registrado por:</label>
                  <input type="text" name="usuario" value="<?=session('idUsuario')?>" hidden="">
                  <input type="text" class="form-control" value="<?=session('nombre').' '.session('apellido')?>" readonly="">
                </div>
              </div>

              <div class="col-sm-5">
                <div class="form-group">
                  <label for="reg-phone">Proyecto:</label>
                  <?php if (isset($caja)){ ?>
                    <input type="text" class="form-control" value="<?=$caja["nombreProyecto"]?>" readonly="">
                    <input type="hidden" name="proyecto" value="<?=$caja["proyecto"]?>">
                <?php } ?>
                </div>
              </div>

            
            <div class="col-sm-3">
              <div class="form-group">
                <label for="reg-email">Fecha</label>
                <input id="fecha" class="form-control" type="date"  name="fecha" value="<?php  if(isset($movi)){ echo $movi["fecha"]; } ?>" required>
                <input id="idmovi"  type="hidden"  name="idmovi" value="<?php  if(isset($movi)){ echo $movi["id"]; } ?>">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-email">Origen</label>
                <input id="origen" autocomplete="off" class="form-control" type="text"  name="origen" value="<?php  if(isset($movi)){ echo $movi["origen"]; } ?>" required>
              </div>
            </div>


            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-email">Destino</label>
                <input id="destino" autocomplete="off" class="form-control" type="text"  name="destino" value="<?php  if(isset($movi)){ echo $movi["destino"]; } ?>" required>
              </div>
            </div>

              
            <div class="col-sm-3">
              <div class="form-group">
                <label for="reg-phone">Caja Chica:</label>
                <?php if (isset($caja)){ ?>
                  <input type="text" class="form-control" value="<?=$caja["codigo"]?>" readonly="">
                  <input type="hidden" name="caja" value="<?=$caja["id"]?>">
                  <input type="hidden" id="monto_compra" value="<?=$caja["montoCompra"]?>">
              <?php } ?>

              </div>
            </div>

            <div class="col-sm-3">
              <div class="form-group">
                <label for="reg-email">Monto Total</label>
                <input id="monto" onblur="F_calculoTotal();" class="form-control" type="number" step="0.01"  name="monto" value="<?php  if(isset($movi)){ echo $movi["monto"]; } ?>" required>
              </div>
            </div>

            <div class="col-sm-3">
              <div class="form-group">
                <label for="reg-email">Ultimo Saldo</label>
                 <input class="form-control" type="text" id="saldo" value="<?php if(isset($caja) && isset($consumido)){ echo (($caja["montoTotal"]+$aumento) - $consumido); } ?>"  readonly>
              </div>
            </div>

            <div class="col-sm-3">
              <div class="form-group">
                <label for="reg-email">Saldo en Caja</label>
                <input class="form-control" type="text" id="saldoFinal" value="<?php if(isset($caja) && isset($consumido) && isset($movi)){ echo (($caja["montoTotal"]+$aumento) - $consumido - $movi["monto"]); } ?>"  readonly>
              </div>
            </div>

            <div class="col-sm-7">
              <div class="form-group">
                <label for="reg-email">Motivo</label>
                <textarea id="motivo" class="form-control" name="motivo" required><?php  if(isset($movi)){ echo $movi["motivo"]; } ?></textarea>
              </div>
            </div>

              <div class="col-sm-5 text-center text-sm-right pt-4">
                <a id="botonregistrar" onclick="F_registrar();" class="btn btn-primary margin-bottom-none" >Editar</a>
                <input id="accionRegi" type="submit" hidden=""/>
                <a class="btn btn-danger margin-bottom-none" href="<?=base_url()?>/cajaChicac/detalleCaja/<?php if(isset($caja)){ echo $caja["id"]; } ?>" >Cancelar</a>
              </div>
            </form>
          </div>
          <div class="col-md-1"></div>
        </div>
      </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        <?php if(isset($movi)){ ?> 
            $("#elpro").val(<?=$movi["proyecto"]?>)
        <?php } ?>
    });
</script>

<script type="text/javascript">

  function dosde(x) {
    return Number.parseFloat(x).toFixed(2);
  }

 function F_calculoTotal(){
  let v_monto = $("#monto").val()*1 || "error";

  if(v_monto == "error"){
    toastr.error('Error Al calcular el monto','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
  }else{
    $("#saldoFinal").val(dosde(($("#saldo").val()*1) - v_monto));
  }

 }
</script>



<script type="text/javascript">
  function F_registrar(){
    let v_elpro = $("#elpro").val();
    let v_fecha = $("#fecha").val();
    let v_origen = $("#origen").val();
    let v_destino = $("#destino").val();
    let v_monto = $("#monto").val()*1 || 0;
    let v_motivo = $("#motivo").val();

    let v_correcto = 0;

    if(v_elpro == ""){
      toastr.error('Error debe seleccionar un Proyecto','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_fecha == ""){
      toastr.error('Error debe registrar la Fecha','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_monto < 0.01){
      toastr.error('Error en el monto de la movilidad','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_origen ==""){
      toastr.error('Error en registrar el origen','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_destino ==""){
      toastr.error('Error en registrar el destino','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_motivo ==""){
      toastr.error('Error en registrar el motivo','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_correcto == 0){
      $("#accionRegi").click();
    }
  
  }

</script>

  <?php if(isset($validation)):?>

    <?php if($validation->getError('origen')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('origen'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>

    <?php if($validation->getError('fecha')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('fecha'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>
    
    <?php if($validation->getError('proyecto')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('proyecto'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>

    <?php if($validation->getError('destino')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('destino'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>

    <?php if($validation->getError('motivo')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('motivo'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>

    <?php if($validation->getError('monto')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('monto'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>
  
  <?php endif; ?>

  <?php if(isset($mensaje)):?>
    <script>
        toastr.error('<?=$mensaje?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
  <?php endif; ?>


<?php
 echo view("residente/footer");
?>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">

    $('#tabla_proye').DataTable({
      
      //para cambiar el lenguaje a español
          "language": {
                  "lengthMenu": "Mostrar _MENU_ registros",
                  "zeroRecords": "No se encontraron resultados",
                  "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                  "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                  "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                  "sSearch": "Buscar:",
                  "oPaginate": {
                      "sFirst": "Primero",
                      "sLast":"Último",
                      "sNext":">>",
                      "sPrevious": "<<"
          },
          "sProcessing":"Procesando...",
              }
      });

</script>

<script type="text/javascript">
  $('#regis_proye').click(function(){

    var base_url2 = '<?php echo base_url(); ?>';
    var v_descrip2 = $('#descrip_proye').val();

    if(v_descrip2 =="" || v_descrip2.length == 0){
      toastr.error('Ingrese el Nombre del Proyecto para agregar','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    }else{

      $.ajax({
        url:base_url2 + '/cajaChicac/agregarProye',
        method: "POST",
        dataType: "json",
        data: {
                para1:v_descrip2
              },
        success:function(resp){
          if(resp.men == "agregado"){
            $('#tabla_proye').DataTable().row.add( [resp.agregado["descripcion"]] ).draw();
            $('#elpro').append($('<option>', {
                value: resp.agregado["id"],
                text: resp.agregado["descripcion"]
            }));
            $('#descrip_proye').val("");
            $('#elpro').val(resp.agregado["id"]);
          }else{
            toastr.error('Error al agregar','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
          }
        }
      });

    }

  });
</script>


</body>
</html>
