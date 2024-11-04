<?php namespace App\Controllers;
use App\Models\SeguimientoModel;
use App\Models\UsuarioModel;
use App\Models\Usuario_model;
class Auth extends BaseController
{

	public function index()
	{
		return view('login');
	}

  //vista registro redireccionar
  public function vistaRegistro(){
    return view('registro');
  }

  public function vistaRegistro2(){
    return view('registro2');
  }

  //CONTROLADOR REGISTRO
  public function nuevoRegistro(){
    helper(['form','url']);
    $datavalid = [];
    $rules = [
      'nombres' => 'required|min_length[3]|max_length[20]',
      'apellidos' => 'required|min_length[3]|max_length[20]',
      'correo' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[usuarios.correo]',
      'celular' => 'required|numeric|min_length[9]|max_length[9]',
      'password' => 'required|min_length[8]|max_length[255]',
      'confirmar_pasword' => 'matches[password]'
    ];
    if (!$this->validate($rules)) {
      $datavalid['validation'] = $this->validator;
      echo view('registro', $datavalid);
    }else{
      $model = new UsuarioModel();
      $data = [
        "nombres" => $this->request->getVar('nombres'),
        "apellidos" =>$this->request->getVar('apellidos'),
        "celular" =>$this->request->getVar('celular'),
        "correo" =>$this->request->getVar('correo'),
        "password" =>password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
      ];
      $model->save($data);
      $session = session();
      $session->setFlashdata('success', 'Registro Exitoso');
      return redirect()->to(base_url().'/auth');
    }
  }

  public function login(){
    helper(['form','url']);
    $datavalid = [];
    $rules = [
      'correo' => 'required|min_length[6]|max_length[50]|valid_email',
      'password' => 'required|min_length[6]|max_length[255]'
    ];
    if (!$this->validate($rules)) {
      $datavalid['validation'] = $this->validator;
      echo view('login', $datavalid);
    }else{
      $model = new UsuarioModel();
      $correo =$this->request->getVar('correo');
      $password =$this->request->getVar('password');
      $db = \Config\Database::connect();

      $query = $db->query('call listar_usuarioCorreo("'.$correo.'")');
      $usuario = $query->getRowArray();

      if($usuario!=false){

        if(password_verify($password,$usuario['contrasena'])){

          $session=session();
          $session->setFlashdata('correcto', 'Login Correcto');
          $session->set('idUsuario',$usuario['id']);
          $session->set('correo',$correo);
          $session->set('nombre',$usuario['nombre']);
          $session->set('apellido',$usuario['apellido']);
          $session->set('tipo',$usuario['tipo']);
          $session->set('nombretipo',$usuario['tipousuario']);
          $session->setFlashdata('success', 'Bienvenido '.$usuario['nombre'].' '.$usuario['apellido']);
          //GUARDADO DE ACTIVIDAD-----------------
          $hoyguardar = getdate();
          $fechaguardar ="";
          $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
          $guardar = new SeguimientoModel();
          $dataguardar = [
            "usuario" =>session("idUsuario"),
            "accion" =>"INICIO SESIÓN USUARIO: ".$usuario['nombre']." ".$usuario['apellido'],
            "fecha" =>$fechaguardar
          ];
          $guardar->save($dataguardar);
          //-----------------------------------------------

          if($usuario['estado']==2){
            return view('tiempo');
          }

          if($usuario['tipo']==1){
            return redirect()->to(base_url().'/dashboard');
          }elseif($usuario['tipo']==11){
            return view('admcajas/dashboard');
          }else{
            return view('tiempo');
          }

        }else{
          $data['mensaje'] = 'Contraseña Incorrecta';
          echo view('login', $data);
        }
      }else{
        $data['mensaje'] = 'no existe el usuario';
        echo view('login', $data);
      }
    }
  }


  public function logout(){
		//GUARDADO DE ACTIVIDAD-----------------
		$hoyguardar = getdate();
		$fechaguardar ="";
		$fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
		$guardar = new SeguimientoModel();
		$dataguardar = [
			"usuario" =>session("idUsuario"),
			"accion" =>"CERRO SESIÓN USUARIO: ".session('nombre')." ".session('apellido'),
			"fecha" =>$fechaguardar
		];
		$guardar->save($dataguardar);
		//-----------------------------------------------
    $session=session();
    $session->remove('correo');
    $session->remove('nombre');
		$session->remove('idUsuario');
    $session->remove('tipo');
		$session->remove('apellido');
		$session->remove('nombretipo');
    return redirect()->to(base_url().'');
  }
}
