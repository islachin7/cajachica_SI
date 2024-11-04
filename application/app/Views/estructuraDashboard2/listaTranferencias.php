<?php
echo view("estructuraDashboard2/cabecera");
?>

<div class="modal fade" id="comentarios" tabindex="-1" style="overflow-y: scroll;">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Comentarios</h4>
          <button id="cerr" class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">

        <div class="row">
            <div class="col-sm-9">
              <div class="form-group">
                <label for="reg-email">Nuevo Comentario:</label>
                <textarea class="form-control" id="nueaaaa" required></textarea>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="reg-email"></label>
              <a class="form-control btn btn-success" id="agregarcomen"><h3 class="text-light py-2"><i class="fas fa-check"></i></h3></a>
              </div>
            </div>
            <div class="col-sm-12 py-3 row" id="cuerpocomentarios">

      </div>

        </div>
        </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="detalletransferencia" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detalle de Solicitud de Transferencia</h4>
          <button id="cerrarmodel" class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-4"><a class="btn btn-secondary" id="btncomentarios" data-toggle="modal" data-target="#comentarios"><i class="fas fa-comments"></i></a></div>
            <div class="col-sm-3"><input type="text" id="elditransferencia" hidden readonly value=""  ></div>
            <div class="col-sm-5">
              <div class="form-group input-group py-2">
                <input class="form-control" type="text" placeholder="código o nombre" id="materialn" required><span class="input-group-addon"><i class="fas fa-search"></i></span>
              </div>
            </div>
          </div>
          <div class="table-responsive shopping-cart mb-0">
            <table class="table">
              <thead>
                <tr>
                  <th class="text-center text-lg text-medium">N°</th>
                  <th class="text-center text-lg text-medium">Código</th>
                  <th class="text-center text-lg text-medium" >Material</th>
                  <th class="text-center text-lg text-medium">Cantidad Requerida</th>
                  <th class="text-center text-lg text-medium">Cantidad Transferida</th>
                  <th class="text-center text-lg text-medium">Saldo</th>
                  <th class="text-center text-lg text-medium">Estado</th>
                </tr>
              </thead>
              <tbody id="cuerpodetalle">
                <tr>
                <td colspan="7">
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
            <div class="text-lg px-2 py-1">Total: <span class="text-medium" id="totalcant">Cargando..</span></div>

          </div>
        </div>
      </div>
    </div>
  </div>



