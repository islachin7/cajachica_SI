  <?php
 echo view("estructuraDashboard2/cabecera");
?>
  <?php
 echo view("estructuraDashboard2/barraLateralDashboard");
?>
  <?php
 echo view("estructuraDashboard2/barraLateralMovilDashboard");
?>
  <?php
 echo view("estructuraDashboard2/navbar");
?>


<button id="errorsito" data-toast data-toast-type="danger" data-toast-position="topRight" data-toast-icon="fas fa-times" data-toast-title="Error" data-toast-message="al agregar" hidden="true">
</button>

      <!-- Page Content-->
      <div class="container padding-bottom-3x mb-2 py-5">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div class="padding-top-3x hidden-md-up"></div>
            <h3 class="margin-bottom-1x">Solicitud de transferencia de Existencias</h3>
            <p>Llene todos los campos con la información requerida.</p>
            <form class="row" method="post" action="<?= base_url() ?>/dashboard/registrarTransferencia">
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-fn">Almacen origen</label>
                  <select id="inputState" class="form-control" name="origen">
                    <option value="0" selected>Seleccionar:</option>
                  <?php  if (isset($almacenes)): ?>
                    <?php foreach ($almacenes as $row){ ?>
                      <option value="<?=$row->id?>"><?=$row->nombre?></option>
                  <?php } ?>
                  <?php endif; ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-1 col-xs-1 col-1 d-flex align-items-center">
                <div class="form-group">
                  <label for="reg-ln"></label>
                  <i class="fas fa-exchange-alt form-control align-middle d-flex align-items-center text-sm-center text-xs-center"></i>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-ln">Almacen destino</label>
                  <select id="inputState" class="form-control" name="destino">
                  <option value="0" selected>Seleccionar:</option>
                  <?php  if (isset($almacenes)): ?>
                    <?php foreach ($almacenes as $row){ ?>
                      <option value="<?=$row->id?>"><?=$row->nombre?></option>
                  <?php } ?>
                  <?php endif; ?>
                  </select>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label>Fecha</label>
                  <input class="form-control" type="text" name="fecha" value="<?php  echo $fecha; ?>"  readonly>
                </div>
              </div>


              <div class="col-sm-5">
                <div class="form-group">
                  <label for="reg-phone">Responsable:</label>
                  <input type="text" name="usuario" value="<?=session('idUsuario')?>" hidden="">
                  <input type="text" class="form-control" value="<?php echo session('nombre').' '.session('apellido');?>" readonly="">
                </div>
              </div>
              <div class="col-sm-2"></div>
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="reg-pass">Tipo de Transferencia</label>
                  <input class="form-control" type="text" id="transfe"  name="tipoTransferencia" readonly>
                </div>
              </div>
              <div class="col-sm-8">
                <div class="form-group">
                  <label for="reg-pass-confirm">Material o Equipo</label>
                 <input class="form-control input-md" type="text" id="material" name="material" placeholder="Buscar por código o descripción" style="border-radius: 5px">

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

                  <ul class="list-group">

                  </ul>
                  <div id="localsearchsimple"></div>
                  <div id="detail"></div>

                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="reg-pass-confirm"></label>
                  <a href="#" class="btn btn-success form-control" id="agregado">Agregar</a>
                </div>
              </div>

<table class="table table-hover">
  <thead class="table-success">
    <tr>
      <th scope="col">Código</th>
      <th scope="col">Material</th>
      <th scope="col" class="align-middle text-center">Cantidad</th>
      <th scope="col" class="align-middle text-center">Acción</th>
    </tr>
  </thead>
  <tbody id="tabla">
    <?php  if (isset($detalle)): ?>
      <?php foreach ($detalle as $row){ ?>
    <tr>
      <th scope="row" class="align-middle">
        <input type="text" name="materiales[]" class="form-control" size="2" value="<?=$row->idmaterial?>" readonly hidden>
        <input type="text" class="form-control" size="1" placeholder="<?=$row->codigo?>" readonly>
      </th>
      <td class="align-middle"><?=$row->material?></td>
      <td class="align-middle text-center">
        <div class="count-input">
          <input type="number" name="cantidades[]" class="form-control" required></div>
        </td>
        <td class="align-middle text-center">
          <button valor="<?=$row->id?>" class="eliminar btn btn-outline-danger"><i class="fas fa-minus-circle"></i></button>
        </td>
      </tr>
      <?php } ?>
    <?php endif; ?>
  </tbody>
</table>


              <div class="col-12 text-center text-sm-right">
                <?php  if (isset($detalle)){
                      if ($detalle!=null){ ?>
                  <input id="botonregistrar" class="btn btn-primary margin-bottom-none" type="submit" value="Registrar">
                <?php }else{ ?>
                  <input disabled id="botonregistrar" class="btn btn-primary margin-bottom-none" type="submit" value="Registrar">
                <?php }} ?>
                <a class="btn btn-danger" id="eliminartodo" href="<?= base_url() ?>/dashboard/eliminartodo" >Cancelar</a>
              </div>
            </form>
          </div>
          <div class="col-md-1"></div>
        </div>
      </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
  function unir(codigo){
    $(document).on('click', "#ad"+codigo, function() {
      var c  =$("#ad"+codigo).attr("codi");
      $("#material").val(c);
      $('.list-group').css('display','none');
      $("#ad"+codigo).removeAttr("href");
    });
  }
