<?php
 echo view("estructuraDashboard/cabecera");
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"/>

<div class="modal fade" id="detallecompra" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Detalle de Comprobante</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <div class="table-responsive shopping-cart mb-0">
              <table class="table">
                <thead>
                  <tr>
                    <th class="text-center text-lg text-medium">N°</th>
                    <th class="text-lg text-left"   width="500">Concepto</th>
                    <th class="text-center text-lg text-medium" width="200">Cantidad</th>
                    <th class="text-center text-lg text-medium" width="200">Precio</th>
                    <th class="text-center text-lg text-medium" width="300">Sub-Total</th>
                  </tr>
                </thead>
                <tbody id="cuerpodetalle">
                  <tr>
                  <td colspan="5">
                  <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                      <img class="" src="<?=base_url()?>/plantilla/img/cargando.gif" alt="loading" />
                    </div>
                    <div class="col-sm-4"></div>
                  </div>
                </td>
                </tr>
                </tbody>
              </table>
            </div>
            <hr class="mb-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-2">
              <div class="text-lg px-2 py-1">Total: <span class="text-medium" id="totalcant">sin dato</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>


    
    <div class="modal fade" id="mdl_eliminarFactura" tabindex="-1">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Confirmar Eliminación de Comprobante</h4>
            <button id="cerr" class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
        <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <div class="form-group">
              <p class="text-center">¿Desea eliminar el comprobante?, <br><strong style="color:red;">Se eliminará la movilidad o el refrigerio asociado también!</strong></p>
            </div>
          </div>
          <div class="col-sm-2"></div>

          <div class="col-sm-2"></div>
          <form class="col-sm-8 text-center" method="POST" action="<?= base_url() ?>/cajaChicac/eliminarFactura">
            <input type="hidden" id="idelimcaja" name="idelimcaja" value="" />
            <input type="hidden" id="idelimfactura" name="idelimfactura" value="" />
            <div>
              <input type="submit" class="btn btn-danger" value="ELIMINAR"/>
              <a class="btn btn-secondary close" type="button" data-dismiss="modal" aria-label="Close">CANCELAR</a>
            </div>

          </form>
        
          <div class="col-sm-2"></div>
        </div>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="mdl_eliminarMovilidad" tabindex="-1">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Confirmar Eliminación de Movilidad</h4>
            <button id="cerr" class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
        <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <div class="form-group">
              <p class="text-center">¿Desea eliminar la Movilidad?</p>
            </div>
          </div>
          <div class="col-sm-2"></div>

          <div class="col-sm-2"></div>
          <form class="col-sm-8 text-center" method="POST" action="<?= base_url() ?>/cajaChicac/eliminarMovilidad">
            <input type="hidden" id="idelimcaja2" name="idelimcaja2" value="" />
            <input type="hidden" id="idelimmovilidad" name="idelimmovilidad" value="" />
            <div>
              <input type="submit" class="btn btn-danger" value="ELIMINAR"/>
              <a class="btn btn-secondary close" type="button" data-dismiss="modal" aria-label="Close">CANCELAR</a>
            </div>

          </form>
        
          <div class="col-sm-2"></div>
        </div>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="mdl_eliminarRefrigerio" tabindex="-1">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Confirmar Eliminación de Refrigerio</h4>
            <button id="cerr" class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
        <div class="row">
          <div class="col-sm-2"></div>
          <div class="col-sm-8">
            <div class="form-group">
              <p class="text-center">¿Desea eliminar el Refrigerio?</p>
            </div>
          </div>
          <div class="col-sm-2"></div>

          <div class="col-sm-2"></div>
          <form class="col-sm-8 text-center" method="POST" action="<?= base_url() ?>/cajaChicac/eliminarRefrigerio">
            <input type="hidden" id="idelimcaja3" name="idelimcaja3" value="" />
            <input type="hidden" id="idelimrefrigerio" name="idelimrefrigerio" value="" />
            <div>
              <input type="submit" class="btn btn-danger" value="ELIMINAR"/>
              <a class="btn btn-secondary close" type="button" data-dismiss="modal" aria-label="Close">CANCELAR</a>
            </div>

          </form>
        
          <div class="col-sm-2"></div>
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
      <section class="container padding-top-3x padding-bottom-3x">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Caja N°: <?php if(isset($caja["codigo"])){ echo $caja["codigo"];} ?></h1>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                <label>Fecha de Apertura:</label>
                <input class="form-control" type="text" value="<?php if(isset($caja["fecha_apertura"])){ echo $caja["fecha_apertura"];} ?>" readonly>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                <label>Fecha de Cierre:</label>
                <input class="form-control" type="text" value="<?php if(isset($caja["fecha_cierre"])){ echo $caja["fecha_cierre"];} ?>" readonly>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                <label>Estado:</label>
                <input class="form-control" type="text" value="<?php if(isset($caja["estado"])){ echo $caja["estado"];} ?>" readonly>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="form-group">
                <label>Creado por:</label>
                <input class="form-control" type="text" value="<?php if(isset($caja["creado"])){ echo $caja["creado"];} ?>" readonly>
                </div>
            </div>

            <div class="col-sm-5">
                <div class="form-group">
                <label>Asignado a:</label>
                <input class="form-control" type="text" value="<?php if(isset($caja["asignado"])){ echo $caja["asignado"];} ?>" readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                <label>Monto por Compra:</label>
                <input class="form-control" type="text" value="<?php if(isset($caja["montoCompra"])){ echo "S/".$caja["montoCompra"];} ?>" readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                <label>Monto Inicial:</label>
                <input id="montoTotal" class="form-control" type="text" value="<?php if(isset($caja)){ echo "S/".($caja["montoTotal"]-$caja["ultsaldo"]);} ?>" readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                <label>Último Saldo:</label>
                <input class="form-control" type="text" value="<?php if(isset($caja)){ echo "S/".$caja["ultsaldo"];} ?>" readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                <label>Aumentos Caja:</label>
                <input class="form-control" type="text" value="<?php if(isset($aumento)){ echo "S/".$aumento;} ?>" readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                <label>Monto Total:</label>
                <input id="montoCompra" class="form-control" type="text" value="<?php if(isset($aumento) && isset($caja)){ echo "S/".($caja["montoTotal"]+ $aumento);} ?>" readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                <label>Monto Consumido:</label>
                <input id="montoCompra" class="form-control" type="text" value="<?php if(isset($consumido)){ echo "S/".$consumido;} ?>" readonly>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="form-group">
                <label>Saldo:</label>
                <input id="montoCompra" class="form-control" type="text" value="<?php if(isset($aumento) && isset($consumido) && isset($caja)){ echo "S/".(($caja["montoTotal"]+$aumento)-$consumido);} ?>" readonly>
                </div>
            </div>

        </div>


        <ul class="nav nav-tabs pt-3" role="tablist">
          <li class="nav-item">
            <a class="nav-link active show" href="#profile" role="tab" data-toggle="tab"><i class="far fa-file-alt"></i> Comprobantes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#buzz" role="tab" data-toggle="tab"><i class="fas fa-bus-alt"></i> Movilidad</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#buzz2" role="tab" data-toggle="tab"><i class="fas fa-utensils"></i> Refrigerio</a>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" style="background-color: #ffffff;">
          <div role="tabpanel" class="tab-pane fade in active show" id="profile">

            <h2 class="pt-3">
              Lista de Comprobantes
              <?php 
              if(isset($caja["caja_estado"])){ 
                if($caja["caja_estado"]==0){ 
              ?>
                <a href="<?=base_url()?>/cajaChicac/nuevaFactura/<?=$caja["id"]?>" class="btn btn-success" ><i class="fas fa-plus"></i></a>
              <?php 
                }
              } 
              ?>
            </h2>
            <table id="peass" class="table table-responsive table-hover" style="border-radius:20px" >
              <thead thead class="thead-inverse">
                <tr>
                  <th width="120">Tipo de Comprobante</th>
                  <th width="300">Comprobante</th>
                  <th class="text-center" width="150">Fecha</th>
                  <th width="200">Proveedor</th>
                  <th width="200">Proyecto</th>
                  <th>Total</th>
                  <th class="text-center">Ver</th>
                  <?php  if(isset($caja["caja_estado"])){ if($caja["caja_estado"]==0){ ?>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Eliminar</th>
                  <?php } } ?>
                </tr>
              </thead>
              <tbody>
                <?php  if (isset($lista)): $a=0;?>
                  <?php foreach ($lista as $row){?>
                <tr>
                  <th class="align-middle" witdh="120"><?=$row->tipoCmpb?></th>
                  <th class="align-middle" witdh="300"><?=$row->factura?></th>
                  <td class="align-middle text-center" witdh="150"><?=$row->fecha?></td>
                  <td class="align-middle" witdh="200"><?=$row->proveedor?></td>
                  <td class="align-middle" witdh="200"><?=$row->proyecto?></td>
                  <td class="align-middle">S/<?=$row->totalNeto?></td>
                  <td class="align-middle text-center">
                    <a class="btn btn-outline-secondary btn-sm mostrar" valor="<?=$row->id?>" data-toggle="modal" data-target="#detallecompra">
                      <i class="far fa-eye"></i>
                    </a>
                  </td>
                  <?php  if(isset($caja["caja_estado"])){ if($caja["caja_estado"]==0){ ?>
                    <td class="align-middle text-center">
                      <a class="btn btn-outline-primary btn-sm" href="<?=base_url()?>/cajaChicac/editFactura/<?=$row->id?>" >
                        <i class="far fa-edit"></i>
                      </a>
                    </td>   
                    
                    <td class="align-middle text-center">
                      <a class="btn btn-outline-danger btn-sm elimfactu" data-toggle="modal" data-target="#mdl_eliminarFactura" href="" cajaid="<?=$caja["id"]?>" facturaid="<?=$row->id?>">
                        <i class="fas fa-trash"></i>
                      </a>
                    </td> 
                  <?php } } ?>
                </tr>
                <?php } ?>
                <?php endif?>
              </tbody>
            </table>

          </div>

          <div role="tabpanel" class="tab-pane fade" id="buzz">

            <h2 class="pt-3">
              Lista de Movilidades
              <?php 
              if(isset($caja["caja_estado"])){ 
                if($caja["caja_estado"]==0){ 
              ?>
                <a href="<?=base_url()?>/cajaChicac/nuevaMovilidad/<?=$caja["id"]?>" class="btn btn-success" ><i class="fas fa-plus"></i></a>
              <?php 
                }
              } 
              ?>
            </h2>
            <table id="tablita2" class="table table-responsive table-hover" style="border-radius:20px" >
              <thead thead class="thead-inverse">
                <tr>
                  <th class="text-center" width="200">Fecha</th>
                  <th width="200">Comprobante</th>
                  <th width="200">Origen</th>
                  <th width="200">Destino</th>
                  <th width="200">Proyecto</th>
                  <th width="400">Motivo</th>
                  <th>Total</th>
                  <?php  if(isset($caja["caja_estado"])){ if($caja["caja_estado"]==0){ ?>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Eliminar</th>
                  <?php } } ?>
                </tr>
              </thead>
              <tbody>
                <?php  if (isset($lista2)): $a=0;?>
                  <?php foreach ($lista2 as $row){?>
                <tr>
                  <td class="align-middle text-center" witdh="200"><?=$row->fecha?></td>
                  <td class="align-middle" witdh="200"><?=$row->comprobante?></td>
                  <td class="align-middle" witdh="200"><?=$row->origen?></td>
                  <td class="align-middle" witdh="200"><?=$row->destino?></td>
                  <td class="align-middle" witdh="200"><?=$row->proyecto?></td>
                  <td class="align-middle" witdh="200"><?=$row->motivo?></td>
                  <td class="align-middle">S/<?=$row->monto?></td>
                  <?php  if(isset($caja["caja_estado"])){ if($caja["caja_estado"]==0){ ?>
                    <td class="align-middle text-center">
                      <a class="btn btn-outline-primary btn-sm" href="<?=base_url()?>/cajaChicac/editMovilidad/<?=$row->id?>" >
                        <i class="far fa-edit"></i>
                      </a>
                    </td>  

                    <td class="align-middle text-center">
                      <a class="btn btn-outline-danger btn-sm elimMovi" data-toggle="modal" data-target="#mdl_eliminarMovilidad" href="" cajaid="<?=$caja["id"]?>" movilid="<?=$row->id?>">
                        <i class="fas fa-trash"></i>
                      </a>
                    </td> 
                  <?php } } ?>
                </tr>
                <?php } ?>
                <?php endif?>
              </tbody>
            </table>

          </div>

          <div role="tabpanel" class="tab-pane fade" id="buzz2">

            <h2 class="pt-3">
              Lista de Refrigerios
              <?php 
              if(isset($caja["caja_estado"])){ 
                if($caja["caja_estado"]==0){ 
              ?>
                <a href="<?=base_url()?>/cajaChicac/nuevoRefrigerio/<?=$caja["id"]?>" class="btn btn-success" ><i class="fas fa-plus"></i></a>
              <?php 
                }
              } 
              ?>
            </h2>
            <table id="tablita3" class="table table-responsive table-hover" style="border-radius:20px" >
              <thead thead class="thead-inverse">
                <tr>
                  <th class="text-center" width="200">Fecha</th>
                  <th width="300">Comprobante</th>
                  <th width="300">Proyecto</th>
                  <th width="400">Motivo</th>
                  <th>Total</th>
                  <?php  if(isset($caja["caja_estado"])){ if($caja["caja_estado"]==0){ ?>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Eliminar</th>
                  <?php } } ?>
                </tr>
              </thead>
              <tbody>
                <?php  if (isset($lista3)): $a=0;?>
                  <?php foreach ($lista3 as $row){?>
                <tr>
                  <td class="align-middle text-center" witdh="200"><?=$row->fecha?></td>
                  <td class="align-middle" witdh="300"><?=$row->comprobante?></td>
                  <td class="align-middle" witdh="300"><?=$row->proyecto?></td>
                  <td class="align-middle" witdh="400"><?=$row->motivo?></td>
                  <td class="align-middle">S/<?=$row->monto?></td>
                  <?php  if(isset($caja["caja_estado"])){ if($caja["caja_estado"]==0){ ?>
                    <td class="align-middle text-center">
                      <a class="btn btn-outline-primary btn-sm" href="<?=base_url()?>/cajaChicac/editRefrigerio/<?=$row->id?>" >
                        <i class="far fa-edit"></i>
                      </a>
                    </td>  

                    <td class="align-middle text-center">
                      <a class="btn btn-outline-danger btn-sm elimRefri" data-toggle="modal" data-target="#mdl_eliminarRefrigerio" href="" cajaid="<?=$caja["id"]?>" refrid="<?=$row->id?>">
                        <i class="fas fa-trash"></i>
                      </a>
                    </td> 
                  <?php } } ?>
                </tr>
                <?php } ?>
                <?php endif?>
              </tbody>
            </table>

          </div>

        </div>
        <!-- Tabs content -->

      </section>



