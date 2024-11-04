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
          <h3 class="margin-bottom-1x">Registrar Nuevo Consumo</h3>
          <p>Llene todos los campos con la información requerida.</p>
          <form class="row" method="post" action="<?= base_url() ?>/dashboard/registrarNuevoConsumo">

            <div class="col-sm-5">
              <div class="form-group">
                <label for="reg-pass">Registrado por:</label>
                <input type="text" name="txtusuario" value="<?=session('idUsuario')?>" hidden="">
                <input type="text" class="form-control" value="<?php echo session('nombre').' '.session('apellido');?>" readonly="">

              </div>
            </div>
            <div class="col-sm-5">
              <div class="form-group">
                <label for="reg-email">Aprobado por:</label>
                <select class="form-control" name="txtaprobador" required>
                  <option  value="nadie" selected>Seleccionar:</option>
                <?php if(isset($usuarios)){
                  foreach ($usuarios as $valor) {?>
                    <option value="<?=$valor->id?>"><?php echo $valor->nombre.' '.$valor->apellido; ?></option>
                <?php }} ?>
                </select>
              </div>
            </div>

            <div class="col-sm-2">
              <div class="form-group">
                <label for="reg-email">Fecha:</label>
                <input class="form-control" type="text" name="txtfecha" value="<?=$fecha?>" readonly>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-email">Proyecto:</label>
                <input class="form-control" type="text" name="txtproyecto" value="<?=$proyecto['id']?>" hidden>
                <input class="form-control" type="text" value="<?=$proyecto['nombre']?>" readonly>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="reg-ln">Partida:</label>
                <textarea class="form-control"  name="txtpartida"> </textarea>
              </div>
            </div>

<div class="col-sm-1"></div>
<div class="col-sm-10">
<table class="table table-hover" id="mitabla">
<thead class="table-primary">
  <tr>
    <th scope="col">Código</th>
    <th scope="col">Material</th>
    <th scope="col" class="align-middle text-center" width="200">Cantidad</th>
  </tr>
</thead>
<tbody id="tabla">
  <?php  if (isset($detalle)): ?>
    <?php foreach ($detalle as $row){ ?>
  <tr>
    <th scope="row" class="align-middle">
      <input type="text" name="materiales[]" class="form-control" size="2" value="<?=$row->idmaterial?>" readonly hidden>
      <?=$row->codigo?>
    </th>
    <td class="align-middle"><?=$row->material?></td>
    <td class="align-middle text-center" width="200">
      <div class="count-input">
        <input type="number" name="cantidades[]" step="any" class="form-control cantidad" value="0" required></div>
      </td>
    </tr>
    <?php } ?>
  <?php endif; ?>
</tbody>
</table>
</div>
<div class="col-sm-1"></div>

<div class="col-sm-8"></div>
<div class="col-sm-1 text-center align-middle" style="display: flex; align-items: center;">
  <div class="form-group text-center align-middle" style="display: flex; align-items: center;">
    TOTAL:
  </div>
</div>
<div class="col-sm-3">
  <div class="form-group">
    <input class="form-control" type="text" id="total"  name="total" value="0"  readonly>
  </div>
</div>


            <div class="col-12 text-center text-sm-right">
              <input id="botonregistrar" class="btn btn-primary margin-bottom-none" type="submit" value="Registrar">
              <a class="btn btn-danger margin-bottom-none" href="<?= base_url() ?>/dashboard/proyectos2" >Cancelar</a>
            </div>
          </form>
        </div>
        <div class="col-md-1"></div>
      </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
  $('.cantidad').keyup(function(){
    var sum = 0;
    $(".cantidad").each(function(){
        sum += +$(this).val();
    });
    $("#total").val(sum);
  });
</script>

<script type="text/javascript">
  $('.cantidad').click(function(){
    var sum = 0;
    $(".cantidad").each(function(){
        sum += +$(this).val();
    });
    $("#total").val(sum);
  });
</script>


<?php if(isset($validation)):?>

 <?php if($validation->getError('txtaprobador')!=""):?>
<script>
  toastr.error('<?php echo $validation->getError('txtaprobador'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
</script>
<?php endif; ?>

 <?php if($validation->getError('txtpartida')!=""):?>
<script>
  toastr.error('<?php echo $validation->getError('txtpartida'); ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
</script>
<?php endif; ?>

<?php endif; ?>

 <?php
echo view("estructuraDashboard2/footer");
?>
