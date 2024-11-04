<?php
 echo view("gerencia/cabecera");
?>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css"/>

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
        <h2>Lista de Actividades en el Sistema</h2>
              <table id="peass" class="table table-responsive table-hover table-bordered" style="border-radius:20px" >
                <thead class="bg-primary text-light">
                  <tr>
                    <th class="align-middle" width="200">Fecha</th>
                    <th class="align-middle" width="200">Usuario</th>
                    <th class="align-middle" width="800">Actividad</th>
                  </tr>
                </thead>
                <tbody>
                <td colspan="3">
                  <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                      <img class="" src="<?=base_url()?>/plantilla/img/cargando.gif" alt="loading" />
                    </div>
                    <div class="col-sm-4"></div>
                  </div>
                </td>
                </tbody>
              </table>
      </section>
              <?php if(isset($errorBDD)):?>
                <script>
                toastr.error('<?php echo $errorBDD; ?>','Alerta',{"closeButton": true,"debug": false,"newestOnTop": false,"progressBar": true,"positionClass": "toast-top-right","preventDuplicates": false,"onclick": null,"showDuration": "5000","hideDuration": "5000","timeOut": "15000","extendedTimeOut": "15000","showEasing": "swing","hideEasing": "linear","showMethod": "fadeIn","hideMethod": "fadeOut"});
              </script>
              <?php endif; ?>
              <!-- Site Footer-->
              <footer class="site-footer">
                <div class="container">
                  <div class="row text-center">
                    <div class="col-lg-6 col-md-6">
                      <!-- Contact Info-->
                      <section class="widget widget-light-skin">
                        <h3 class="widget-title">Contactanos</h3>
                        <p class="text-white">Cell: 997 958 365</p>
                        <ul class="list-unstyled text-sm text-white">
                          <li><span class="opacity-50">Lunes a Viernes:</span>9.00 am - 8.00 pm</li>
                          <li><span class="opacity-50">Sabados:</span>10.00 am - 6.00 pm</li>
                        </ul>
                        <p><a class="navi-link-light" href="#">empresa@gmail.com</a></p>
                          <a class="social-button shape-circle sb-facebook sb-light-skin" href="#">
                            <i class="socicon-facebook"></i></a>
                          <a class="social-button shape-circle sb-twitter sb-light-skin" href="#">
                            <i class="socicon-twitter"></i></a>
                          <a class="social-button shape-circle sb-instagram sb-light-skin" href="#">
                            <i class="socicon-instagram"></i></a>
                          <a class="social-button shape-circle sb-google-plus sb-light-skin" href="#">
                            <i class="socicon-whatsapp"></i></a>
                      </section>
                    </div>
                    <style>
                    .widget-light-skin.widget-links ul>li>a:hover{
                      color: #ff914d;
                    }
                    </style>
                    <div class="col-lg-6 col-md-6">
                      <!-- About Us-->
                      <section class="widget widget-links widget-light-skin">
                        <h3 class="widget-title">Acerca de Nosotros</h3>
                        <ul class="text-left">
                          <li><a href="#">¿Quienes Somos?</a></li>
                          <li><a href="#">Acerca del Sistema</a></li>
                        </ul>
                      </section>
                    </div>
                  </div>
                  <hr class="hr-light mt-2 margin-bottom-2x">
                  <!-- Copyright-->
                  <p class="footer-copyright text-center">© Desarrollado por Victor Islachin</p>
                </div>
              </footer>
            </div>
            <!-- Back To Top Button-->
            <a class="scroll-to-top-btn" href="#"><i class="icon-arrow-up"></i></a>
            <!-- Backdrop-->
            <div class="site-backdrop"></div>
            <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
            <script src="<?= base_url() ?>/plantilla/js/vendor.min.js"></script>
            <script src="<?= base_url() ?>/plantilla/js/scripts.min.js"></script>
            <!-- Customizer scripts-->
            <script src="<?= base_url() ?>/plantilla/customizer/customizer.min.js"></script>
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
            <script type="text/javascript">
              $(document).ready(function() {
                  let base_url = '<?php echo base_url(); ?>';
                  $('#peass').DataTable({
                      "order": [[ 0, "desc" ]],
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
                      "ajax": {
                        url: base_url+"/seguimientoc/index2"
                      },
                      columnDefs: [{
                        "defaultContent": "-",
                        "targets": "_all",
                        "className": 'text-bold'
                      }],
                      columns: [
                        {"data" : "Fecha"},
                        {"data" : "Usuario"},
                        {"data" : "Actividad"}             
                        ],
                  });
              });
            </script>
          </body>
        </html>
