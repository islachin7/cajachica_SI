  <?php
 echo view("estructuraDashboard2/cabecera");
?>

<div class="modal fade" id="detalletransferencia" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Detalle de la Transferencia</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">

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

              <div class="text-lg px-2 py-1">Total: <span class="text-medium" id="totalcant">Cargando...</span></div>
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
        <h2>Mis Transferencias</h2>

        <div class="table-responsive">
              <table class="table">
                <thead class="thead-inverse">
                  <tr>
                    <th>N°</th>
                    <th># de Transferencia</th>
                    <th class="text-center" >Fecha</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Tipo de Transferencia</th>
                    <th>Responsable</th>
                    <th>ver Detalle</th>
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

  <?php
 echo view("estructuraDashboard2/footer");
?>
