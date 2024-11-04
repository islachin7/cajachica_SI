

  <?php
 echo view("estructuraDashboard2/cabecera");
?>

<div class="modal fade" id="detalledelconsumo" tabindex="-1">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">DETALLE DEL CONSUMO</h4>
            <button id="cerr" class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">

        <div class="row">

          <!-- Product Info-->
          <div class="col-md-12">
            <div class="row">
              <div class="col-sm-1"></div>
              <div class="col-sm-10">
                <div class="form-group">
                  <label for="reg-email">Registrado por:</label>
                  <input class="form-control" readonly id="registrado">
                </div>
              </div>
              <div class="col-sm-1"></div>
              <div class="col-sm-1"></div>
              <div class="col-sm-10">
                <div class="form-group">
                  <label for="reg-email">aprobado por:</label>
                  <input class="form-control" required readonly id="aprobador">
                </div>
              </div>
              <div class="col-sm-1"></div>


              <div class="col-sm-1"></div>
              <div class="col-sm-10">
                <div class="form-group">
                  <label for="reg-email">Partida:</label>
                  <textarea class="form-control" id="partida" readonly> </textarea>
                </div>
              </div>
              <div class="col-sm-1"></div>

            </div>

          </div>
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
  <h2>Lista de Consumos</h2>

  <?php if(session("tipo")!=3){ ?>
  <a class="btn btn-outline-primary" href="<?=base_url()?>/dashboard/nuevoConsumo?id=<?php if(isset($idproyecto)) echo $idproyecto;  ?>">Nuevo</a>
  <?php } ?>
  <a class="btn btn-outline-success" href="<?=base_url()?>/dashboard/excelConsumos?id=<?php if(isset($idproyecto)) echo $idproyecto;  ?>"><i class="far fa-file-excel"></i>&nbsp;Excel</a>

  <?php if(isset($consumos)){
      if($consumos!=null){
     ?>
  <div class="table-responsive py-3">
        <table class="table table-hover">
          <thead class="thead-inverse table-bordered">

            <tr>
              <th class="text-center align-middle" WIDTH="20">Material</th>
              <?php
                  foreach ($consumos as $fila) {
              ?>
              <th WIDTH="10">
                <p class="text-center align-middle" style="writing-mode: vertical-lr;transform: rotate(180deg);"><?=$fila->fecha?> <br> <?=$fila->usuario?></p>
                <a class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#detalledelconsumo" id="mostrar<?=$fila->id?>" valor="<?=$fila->id?>"><i class="fas fa-info-circle"></i></a>
              </th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php
              if(isset($almacen)){
                foreach ($almacen as $fila2) {
            ?>
            <tr>
              <td><?=$fila2->material?></td>
              <?php foreach ($detalleconsumo as $fila4) {
                    if($fila2->idmaterial==$fila4->idmaterial){
                ?>
                <td><?=$fila4->cantidadconsumida?></td>

                <?php }?>
          <?php  } ?>

            </tr>
            <?php
                }
              }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th class="text-center align-middle text-bold h6" WIDTH="20">Total:</th>
              <?php
                  foreach ($consumos as $fila) {
              ?>
              <th WIDTH="10" class="text-left align-middle h6"><?=$fila->totalcant?></th>
              <?php } ?>
            </tr>
          </tfoot>
        </table>
      </div>
    <?php }} ?>

</section>



<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
        <?php  if (isset($consumos)): ?>

<?php foreach ($consumos as $row){ ?>
$(document).on('click', "#mostrar<?php echo $row->id; ?>", function() {
  var base_url = '<?php echo base_url(); ?>';
    var vari = $("#mostrar<?php echo $row->id; ?>").attr("valor");
     $.ajax({
            type: 'POST',
            url: base_url + '/dashboard/mostrarDetalleConsumo',
            data: {id: vari },
            dataType: "json",
            success: function(resp){
              $("#registrado").val(resp.registra);
              $("#aprobador").val(resp.aprueba);
              $("#partida").val(resp.partida);
            }
        });
});



$(document).ready(function(){
    var base_url = '<?php echo base_url(); ?>';
      $("#mostrar<?php echo $row->id; ?>").click(function(){
        var vari = $("#mostrar<?php echo $row->id; ?>").attr("valor");
        $.ajax({
               type: 'POST',
               url: base_url + '/dashboard/mostrarDetalleConsumo',
               data: {id: vari },
               dataType: "json",
               success: function(resp){
                 $("#registrado").val(resp.registra);
                 $("#aprobador").val(resp.aprueba);
                 $("#partida").val(resp.partida);
               }
           });

      });
});

                  <?php } ?>
                  <?php endif; ?>
</script>


  <?php
 echo view("estructuraDashboard2/footer");
?>
