<?php
echo view("admcajas/cabecera");
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

<div class="modal fade" id="creacion_prove" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Crear Proveedor</h4>
          <button id="cerr" class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-12 row">

                <div class="col-sm-4">
                  <div class="form-group">
                    <label>DNI o RUC:</label>
                    <input class="form-control" type="number" id="dniruc" placeholder="DNI o RUC">
                  </div>
                </div>

                <div class="col-sm-8">
                  <div class="form-group">
                    <label>Razón Social o Nombre:</label>
                    <input class="form-control" type="text" id="descrip_prove">
                  </div>
                </div>

                <div class="col-sm-4"></div>
                <div class="col-sm-4 text-center">
                  <a  class="btn btn-success" id="regis_prove">REGISTRAR</a>
                </div>
                <div class="col-sm-4 "></div>
            </div>

            <div class="col-12 pt-3">

              <table id="tabla_prove" class="table table-responsive table-hover" style="border-radius:20px; width:100%;" >
                <thead class="table-primary">
                  <tr>
                    <th width="200">DNI o RUC</th>
                    <th width="500">Razón Social o Nombre</th>
                    <th>Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                  <td colspan="3">
                    <div class="row">
                      <div class="col-sm-4"></div>
                      <div class="col-sm-4">
                        <img class="" src="<?=base_url()?>/plantilla/img/cargando.gif" alt="loading" />
                      </div>
                      <div class="col-sm-4"></div>
                    </div>
                  </td>
                </tbody>
              </table>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


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
echo view("admcajas/barraLateralDashboard");
echo view("admcajas/barraLateralMovilDashboard");
echo view("admcajas/navbar");
?>

<button id="errorsito" data-toast data-toast-type="danger" data-toast-position="topRight" data-toast-icon="fas fa-times" data-toast-title="Error" data-toast-message="al agregar" hidden="true">
</button>
      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-2 py-5">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="padding-top-3x hidden-md-up"></div>
            <h3 class="margin-bottom-1x">Edición de Factura</h3>
            <p>Llene todos los campos con la información requerida.</p>
            <form class="row" method="post" action="<?= base_url() ?>/cajaChicac/editarFactura">

              <div class="col-sm-5 row">
                <div class="col-10" style="padding-right:5px;">
                  <div class="form-group">
                    <label for="reg-fn">Proveedor</label>
                    <select class="form-control" data-show-subtext="true" data-live-search="true" name="proveedor" id="proveedor" required>
                    <option selected value="">Seleccionar:</option>
                    <?php  if (isset($proveedores)): ?>
                      <?php foreach ($proveedores as $row){ ?>
                        <option value="<?=$row->id?>"><?=$row->descripcion?></option>
                    <?php } ?>
                    <?php endif; ?>
                    </select>
                  </div>
                </div>  
                <div class="col-2" style="padding-right:0px; padding-left:0px;">
                  <div class="form-group">
                  <label for="reg-fn"></label>
                    <a data-toggle="modal" data-target="#creacion_prove" class="btn btn-success" ><i class="fas fa-plus"></i></a>
                  </div>
                </div>
              </div>
     

              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-email">Factura:</label>
                  <input class="form-control" autocomplete="off" type="text"  name="factura" id="factura" value="<?php  if(isset($factura)){ echo $factura["factura"]; } ?>">
                  <input type="hidden"  name="idfactura" id="idfactura" value="<?php  if(isset($factura)){ echo $factura["id"]; } ?>">
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="reg-email">Fecha</label>
                  <input class="form-control" type="text"  name="fecha" value="<?php  if(isset($factura)){ echo $factura["fecha"]; } ?>"  readonly>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-phone">Registrado por:</label>
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
                  <label for="reg-phone">Caja Chica:</label>
                  <?php if (isset($caja)){ ?>
                    <input type="text" class="form-control" value="<?=$caja["codigo"]?>" readonly="">
                    <input type="hidden" name="caja" value="<?=$caja["id"]?>">
                    <input type="hidden" id="monto_compra" value="<?=$caja["montoCompra"]?>">
                <?php } ?>

                </div>
              </div>

              <HR size="5" width="100%" align="center" class="mb-3">

              <div class="col-sm-5">
                <div class="form-group">
                  <label for="reg-pass-confirm">Material o Equipo</label>
                  <input autocomplete="off"  class="form-control input-md" type="text" id="item" name="material" placeholder="Escriba la descripción">
                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                  <label for="reg-pass-confirm">Cantidad</label>
                  <input autocomplete="off" class="form-control input-md" type="number" id="cantidad" name="material" placeholder="0">
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label for="reg-pass-confirm">Precio</label>
                  <input autocomplete="off" class="form-control input-md" type="number" step="0.01" id="precio" name="material" placeholder="0.00">
                </div>
              </div>

              <div class="col-sm-2">
                <div class="form-group">
                  <label for="reg-pass-confirm"></label>
                  <a href="#" class="btn btn-success form-control" id="agregado">Agregar</a>
                </div>
              </div>
