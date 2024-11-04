<?php namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\CatePadreModel;
use App\Models\SeguimientoModel;
use App\Libraries\phpmailer;
use App\Libraries\smtp;
use App\Libraries\pop;
use App\Libraries\exception;
class Dashboard extends BaseController
{

  public function __construct(){
    if(session('correo')==""){
      echo view('login');
    }
  }

	public function index()
	{
    if(session("tipo")==1){
      return view('dashboard');
    }
	}
  public function indexAdminProyecto()
	{
    if(session("tipo")==9){
      return view('adminproyecto/dashboard');
    }
	}
  public function residente()
	{
    if(session("tipo")==8){
      return view('residente/dashboard');
    }
	}
  public function indexJefe()
	{
    if(session("tipo")==2){
      return view('jefeproyecto/dashboard');
    }
	}
  public function indexAuditor()
	{
    if(session("tipo")==5){
      return view('auditor/dashboard');
    }
	}
  public function indexPrevencionista()
	{
    if(session("tipo")==7){
      return view('prevencionista/dashboard');
    }
	}
  public function indexGerencia()
	{
    if(session("tipo")==10){
      return view('gerencia/dashboard');
    }
	}

  public function indexCaja()
	{
    if(session("tipo")==11){
      return view('admcajas/dashboard');
    }
	}

