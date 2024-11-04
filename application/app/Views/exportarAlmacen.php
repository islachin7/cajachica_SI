<?php
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=UTF-8;");
header("Content-Disposition: attachment; filename=$nombre.xls");
header("Pragma: no-cache");
header("Expire: 0");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;"charset="UTF-8" />
</head>
<body>
              <table class="table" border="1">
                <thead>
                  <tr>
                    <th rowspan="3" width="200" style="text-align:center"> <img style="text-align:center" src="<?=base_url()?>/plantilla/logo.png" alt="Logo de la empresa"></th>
                    <th rowspan="3"><strong style="font-size:22px">STOCK DE ALMACÉN</strong></th>
                    <th colspan="3" rowspan="2">Fecha de reporte</th>
                  </tr>
                  <tr>
                  </tr>
                  <tr>
                    <th colspan="3"><?=$fechita?></th>
                  </tr>
                  <tr>
                    <th colspan="2">Almacen:</th>
                    <th colspan="3"><?=$cabe["nombre"]?></th>
                  </tr>
                  <tr>
                    <th colspan="2">Proyecto:</th>
                    <th colspan="3"><?=$cabe["proyecto"]?></th>
                  </tr>
                  <tr>
                    <th colspan="2">Fecha de Creación:</th>
                    <th colspan="3"><?=$cabe["fechaCreacion"]?></th>
                  </tr>
                  <tr>
                    <th colspan="5">DETALLE</th>
                  </tr>
                  <tr>
                    <th>Codigo</th>
                    <th>Material</th>
                    <th>Stock</th>
                    <th>Unidad</th>
                    <th>Estado en Almacen</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  if (isset($lista)): ?>
                    <?php foreach ($lista as $row){ ?>
                  <tr>
                    <td class="align-middle"><?=$row->codigo?></td>
                    <td class="align-middle"><?=$row->material?></td>
                    <td class="align-middle"><?=$row->stockProducto?></td>
                    <td class="align-middle"><?=$row->unidadMedida?></td>
                    <?php if($row->usado==1){ ?>
                    <td class="align-middle">Material Utilizado</td>
                    <?php }else{ ?>
                    <td class="align-middle">Material no Utilizado</td>
                    <?php } ?>
                  </tr>
                  <?php } ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </body>
            </html>
