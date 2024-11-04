<?php
 echo view("admcajas/cabecera");
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"/>
    <div class="modal fade" id="modaleliminar" tabindex="-1">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Eliminar</h4>
            <button id="cerr" class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
        <div class="row">
          <!-- Product Info-->
          <div class="col-md-12">
            <div class="row text-center">
              <div class="col-sm-2"></div>
              <div class="col-sm-8">
                ¿Esta seguro de eliminar al usuario?
              </div>
              <div class="col-sm-2"></div>
            </div>
            <div class="py-3 d-flex flex-wrap justify-content-center">
              <div class="sp-buttons mt-2 mb-2 text-center">
                <a class="btn btn-success text-center btn-lg" href="<?=base_url()?>/usuario" id="eli"><i class="fas fa-check"></i></a>
                <button class="btn btn-danger text-center btn-lg" type="button" data-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
              </div>
            </div>
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

.lbl{
  margin-top: 13px;
  display: inline-block;
  width: 65px;
  height: 33px;
  background: #ed3a32;
  border-radius: 100px;
  cursor: pointer;
  position: relative;
  transition: .2s;
}


.lbl::after{
  content: '';
  display: block;
  width: 25px;
  height: 25px;
  background: #eee;
  border-radius: 100px;
  position: absolute;
  top: 4px;
  left: 4px;
  transition: .2s;
}


.siese + .lbl::after{
  left: 36px;
}

.lbl-active::after{
  content: '';
  display: block;
  width: 25px;
  height: 25px;
  background: #eee;
  border-radius: 100px;
  position: absolute;
  top: 4px;
  left: 4px;
  transition: .2s;
}


.lbl-active{
  margin-top: 13px;
  display: inline-block;
  width: 65px;
  height: 33px;
  background: #01d801;
  border-radius: 100px;
  cursor: pointer;
  position: relative;

}

.siese +  .lbl-active::after{
  left: 36px;
}