<table class="table table-responsive table-hover" style="border-radius:20px;" id="mitabla">
    <thead class="table-primary">
      <tr>
        <th scope="col" WIDTH="400" class="align-middle ">Material o Equipo</th>
        <th scope="col" WIDTH="180" class="align-middle text-center">Cantidad</th>
        <th scope="col" WIDTH="180" class="align-middle text-center">Precio</th>
        <th scope="col" WIDTH="180" class="align-middle text-center">Sub-Total</th>
        <th scope="col" WIDTH="30"  class="align-middle text-center">Acción</th>
      </tr>
    </thead>
  <tbody id="tabla">
    <?php  if (isset($detalle)): ?>
      <?php foreach ($detalle as $row){ ?>
      <tr>
        <th scope="row" class="align-middle">
          <div style="width: max-content;"><input size="35" id="itemN<?=$row->id?>" type="text" class="form-control" value="<?=$row->item?>" onblur="F_editItem(<?=$row->id?>);" required="" /></div>
        </th>
        <td class="align-middle">
          <div style="width: max-content;"><input size="10" id="itemC<?=$row->id?>" type="text" class="form-control" value="<?=$row->cantidad?>" onblur="F_editCant(<?=$row->id?>);" required="" /></div>
        </td>
        <td class="align-middle">
          <div style="width: max-content;"><input size="10" id="itemP<?=$row->id?>" type="text" class="form-control" value="<?=$row->precio?>" onblur="F_editPrecio(<?=$row->id?>);" required="" /></div>
        </td>
        <td class="align-middle text-center"><span id="itemS<?=$row->id?>"><?=$row->precio*$row->cantidad?></span></td>
        <td class="align-middle text-right">
            <a onclick="F_eliminarDetalle(<?=$row->id?>);" title="eliminar detalle" class="eliminar btn btn-sm btn-outline-danger"><i class="fas fa-minus-circle"></i></a>
        </td>
      </tr>
      <?php } ?>
    <?php endif; ?>
  </tbody>
</table>

<div class="col-sm-3"></div>
<div class="col-sm-5 text-center pt-2">
  <div class="form-group form-check">
    <input id="igv" onclick="F_Checked();" value="1" type="checkbox" class="form-check-input" id="exampleCheck1" checked="" name="igv">
    <label class="form-check-label" for="exampleCheck1"><strong>Incluye IGV</strong></label>
  </div>
</div>
<div class="col-sm-1 text-right align-middle" style="display: flex; align-items: center;">
  <div class="form-group text-center align-middle" style="display: flex; align-items: center;">
    SUB-TOTAL:
  </div>
</div>
<div class="col-sm-3">
  <div class="form-group">
    <input class="form-control" type="text" id="resul-sub-total" value="<?php if(isset($detalle) && isset($total)){ echo $total; } ?>"  readonly>
  </div>
</div>

<div class="col-sm-8"></div>
<div class="col-sm-1 text-right align-middle" style="display: flex; align-items: center;">
  <div class="form-group text-center align-middle" style="display: flex; align-items: center;">
    IGV (18%):
  </div>
