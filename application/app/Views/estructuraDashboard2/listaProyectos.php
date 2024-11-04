  <?php
 echo view("estructuraDashboard2/cabecera");
?>


<div class="modal fade" id="almacendetalles" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="almacen">Nombre Almacen</h4>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
          </div>
          <div class="modal-body">
            <div class="row mb-2">

                <div class="col-md-1"></div>
                <div class="col-md-10">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="reg-pass">fecha de Creación:</label>
                        <input class="form-control" type="text" id="fechaCrea" readonly>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                      <label for="reg-pass">Proyecto:</label>
                      <input class="form-control" type="text" id="Proyec" readonly>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                      <label for="reg-pass">Dirección:</label>
                      <input class="form-control" type="text" id="Dire" readonly>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-1"></div>

            </div>

            <div class="row">
              <div class="col-sm-1"></div>
              <div class="col-sm-10">
                <div class="row">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-6">
                    <div class="form-group input-group py-2">
                      <input hidden id="idalmacen" value="">
                      <input class="form-control" type="text" placeholder="código o nombre" id="materialn" required><span class="input-group-addon"><i class="fas fa-search"></i></span>
                    </div>
                  </div>
                  <div class="col-sm-3"></div>
                </div>
              </div>
              <div class="col-sm-1"></div>
            </div>

            <div class="table-responsive shopping-cart mb-0">
              <table class="table">
                <thead>
                  <tr>
                    <th class="text-center text-lg text-medium">Código</th>
                    <th class="text-center text-lg text-medium" >Material</th>
                    <th class="text-center text-lg text-medium">Stock</th>
                  </tr>
                </thead>
                <tbody id="cuerpodetalle">
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
        <h2>Mis Proyectos</h2>

        <div class="row d-flex justify-content-center ">
          <?php  if (isset($lista)): ?>
            <?php foreach ($lista as $row){ ?>
                <div class="col-lg-3 margin-bottom-1x" >
                  <div class="card text-center">
                    <div class="card-body py-2 d-block" style="height:120px;">
                      <h1 class="card-title"><i class="fas fa-chart-line"></i>&nbsp;</h1>
                      <h6 class="card-title text-uppercase"><?php echo $row->nombre; ?></h6>
                      <p class="text-center"><?=$row->usuario?></p>
                    </div>
                    <div class="card-body">
                      <a class="btn btn-outline-secondary btn-sm" id="mostrar<?=$row->id?>" valor="<?=$row->almacen?>" data-toggle="modal" data-target="#almacendetalles"><i class="far fa-eye"></i></a>
                      <a class="btn btn-outline-info btn-sm" href="<?=base_url()?>/dashboard/consumosdiarios?id=<?=$row->id?>"><i class="far fa-calendar-alt"></i></a>
                      <a class="btn btn-outline-success btn-sm" href="<?=base_url()?>/dashboard/excelAlmacen?id=<?=$row->almacen?>"><i class="far fa-file-excel"></i></a>
                    </div>
                  </div>
                </div>
              <?php } ?>
              <?php endif; ?>
        </div>

      </section>

      <script type="text/javascript">
        $('#materialn').keyup(function(){
          var base_url = '<?php echo base_url(); ?>';
          var palabra = $('#materialn').val();
          var idalmac = $("#idalmacen").val();
        if(palabra.length >= 0){

          $.ajax({
            url:base_url + '/dashboard/filtrardetalleAlmacen',
            method: "POST",
            dataType: "json",
            data:{palabra:palabra,almacenid:idalmac},
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
                  url: base_url + '/dashboard/mostrarDetalle',
                  data: {id: vari },
                  dataType: "json",
                  success: function(resp){
                    $("#almacen").html(resp.nombre);
                    $("#cuerpodetalle").html(resp.cuerpo);
                    $("#totalcant").html(resp.total+" Materiales");
                    $("#fechaCrea").val(resp.fecha);
                    $("#Proyec").val(resp.proyecto);
                    $("#Dire").val(resp.direccion);
                    $("#idalmacen").val(vari);
                  }
              });
      });



      $(document).ready(function(){
          var base_url = '<?php echo base_url(); ?>';
            $("#mostrar<?php echo $row->id; ?>").click(function(){
              var vari = $("#mostrar<?php echo $row->id; ?>").attr("valor");
              $.ajax({
                  type: 'POST',
                  url: base_url + '/dashboard/mostrarDetalle',
                  data: {id: vari },
                  dataType: "json",
                  success: function(resp){
                    $("#almacen").html(resp.nombre);
                    $("#cuerpodetalle").html(resp.cuerpo);
                    $("#totalcant").html(resp.total+" Materiales");
                    $("#fechaCrea").val(resp.fecha);
                    $("#Proyec").val(resp.proyecto);
                    $("#Dire").val(resp.direccion);
                    $("#idalmacen").val(vari);
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