</style>


      <section class="container padding-top-3x padding-bottom-3x">
        <h2>Lista de Usuarios</h2>
        <?php if(session("tipo")!=3){ ?>
        <a class="btn btn-success mb-4" style="border-radius:20px" href="<?=base_url()?>/usuario/nuevoUsuario">Nuevo</a>
        <?php } ?>
              <table id="peass" class="table table-responsive table-hover" style="border-radius:20px;background-color:#fff;" >
                <thead class="thead-inverse">
                  <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Celular</th>
                    <th>Correo</th>
                    <th>Tipo de Usuario</th>
                    <th class="text-center">Editar</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Eliminar</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  if (isset($lista)): ?>
                    <?php foreach ($lista as $row){ ?>
                  <?php  if($row->estado == 2){ ?>
                    <tr>
                      <td class="align-middle" width="200"><?php echo $row->nombre; ?></td>
                      <td class="align-middle" width="200"><?php echo $row->apellido; ?></td>
                      <td class="align-middle" width="120"><?php echo $row->celular; ?></td>
                      <td class="align-middle" width="200"><?php echo $row->correo; ?></td>
                      <td class="align-middle" width="200"><?php echo $row->tipousuario; ?></td>
                      <td class="align-middle text-center">
                        <a id="btneditus<?=$row->id?>" disabled class="btn btn-outline-primary">
                          <i class="fas fa-edit"></i>
                        </a>
                      </td>
                      <td class="align-middle">
                        <div class="swtich-container">
                          <input type="checkbox" id="switch<?=$row->id?>" style="display: none;">
                          <label id="eicolo<?=$row->id?>"  valor=<?=$row->id?>  for="switch<?=$row->id?>" class=" botin lbl "></label>
                        </div>
                      </td>
                      <td class="align-middle text-left">
                        <a class="btn btn-outline-danger" data-toggle="modal" data-target="#modaleliminar" id="elimnando<?php echo $row->id; ?>">
                          <i class="fas fa-trash-alt"></i>
                        </a>
                      </td>
                    </tr>
                  <?php  }else{ ?>
                    <tr>
                      <td class="align-middle" width="200"><?php echo $row->nombre; ?></td>
                      <td class="align-middle" width="200"><?php echo $row->apellido; ?></td>
                      <td class="align-middle" width="120"><?php echo $row->celular; ?></td>
                      <td class="align-middle" width="200"><?php echo $row->correo; ?></td>
                      <td class="align-middle" width="200"><?php echo $row->tipousuario; ?></td>
                      <td class="align-middle text-center">
                        <a id="btneditus<?=$row->id?>" href="<?=base_url()?>/usuario/actuUsuarioAdm?id=<?=$row->id?>" class="btn btn-outline-primary">
                          <i class="fas fa-edit"></i>
                        </a>
                      </td>
                      <td class="align-middle">
                        <div class="swtich-container">
                          <input type="checkbox" class="siese" checked  id="switch<?=$row->id?>" style="display: none;">
                          <label id="eicolo<?=$row->id?>"  valor=<?=$row->id?>  for="switch<?=$row->id?>" class=" botin lbl-active "></label>
                        </div>
                      </td>
                      <td class="align-middle text-left">
                        <a class="btn btn-outline-danger" data-toggle="modal" data-target="#modaleliminar" id="elimnando<?php echo $row->id; ?>">
                          <i class="fas fa-ban"></i>
                        </a>
                      </td>
                    </tr>
                  <?php  }?>
                  <?php } ?>
                  <?php endif; ?>
                </tbody>
              </table>
      </section>

      <script type="text/javascript">
        <?php  if (isset($lista)): ?>
         <?php foreach ($lista as $row){ ?>
        $(document).ready(function(){
            var base_url = '<?php echo base_url(); ?>';
            $("#elimnando<?php echo $row->id; ?>").click(function(){
              $("#usu").html("<?php echo $row->correo; ?>");
              $("#eli").attr('href', base_url+'/usuario/eliminarUsuario?id='+<?php echo $row->id; ?>);
            });
        });
        $(document).on('click', "#elimnando<?php echo $row->id; ?>", function() {
          var base_url = '<?php echo base_url(); ?>';
            $("#usu").html("<?php echo $row->correo; ?>");
            $("#eli").attr('href', base_url+'/usuario/eliminarUsuario?id='+<?php echo $row->id; ?>);
          });
        <?php } ?>
        <?php endif; ?>
      </script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

      <?php if(isset($errorBDD)):?>
        <script>
          toastr.error('<?php echo $errorBDD; ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
        </script>
      <?php endif; ?>

      <?php if(isset($correcto)):?>
        <script>
          toastr.success('<?php echo $correcto; ?>','Notificación',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
        </script>
      <?php endif; ?>

<?php
 echo view("admcajas/footer");
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
            }
        });
    });

  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
 var base_url = '<?php echo base_url(); ?>';

      $('.botin').on('click', function() {
        var asc = $(this).attr("valor");
        if ($("#switch"+asc).prop('checked')) {
          //activando
          $.ajax({
              type: 'POST',
              url: base_url + '/usuario/desactivando',
              data: {id: asc },
              dataType: "json",
              success: function(resp){
                  $("#switch"+asc).removeClass('siese');
                  $("#eicolo"+asc).removeClass('lbl-active');
                  $("#eicolo"+asc).addClass('lbl');
                  $("#btneditus"+asc).removeAttr('href');
                  $("#btneditus"+asc).attr('disabled',true);
                  toastr.error('Desactivado','Notificación',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});

              },
              error:function(resp) {
                toastr.error('Error','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
              }
          });
       } else {
         //descativnado
         $.ajax({
             type: 'POST',
             url: base_url + '/usuario/activando',
             data: {id: asc },
             dataType: "json",
             success: function(resp){
                 $("#switch"+asc).addClass('siese');
                 $("#eicolo"+asc).removeClass('lbl');
                 $("#eicolo"+asc).addClass('lbl-active');
                 $("#btneditus"+asc).removeAttr('disabled');
                 $("#btneditus"+asc).attr('href',base_url+'/usuario/actuUsuarioAdm?id='+asc);
                 toastr.success('Activado','Notificación',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});

             },
             error:function(resp) {
               toastr.error('Error','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
             }
         });
       }
     });
 </script>
</body>
</html>