</div>
<div class="col-sm-3">
  <div class="form-group">
    <input class="form-control" type="text" id="monto-igv" value="0"  readonly>
  </div>
</div>

<div class="col-sm-8"></div>
<div class="col-sm-1 text-right align-middle" style="display: flex; align-items: center;">
  <div class="form-group text-center align-middle" style="display: flex; align-items: center;">
     TOTAL:
  </div>
</div>
<div class="col-sm-3">
  <div class="form-group">
    <input class="form-control" type="text" id="resul-total" name="total" value="<?php if(isset($detalle) && isset($total)){ echo $total; } ?>"  readonly>
  </div>
</div>

<div class="col-sm-8"></div>
<div class="col-sm-1 text-right align-middle" style="display: flex; align-items: center;">
  <div class="form-group text-center align-middle" style="display: flex; align-items: center;">
    ÚLTIMO SALDO:
  </div>
</div>
<div class="col-sm-3">
  <div class="form-group">
    <input class="form-control" type="text" id="saldo" value="<?php if(isset($detalle) && isset($caja) && isset($consumido)){ echo (($caja["montoTotal"]+$aumento) - $consumido); } ?>"  readonly>
  </div>
</div>

<div class="col-sm-8"></div>
<div class="col-sm-1 text-right align-middle" style="display: flex; align-items: center;">
  <div class="form-group text-center align-middle" style="display: flex; align-items: center;">
    SALDO CAJA:
  </div>
</div>
<div class="col-sm-3">
  <div class="form-group">
    <input class="form-control" type="text" id="saldoFinal"  value="<?php if(isset($detalle) && isset($total) && isset($caja) && isset($consumido)){ echo (($caja["montoTotal"]+$aumento) - $consumido - $total); } ?>"  readonly>
  </div>
</div>

              <div class="col-12 text-center text-sm-right">
                <?php if(isset($detalle)){ if (count($detalle)!=0){ ?>
                <a id="botonregistrar" onclick="F_registrar();" class="btn btn-primary margin-bottom-none" >Editar</a>
                <?php }else{ ?>
                <a id="botonregistrar" disabled class="btn btn-primary margin-bottom-none" >Editar</a>
              <?php }}else{?>
                <a id="botonregistrar" disabled class="btn btn-primary margin-bottom-none" >Editar</a>
              <?php } ?>
                <input id="accionRegi" type="submit" hidden=""/>
                <a class="btn btn-danger margin-bottom-none" href="<?=base_url()?>/cajaChicac/cancelarEditFactura/<?php if(isset($factura)){ echo $factura["caja"]; } ?>" >Cancelar</a>
              </div>
            </form>
          </div>
          <div class="col-md-1"></div>
        </div>
      </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>




<script type="text/javascript">
    $(document).ready(function() {
        <?php if(isset($factura)){ ?> 
            $("#proveedor").val(<?=$factura["proveedor"]?>);
            $("#elpro").val(<?=$factura["proyecto"]?>);
            let siigv = <?php if($factura["igv"]!=""){ echo $factura["igv"];}else{ echo 0;} ?>;
            if(siigv == 0){
              $("#igv").click();
            }
        <?php } ?>
    });
</script>

