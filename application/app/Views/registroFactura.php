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
            <h3 class="margin-bottom-1x">Registro de Comprobante</h3>
            <p>Llene todos los campos con la información requerida.</p>
            <form style="display: flex;justify-content: space-around;" class="row" method="post" action="<?= base_url() ?>/cajaChicac/registrarFactura">

            <div class="col-sm-3">
                <div class="form-group">
                  <label for="reg-email">Tipo de Comprobante:</label>
                  <select class="form-control" name="tipoCmpb" id="tipoCmpb" onchange="F_cambioComision();" required>
                    <option selected value="0">Seleccionar:</option>
                    <option value="1">FACTURA</option>
                    <option value="2">BOLETA DE VENTA</option>
                    <option value="3">RECIBO X HONORARIOS</option>
                    <option value="4">TICKET</option>
                  </select>
                </div>
              </div>
     

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="reg-email">Comprobante:</label>
                  <input class="form-control" autocomplete="off" type="text"  name="factura" id="factura" required>
                </div>
              </div>


              <div class="col-sm-3">
                <div class="form-group">
                  <label for="reg-email">Fecha</label>
                  <input class="form-control" type="date"  name="fecha" value="<?php if(isset($fecha)){ echo $fecha; } ?>"  required>
                </div>
              </div>
              
              <div class="col-sm-4" hidden="">
                <div class="form-group">
                  <label for="reg-phone">Registrado por:</label>
                  <input type="text" name="usuario" value="<?=session('idUsuario')?>" hidden="">
                  <input type="text" class="form-control" value="<?=session('nombre').' '.session('apellido')?>" readonly="">
                </div>
              </div>
                      
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


            <div class="col-sm-2">
                <div class="form-group">
                  <label for="reg-phone">Caja Chica:</label>
                  <?php if (isset($caja)){ ?>
                    <input type="text" class="form-control" value="<?=$caja["codigo"]?>" readonly="">
                    <input type="hidden" name="caja" value="<?=$caja["id"]?>">
                    <input type="hidden" id="monto_compra" value="<?=$caja["montoCompra"]?>">
                <?php } ?>
              </div>
            </div>

            <HR size="5" width="100%" align="center" class="mb-3" style="border-top: 1px solid #c5c5c5;">

              <div class="col-sm-5">
                <div class="form-group">
                  <label for="reg-pass-confirm">Concepto</label>
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
<table class="table table-responsive table-hover" style="border-radius:20px;background-color:#fff;" id="mitabla">
    <thead class="table-primary">
      <tr>
        <th scope="col" WIDTH="400" class="align-middle ">Concepto</th>
        <th scope="col" WIDTH="180" class="align-middle text-center">Cantidad</th>
        <th scope="col" WIDTH="180" class="align-middle text-center">Precio</th>
        <th scope="col" WIDTH="180" class="align-middle text-center">Sub-Total</th>
        <th scope="col" WIDTH="30" colspan="2" class="align-middle text-center">Acción</th>
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

      <!-- INICIO CHECKS IGV -->

      <div class="col-sm-1 check1" hidden></div>

      <div class="col-sm-1 check" hidden></div>

      <div id="div_igv1" class="col-6 col-md-2 text-center pt-2" hidden>
        <div class="form-group form-check">
          <input onclick="F_Checked();" id="igv1" value="1" type="radio" class="form-check-input" id="flexRadioDefault1" checked name="igv">
          <label class="form-check-label" for="flexRadioDefault1"><strong>Sin IGV</strong></label>
        </div>
      </div>

      <div class="col-sm-4 check1" hidden></div>
      <div class="col-sm-1 check1" hidden></div>

      <div class="col-6 col-md-2 text-center pt-2 check" hidden>
        <div class="form-group form-check">
          <input onclick="F_Checked();" id="igv2" value="2" type="radio" class="form-check-input" id="flexRadioDefault1" name="igv">
          <label class="form-check-label" for="flexRadioDefault1"><strong>IGV 18%</strong></label>
        </div>
      </div>

      <div class="col-6 col-md-2 text-center pt-2 check" hidden>
        <div class="form-group form-check">
          <input onclick="F_Checked();" id="igv3" value="3" type="radio" class="form-check-input" id="flexRadioDefault1" name="igv">
          <label class="form-check-label" for="flexRadioDefault1"><strong>IGV 10%</strong></label>
        </div>
      </div>

      <div class="col-sm-1 check" hidden></div>

      <!-- FIN CHECKS IGV -->

      <!-- INICIO CHECKS RETENSIÓN -->

      <div class="col-sm-1 check3" hidden></div>

      <div class="col-6 col-md-3 text-center pt-2 check3" hidden>
        <div class="form-group form-check">
          <input onclick="F_Checked();" id="igv4" value="4" type="radio" class="form-check-input" id="flexRadioDefault1" checked name="igv">
          <label class="form-check-label" for="flexRadioDefault1"><strong>Sin Retensión</strong></label>
        </div>
      </div>

      <div class="col-6 col-md-3 text-center pt-2 check3" hidden>
        <div class="form-group form-check">
          <input onclick="F_Checked();" id="igv5" value="5" type="radio" class="form-check-input" id="flexRadioDefault1" name="igv">
          <label class="form-check-label" for="flexRadioDefault1"><strong>Retensión 8%</strong></label>
        </div>
      </div>

      <div class="col-sm-1 check3" hidden></div>

      <!-- FIN CHECKS RETENSIÓN -->

      <div class="col-sm-8 check2"></div>

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
        <div id="nombreComi" class="form-group text-center align-middle" style="display: flex; align-items: center;">
          IGV:
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
        <input type="hidden" id="resul-total-v2" value="<?php if(isset($detalle) && isset($total)){ echo $total; } ?>">
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
                <a id="botonregistrar" onclick="F_registrar();" class="btn btn-primary margin-bottom-none" >Registrar</a>
                <?php }else{ ?>
                <a id="botonregistrar" disabled class="btn btn-primary margin-bottom-none" >Registrar</a>
              <?php }}else{?>
                <a id="botonregistrar" disabled class="btn btn-primary margin-bottom-none" >Registrar</a>
              <?php } ?>
                <input id="accionRegi" type="submit" hidden=""/>
                <a class="btn btn-danger margin-bottom-none" href="<?=base_url()?>/cajaChicac/cancelarTodoFactura/<?php if(isset($caja)){ echo $caja["id"]; } ?>" >Cancelar</a>
              </div>
            </form>
          </div>
          <div class="col-md-1"></div>
        </div>
      </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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
            $("#resul-total").val(dosde(resp.total*1));
            $("#resul-total-v2").val(dosde(resp.total*1));

            if($("#igv2").prop("checked")){
              $("#resul-sub-total").val(dosde((resp.total/1.18)));
              $("#monto-igv").val(dosde((resp.total/1.18)*0.18));
              $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (resp.total*1)));
            }else if($("#igv3").prop("checked")){
              $("#resul-sub-total").val(dosde((resp.total/1.1)));
              $("#monto-igv").val(dosde((resp.total/1.1)*0.1));
              $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (resp.total*1)));
            }else if($("#igv5").prop("checked")){
              $("#resul-sub-total").val(dosde(resp.total*1));
              $("#monto-igv").val(dosde(resp.total*0.08));
              $("#resul-total").val(dosde((resp.total*1)-(resp.total*0.08)));
              $("#saldoFinal").val(dosde(($("#saldo").val()*1) - ((resp.total*1)-(resp.total*0.08))));
            }else{
              $("#resul-sub-total").val(dosde(resp.total*1));
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
            $("#resul-total").val(dosde(resp.total*1));
            $("#resul-total-v2").val(dosde(resp.total*1));

            if($("#igv2").prop("checked")){
              $("#resul-sub-total").val(dosde((resp.total/1.18)));
              $("#monto-igv").val(dosde((resp.total/1.18)*0.18));
              $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (resp.total*1)));
            }else if($("#igv3").prop("checked")){
              $("#resul-sub-total").val(dosde((resp.total/1.1)));
              $("#monto-igv").val(dosde((resp.total/1.1)*0.1));
              $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (resp.total*1)));
            }else if($("#igv5").prop("checked")){
              $("#resul-sub-total").val(dosde(resp.total*1));
              $("#monto-igv").val(dosde(resp.total*0.08));
              $("#resul-total").val(dosde((resp.total*1)-(resp.total*0.08)));
              $("#saldoFinal").val(dosde(($("#saldo").val()*1) - ((resp.total*1)-(resp.total*0.08))));
            }else{
              $("#resul-sub-total").val(dosde(resp.total*1));
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
                
                $("#resul-total").val(dosde(resp.total*1));
                $("#resul-total-v2").val(dosde(resp.total*1));

                if($("#igv2").prop("checked")){
                  $("#resul-sub-total").val(dosde((resp.total/1.18)));
                  $("#monto-igv").val(dosde((resp.total/1.18)*0.18));
                  $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (resp.total*1)));
                }else if($("#igv3").prop("checked")){
                  $("#resul-sub-total").val(dosde((resp.total/1.1)));
                  $("#monto-igv").val(dosde((resp.total/1.1)*0.1));
                  $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (resp.total*1)));
                }else if($("#igv5").prop("checked")){
                  $("#resul-sub-total").val(dosde(resp.total*1));
                  $("#monto-igv").val(dosde(resp.total*0.08));
                  $("#resul-total").val(dosde((resp.total*1)-(resp.total*0.08)));
                  $("#saldoFinal").val(dosde(($("#saldo").val()*1) - ((resp.total*1)-(resp.total*0.08))));
                }else{
                  $("#resul-sub-total").val(dosde(resp.total*1));
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
                para3:v_precio
              },
        success:function(resp){
          if(resp.men == "agregado"){
            $('#tabla').html("");
            $('#tabla').append(resp.html);
            $("#item").val("");
            $("#cantidad").val("");
            $("#precio").val("");
            $("#item").focus();

            $("#resul-total").val(dosde(resp.total*1));
            $("#resul-total-v2").val(dosde(resp.total*1));

            if($("#igv2").prop("checked")){
              $("#resul-sub-total").val(dosde((resp.total/1.18)));
              $("#monto-igv").val(dosde((resp.total/1.18)*0.18));
              $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (resp.total*1)));
            }else if($("#igv3").prop("checked")){
              $("#resul-sub-total").val(dosde((resp.total/1.1)));
              $("#monto-igv").val(dosde((resp.total/1.1)*0.1));
              $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (resp.total*1)));
            }else if($("#igv5").prop("checked")){
              $("#resul-sub-total").val(dosde(resp.total*1));
              $("#monto-igv").val(dosde(resp.total*0.08));
              $("#resul-total").val(dosde((resp.total*1)-(resp.total*0.08)));
              $("#saldoFinal").val(dosde(($("#saldo").val()*1) - ((resp.total*1)-(resp.total*0.08))));
            }else{
              $("#resul-sub-total").val(dosde(resp.total*1));
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

  function F_cambioComision(){
    let tipocom = $("#tipoCmpb").val()*1;

    //check -- valores de igv
    //check1 -- sin igv que se usa para rxh boleta y factura
    //check2 --bloque de codigo cuando no hayan elegido nada
    //check3 --bloque para retensión en rxh
    
    switch(tipocom){
      // factura
      case 1:
        $(".check").removeAttr("hidden");
        $(".check1").attr("hidden",true);
        $("#div_igv1").removeAttr("hidden");
        $(".check2").attr("hidden",true);
        $(".check3").attr("hidden",true);
        $("#nombreComi").html("IGV:");
        $("#igv1").click();

        setTimeout(() => {
          $("#igv1").click();
        }, 10);
       break;
      //boleta
      case 2:
        $(".check").attr("hidden",true);
        $(".check1").attr("hidden",true);
        $("#div_igv1").attr("hidden",true);
        $(".check2").removeAttr("hidden");
        $(".check3").attr("hidden",true);
        $("#nombreComi").html("IGV:");
        $("#igv1").click();

        setTimeout(() => {
          $("#igv1").click();
        }, 10);

       break;
      //recibo x honorarios
      case 3:
        $(".check").attr("hidden",true);
        $(".check1").attr("hidden",true);
        $("#div_igv1").attr("hidden",true);
        $(".check2").attr("hidden",true);
        $(".check3").removeAttr("hidden");
        $("#nombreComi").html("RETE:");
        $("#igv4").click();

        setTimeout(() => {
          $("#igv4").click();
        }, 10);

       break;
      //ticket
      case 4:
        $(".check").attr("hidden",true);
        $(".check1").attr("hidden",true);
        $("#div_igv1").attr("hidden",true);
        $(".check2").removeAttr("hidden");
        $(".check3").attr("hidden",true);
        $("#nombreComi").html("IGV:");

        $("#igv1").click();

        setTimeout(() => {
          $("#igv1").click();
        }, 10);

       break;
      default:
        $(".check").attr("hidden",true);
        $(".check1").attr("hidden",true);
        $("#div_igv1").attr("hidden",true);
        $(".check2").removeAttr("hidden");
        $(".check3").attr("hidden",true);
        $("#nombreComi").html("IGV:");

        $("#igv1").click();

        setTimeout(() => {
          $("#igv1").click();
        }, 10);

        break;
    }

  }

</script>


<script type="text/javascript">
  function F_Checked(){

    let v_total = $("#resul-total-v2").val();

    if(v_total>0){

      if($("#igv2").prop("checked")){
        $("#resul-sub-total").val(dosde((v_total/1.18)));
        $("#monto-igv").val(dosde((v_total/1.18)*0.18));
        $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (v_total*1)));
        $("#resul-total").val(dosde(v_total*1));
      }else if($("#igv3").prop("checked")){
        $("#resul-sub-total").val(dosde((v_total/1.1)));
        $("#monto-igv").val(dosde((v_total/1.1)*0.1));
        $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (v_total*1)));
        $("#resul-total").val(dosde(v_total*1));
      }else if($("#igv5").prop("checked")){
        $("#resul-sub-total").val(dosde(v_total*1));
        $("#monto-igv").val(dosde(v_total*0.08));
        $("#resul-total").val(dosde((v_total*1)-(v_total*0.08)));
        $("#saldoFinal").val(dosde(($("#saldo").val()*1) - ((v_total*1)-(v_total*0.08))));
      }else{
        $("#resul-sub-total").val(dosde(v_total*1));
        $("#monto-igv").val(0);
        $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (v_total*1)));
        $("#resul-total").val(dosde(v_total*1));
      }

    }else{
      $("#saldoFinal").val(dosde(($("#saldo").val()*1) - (v_total*1)));
      $("#monto-igv").val(0);
      $("#resul-total").val(0);
      $("#resul-sub-total").val(0);
    }


  }
</script>


<script type="text/javascript">
  function F_registrar(){ 
    let v_proveedor = $("#proveedor").val();
    let v_elpro = $("#elpro").val();
    let v_factura = $("#factura").val();
    let v_total = $("#resul-total").val()*1;
    let v_tipo = $("#tipoCmpb").val()*1;
    

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
      toastr.error('Error debe registrar un Comprobante','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_total > v_maxCompra){
      toastr.error('el monto de la compra Excede el límite de la Caja S/'+v_maxCompra,'Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
      v_correcto = 1;
    }

    if(v_tipo == 0){
      toastr.error('Error debe registrar un tipo de Comprobante','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
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


    <?php if($validation->getError('tipoCmpb')!=""):?>
    <script>
      toastr.error('<?php echo $validation->getError('tipoCmpb'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
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