<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
  $(document).on('click', '.elimfactu', function(event) {
    let cajaid = $(this).attr('cajaid');
    let facturaid = $(this).attr('facturaid');
    
    $("#idelimcaja").val(cajaid);
    $("#idelimfactura").val(facturaid);
  });
</script>


<script type="text/javascript">
  $(document).on('click', '.elimMovi', function(event) {
    let cajaid = $(this).attr('cajaid');
    let movilid = $(this).attr('movilid');
    
    $("#idelimcaja2").val(cajaid);
    $("#idelimmovilidad").val(movilid);
  });
</script>

<script type="text/javascript">
  $(document).on('click', '.elimRefri', function(event) {
    let cajaid = $(this).attr('cajaid');
    let refrid = $(this).attr('refrid');
    
    $("#idelimcaja3").val(cajaid);
    $("#idelimrefrigerio").val(refrid);
  });
</script>

<?php if(isset($mensaje)):?>
    <script>
        toastr.success('<?=$mensaje?>','Notificación',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "5000","extendedTimeOut": "5000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
    </script>
  <?php endif; ?>

<script type="text/javascript">
  $(document).on('click', ".mostrar", function() {
    var base_url = '<?=base_url()?>';
      var vari = $(this).attr("valor");
          $.ajax({
              type: 'POST',
              url: base_url + '/cajaChicac/mostrarDetalleFactura',
              data: {id: vari },
              dataType: "json",
              success: function(resp){
                $("#cuerpodetalle").html(resp.cuerpo);
                $("#totalcant").html(resp.total+" Conceptos");
              }
          });
  });

  $(document).ready(function(){
      var base_url = '<?=base_url()?>';
        $(".mostrar").click(function(){
          var vari = $(this).attr("valor");
          $.ajax({
              type: 'POST',
              url: base_url + '/cajaChicac/mostrarDetalleFactura',
              data: {id: vari },
              dataType: "json",
              success: function(resp){
                $("#cuerpodetalle").html(resp.cuerpo);
                $("#totalcant").html(resp.total+" Conceptos");
              }
          });
        });
  });
</script>

<?php
 echo view("estructuraDashboard/footer");
?>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#peass').DataTable({
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
        },
        "order": []
    });

    $('#tablita2').DataTable({
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
        },
        "order": []
    });

    $('#tablita3').DataTable({
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
        },
        "order": []
    });

  });
</script>
  </body>
  </html>
