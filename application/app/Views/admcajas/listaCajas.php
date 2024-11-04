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


<div class="modal fade" id="creacion" tabindex="-1">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Crear Nueva Caja Chica</h4>
            <button id="cerr" class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">

            <div class="col-md-12">
                <form class="row" method="post" action="<?=base_url()?>/cajaChicac/nuevaCaja">
    
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Código:</label>
                      <input class="form-control" type="text" name="cod" value="" readonly>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Fecha de Apertura:</label>
                      <input class="form-control" type="text" value="<?php if(isset($fecha)){ echo $fecha;} ?>" readonly>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Creado por:</label>
                      <input class="form-control" type="text" value="<?php echo session('nombre').' '.session('apellido');?>" readonly>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="reg-email">Asignado a:</label>
                      <select id="asig" class="form-control" name="asig" onchange="F_buscarSaldo();" required>
                        <option value="noselecciono" selected>Seleccionar:</option>
                      <?php if(isset($usuarioAsig)){
                        foreach ($usuarioAsig as $valor) {?>
                          <option  value="<?=$valor->id?>" tip="<?=$valor->tipousuario?>"><?php echo $valor->nombre.' '.$valor->apellido; ?></option>
                      <?php }} ?>
                      </select>
                    </div>
                  </div>

                  <div id="siresi" class="col-12 row d-none">
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

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Monto Apertura:</label>
                      <input autocomplete="off" id="montoTotal" class="form-control" type="number" step="0.01" name="montoTotal" required>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Monto x Compra:</label>
                      <input autocomplete="off" id="montoCompra" class="form-control" type="number" step="0.01" name="montoCompra" required>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Último saldo:</label>
                      <input type="text" id="ultSaldo" class="form-control" name="ultSaldo" value="0" readonly>
                      <input type="hidden" id="cajaUltSaldo" name="cajaUltSaldo" value="">
                    </div>
                  </div>

                  <div class="col-sm-12 row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 text-center">
                      <input type="submit" class="btn btn-success" value="REGISTRAR">
                    </div>
                    <div class="col-sm-4 "></div>
                  </div>
                  
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="edicion" tabindex="-1">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar Caja Chica</h4>
            <button id="cerr" class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">

            <div class="col-md-12">
                <form class="row" method="post" action="<?=base_url()?>/cajaChicac/editarCaja">
    
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Código:</label>
                      <input class="form-control" type="text" id="e-cod" value="" readonly>
                      <input class="form-control" type="hidden" id="e-id" name="idCaja" value="">
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Fecha de Apertura:</label>
                      <input class="form-control" type="text" id="e-fecape" readonly>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Creado por:</label>
                      <input class="form-control" type="text" id="e-creador" readonly>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Asignado a:</label>
                      <input class="form-control" type="text" id="e-asignado" readonly>
                    </div>
                  </div>

                  <div id="div-proyecto" class="col-sm-12 d-none">
                    <div class="form-group">
                      <label>Proyecto:</label>
                      <input class="form-control" type="text" id="e-proyecto" readonly>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Monto Apertura:</label>
                      <input autocomplete="off" id="e-montoTotal" class="form-control" type="text" value="0"  readonly>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Monto x Compra:</label>
                      <input autocomplete="off" id="e-montoCompra" class="form-control" type="number" step="0.01" name="montoCompra" required>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label>Último saldo:</label>
                      <input id="e-ultSaldo" class="form-control" value="0" name="ultSaldo" readonly>
                    </div>
                  </div>


                  <div class="col-sm-12 row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 text-center">
                      <input type="submit" class="btn btn-primary" value="EDITAR">
                    </div>
                    <div class="col-sm-4 "></div>
                  </div>
                  
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="cerrar" tabindex="-1">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Confirmar cerrado de Caja</h4>
            <button id="cerr" class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form method="post" action="<?= base_url() ?>/cajaChicac/cerrarCaja">
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-1"></div>
              <div class="col-sm-10">
                <div class="form-group">
                  <p class="text-center" id="cerra_men">¿Desea cerrar la caja?</p>
                  <input type="hidden" name="idcajace" id="idcajace" value="" />
                </div>
              </div>
              <div class="col-sm-1"></div>

              <div class="col-sm-1"></div>
              <div class="col-sm-10 row" id="cuerpocerra">
              </div>
              <div class="col-sm-1"></div>

              <div class="col-sm-2"></div>
              <div class="col-sm-8 text-center">
                <input type="submit" class="btn btn-success" value="CERRAR" />
                <a class="btn btn-danger close" type="button" data-dismiss="modal" aria-label="Close">CANCELAR</a>
              </div>
              <div class="col-sm-2"></div>
              
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="aumentar" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Aumentar Caja</h4>
            <button id="cerr" class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="row">

              <div class="col-sm-3">
                <div class="form-group">
                  <label>Fecha:</label>
                  <input id="cajaAumento" class="form-control" type="hidden">
                  <input id="fechaAumento" class="form-control" type="date">
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label>Monto S/:</label>
                  <input id="montoAumento" class="form-control" type="number" step="0.01">
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label>Origen:</label>
                  <select id="cbo_origen" class="form-control" required>
                    <option value="0" selected>Seleccionar:</option>
                    <option value="1" >Transferencia</option>
                    <option value="2" >Efectivo</option>
                    <option value="3" >Cheque</option>
                  </select>
                </div>
              </div>

              <div class="col-sm-3">
                <div class="form-group">
                  <label>Observación:</label>
                  <textarea id="observacion" class="form-control"  required></textarea>
                </div>
              </div>


              <div class="col-12 table-responsive shopping-cart mb-0">
              <table class="table">
                <thead>
                  <tr>
                    <th class="text-center" width="100">Fecha</th>
                    <th class="text-center" width="100">Monto S/</th>
                    <th class="text-center" width="200">Observación</th>
                    <th class="text-center" width="10">Eliminar</th>
                  </tr>
                </thead>
                <tbody id="cuerpo-aumento">
                  <tr>
                  <td colspan="3">
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
            <hr class="mb-5 pb-5">

              <div class="col-sm-2"></div>
              <div class="col-sm-8 text-center">
                <a href="#" class="btn btn-success" onclick="F_aumentar();">Aumentar</a>
                <a class="btn btn-danger close" type="button" data-dismiss="modal" aria-label="Close">CANCELAR</a>
              </div>
              <div class="col-sm-2"></div>

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
      <section class="container padding-top-1x padding-bottom-1x">
          <h2>Lista de Cajas
            <a onclick="F_formatear();" class="btn btn-success" data-toggle="modal" data-target="#creacion"><i class="fas fa-plus"></i></a>
          </h2>
        
       <?php if(isset($usuarios)){ ?>
        <form class="row py-2" method="post" action="<?= base_url() ?>/cajaChicac/filtrar">

            <div class="col-sm-3"></div>
            <div class="col-sm-5">
              <div class="form-group">
                <label for="reg-phone">Buscar por Usuario:</label>
                <select id="filusuario" class="form-control" name="filusuario">
                  <option value="" selected>Todos los usuarios</option>
                <?php foreach ($usuarios as $valor) {?>
                    <option value="<?=$valor->id?>"><?php echo $valor->nombre.' '.$valor->apellido; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                  <label for="reg-pass-confirm"></label>
                  <input class="btn btn-primary form-control" type="submit" value="Filtrar">
                </div>
              </div>
              <div class="col-sm-2"></div>
        </form>
        <?php } ?>

        <div class="row d-flex justify-content-center" id="productos">
          <?php  if (isset($lista)){ ?>
            <?php foreach ($lista as $row){ ?>
                <div class="col-lg-4 margin-bottom-1x" >
                  <div class="card text-center">
                    <div class="card-body py-2 d-block" style="height:120px;">
                      <div class="row">
                        <div class="col-2">
                          <div class="dropdown text-left">
                            <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="<?=base_url()?>/cajaChicac/detalleCaja/<?=$row->id?>">Revisar</a>
                              
                              <?php if($row->estado == "Abierta" && session("tipo")==11){ ?>
                                <a class="editar dropdown-item" data-toggle="modal" data-target="#edicion" href="" valor="<?=$row->id?>" >Editar</a>
                                <a class="aumentar dropdown-item" data-toggle="modal" data-target="#aumentar" href="" valor="<?=$row->id?>" >Aumentar</a>
                                <a class="cerrar dropdown-item" data-toggle="modal" data-target="#cerrar" href="" valor="<?=$row->id?>">Cerrar</a>
                              <?php }elseif($row->estado == "Cerrada" && session("tipo")==11){?>
                                <a class="dropdown-item" href="<?=base_url()?>/cajaChicac/excelCaja/<?=$row->id?>"><i class="far fa-file-excel"></i> Reporte</a>
                              <?php }?>

                              <?php if(session("tipo")==11){ ?>
                                <a class="dropdown-item" href="<?=base_url()?>/cajaChicac/excelDetalladoCaja/<?=$row->id?>"><i class="far fa-file-excel"></i> Exportar</a>
                              <?php } ?>
                              
                            </div>
                          </div>
                        </div>

                        <div class="col-3 py-2">
                          <h1 class="display-4 card-title"><i class="fas fa-cash-register"></i>&nbsp;</h1>
                        </div>

                        <div class="col-7 text-left">
                          <p><strong>N°   :</strong> <?=$row->codigo?><br>
                            <strong>Asign:</strong>  <?=$row->asignado_card?><br>
                            <strong>Fecha:</strong>  <?=$row->fecha_apertura?></p>
                        </div>
                        <div class="col-sm-12 text-center">
                          <?php if($row->estado == "Abierta"){ ?>
                            <h4 class="text-success"><?=$row->estado?></h4>
                          <?php }else{ ?>
                            <h4 class="text-danger"><?=$row->estado?></h4>
                          <?php } ?>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
              
                <?php } ?>
            <?php }else{ ?>
                <div style="padding:200px"></div>
            <?php } ?>
        </div>
      </section>

      <!-- Pagination-->
      <nav nav class="pagination text-center pb-3" style="justify-content: space-around;">
        <div class="column">
          <ul class="pages" id="pages">
          </ul>
        </div>
      </nav>

    <script>
      function dosde(x) {
        return Number.parseFloat(x).toFixed(2);
      }
    </script>
    

    <script>
      function F_eliminarAumento(par1,par2){
        var base_url_el = '<?php echo base_url(); ?>';
        $("#cuerpo-aumento").html('');
          $.ajax({
            type: 'POST',
            url: base_url_el + '/cajaChicac/eliminarAumento',
            data: {para1: par1,para2:par2 },
            dataType: "json",
            success: function(resp){
              $("#cuerpo-aumento").html(resp.html);
            }
          }); 
          
      }
    </script>

      <script>

<?php  if(isset($pagi)):?>
    //Nuevo Script para la paginación
    const ul = document.getElementById("pages");
    let allPages = <?php echo $pagi; ?>;

    function elem(allPages, page){
        let li = '';

        let beforePages = page - 1;
        let afterPages = page + 1;
        let liActive;

        if(page > 1){
          li += `<li class="btn" onclick="elem(allPages, ${page-1})" ><i class="fas fa-angle-left"></i></li>`;
        }

        for (let pageLength = beforePages; pageLength <= afterPages; pageLength++){
            if(pageLength > allPages){ continue; }
            if(pageLength == 0){  pageLength = pageLength + 1;  }
            if(page == pageLength){  
              liActive = 'active';
            }else{
              liActive = '';
            }

            li += `<li class="m-1 ${liActive}" onclick="elem(allPages, ${pageLength})" ><a href="#">${pageLength}</a></li>`
        }

        if(page < allPages){
          li += `<li class="btn" onclick="elem(allPages, ${page+1})" ><i class="fas fa-angle-right"></i></li>`;
        }

        ul.innerHTML = li;

       let base_url = '<?php echo base_url(); ?>';

       let fil = "";

        <?php if(isset($fil)){ ?>
          fil = <?=$fil?>
        <?php } ?>

        $.ajax({
            type: 'POST',
            url: base_url + '/cajaChicac/pagina',
            data: {pag: page, filtro: fil},
            dataType: "json",
            success: function(resp){          
              $("#productos").html(resp.html);
            }
        });
    }
    elem(allPages, 1);
  <?php endif; ?>

    </script>


    
    <?php if(isset($fil)){ ?>
    <script>
      $("#filusuario").val(<?=$fil?>);
    </script>
    <?php } ?>

      <script>
      $(document).on('click', ".editar", function() {
        var base_url = '<?php echo base_url(); ?>';
        var vari = $(this).attr("valor");
        $.ajax({
            type: 'POST',
            url: base_url + '/cajaChicac/editCaja',
            data: {id: vari },
            dataType: "json",
            success: function(resp){
              $("#e-cod").val(resp.caja["codigo"]);
              $("#e-id").val(resp.caja["id"]);
              $("#e-fecape").val(resp.caja["fecha_apertura"]);
              $("#e-creador").val(resp.caja["creado"]);
              $("#e-asignado").val(resp.caja["asignado"]);
              $("#e-montoTotal").val("S/"+(resp.caja["montoTotal"]-resp.caja["ultsaldo"]));
              $("#e-montoCompra").val(resp.caja["montoCompra"]);
              $("#e-ultSaldo").val("S/"+resp.caja["ultsaldo"]);
              if(resp.caja["proyecto"] != 0){
                  $("#div-proyecto").removeClass("d-none");
                  $("#e-proyecto").val(resp.caja["nombreProyecto"]);
                }else{
                  $("#div-proyecto").addClass("d-none");
                }
              
            }
        });
      });

      $(document).ready(function(){
        var base_url = '<?php echo base_url(); ?>';
        $(".editar").click(function(){
          var vari = $(this).attr("valor");
          $.ajax({
              type: 'POST',
              url: base_url + '/cajaChicac/editCaja',
              data: {id: vari },
              dataType: "json",
              success: function(resp){
                $("#e-cod").val(resp.caja["codigo"]);
                $("#e-id").val(resp.caja["id"]);
                $("#e-fecape").val(resp.caja["fecha_apertura"]);
                $("#e-creador").val(resp.caja["creado"]);
                $("#e-asignado").val(resp.caja["asignado"]);
                $("#e-montoTotal").val("S/"+(resp.caja["montoTotal"]-resp.caja["ultsaldo"]));
                $("#e-montoCompra").val(resp.caja["montoCompra"]);
                $("#e-ultSaldo").val("S/"+resp.caja["ultsaldo"]);
                if(resp.caja["proyecto"] != null){
                  $("#div-proyecto").removeClass("d-none");
                  $("#e-proyecto").val(resp.caja["nombreProyecto"]);
                }else{
                  $("#div-proyecto").addClass("d-none");
                }
              }
          });   
        });
      });
      </script>

      <script>
        $(document).on('click', ".cerrar", function() {
          var base_url = '<?php echo base_url(); ?>';
          var vari = $(this).attr("valor");
          $("#e-cerrar").attr("href",base_url+"/cajaChicac/cerrarCaja/"+vari);
        });

        $(document).ready(function(){
          var base_url = '<?php echo base_url(); ?>';
          $(".cerrar").click(function(){
            var vari = $(this).attr("valor");
            $("#e-cerrar").attr("href",base_url+"/cajaChicac/cerrarCaja/"+vari);
          });
        });
      </script>

      <script>
        $(document).ready(function(){
          var base_url = '<?php echo base_url(); ?>';
          $(".cerrar").click(function(){
            var vari = $(this).attr("valor");
              $.ajax({
                  type: 'POST',
                  url: base_url + '/cajaChicac/mensajeCerrar',
                  data: {id: vari },
                  dataType: "json",
                  success: function(resp){
                    $("#cerra_men").html("<strong>"+resp.data+"</strong>");
                    $("#cuerpocerra").html(resp.opci);
                  }
              });

              $("#idcajace").val(vari);

          });
        });

        $(document).on('click', ".cerrar", function() {
          var base_url = '<?php echo base_url(); ?>';
          var vari = $(this).attr("valor");
            $.ajax({
                type: 'POST',
                url: base_url + '/cajaChicac/mensajeCerrar',
                data: {id: vari },
                dataType: "json",
                success: function(resp){
                  $("#cerra_men").html("<strong>"+resp.data+"</strong>");
                  $("#cuerpocerra").html(resp.opci);
                }
            });

          $("#idcajace").val(vari);

        });
      </script>

<script>
      $(document).on('click', ".aumentar", function() {
        var base_url = '<?php echo base_url(); ?>';
        var vari = $(this).attr("valor");
        $("#cuerpo-aumento").html('');
        $.ajax({
            type: 'POST',
            url: base_url + '/cajaChicac/aumentoCaja',
            data: {id: vari },
            dataType: "json",
            success: function(resp){
              $("#cuerpo-aumento").html(resp.html);
              $("#fechaAumento").val(resp.fecha);
              $("#cajaAumento").val(resp.caja);
              $("#montoAumento").val("");
            }
        });
      });

      $(document).ready(function(){
        var base_url = '<?php echo base_url(); ?>';
        $("#cuerpo-aumento").html('');
        $(".aumentar").click(function(){
          var vari = $(this).attr("valor");
          $.ajax({
            type: 'POST',
            url: base_url + '/cajaChicac/aumentoCaja',
            data: {id: vari },
            dataType: "json",
            success: function(resp){
              $("#cuerpo-aumento").html(resp.html);
              $("#fechaAumento").val(resp.fecha);
              $("#cajaAumento").val(resp.caja);
              $("#montoAumento").val("");
            }
          }); 
        });
      });
      </script>


      <script>
        function F_buscarSaldo(){
          var base_url = '<?php echo base_url(); ?>';

          let v_id = $("#asig").val();
          
          if(v_id != "" || v_id.length > 0){

            $.ajax({
              type: 'POST',
              url: base_url + '/cajaChicac/buscarSaldo',
              data: {id: v_id },
              dataType: "json",
              success: function(resp){
                $("#ultSaldo").val(dosde(resp.saldo));
                $("#cajaUltSaldo").val(resp.idcaja);
              }
          });

          }else{
            $("#ultSaldo").val(0);
          }

          let select = document.getElementById('asig');
          let index = select.selectedIndex;
          let v_tip = (select.options[index].getAttribute("tip")) || 0;

          if(v_tip == 8){
            $("#siresi").removeClass("d-none");
          }else{
            $("#siresi").addClass("d-none");
            $("#elpro").val($("#elpro first:option").val());
          }
          
        }
      </script>



      <script>
        function F_aumentar(){
          let v_fecA = $("#fechaAumento").val();
          let v_monA = $("#montoAumento").val();
          let v_cajA = $("#cajaAumento").val();
          let v_oriA = $("#cbo_origen").val();
          let v_obsA = $("#observacion").val();

          let v_correcto = 0;

          if(v_fecA == ""  || v_fecA.length == 0){
            toastr.error('Error falta la Fecha','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
            v_correcto = 1;
            $("#fechaAumento").focus();
          }

          if(v_monA <=0 || v_monA==""){
            toastr.error('Error no se registro correctamente el monto','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
            v_correcto = 1;
            $("#montoAumento").focus();
          }

          if(v_oriA == 0 || v_oriA==""){
            toastr.error('Error no se selecciono correctamente el origen','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
            v_correcto = 1;
            $("#cbo_origen").val(0);
          }

          if(v_obsA == ""  || v_obsA.length == 0){
            toastr.error('Error falta la observación','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
            v_correcto = 1;
            $("#observacion").focus();
          }

          if(v_correcto == 0){
            var base_url3 = '<?php echo base_url(); ?>';
            $.ajax({
              url:base_url3 + '/cajaChicac/aumentarCajachica',
              method: "POST",
              dataType: "json",
              data: {
                      para1:v_fecA,
                      para2:v_monA,
                      para3:v_cajA,
                      para4:v_oriA,
                      para5:v_obsA
                    },
              success:function(resp){

                if(resp.mensaje == ""){
                  $("#cuerpo-aumento").html(resp.html);
                  $("#montoAumento").val("");
                  $("#cbo_origen").val(0);
                  $("#observacion").val("");

                }else{
                  toastr.error(resp.mensaje,'Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
                }

              }
            });

          }
        }
      </script>

      <script>
        function F_formatear(){
          $("#asig").val($("#asig option:first").val());
          $("#montoTotal").val("");
          $("#montoCompra").val("");
          $("#siresi").addClass("d-none");
          $("#ultSaldo").val("");
        }
      </script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <?php if(isset($validation)):?>
        <?php if($validation->getError('asig')!=""):?>
          <script>
            toastr.error('<?php echo $validation->getError('asig'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
          </script>
        <?php endif; ?>

        <?php if($validation->getError('montoTotal')!=""):?>
          <script>
            toastr.error('<?php echo $validation->getError('montoTotal'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
          </script>
        <?php endif; ?>

        <?php if($validation->getError('montoCompra')!=""):?>
          <script>
            toastr.error('<?php echo $validation->getError('montoCompra'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
          </script>
        <?php endif; ?>
    
      <?php endif; ?>

      <?php if(isset($mensaje)):?>
        <script>
          toastr.error('<?php echo $mensaje; ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
        </script>
      <?php endif; ?>


<?php
 echo view("admcajas/footer");
?>

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
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