  //-------------------------------------------------------
  private function correosimple($usuario,$info,$cuerpo,$para,$asunto){
    $mail = new PHPMailer(false);
    try {
      //Server settings
      $mail->SMTPDebug = SMTP::DEBUG_OFF;                   //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'mail.ravennaproyectos.pe';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'sistema@ravennaproyectos.pe';                     //SMTP username
      $mail->Password   = 'S1st3m@c01s@v';                               //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
      //Recipients
      $mail->setFrom('sistema@ravennaproyectos.pe', 'Información del Sistema');
      $mail->addAddress($para);     //Add a recipient
      //$mail->addAddress('ellen@example.com');               //Name is optional
      //$mail->addReplyTo('info@example.com', 'Information');
    /*
      foreach ($valor as $val) {
      $mail->addCC($val->correo);
    }*/
      $mail->addCC('antonioravenna@gmail.com');
    // $mail->addBCC('bcc@example.com');
      //Attachments
      //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
      //Content
      $mail->isHTML(true);
      $mail->Subject = $asunto;
      $mail->Body    = '
      <!DOCTYPE html>
        <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
          <head>
          <meta charset="utf-8">
          <meta charset="iso-8859-1">
          <meta name="viewport" content="width=device-width,initial-scale=1">
          <meta name="x-apple-disable-message-reformatting">
          <title></title>
          <style>
            table, td, div, h1, p {
              font-family: Arial, sans-serif;
            }
            @media screen and (max-width: 530px) {
              .unsub {
                display: block;
                padding: 8px;
                margin-top: 14px;
                border-radius: 6px;
                background-color: #555555;
                text-decoration: none !important;
                font-weight: bold;
              }
              .col-lge {
                max-width: 100% !important;
              }
            }
            @media screen and (min-width: 531px) {
              .col-sml {
                max-width: 27% !important;
              }
              .col-lge {
                max-width: 73% !important;
              }
            }
          </style>
          </head>
          <body style="margin:0;padding:0;word-spacing:normal;background-color:#374250;">
          <div role="article" aria-roledescription="email" lang="en" style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#374250;">
            <table role="presentation" style="width:100%;border:none;border-spacing:0;">
              <tr>
                <td align="center" style="padding:0;">
                  <table role="presentation" style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                    <tr>
                      <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                        <a href="" style="text-decoration:none;"><img src="'.base_url().'/plantilla/logo-02.png" width="300" alt="Logo" style="width:80%;max-width:300px;height:auto;border:none;text-decoration:none;color:#ffffff;"></a>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding:30px;background-color:#ffffff;">
                        <h1 style="margin-top:0;margin-bottom:16px;font-size:26px;line-height:32px;font-weight:bold;letter-spacing:-0.02em;">Hola '.$usuario.'! </h1>
                        <p style="margin:0;">'.$info.'</p>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding:35px 30px 11px 30px;font-size:0;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);">
                        <div class="col-sml" style="display:inline-block;width:100%;max-width:145px;vertical-align:top;text-align:left;font-family:Arial,sans-serif;font-size:14px;color:#363636;">
                          <img src="'.base_url().'/plantilla/inf.png" width="115" alt="" style="width:80%;max-width:115px;margin-bottom:20px;">
                        </div>
                        <div class="col-lge" style="display:inline-block;width:100%;max-width:395px;vertical-align:top;padding-bottom:20px;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                          '.$cuerpo.'
                          <p style="margin:0;"><a href="'.base_url().'/" style="background: #b6bf4a; text-decoration: none; padding: 10px 25px; color: #ffffff; border-radius: 4px; display:inline-block; mso-padding-alt:0;text-underline-color:#ff3884"><span style="mso-text-raise:10pt;font-weight:bold;">Ingresar</span></a></p>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding:30px;background-color:#ffffff;">
                        <p style="margin:0;">Este mensaje fue generado por el Sistema Coisav, para notificación del usuario, no olvidar ingresar al sistema para ver la información, <strong>NO DEVOLVER EL MENSAJE </strong></p>
                      </td>
                    </tr>
                    <tr>
                      <td style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                        <p style="margin:0;font-size:14px;line-height:20px;">&reg; Sistema Coisav 2021<br>Desarrollado por: Victor Islachin</a></p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </div>
          </body>
        </html>';
      $mail->send();
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

    //-------------------------------------------------------
    private function enviarcorreo($usuario,$info,$cuerpo,$para){
      $titulo = 'Información del Sistema';
      $mensaje = '<!doctype>
        <html>
          <head>
          <style type="text/css">
                  body {font-family: Verdana, Geneva, sans-serif}
                  .form-group{margin-bottom:1rem}
                  .form-group{display:-ms-flexbox;display:flex;-ms-flex:0 0 auto;flex:0 0 auto;-ms-flex-flow:row wrap;flex-flow:row wrap;-ms-flex-align:center;align-items:center;margin-bottom:0}
                  .form-group label {margin-bottom: 8px;padding-left: 18px;font-size: 13px;font-weight: 500;cursor: pointer;}
                  .form-control{display:block;width:100%;height:calc(1.5em + .75rem + 2px);padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.5;color:#495057;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out}
                  p {font-weight:bold}.btn{display:inline-block;font-weight:400;color:#212529;text-align:center;vertical-align:middle;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-color:transparent;border:1px solid transparent;padding:.375rem .75rem;font-size:1rem;line-height:1.5;border-radius:.25rem;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out}
                  .btn-primary{color:#fff;background-color:#007bff;border-color:#007bff}
                  .btn-primary:hover{color:#fff;background-color:#0069d9;border-color:#0062cc}
                  .btn-primary.focus,.btn-primary:focus{color:#fff;background-color:#0069d9;border-color:#0062cc;box-shadow:0 0 0 .2rem rgba(38,143,255,.5)}
                  .btn-primary.disabled,.btn-primary:disabled{color:#fff;background-color:#007bff;border-color:#007bff}
                  .row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-15px;margin-left:-15px}.col,.col-1,.col-10,.col-11,.col-12,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-auto,.col-lg,.col-lg-1,.col-lg-10,.col-lg-11,.col-lg-12,.col-lg-2,.col-lg-3,.col-lg-4,.col-lg-5,.col-lg-6,.col-lg-7,.col-lg-8,.col-lg-9,.col-lg-auto,.col-md,.col-md-1,.col-md-10,.col-md-11,.col-md-12,.col-md-2,.col-md-3,.col-md-4,.col-md-5,.col-md-6,.col-md-7,.col-md-8,.col-md-9,.col-md-auto,.col-sm,.col-sm-1,.col-sm-10,.col-sm-11,.col-sm-12,.col-sm-2,.col-sm-3,.col-sm-4,.col-sm-5,.col-sm-6,.col-sm-7,.col-sm-8,.col-sm-9,.col-sm-auto,.col-xl,.col-xl-1,.col-xl-10,.col-xl-11,.col-xl-12,.col-xl-2,.col-xl-3,.col-xl-4,.col-xl-5,.col-xl-6,.col-xl-7,.col-xl-8,.col-xl-9,.col-xl-auto{position:relative;width:100%;padding-right:15px;padding-left:15px}.col{-ms-flex-preferred-size:0;flex-basis:0;-ms-flex-positive:1;flex-grow:1;max-width:100%}
          </style>
          </head>
          <body style="background-color:#374250; text-align:center!important">
            <div style="padding-top:3rem!important;">
            <img src="'.base_url().'/plantilla/logo-02.png" alt="Card image">
            </div>
            <section style="display:block; text-align:center!important; width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto;">
            <h3 style="color:white;">Hola, '.$usuario.'</h3>
            <h4 style="color:white;">'.$info.'</h4>
            '.$cuerpo.'
            <h4 style="color:#dcd53f;">Para ingresar al sistema de click al siguiente boton</h4>
            <a href="'.base_url().'/" class="btn btn-primary" style="color:white;text-decoration:none;">INGRESAR</a>
            <div class="row">
              <div class="col-6" style="text-align:center!important;">
              <h5 style="color:#0094c8;">
              MENSAJE GENERADO POR SISTEMA COISAV NO RESPONDER
              </h5>
              </div>
              <div class="col-6">
              <img src="'.base_url().'/plantilla/logo.png" alt="Card image">
              </div>
            </div>
            </section>
          </body>
        </html>';
      $email = \Config\Services::email();
      $email->setTo($para);
      $email->setFrom('sistemacoisav','Información del Sistema');
      $email->setSubject($titulo);
      $email->setMessage($mensaje);
      if($email->send()){
        return true;
      }else{
        return false;
      }
    }
  

  //-------------------------------------------------------
  public function jaja(){
      /*
      $para ="islachinvictor7@gmail.com";
      $asunto = "mensaje de prueba del sistema";
      $info = "se inserto un nuevo dato de prueba esta es una prueba ajajjaja";
      $usuario = "Victor Islachin";
      $cuerpo = '
  <p style="margin-top:0;margin-bottom:12px;"><strong># de Solicitud:</strong> 19</p>
  <p style="margin-top:0;margin-bottom:18px;"><strong>Tipo de Transferencia:</strong> Devolución al Almacén</p>
  <p style="margin-top:0;margin-bottom:18px;"><strong>Fecha de creación:</strong> 2021-05-20</p>
  <p style="margin-top:0;margin-bottom:18px;"><strong>Responsable:</strong> Victor Islachin</p>
      ';
      if($this->correosimple($usuario,$info,$cuerpo,$para,$asunto)==true){
        echo "siiii insertalo de leyr";
      }else{
        echo "no mal trabajo";
      }
      */
  $db = \Config\Database::connect();


    /*
    $query1 = $db->query("
    CREATE INDEX SeguimientoUsuario ON seguimiento(usuario);
    ");  
    */


 $query1 = $db->query("DROP procedure listar_usuariosAsignar");

   $query2 = $db->query("
 CREATE procedure listar_usuariosAsignar()
        BEGIN
          SELECT * 
		    FROM usuario
           WHERE tipousuario IN (1,8) 
		  	 AND estado != 0;
        END;

    ");


      //solo para querys jaja
/*
      $query1 = $db->query("
      ALTER TABLE aumentoCaja add column observacion varchar(500)
      ");
*/
      /*
      $query1 = $db->query("
      INSERT INTO tipoUsuario (id, nombre, descripcion) VALUES (11, 'Administrado Caja Chica', 'Caja Chica');
      ");
      */

      /*
      $query1 = $db->query("

      create table aumentoCaja(
        id int primary key auto_increment,
        monto decimal(18,2),
        fecha date
      );

      ");
      */

     
/*
      $query1 = $db->query('create table cajaChicaC(
        id int primary key auto_increment,
        codigo varchar(100),
        fecha_apertura date,
        decimal(18,2),
        usuario int,
        idmaterial int,
        unique u_codigo(codigo,usuario),
        INDEX(usuario),
        INDEX(idmaterial),
        FOREIGN KEY (usuario) REFERENCES usuario(id),
        FOREIGN KEY (idmaterial) REFERENCES material_equipo(id)
      );');
      
      */
  
  //$query1 = $db->query('ALTER TABLE usuario add estado int');
  //$query1 = $db->query('ALTER TABLE movilidad modify monto decimal(18,2)');
  //$query1 = $db->query('update transferencia set verificador=2 where id=111');
  //$query1 = $db->query("INSERT INTO tipoUsuario (id, nombre, descripcion) VALUES (11, 'Administrado Caja Chica', 'Caja Chica')");
  //$query1 = $db->query('update usuario set estado = 1');
  //$query1 = $db->query('update tipoUsuario set nombre = "Cajero" where id=11');
  //$query1 = $db->query('INSERT INTO tipoInventario (id, nombre) VALUES (NULL, "PERSONALIZADO")');
 // $query1 = $db->query('delete from usuario where id IN (4,9,15,18) ');
  //$query1 = $db->query('delete from detalleCompra where compra=61 and materialEquipo=647 ');
  //$query1 = $db->query('delete FROM detalleFactura WHERE factura=14');
  //$query1 = $db->query('update cajaChicaC set totalConsumido=30 where id=3');
  //$query1 = $db->query('delete from usuario where id IN (19)');
  //$results1 = $query1->getResult();
  //$valor=0.00;  
// $query1 = $db->query('delete from seguimiento');

  //echo var_dump($results1);
  /*
  $query1 = $db->query("delete from factura");
  $results1 = $query1->getResult();
*/

//$query1 = $db->query('update tipoUsuario set nombre = "Administrador de Caja Chica" WHERE id = 11');

/*
$query1 = $db->query("

SELECT * FROM usuario
          WHERE tipousuario IN (1,8) 
		  	AND estado != 0;


");
$results1 = $query1->getResult();

  foreach ($results1 as $row) {
    echo '('.$row->id.'|'.$row->apellido.'|'.$row->estado.')<br>';
  }

*/

  //echo "listo";
  //echo var_dump($results1);
  /*
      foreach ($results1 as $row) {
      echo 'id '.$row->id.'- dato '.$row->verificador.'<br>';
      }
  
  $id = 123;
  $idSanetizado = filter_var( $id,FILTER_SANITIZE_NUMBER_INT );

  echo $idSanetizado;
  */
    }

  }

  