<?php
echo view("estructuraDashboard2/barraLateralDashboard");
?>
<?php
echo view("estructuraDashboard2/barraLateralMovilDashboard");
?>
<?php
echo view("estructuraDashboard2/navbar");
?>
    <section class="container padding-top-3x padding-bottom-3x">
      <h2>Lista de Solicitudes de Transferencias</h2>
      <a class="btn btn-outline-success" href="<?= base_url() ?>/dashboard/nuevaTranferencia">Nuevo</a>

      <form class="row py-2" method="post" action="<?= base_url() ?>/dashboard/filtrar2">
        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12"></div>

        <div class="col-sm-1 text-center align-middle" style="display: flex; align-items: center;">
          <div class="form-group text-center align-middle text-bold" style="display: flex; align-items: center;">
            FILTROS:
          </div>
        </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="reg-phone">Fecha Inicio:</label>
              <input class="form-control" type="date" name="fechaIni">
            </div>
          </div>
          <div class="col-sm-1 col-xs-1 col-1 d-flex align-items-center">
            <div class="form-group">
              <label for="reg-ln"></label>
              <i class="fas fa-arrow-right form-control align-middle d-flex align-items-center text-sm-center text-xs-center"></i>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="form-group">
              <label for="reg-phone">Fecha Fin:</label>
              <input class="form-control" type="date" name="fechaFin">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label for="reg-phone">Estado Transferencia:</label>
              <select class="form-control" name="estadito">
                <option selected value="">Seleccionar:</option>
                <option  value="pendiente">Pendiente</option>
                <option  value="cerrada">Cerrada</option>
                <option  value="cerrada Parcialmente">cerrada Parcialmente</option>
                <option  value="en trámite">En Trámite</option>
                <option  value="rechazada">Rechazada</option>
              </select>
            </div>
          </div>
          <div class="col-sm-2">
              <div class="form-group">
                <label for="reg-pass-confirm"></label>
                <input class="btn btn-outline-primary form-control" type="submit" value="Filtrar">
              </div>
            </div>
      </form>

      <script>
      /*
        $(document).ready(function(){
          $("#jajajsjsjs").click(function(){
            alert($("#fechitape").val());
          });
        });
        */
      </script>

      <div class="table-responsive">
            <table class="table">
              <thead class="thead-inverse">
                <tr>
                  <th>N°</th>
                  <th class="text-center"># Solicitud de Transferencia</th>
                  <th class="text-center" >Fecha</th>
                  <th>Origen</th>
                  <th>Destino</th>
                  <th>Tipo de Transferencia</th>
                  <th>Responsable</th>
                  <th>Estado</th>
                  <th class="text-center">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php  if (isset($lista)): $a=0;?>
                  <?php foreach ($lista as $row){ $a++;?>
                <tr>
                  <th class="align-middle"><?php echo $a; ?></th>
                  <th class="align-middle text-center"># <?php echo $row->id; ?></th>
                  <td class="align-middle text-center" WIDTH="150" ><?php echo $row->fecha; ?></td>
                  <td class="align-middle"><?php echo $row->origen; ?></td>
                  <td class="align-middle"><?php echo $row->destino; ?></td>
                  <td class="align-middle"><?php echo $row->tipoTransferencia; ?></td>
                  <td class="align-middle"><?php echo $row->usuario; ?></td>
                  <?php if($row->estadoTransferencia=="pendiente"){ ?>
                    <th class="align-middle text-center h5 text-dark"><?php echo $row->estadoTransferencia; ?></th>
                  <?php }elseif($row->estadoTransferencia=="rechazada"){ ?>
                    <th class="align-middle text-center h5 text-danger"><?php echo $row->estadoTransferencia; ?></th>
                  <?php }elseif($row->estadoTransferencia=="cerrada"){ ?>
                    <th class="align-middle text-center h5 text-success"><?php echo $row->estadoTransferencia; ?></th>
                  <?php }elseif($row->estadoTransferencia=="cerrada Parcialmente"){ ?>
                    <th class="align-middle text-center h5 text-success"><?php echo $row->estadoTransferencia; ?></th>
                  <?php }else{ ?>
                    <th class="align-middle text-center h5 text-primary"><?php echo $row->estadoTransferencia; ?></th>
                  <?php } ?>


                  <td class="align-middle text-right"><a class="btn btn-outline-secondary" id="mostrar<?=$row->id?>" valor="<?=$row->id?>" data-toggle="modal" data-target="#detalletransferencia">
                    <i class="far fa-eye"></i>
                  </a></td>
                </tr>
                <?php } ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
    </section>

    <script>
    $(document).ready(function(){
      var base_url = '<?php echo base_url(); ?>';
      $("#btncomentarios").click(function(){
      var transfeid = $("#elditransferencia").val();
      $("#cerrarmodel").click();
            $.ajax({
                type: 'POST',
                url: base_url + '/dashboard/comentarios',
                data: {transferen:transfeid },
                dataType: "json",
                success: function(resp){
                  $("#cuerpocomentarios").html(resp);
                  $("#nueaaaa").focus();
                },
                error:function(resp) {

                }
            });

          });
      });

    </script>

    <script>
    $(document).ready(function(){
      var base_url = '<?php echo base_url(); ?>';
      $("#agregarcomen").click(function(){
      var transfeid = $("#elditransferencia").val();
      var elcome = $("#nueaaaa").val();
            $.ajax({
                type: 'POST',
                url: base_url + '/dashboard/agregarComentario',
                data: {transferen:transfeid, comentario:elcome},
                dataType: "json",
                success: function(resp){
                  $("#cuerpocomentarios").html(resp);
                  $("#nueaaaa").val("");
                  $("#nueaaaa").focus();
                },
                error:function(resp) {

                }
            });
          });
      });

    </script>

    <script>
    $(document).on("click",".eliminacom",function(){
              event.preventDefault();
            var base_url = '<?php echo base_url(); ?>';
            var valor = $(this).attr("idco");
            var transfeid = $("#elditransferencia").val();
            $.ajax({
                type: 'POST',
                url: base_url + '/dashboard/eliminarComentario',
                data: {idcome:valor,transferen:transfeid},
                dataType: "json",
                success: function(resp){

                  if(resp=="incorrecto"){
                  toastr.error('Error al eliminar','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
                  }else{
                    $("#cuerpocomentarios").html(resp);
                    $("#nueaaaa").val("");
                    $("#nueaaaa").focus();
                  }

                },
                error:function(resp) {

                }
            });
    });

    </script>

    <script type="text/javascript">
      $('#materialn').keyup(function(){
        var base_url = '<?php echo base_url(); ?>';
        var palabra = $('#materialn').val();
        var transfeid = $("#elditransferencia").val();
      if(palabra.length >= 0){

        $.ajax({
          url:base_url + '/dashboard/filtrardetalle',
          method: "POST",
          dataType: "json",
          data:{palabra:palabra,transferen:transfeid},
          success:function(resp){
            $("#cuerpodetalle").html(resp.cuerpo);
            $("#totalcant").html(resp.total+" Materiales");
          }
        });

      }

      });
    </script>

<script type="text/javascript">
      <?php  if (isset($lista)): ?>

<?php foreach ($lista as $row){ ?>
$(document).on('click', "#mostrar<?php echo $row->id; ?>", function() {
var base_url = '<?php echo base_url(); ?>';
  var vari = $("#mostrar<?php echo $row->id; ?>").attr("valor");
      $.ajax({
          type: 'POST',
          url: base_url + '/dashboard/mostrarDetalleTransferencia',
          data: {id: vari },
          dataType: "json",
          success: function(resp){
            $("#cuerpodetalle").html(resp.cuerpo);
            $("#totalcant").html(resp.total+" Materiales");
            $("#elditransferencia").val(vari);
          }
      });
});



$(document).ready(function(){
  var base_url = '<?php echo base_url(); ?>';
    $("#mostrar<?php echo $row->id; ?>").click(function(){
      var vari = $("#mostrar<?php echo $row->id; ?>").attr("valor");
      $.ajax({
          type: 'POST',
          url: base_url + '/dashboard/mostrarDetalleTransferencia',
          data: {id: vari },
          dataType: "json",
          success: function(resp){
            $("#cuerpodetalle").html(resp.cuerpo);
            $("#totalcant").html(resp.total+" Materiales");
          }
      });

    });
});

                <?php } ?>
                <?php endif; ?>
</script>


<?php if(isset($mensaje)):?>
<script>
toastr.error('<?php echo $mensaje; ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
</script>
<?php endif; ?>

<?php
echo view("estructuraDashboard2/footer");
?>