<script type="text/javascript">
  function F_editItem(e){
    let v_itemN = $("#itemN"+e).val();
    var base_url = '<?php echo base_url(); ?>';

    let v_correcto = 0;

    if(v_itemN == ""  || v_itemN.length == 0){
      toastr.error('Error falta nombre de ITEM','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_correcto ==0){
      $.ajax({
        type: 'POST',
        url: base_url + '/cajaChicac/cambiarNombre',
        data: {
                para1 : e,
                para2 : v_itemN
              },
        dataType: "json",
        success: function(resp){
          if(resp.men=="correcto"){
            toastr.success('Actualizado','Notificación',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}); 
          }else{
            toastr.error('Error','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
          }
        },
        error:function(resp) {
          toastr.error('Error','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
        }
      });

    }
  }
</script>

<script type="text/javascript">
  function F_editCant(e){
    let v_itemC = $("#itemC"+e).val();
    let v_itemP = $("#itemP"+e).val();
    var base_url = '<?php echo base_url(); ?>';

    let v_correcto = 0;

    if(v_itemC == ""  || v_itemC.length == 0 || v_itemC <=0){
      toastr.error('Error en la Cantidad','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_correcto ==0){
      $.ajax({
        type: 'POST',
        url: base_url + '/cajaChicac/cambiarCantidad',
        data: {
                para1 : e,
                para2 : v_itemC
              },
        dataType: "json",
        success: function(resp){
          if(resp.men=="correcto"){
            toastr.success('Actualizado','Notificación',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}); 
            $("#itemS"+e).html(dosde(v_itemC*v_itemP));
            $("#resul-sub-total").val(dosde(resp.total*1));
            if($("#igv").prop("checked") == false){
              $("#resul-total").val(dosde((resp.total*1)+(resp.total*0.18)));
              $("#monto-igv").val(dosde(resp.total*0.18));
              $("#saldoFinal").val(dosde(($("#saldo").val()*1) - ((resp.total*1)+(resp.total*0.18))));
              $("#igv").val(0);
            }else{
              $("#igv").val(1);
              $("#monto-igv").val(0);
              $("#resul-total").val($("#resul-sub-total").val());
              $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (resp.total*1)));
            }

          }else{
            toastr.error('Error','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
          }
        },
        error:function(resp) {
          toastr.error('Error','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
        }
      });

    }
  }
</script>

<script type="text/javascript">
  function F_editPrecio(e){
    let v_itemC = $("#itemC"+e).val();
    let v_itemP = $("#itemP"+e).val();
    var base_url = '<?php echo base_url(); ?>';

    let v_correcto = 0;

    if(v_itemP == ""  || v_itemP.length == 0 || v_itemP <=0){
      toastr.error('Error en el Precio','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_correcto ==0){
      $.ajax({
        type: 'POST',
        url: base_url + '/cajaChicac/cambiarPrecio',
        data: {
                para1 : e,
                para2 : v_itemP
              },
        dataType: "json",
        success: function(resp){
          if(resp.men=="correcto"){
            toastr.success('Actualizado','Notificación',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}); 
            $("#itemS"+e).html(dosde(v_itemC*v_itemP));
            $("#resul-sub-total").val(dosde(resp.total*1));
            if($("#igv").prop("checked") == false){
              $("#resul-total").val(dosde((resp.total*1)+(resp.total*0.18)));
              $("#monto-igv").val(dosde(resp.total*0.18));
              $("#saldoFinal").val(dosde(($("#saldo").val()*1) - ((resp.total*1)+(resp.total*0.18))));
              $("#igv").val(0);
            }else{
              $("#igv").val(1);
              $("#monto-igv").val(0);
              $("#resul-total").val($("#resul-sub-total").val());
              $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (resp.total*1)));
            }

          }else{
            toastr.error('Error','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
          }
        },
        error:function(resp) {
          toastr.error('Error','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
        }
      });

    }
  }
</script>

<script type="text/javascript">

  $(document).on('click', '.eliminar', function(event) {
    event.preventDefault();
    $(this).closest('tr').remove();
  });

  function dosde(x) {
    return Number.parseFloat(x).toFixed(2);
  }

  function F_eliminarDetalle(e){
    var base_url = '<?php echo base_url(); ?>';
    $.ajax({
            type: 'POST',
            url: base_url + '/cajaChicac/eliminarDetalleFactura',
            data: {id: e },
            dataType: "json",
            success: function(resp){
              if(resp.men=="correcto"){
                
                $("#resul-sub-total").val(dosde(resp.total*1));

                if($("#igv").prop("checked") == false){
                  $("#resul-total").val(dosde((resp.total*1)+(resp.total*0.18)));
                  $("#monto-igv").val(dosde(resp.total*0.18));
                  $("#saldoFinal").val(dosde(($("#saldo").val()*1) - ((resp.total*1)+(resp.total*0.18))));
                  $("#igv").val(0);
                }else{
                  $("#igv").val(1);
                  $("#monto-igv").val(0);
                  $("#resul-total").val($("#resul-sub-total").val());
                  $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (resp.total*1)));
                }

                
                if((resp.total*1)==0){
                  $("#botonregistrar").attr("disabled",true);
                  $("#botonregistrar").removeAttr("onclick");
                }
              }
            },
            error:function(resp) {
              alert("Error");
            }
        });
        
  }
