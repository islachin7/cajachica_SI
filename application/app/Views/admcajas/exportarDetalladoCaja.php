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
                    <th rowspan="2" colspan="2" class="align-middle"><div style="text-align:center"><img src="<?=base_url()?>/plantilla/logoEmpresa-02.png" alt="Logo de la empresa"></div></th>
                    <th rowspan="2" colspan="11"><strong style="font-size:45px">CAJA CHICA N° <?=$caja["codigo"]?></strong></th>
                    <th colspan="2" style="font-size:25px">Fecha de reporte</th>
                  </tr>

                  <tr><th colspan="2"><?=$fecha?></th></tr>

                  <tr><td colspan="15" style="background-color:#b9cbe2; padding:4px;"></td></tr>
            
                  <tr>
                    <th colspan="15" style="background-color:#ffffff; color:#000000; font-size:32px;text-align:center;">
                      <strong>REPORTE DE CAJA CHICA DEL <?=$caja["fecha_apertura"]?> AL <?=$fechaH?></strong>
                    </th>
                </tr>
                  <tr>
                    <th colspan="2" style="background-color:#b9cbe2;text-align:center;color:#000000;">Fecha</th>
                    <th colspan="3" style="background-color:#b9cbe2;text-align:center;color:#000000;">Concepto</th>
                    <th colspan="2" style="background-color:#b9cbe2;text-align:center;color:#000000;">Num° Comprobante</th>
                    <th colspan="2" style="background-color:#b9cbe2;text-align:center;color:#000000;">Proveedor</th>
                    <th class="align-middle" style="background-color:#b9cbe2;text-align:center;color:#000000;">Ingreso</th>
                    <th class="align-middle" style="background-color:#b9cbe2;text-align:center;color:#000000;">Salida</th>
                    <th class="align-middle" colspan="4" style="background-color:#b9cbe2;text-align:center;color:#000000;">Observaciones</th>
                  </tr>

                </thead>
                <tbody>

                  <?php  if (isset($cabecera)): ?>
                    <?php foreach ($cabecera as $row){ ?>
                  <tr>
                    <td class="align-middle" colspan="2" style="text-align:center;"><?=$row->fecha?></td>
                    <td class="align-middle" colspan="3"><?=$row->descrip?></td>
                    <td class="align-middle" colspan="2"><?=$row->cmpb?></td>
                    <td class="align-middle" colspan="2"><?=$row->prove?></td>
                    <td class="align-middle"><?=$row->ingreso?></td>
                    <td class="align-middle"><?=$row->salida?></td>
                    <td class="align-middle" colspan="4"><?=$row->observacion?></td>
                  </tr>

                  <?php } ?>
                  <?php endif; ?>

                  <?php  if (isset($cuerpo)): ?>
                    <?php foreach ($cuerpo as $row){ ?>
                  <tr>
                    <td class="align-middle" colspan="2" style="text-align:center;"><?=$row->fecha?></td>
                    <td class="align-middle" colspan="3"><?=$row->descrip?></td>
                    <td class="align-middle" colspan="2"><?=$row->cmpb?></td>
                    <td class="align-middle" colspan="2"><?=$row->prove?></td>
                    <td class="align-middle"><?=$row->ingreso?></td>
                    <td class="align-middle"><?=$row->salida?></td>
                    <td class="align-middle" colspan="4"><?=$row->observacion?></td>
                  </tr>

                  <?php } ?>
                  <?php endif; ?>

                  <tr>
                    <th colspan="9" style="text-align:right;color:#000000;">TOTALES S/</th>
                    <td><?=($caja["montoTotal"]+$aumento)?></td>
                    <td><?=$totalconsumido?></td>
                    <th colspan="4" ></th>
                  </tr>

                  <tr>
                    <th colspan="9" style="text-align:right;color:red;">SALDO A LA FECHA S/</th>
                    <td></td>
                    <td><?=(($caja["montoTotal"]+$aumento) - $totalconsumido)?></td>
                    <th colspan="4"></th>
                  </tr>

                </tbody>

              </table>
            </body>
            </html>
