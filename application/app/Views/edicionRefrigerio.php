<?php
echo view("estructuraDashboard/cabecera");
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
echo view("estructuraDashboard/barraLateralDashboard");
echo view("estructuraDashboard/barraLateralMovilDashboard");
echo view("estructuraDashboard/navbar");
?>

<button id="errorsito" data-toast data-toast-type="danger" data-toast-position="topRight" data-toast-icon="fas fa-times" data-toast-title="Error" data-toast-message="al agregar" hidden="true">
</button>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-2 py-5">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="padding-top-3x hidden-md-up"></div>
            <h3 class="margin-bottom-1x">Edición de Refrigerio</h3>
            <p>Llene todos los campos con la información requerida.</p>
            <form class="row" method="post" action="<?= base_url() ?>/cajaChicac/editarRefrigerio">

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-phone">Editado por:</label>
                  <input type="text" name="usuario" value="<?=session('idUsuario')?>" hidden="">
                  <input type="text" class="form-control" value="<?=session('nombre').' '.session('apellido')?>" readonly="">
                </div>
              </div>

              <div class="col-sm-5 row">
              <div class="col-10" style="padding-right:5px;">
                  <div class="form-group">
                    <label for="reg-phone">Proyecto</label>
                    <select class="form-control" name="proyecto" id="elpro">
                    <option selected value="">Seleccionar:</option>
                    <?php  if (isset($proyectos)): ?>
                      <?php foreach ($proyectos as $row){ ?>
                        <option value="<?=$row->id?>"><?=$row->descripcion?></option>
                    <?php } ?>
                    <?php endif; ?>
                    </select>
                  </div>
              </div>
              <div class="col-2" style="padding-right:0px; padding-left:0px;">
                  <div class="form-group">
                    <label for="reg-fn"></label>
                    <a data-toggle="modal" data-target="#creacion_proye" class="btn btn-success" ><i class="fas fa-plus"></i></a>
                  </div>
                </div>
            </div> 

            
            <div class="col-sm-3">
              <div class="form-group">
                <label for="reg-email">Fecha</label>
                <input id="fecha" class="form-control" type="date"  name="fecha" value="<?php  if(isset($refri)){ echo $refri["fecha"]; } ?>" required>
                <input id="idrefri"  type="hidden"  name="idrefri" value="<?php  if(isset($refri)){ echo $refri["id"]; } ?>">
              </div>
            </div>

            <div class="col-sm-6">
            <div class="form-group">
                  <label for="reg-pass-confirm">Comprobante</label>
                  <input type="hidden" id="comprobante" name="comprobante" value="<?php  if(isset($refri)){ echo $refri["comprobante"]; } ?>" />
                  <input autocomplete="off" class="form-control input-md" type="text" id="cmpb" value="<?php  if(isset($refri)){ echo $refri["factura"]; } ?>"  placeholder="Buscar por N° de comprobante" style="border-radius: 5px">
                  <style type="text/css">
                    .boton-prueba{
                      background-color: #FFF;
                      color: #000;
                      text-decoration: none;
                    }
                    .boton-prueba:hover{
                      background-color: #000;
                      color: #FFF;
                      text-decoration: none;
                    }
                    .boton-pruebali{
                      background-color: #FFF;
                      color: #000;
                      text-decoration: none;
                    }
                    .boton-pruebali:hover{
                      background-color: #000;
                      color: #FFF;
                    }
                  </style>
                  <ul class="list-group" style="display: block;position: absolute;width: 91%;z-index: 2;overflow:hidden;
    height: 150%;">
                  </ul>
                  <div id="localsearchsimple"></div>
                  <div id="detail"></div>
                </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-email">Motivo</label>
                <textarea id="motivo" class="form-control" name="motivo" required><?php  if(isset($refri)){ echo $refri["motivo"]; } ?></textarea>
              </div>
            </div>

            <div class="col-sm-6"></div>

            <div class="col-sm-2">
              <div class="form-group">
                <label for="reg-phone">Caja Chica:</label>
                <?php if (isset($caja)){ ?>
                  <input type="text" class="form-control" value="<?=$caja["codigo"]?>" readonly="">
                  <input type="hidden" id="caja" name="caja" value="<?=$caja["id"]?>">
                  <input type="hidden" id="monto_compra" value="<?=$caja["montoCompra"]?>">
              <?php } ?>

              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                <label for="reg-email">Monto Total</label>
                <input id="monto" class="form-control" type="number"  name="monto" value="<?php  if(isset($refri)){ echo $refri["monto"]; } ?>" required readonly>
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                <label for="reg-email">Ultimo Saldo</label>
                 <input class="form-control" type="text" id="saldo" value="<?php if(isset($caja) && isset($consumido)){ echo (($caja["montoTotal"]+$aumento) - $consumido); } ?>"  readonly>
              </div>
            </div>

              <div class="col-12 text-center text-sm-right pt-4">
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
        <?php if(isset($refri)){ ?> 
            $("#elpro").val(<?=$refri["proyecto"]?>)
        <?php } ?>
    });
</script>



<script type="text/javascript">
  function unir(){
    $(document).on('click', '.compro', function() {
      let valor = $(this).attr("valor");
      let fact = $(this).attr("fact");
      let mont = $(this).attr("mont");
      $("#comprobante").val(valor);
      $("#cmpb").val(fact);
      $("#monto").val(mont);
      $('.list-group').css('display','none');
    });
  }
</script>


<script type="text/javascript">
  $('#cmpb').keyup(function(){
    var base_url = '<?php echo base_url(); ?>';
    var palabra = $('#cmpb').val();
    var idcajita = $("#caja").val();
    var idfacturita = $("#comprobante").val();
    $("#monto").val('');
    $('#detail').html('');
    $('.list-group').css('display','block');
    $('.list-group').css('overflow-y','scroll');
  if(palabra.length >= 1){
    $.ajax({
      url:base_url + '/cajaChicac/buscarComprobante2',
      method: "POST",
      dataType: "json",
      data:{
        palabra :palabra,
        idCaja  :idcajita,
        idFact  :idfacturita
      },
      success:function(resp){
        $('.list-group').html(resp);
      }
    });
  }
  if(palabra.length == 0){
    $('.list-group').css('display','none');
  }
  });
</script>

<script type="text/javascript">

  function dosde(x) {
    return Number.parseFloat(x).toFixed(2);
  }

</script>



<script type="text/javascript">
  function F_registrar(){
    let v_elpro = $("#elpro").val();
    let v_fecha = $("#fecha").val();
    let v_monto = $("#monto").val()*1 || 0;
    let v_motivo = $("#motivo").val();
    let v_cmpb = $("#comprobante").val();

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

    if(v_motivo ==""){
      toastr.error('Error en registrar el motivo','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_cmpb ==""){
      toastr.error('Error en Seleccionar un Comprobante','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_correcto == 0){
      $("#accionRegi").click();
    }
  
  }

</script>

  <?php if(isset($validation)):?>

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

    <?php if($validation->getError('comprobante')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('comprobante'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>
  
  <?php endif; ?>

  <?php if(isset($mensaje)):?>
    <script>
        toastr.error('<?=$mensaje?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
  <?php endif; ?>


<?php
 echo view("estructuraDashboard/footer");
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