</script>

<script type="text/javascript">
  $('#agregado').click(function(){ 
    let v_item = $("#item").val();
    let v_cantidad = $("#cantidad").val();
    let v_precio = $("#precio").val();
    let v_idFactura = $("#idfactura").val();

    let v_correcto = 0;

    if(v_item == ""  || v_item.length == 0){
      toastr.error('Error falta nombre de ITEM','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
      $("#item").focus();
    }

    if(v_cantidad <=0 || v_cantidad==""){
      toastr.error('Error no se registro correctamente la Cantidad','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
      $("#cantidad").focus();
    }

    if(v_precio <=0 || v_precio==""){
      toastr.error('Error no se registro correctamente el precio','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
      $("#precio").focus();
    }

    if(v_correcto == 0){
      var base_url3 = '<?php echo base_url(); ?>';
      $.ajax({
        url:base_url3 + '/cajaChicac/agregarDetalleFactura',
        method: "POST",
        dataType: "json",
        data: {
                para1:v_item,
                para2:v_cantidad,
                para3:v_precio,
                para4:v_idFactura
              },
        success:function(resp){
          if(resp.men == "agregado"){
            $('#tabla').html("");
            $('#tabla').append(resp.html);
            $("#item").val("");
            $("#cantidad").val("");
            $("#precio").val("");
            $("#item").focus();
            $("#resul-sub-total").val(dosde(resp.total*1));

            if($("#igv").prop("checked") == false){
              $("#resul-total").val(dosde((resp.total*1)+(resp.total*0.18)));
              $("#monto-igv").val(dosde(resp.total*0.18));
              $("#saldoFinal").val(dosde(($("#saldo").val()*1) - ((resp.total*1)+(resp.total*0.18))));
              $("#igv").val(0);
            }else{
              $("#igv").val(1);
              $("#monto-igv").val(0);
              $("#resul-total").val($("#resul-sub-total").val());
              $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (resp.total*1)));
            }

            $("#botonregistrar").removeAttr("disabled");
            $("#botonregistrar").attr("onclick","F_registrar();");

          }else{
            toastr.error('Error al agregar','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
          }
        }
      });

    }

  });
</script>


<script type="text/javascript">
  function F_Checked(){
    if ($("#igv").prop("checked")) {
      $("#igv").val("1");
    }else{
      $("#igv").val("0");
    }

    let v_check = $("#igv").val();
    let v_total = $("#resul-sub-total").val();

    if(v_check == 0 && v_total>0){
      $("#monto-igv").val(dosde(v_total*0.18));
      $("#resul-total").val(dosde((v_total*1)+(v_total*0.18)));
      $("#saldoFinal").val(dosde(($("#saldo").val()*1) - ((v_total*1)+(v_total*0.18))));
    }else{
      $("#igv").prop("checked");
      $("#igv").val("1");
      $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (v_total*1)));
      $("#monto-igv").val(0);
      $("#resul-total").val(v_total);
    }
    
  }
</script>


