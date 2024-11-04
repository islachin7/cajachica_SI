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
                    <th rowspan="4" colspan="3" style="text-align:center"> <img style="text-align:center" src="<?=base_url()?>/plantilla/logoEmpresa-02.png" alt="Logo de la empresa"></th>
                    <th rowspan="4" colspan="5"><strong style="font-size:22px">CAJA CHICA N° <?=$caja["codigo"]?></strong></th>
                    <th rowspan="3" colspan="2">Fecha de reporte</th>
                  </tr>

                  <tr></tr>

                  <tr><th colspan="2"><?=$fecha?></th></tr>

                  <tr><td colspan="10" style="background-color:#b9cbe2"></td></tr>

                  <tr>
                    <th colspan="2">Fecha de Apertura:</th>
                    <td colspan="8" style="text-align:left;"><?=$caja["fecha_apertura"]?></td>
                  </tr>

                  <tr>
                    <th colspan="2">Fecha de Cierre:</th>
                    <td colspan="8" style="text-align:left;"><?=$caja["fecha_cierre"]?></td>
                  </tr>

                  <tr>
                    <th colspan="2">Área:</th>
                    <td colspan="8" style="text-align:left;">Logística</td>
                  </tr>

                  <tr>
                    <th colspan="2">Atención:</th>
                    <td colspan="8" style="text-align:left;">Área Administrativa Contable</td>
                  </tr>

                  <tr><td colspan="10" style="background-color:#ffffff"></td></tr>
                  
                  <tr><th colspan="10" style="background-color:#b9cbe2; color:#000000; text-align:center;">Datos del Responsable de la Caja</th></tr>
                 
                  <tr>
                    <th colspan="2">Asignado a:</th>
                    <td colspan="8" style="text-align:left;"><?=$caja["asignado"]?></td>
                  </tr>

                  <tr>
                    <th colspan="2">Creado por:</th>
                    <td colspan="8" style="text-align:left;"><?=$caja["creado"]?></td>
                  </tr>
                  
                  <tr><td colspan="10" style="background-color:#ffffff"></td></tr>
                  
                  <tr><th colspan="10" style="background-color:#ffffff; color:#000000; font-size:18px;text-align:left;"><strong>INGRESOS</strong></th></tr>
                  
                  <tr>
                    <th colspan="3" style="background-color:#b9cbe2;text-align:center;color:#000000;">Fecha</th>
                    <th colspan="5" style="background-color:#b9cbe2;text-align:center;color:#000000;">Descripción de Ingreso</th>
                    <th colspan="2" style="background-color:#b9cbe2;text-align:center;color:#000000;">Monto S/</th>
                  </tr>

                  <tr>
                    <td colspan="3" style="text-align:center;color:#000000;"><?=$caja["fecha_apertura"]?></td>
                    <td colspan="5" style="text-align:left;color:#000000;">INGRESO INICIAL</td>
                    <td colspan="2" style="text-align:center;color:#000000;"><?=($caja["montoTotal"]-$caja["ultsaldo"])?></td>
                  </tr>

                  <tr>
                    <td colspan="3" style="text-align:center;color:#000000;"><?=$caja["fecha_apertura"]?></td>
                    <td colspan="5" style="text-align:left;color:#000000;">SALDO DE LA CAJA N° <?=$caja["cajaUltSaldo"]?></td>
                    <td colspan="2" style="text-align:center;color:#000000;"><?=($caja["ultsaldo"]=="" ? "0": $caja["ultsaldo"])?></td>
                  </tr>

                  <?php  if (isset($aumentos)): $a=0; ?>
                    <?php foreach ($aumentos as $row){ $a++;?>
                      <tr>
                    <td colspan="3" style="text-align:center;color:#000000;"><?=$row->fecha?></td>
                    <td colspan="5" style="text-align:left;color:#000000;">AUMENTO AL SALDO INICIAL</td>
                    <td colspan="2" style="text-align:center;color:#000000;"><?=$row->monto?></td>
                  </tr>
                  <?php } ?>
                  <?php endif; ?>

                  <tr>
                    <th colspan="8" style="text-align:right;color:#000000;">TOTAL DE INGRESOS</th>
                    <td colspan="2" style="text-align:center;color:#000000;"><?=($caja["montoTotal"]+$aumento)?></td>
                  </tr>

                  <tr><td colspan="10" style="background-color:#ffffff"></td></tr>
                  
                  <tr><th colspan="10" style="background-color:#ffffff; color:#000000; font-size:18px;text-align:left;"><strong>EGRESOS</strong></th></tr>

                  <tr>
                    <th style="background-color:#b9cbe2;text-align:center;color:#000000;">N°</th>
                    <th style="background-color:#b9cbe2;text-align:center;color:#000000;">Fecha</th>
                    <th colspan="2" style="background-color:#b9cbe2;text-align:center;color:#000000;">Factura</th>
                    <th colspan="2" style="background-color:#b9cbe2;text-align:center;color:#000000;">Proyecto</th>
                    <th colspan="2" style="background-color:#b9cbe2;text-align:center;color:#000000;">Proveedor</th>
                    <th colspan="2" style="background-color:#b9cbe2;text-align:center;color:#000000;">Monto S/</th>
                  </tr>

                </thead>
                <tbody>
                  <?php  if (isset($facturas)): $a=0; ?>
                    <?php foreach ($facturas as $row){ $a++;?>
                  <tr>
                    <td class="align-middle"><?=$a?></td>
                    <td class="align-middle"><?=$row->fecha?></td>
                    <td class="align-middle" colspan="2"><?=$row->factura?></td>
                    <td class="align-middle" colspan="2"><?=$row->proyecto?></td>
                    <td class="align-middle" colspan="2"><?=$row->proveedor?></td>
                    <td class="align-middle" colspan="2"><?=$row->totalNeto?></td>
                  </tr>
                  <?php } ?>
                  <?php endif; ?>

                  <tr>
                    <th colspan="8" style="text-align:right;color:#000000;">TOTAL DE FACTURAS</th>
                    <td colspan="2"><?=$consumidoF?></td>
                  </tr>

                  <tr><td colspan="10" style="background-color:#ffffff"></td></tr>
                  
                  <tr>
                    <td></td>
                    <th colspan="8" style="background-color:#b9cbe2; color:#000000; text-align:center;">Calculo de Saldo Final</th>
                    <td></td>
                  </tr>
                  
                  <tr>
                    <td></td>
                    <th colspan="2" style="background-color:#b9cbe2;text-align:center;color:#000000;">Total Facturas S/</th>
                    <th colspan="2" style="background-color:#b9cbe2;text-align:center;color:#000000;">Total Movilidad S/</th>
                    <th colspan="2" style="background-color:#b9cbe2;text-align:center;color:#000000;">Total Ingresos S/</th>
                    <th colspan="2" style="background-color:#b9cbe2;text-align:center;color:#000000;">Saldo Final S/</th>
                    <td></td>
                  </tr>

                  <tr>
                    <td></td>
                    <th colspan="2" style="text-align:center;color:#000000;"><?=$consumidoF?></th>
                    <th colspan="2" style="text-align:center;color:#000000;"><?=$consumidoM?></th>
                    <th colspan="2" style="text-align:center;color:#000000;"><?=($caja["montoTotal"]+$aumento)?></th>
                    <th colspan="2" style="text-align:center;color:#000000;font-size:30px;"><?=(($caja["montoTotal"]+$aumento)-($consumidoF+$consumidoM))?></th>
                    <td></td>
                  </tr>
                  

                </tbody>

              </table>
            </body>
            </html>
