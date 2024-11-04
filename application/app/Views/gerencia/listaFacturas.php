<?php
 echo view("gerencia/cabecera");
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"/>

    
<div class="modal fade" id="detallecompra" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Detalle de Compra</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <div class="table-responsive shopping-cart mb-0">
              <table class="table">
                <thead>
                  <tr>
                    <th class="text-center text-lg text-medium">N°</th>
                    <th class="text-lg text-left"   width="500">Material</th>
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


<?php
 echo view("gerencia/barraLateralDashboard");
 echo view("gerencia/barraLateralMovilDashboard");
 echo view("gerencia/navbar");
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
                <label>Asigando a:</label>
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
            <a class="nav-link active show" href="#profile" role="tab" data-toggle="tab"><i class="far fa-file-alt"></i> Facturas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#buzz" role="tab" data-toggle="tab"><i class="fas fa-bus-alt"></i> Movilidad</a>
          </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade in active show" id="profile">
            <h2 class="pt-3">Lista de Facturas</h2>
            <table id="peass" class="table table-responsive table-hover" style="border-radius:20px" >
              <thead thead class="thead-inverse">
                <tr>
                  <th width="120">Factura</th>
                  <th class="text-center" width="120">Fecha</th>
                  <th width="300">Proveedor</th>
                  <th width="300">Creador</th>
                  <th width="200">Proyecto</th>
                  <th>Total</th>
                  <th class="text-center">Ver</th>
                </tr>
              </thead>
              <tbody>
                <?php  if (isset($lista)): $a=0;?>
                  <?php foreach ($lista as $row){ $a++;?>
                <tr>
                  <th class="align-middle" witdh="120"><?=$row->factura?></th>
                  <td class="align-middle text-center" witdh="120"><?=$row->fecha?></td>
                  <td class="align-middle" witdh="300"><?=$row->proveedor?></td>
                  <td class="align-middle" witdh="300"><?=$row->usuario?></td>
                  <td class="align-middle" witdh="200"><?=$row->proyecto?></td>
                  <td class="align-middle">S/<?=$row->totalNeto?></td>
                  <td class="align-middle text-right">
                    <a class="btn btn-outline-secondary btn-sm mostrar" valor="<?=$row->id?>" data-toggle="modal" data-target="#detallecompra">
                      <i class="far fa-eye"></i>
                    </a>
                  </td>
                </tr>
                <?php } ?>
                <?php endif?>
              </tbody>
            </table>
          </div>
          <div role="tabpanel" class="tab-pane fade" id="buzz">

            <h2 class="pt-3">Lista de Movilidades</h2>
            <table id="tablita2" class="table table-responsive table-hover" style="border-radius:20px" >
              <thead thead class="thead-inverse">
                <tr>
                  <th class="text-center" width="120">Fecha</th>
                  <th width="200">Creador</th>
                  <th width="200">Origen</th>
                  <th width="200">Destino</th>
                  <th width="200">Proyecto</th>
                  <th width="400">Motivo</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php  if (isset($lista2)): $a=0;?>
                  <?php foreach ($lista2 as $row){ $a++;?>
                <tr>
                  <td class="align-middle text-center" witdh="120"><?=$row->fecha?></td>
                  <td class="align-middle" witdh="200"><?=$row->usuario?></td>
                  <td class="align-middle" witdh="200"><?=$row->origen?></td>
                  <td class="align-middle" witdh="200"><?=$row->destino?></td>
                  <td class="align-middle" witdh="200"><?=$row->proyecto?></td>
                  <td class="align-middle" witdh="200"><?=$row->motivo?></td>
                  <td class="align-middle">S/<?=$row->monto?></td>
                </tr>
                <?php } ?>
                <?php endif?>
              </tbody>
            </table>

          </div>
        </div>
        <!-- Tabs content -->

      </section>



           
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
                $("#totalcant").html(resp.total+" Materiales");
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
                $("#totalcant").html(resp.total+" Materiales");
              }
          });
        });
  });
</script>



<?php
 echo view("gerencia/footer");
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
  });
</script>
  </body>
  </html>