<script type="text/javascript">
  function F_registrar(){
    let v_proveedor = $("#proveedor").val();
    let v_elpro = $("#elpro").val();
    let v_factura = $("#factura").val();
    let v_total = $("#resul-total").val()*1;
    

    let v_maxCompra = $("#monto_compra").val()*1;

    let v_correcto = 0;

    if(v_proveedor == 0){
      toastr.error('Error debe seleccionar un Proveedor','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_elpro == ""){
      toastr.error('Error debe seleccionar un Proyecto','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_factura == ""){
      toastr.error('Error debe registrar un Documento o Factura','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_total > v_maxCompra){
      toastr.error('el monto de la compra Excede el límite de la Caja S/'+v_maxCompra,'Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_correcto == 0){
      $("#accionRegi").click();
    }
  
  }

</script>

  <?php if(isset($validation)):?>

    <?php if($validation->getError('proveedor')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('proveedor'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>

    <?php if($validation->getError('total')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('total'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>
    
    <?php if($validation->getError('proyecto')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('proyecto'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>

    <?php if($validation->getError('factura')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('factura'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
    <?php endif; ?>
  
  <?php endif; ?>

  <?php if(isset($mensaje)):?>
    <script>
        toastr.error('<?=$mensaje?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
  <?php endif; ?>

<?php
 echo view("admcajas/footer");
?>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    let base_url = '<?php echo base_url(); ?>';
    $('#tabla_prove').DataTable({
    //para cambiar el lenguaje a español
        "order": [],
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
            },
        "ajax": {
          url: base_url+"/cajaChicac/traerProveedores"
        },
        columns: [
          { "data" : "dniRuc"},
          { "data" : "descripcion"},
          { 
            "data" : "id",
            render: function (data, type) {
              return '<button id="botonborrafila" class="eliminar" hidden=""></button><a href="#" onclick="F_EliminaProve('+data+')" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>';
            }
          }
        ],
        autoWidth: false
    });


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

  });

</script>

<script type="text/javascript">

function volverTabla(){
      let base_url = '<?php echo base_url(); ?>';
      $("#tabla_prove").dataTable().fnDestroy();
      $('#tabla_prove').DataTable({
      //para cambiar el lenguaje a español
          "order": [],
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
              },
          "ajax": {
            url: base_url+"/cajaChicac/traerProveedores"
          },
          columns: [
            { "data" : "dniRuc"},
            { "data" : "descripcion"},
            { 
              "data" : "id",
              render: function (data, type) {
                return '<button id="botonborrafila" class="eliminar" hidden=""></button><a href="#" onclick="F_EliminaProve('+data+')" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>';
              }
            }
          ],
          autoWidth: false
      });
    }
  
  $('#regis_prove').click(function(){

    var base_url = '<?php echo base_url(); ?>';
    var v_dniruc = $('#dniruc').val();
    var v_descrip = $('#descrip_prove').val();

    if(v_descrip =="" || v_descrip.length == 0){
      toastr.error('Ingrese la Descripción para agregar','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    }else{

      $.ajax({
        url:base_url + '/cajaChicac/agregarProve',
        method: "POST",
        dataType: "json",
        data: {
                para1:v_dniruc,
                para2:v_descrip
              },


             
        success:function(resp){
          if(resp.men == "agregado"){
            volverTabla();
            $('#proveedor').append($('<option>', {
                value: resp.agregado["id"],
                text: resp.agregado["descripcion"]
            }));
            $('#dniruc').val("");
            $('#descrip_prove').val("");
            $('#proveedor').val(resp.agregado["id"]);
          }else{
            toastr.error('Error al agregar','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
          }
        }
      });

    }

  });

  function F_EliminaProve(par1){
    var base_url2 = '<?php echo base_url(); ?>';

    $.ajax({
        type: 'POST',
        url: base_url2 + '/cajaChicac/eliminarProve',
        data: {
                para1 : par1
              },
        dataType: "json",
        success: function(resp){
          if(resp.men=="eliminado"){
            toastr.success('Eliminado Correctamente','Notificación',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-center","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"}); 
            volverTabla();
            $("#proveedor option[value='"+resp.idElim+"']").remove();
          }else{
            toastr.error('Error','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-center","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
          }
        },
        error:function(resp) {
          toastr.error('Error','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-center","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
        }
      });
      
  }


  $('#regis_proye').click(function(){

    var base_url2 = '<?php echo base_url(); ?>';
    var v_descrip2 = $('#descrip_proye').val();

    if(v_descrip2 =="" || v_descrip2.length == 0){
      toastr.error('Ingrese el Nombre del Proyecto para agregar','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
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
            toastr.error('Error al agregar','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
          }
        }
      });

    }

  });
</script>


</body>
</html>