</script>

<script type="text/javascript">
  $('#material').keyup(function(){
    var base_url = '<?php echo base_url(); ?>';
    var palabra = $('#material').val();
    $('#detail').html('');
    $('.list-group').css('display','block');
  if(palabra.length >= 2){
    $.ajax({
      url:base_url + '/dashboard/buscarmaterial',
      method: "POST",
      dataType: "json",
      data:{palabra:palabra},
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



<script>
$(document).ready(function(){
    $("#agregado").attr("disabled", true);
    var base_url = '<?php echo base_url(); ?>';
  $("#agregado").click(function(){
  var valor = $("#material").val();
  var usua = '<?php echo session('idUsuario'); ?>';
  var ori = $('select[name=origen]').val();
  var des = $('select[name=destino]').val();
    if(valor == ""){
      $("#errorsito").click();
      $("#material").focus();
    }else{

        $.ajax({
            type: 'POST',
            url: base_url + '/dashboard/agregarDetalle',
            data: {material: valor, usuario:usua, origen:ori, destino:des },
            dataType: "json",
            success: function(resp){
            if(resp=="ag"){
              toastr.error('Ya esta Agregado','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
              $("#material").focus();
            }else if(resp=="origen"){
              toastr.error('No existe el material en el almacen de origen','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
              $("#material").focus();
            }else if(resp=="destino"){
              toastr.error('No existe el material en el almacen de destino','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
              $("#material").focus();
            }else{
                $("#tabla").append(resp);
                $("#material").val('');
                $("#material").focus();
                $("#botonregistrar").attr("disabled", false);
              }

            },
            error:function(resp) {
            toastr.error('Error al Agregar','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
            $("#material").focus();

            }
        });

        }


      });


  });

$(document).on("click",".eliminar",function(){
          event.preventDefault();
        var base_url = '<?php echo base_url(); ?>';
        var asc = $(this).attr("valor");
        $(this).closest('tr').remove();

        $.ajax({
            type: 'POST',
            url: base_url + '/dashboard/eliminarDetalle',
            data: {id: asc },
            dataType: "json",
            success: function(resp){
              if(resp=="correcto"){
              $("#material").focus();
              }

            },
            error:function(resp) {
              $("#errorsito").click();
              $("#material").focus();

            }
        });
});


$(document).ready(function(){
    var base_url = '<?php echo base_url(); ?>';
    var ori=0;
    var des=0;
    var central = '<?php if(isset($central)){ echo $central; } ?>';

  $("select[name=origen]").change(function(){
        ori = $('select[name=origen]').val();
        if(ori==central && des!=central){
          $('#transfe').val('nueva transferencia');
        }
        if(ori!=central && des!=central){
          $('#transfe').val('transferencia interna');
        }
        if(ori!=central && des==central){
          $('#transfe').val('devolución a almacén');
        }
    if(ori==des){
      $('#transfe').val('');
    }
    if(ori==0 || des==0){
      $('#transfe').val('');
    }

    if($('#transfe').val()!=""){
      $("#agregado").attr("disabled", false);
    }else{
      $("#agregado").attr("disabled", true);
    }

  });

    $("select[name=destino]").change(function(){
        des = $('select[name=destino]').val();

        if(ori==central && des!=central){
          $('#transfe').val('nueva transferencia');
        }
        if(ori!=central && des!=central){
          $('#transfe').val('transferencia interna');
        }
        if(ori!=central && des==central){
          $('#transfe').val('devolución a almacén');
        }
    if(ori==des){
      $('#transfe').val('');
    }
    if(ori==0 || des==0){
      $('#transfe').val('');
    }

    if($('#transfe').val()!=""){
      $("#agregado").attr("disabled", false);
    }else{
      $("#agregado").attr("disabled", true);
    }

  });



});

</script>

              <?php if(isset($validation)):?>
               <?php if($validation->getError('origen')!=""):?>
              <script>
                toastr.error('<?php echo $validation->getError('origen'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
              </script>
              <?php endif; ?>

                 <?php if($validation->getError('destino')!=""):?>
              <script>
                toastr.error('<?php echo $validation->getError('destino'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
              </script>
              <?php endif; ?>

              <?php if($validation->getError('fecha')!=""):?>
              <script>
                toastr.error('<?php echo $validation->getError('fecha'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
              </script>
              <?php endif; ?>

              <?php if($validation->getError('tipoTransferencia')!=""):?>
              <script>
                toastr.error('<?php echo $validation->getError('tipoTransferencia'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
              </script>
              <?php endif; ?>

              <?php if($validation->getError('usuario')!=""):?>
              <script>
                toastr.error('<?php echo $validation->getError('usuario'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
              </script>
              <?php endif; ?>

              <?php if($validation->getError('proyecto')!=""):?>
              <script>
                toastr.error('<?php echo $validation->getError('proyecto'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
              </script>
              <?php endif; ?>

              <?php if($validation->getError('materiales')!=""):?>
              <script>
                toastr.error('<?php echo $validation->getError('materiales'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
              </script>
              <?php endif; ?>

              <?php if($validation->getError('cantidades')!=""):?>
              <script>
                toastr.error('<?php echo $validation->getError('cantidades'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
              </script>
              <?php endif; ?>
                <?php endif; ?>


   <?php
 echo view("estructuraDashboard2/footer");
?>
