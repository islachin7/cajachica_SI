<?php
 echo view("estructuraDashboard/cabecera");
 echo view("estructuraDashboard/barraLateralDashboard");
 echo view("estructuraDashboard/barraLateralMovilDashboard");
 echo view("estructuraDashboard/navbar");
?>
      <section class="container padding-top-1x padding-top-1x">
        <h2>Lista de Cajas</h2>
        
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
                                <a class="editar dropdown-item" href="<?=base_url()?>/cajaChicac/detalleCaja/<?=$row->id?>">Revisar</a>
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
      <nav nav class="pagination text-center pb-3">
        <div class="column">
          <ul class="pages" id="pages">
          </ul>
        </div>
      </nav>


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
 echo view("estructuraDashboard/footer");
?>

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

       var base_url = '<?php echo base_url(); ?>';

        $.ajax({
            type: 'POST',
            url: base_url + '/cajaChicac/pagina',
            data: {pag: page},
            dataType: "json",
            success: function(resp){          
              $("#productos").html(resp.html);
            }
        });
    }
    elem(allPages, 1);
  <?php endif; ?>
</script>


</body>
</html>
