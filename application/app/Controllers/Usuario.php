<?php namespace App\Controllers;
use App\Models\UsuarioModel;
use App\Models\SeguimientoModel;
class Usuario extends BaseController
{

  //funcion inicial
  public function index(){
    $db = \Config\Database::connect();
    $query = $db->query('call listar_usuariosActivos()');
    $results = $query->getResult();
    $data['lista'] = $results;
    if(session("tipo")==11){
      echo view('admcajas/listaUsuarios', $data);
    }elseif(session("tipo")==10){
      echo view('gerencia/listaUsuarios', $data);
    }
  }
  //------------------------------------------------------

  public function nuevoUsuario(){
    $db = \Config\Database::connect();
    $querytipo = $db->query('SELECT * FROM tipoUsuario where id<>4');
    $tiposde = $querytipo->getResult();
    $data['tipos'] = $tiposde;
    return view('admcajas/registroUsuario',$data);
  }
  //----------------------------------------------------------

  public function registrarUsuario(){
    $db = \Config\Database::connect();
    helper(['form','url']);
    $datavalid = [];
    $rules = [
      'nombre'            => 'required|min_length[3]|max_length[20]',
      'apellido'          => 'required|min_length[3]|max_length[20]',
      'correo'            => 'required|min_length[6]|max_length[50]|valid_email|is_unique[usuario.correo]',
      'celular'           => 'required|numeric|min_length[9]|max_length[9]',
      'tipousuario'       => 'required|is_natural_no_zero|numeric',
      'password'          => 'required|min_length[8]|max_length[255]',
      'confirmar_password'=> 'matches[password]'
    ];
    if (!$this->validate($rules)) {
      $querytipo = $db->query('SELECT * FROM tipoUsuario where id<>4');
      $tiposde = $querytipo->getResult();
      $datavalid = [
        'validation' => $this->validator,
        'tipos' => $tiposde
      ];
      echo view('admcajas/registroUsuario', $datavalid);
    }else{
      $model = new UsuarioModel();

      $data = [
        "nombre"      => $this->request->getVar('nombre'),
        "apellido"    => $this->request->getVar('apellido'),
        "celular"     => $this->request->getVar('celular'),
        "correo"      => $this->request->getVar('correo'),
        "contrasena"  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        "tipousuario" => $this->request->getVar('tipousuario'),
        "estado"      => 1
      ];

      $model->save($data);

      //GUARDADO DE ACTIVIDAD-----------------
      $hoyguardar = getdate();
      $fechaguardar ="";
      $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
      $guardar = new SeguimientoModel();
      $dataguardar = [
        "usuario" =>session("idUsuario"),
        "accion" =>"SE REGISTRO AL USUARIO CON: ".$this->request->getVar('nombre')." ".$this->request->getVar('apellido'),
        "fecha" =>$fechaguardar
      ];
      $guardar->save($dataguardar);
      //-----------------------------------------------

      $query = $db->query('call listar_usuariosActivos()');
      $results = $query->getResult();
      $data = [
        "lista"     =>$results,
        "correcto"  =>"Registrado Correctamente"
      ];
      echo view('admcajas/listaUsuarios', $data);

    }
  }
  //------------------------------------------------------------

  public function actuUsuario(){
    $id = $this->request->getGet('id');
    $db = \Config\Database::connect();

    if($id==""){
      return redirect()->to(base_url().'/usuario');
    }else{
      
      $query1 = $db->query("SELECT * FROM usuario where id=".$id);
      $results1 = $query1->getRowArray();
      $querytipo = $db->query('SELECT * FROM tipoUsuario where id<>4');
      $tiposde = $querytipo->getResult();
      $data =[
        "usuario" => $results1,
        "tipos" => $tiposde
      ];

      if(session("tipo")==1){
        return view('actualizaUsuario2',$data);
      }elseif(session("tipo")==2){
        echo view('jefeproyecto/actualizaUsuario2', $data);
      }elseif(session("tipo")==8){
        echo view('residente/actualizaUsuario2', $data);
      }elseif(session("tipo")==9){
        echo view('adminproyecto/actualizaUsuario2', $data);
      }elseif(session("tipo")==5){
        echo view('auditor/actualizaUsuario2', $data);
      }elseif(session("tipo")==7){
        echo view('prevencionista/actualizaUsuario2', $data);
      }elseif(session("tipo")==10){
        echo view('gerencia/actualizaUsuario2', $data);
      }elseif(session("tipo")==11){
        echo view('admcajas/actualizaUsuario2', $data);
      }
    }
  }
  //----------------------------------------------------------------

  public function actuUsuarioAdm(){
    $id = $this->request->getGet('id');

    if($id==""){
      return redirect()->to(base_url().'/usuario');
    }else{
      $db = \Config\Database::connect();
      $query1 = $db->query("SELECT * FROM usuario where id=".$id);
      $results1 = $query1->getRowArray();
      $querytipo = $db->query('SELECT * FROM tipoUsuario where id<>4');
      $tiposde = $querytipo->getResult();
      $data =[
        "usuario" => $results1,
        "tipos" => $tiposde
      ];

      if(session("tipo")==11){
        return view('admcajas/actualizaUsuario',$data);
      }

    }
  }
  //----------------------------------------------------------------

  public function actualizarUsuario(){
    helper(['form','url']);
    $datavalid = [];
    $concambio = $this->request->getVar('cambiar');

    if($concambio=="si"){
      $rules = [
        'nombre' => 'required|min_length[3]|max_length[20]',
        'apellido' => 'required|min_length[3]|max_length[20]',
        'correo' => 'required|min_length[6]|max_length[50]|valid_email',
        'celular' => 'required|numeric|min_length[9]|max_length[9]',
        'tipousuario' => 'required|is_natural_no_zero|numeric',
        'password' => 'required|min_length[8]|max_length[255]',
        'confirmar_password' => 'matches[password]'
      ];

      if (!$this->validate($rules)) {
        $id = $this->request->getVar('id');
        $db = \Config\Database::connect();
        $query1 = $db->query("SELECT * FROM usuario where id=".$id);
        $results1 = $query1->getRowArray();
        $querytipo = $db->query('SELECT * FROM tipoUsuario where id<>4');
        $tiposde = $querytipo->getResult();

        $datavalid =[
          "validation"  => $this->validator,
          "usuario"     => $results1,
          "tipos"       =>$tiposde
        ];

        if(session("tipo")==1){
          return view('actualizaUsuario2',$datavalid);
        }elseif(session("tipo")==2){
          echo view('jefeproyecto/actualizaUsuario2', $datavalid);
        }elseif(session("tipo")==8){
          echo view('residente/actualizaUsuario2', $datavalid);
        }elseif(session("tipo")==9){
          echo view('adminproyecto/actualizaUsuario2', $datavalid);
        }elseif(session("tipo")==5){
          echo view('auditor/actualizaUsuario2', $datavalid);
        }elseif(session("tipo")==7){
          echo view('prevencionista/actualizaUsuario2', $datavalid);
        }elseif(session("tipo")==10){
          echo view('gerencia/actualizaUsuario2', $datavalid);
        }elseif(session("tipo")==11){
          echo view('admcajas/actualizaUsuario2', $datavalid);
        }

      }else{

        $model = new UsuarioModel();
        $id = $this->request->getVar('id');
        $data = [
          "nombre" => $this->request->getVar('nombre'),
          "apellido" =>$this->request->getVar('apellido'),
          "celular" =>$this->request->getVar('celular'),
          "correo" =>$this->request->getVar('correo'),
          "contrasena" =>password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
          "tipousuario" =>$this->request->getVar('tipousuario')
        ];

        $model->update($id,$data);

        $dato = [
          "msj"=>"Actualizado"
        ];

        if(session("tipo")==1){
          return view('dashboard',$dato);
        }elseif(session("tipo")==2){
          echo view('jefeproyecto/dashboard', $dato);
        }elseif(session("tipo")==8){
          echo view('residente/dashboard', $dato);
        }elseif(session("tipo")==9){
          echo view('adminproyecto/dashboard', $dato);
        }elseif(session("tipo")==5){
          echo view('auditor/dashboard', $dato);
        }elseif(session("tipo")==7){
          echo view('prevencionista/dashboard', $dato);
        }elseif(session("tipo")==10){
          echo view('gerencia/dashboard', $dato);
        }elseif(session("tipo")==11){
          echo view('admcajas/dashboard', $dato);
        }

      }

    }else{

      $rules = [
        'nombre' => 'required|min_length[3]|max_length[20]',
        'apellido' => 'required|min_length[3]|max_length[20]',
        'correo' => 'required|min_length[6]|max_length[50]|valid_email',
        'celular' => 'required|numeric|min_length[9]|max_length[9]',
        'tipousuario' => 'required|is_natural_no_zero|numeric'
      ];

      if (!$this->validate($rules)) {

        $id = $this->request->getVar('id');
        $db = \Config\Database::connect();
        $query1 = $db->query("SELECT * FROM usuario where id=".$id);
        $results1 = $query1->getRowArray();
        $querytipo = $db->query('SELECT * FROM tipoUsuario where id<>4');
        $tiposde = $querytipo->getResult();

        $datavalid =[
          "validation" => $this->validator,
          "usuario" => $results1,
          "tipos"=>$tiposde
        ];

        if(session("tipo")==1){
          return view('actualizaUsuario2',$datavalid);
        }elseif(session("tipo")==2){
          echo view('jefeproyecto/actualizaUsuario2', $datavalid);
        }elseif(session("tipo")==8){
          echo view('residente/actualizaUsuario2', $datavalid);
        }elseif(session("tipo")==9){
          echo view('adminproyecto/actualizaUsuario2', $datavalid);
        }elseif(session("tipo")==5){
          echo view('auditor/actualizaUsuario2', $datavalid);
        }elseif(session("tipo")==7){
          echo view('prevencionista/actualizaUsuario2', $datavalid);
        }elseif(session("tipo")==10){
          echo view('gerencia/actualizaUsuario2', $datavalid);
        }elseif(session("tipo")==11){
          echo view('admcajas/actualizaUsuario2', $datavalid);
        }

      }else{

        $model = new UsuarioModel();
        $id = $this->request->getVar('id');
        $data = [
          "nombre"      => $this->request->getVar('nombre'),
          "apellido"    =>$this->request->getVar('apellido'),
          "celular"     =>$this->request->getVar('celular'),
          "correo"      =>$this->request->getVar('correo'),
          "tipousuario" =>$this->request->getVar('tipousuario')
        ];
        $model->update($id,$data);

        //GUARDADO DE ACTIVIDAD-----------------
        $hoyguardar = getdate();
        $fechaguardar ="";
        $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
        $guardar = new SeguimientoModel();
        $dataguardar = [
          "usuario" =>session("idUsuario"),
          "accion" =>"SE EDITO EL USUARIO CON ID ".session("idUsuario"),
          "fecha" =>$fechaguardar
        ];
        $guardar->save($dataguardar);
        //-----------------------------------------------

        $dato = [
          "msj"=>"Actualizado"
        ];

        if(session("tipo")==1){
          return view('dashboard',$dato);
        }elseif(session("tipo")==2){
          echo view('jefeproyecto/dashboard', $dato);
        }elseif(session("tipo")==8){
          echo view('residente/dashboard', $dato);
        }elseif(session("tipo")==9){
          echo view('adminproyecto/dashboard', $dato);
        }elseif(session("tipo")==5){
          echo view('auditor/dashboard', $dato);
        }elseif(session("tipo")==7){
          echo view('prevencionista/dashboard', $dato);
        }elseif(session("tipo")==10){
          echo view('gerencia/dashboard', $dato);
        }elseif(session("tipo")==11){
          echo view('admcajas/dashboard', $dato);
        }

      }
    }
  }
  //-------------------------------------------------------------

  public function actualizarUsuarioAdm(){
    helper(['form','url']);
    $datavalid = [];
    $concambio = $this->request->getVar('cambiar');
    $db = \Config\Database::connect();

    if($concambio=="si"){
      $rules = [
        'nombre' => 'required|min_length[3]|max_length[20]',
        'apellido' => 'required|min_length[3]|max_length[20]',
        'correo' => 'required|min_length[6]|max_length[50]|valid_email',
        'celular' => 'required|numeric|min_length[9]|max_length[9]',
        'tipousuario' => 'required|is_natural_no_zero|numeric',
        'password' => 'required|min_length[8]|max_length[255]',
        'confirmar_password' => 'matches[password]'
      ];

      if (!$this->validate($rules)) {

        $id = $this->request->getVar('id');
        $query1 = $db->query("SELECT * FROM usuario where id=".$id);
        $results1 = $query1->getRowArray();
        $querytipo = $db->query('SELECT * FROM tipoUsuario where id<>4');
        $tiposde = $querytipo->getResult();

        $datavalid =[
          "validation"  => $this->validator,
          "usuario"     => $results1,
          "tipos"       =>$tiposde
        ];

        if(session("tipo")==11){
          echo view('admcajas/actualizaUsuario', $datavalid);
        }

      }else{

        $model = new UsuarioModel();
        $id = $this->request->getVar('id');
        $data = [
          "nombre" => $this->request->getVar('nombre'),
          "apellido" =>$this->request->getVar('apellido'),
          "celular" =>$this->request->getVar('celular'),
          "correo" =>$this->request->getVar('correo'),
          "contrasena" =>password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
          "tipousuario" =>$this->request->getVar('tipousuario')
        ];

        $model->update($id,$data);

        $query = $db->query('call listar_usuariosActivos()');
        $results = $query->getResult();
        $dato = [
          "lista"     =>$results,
          "correcto"  =>"Actualizado"
        ];
        echo view('admcajas/listaUsuarios', $dato);

      }

    }else{

      $rules = [
        'nombre' => 'required|min_length[3]|max_length[20]',
        'apellido' => 'required|min_length[3]|max_length[20]',
        'correo' => 'required|min_length[6]|max_length[50]|valid_email',
        'celular' => 'required|numeric|min_length[9]|max_length[9]',
        'tipousuario' => 'required|is_natural_no_zero|numeric'
      ];

      if (!$this->validate($rules)) {

        $id = $this->request->getVar('id');
        $query1 = $db->query("SELECT * FROM usuario where id=".$id);
        $results1 = $query1->getRowArray();
        $querytipo = $db->query('SELECT * FROM tipoUsuario where id<>4');
        $tiposde = $querytipo->getResult();

        $datavalid =[
          "validation" => $this->validator,
          "usuario" => $results1,
          "tipos"=>$tiposde
        ];

        if(session("tipo")==11){
          echo view('admcajas/actualizaUsuario', $datavalid);
        }

      }else{

        $model = new UsuarioModel();
        $id = $this->request->getVar('id');
        $data = [
          "nombre"      => $this->request->getVar('nombre'),
          "apellido"    =>$this->request->getVar('apellido'),
          "celular"     =>$this->request->getVar('celular'),
          "correo"      =>$this->request->getVar('correo'),
          "tipousuario" =>$this->request->getVar('tipousuario')
        ];
        $model->update($id,$data);

        //GUARDADO DE ACTIVIDAD-----------------
        $hoyguardar = getdate();
        $fechaguardar ="";
        $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
        $guardar = new SeguimientoModel();
        $dataguardar = [
          "usuario" =>session("idUsuario"),
          "accion" =>"SE EDITO EL USUARIO CON ID ".session("idUsuario"),
          "fecha" =>$fechaguardar
        ];
        $guardar->save($dataguardar);
        //-----------------------------------------------

        $query = $db->query('call listar_usuariosActivos()');
        $results = $query->getResult();
        $dato = [
          "lista"     =>$results,
          "correcto"  =>"Actualizado"
        ];
        echo view('admcajas/listaUsuarios', $dato);

      }
    }
  }

  //-------------------------------------------------------------
  public function activando(){
    $db = \Config\Database::connect();
    $id = $this->request->getPost('id');
    $model = new UsuarioModel();
    $query1 = $db->query('select * from usuario where id='.$id);
    $usuario= $query1->getRowArray();
      $msj="";
    try{
      if($usuario["estado"]==0 || $usuario["estado"]==1){
        $msj="error";
      }else{
        $msj="activando";
        $data = [
          "estado" => 1
        ];
        $model->update($id,$data);
      }
    }catch(\Exception $e){
      $msj="";
    }
    echo json_encode($msj);
    exit();
  }

  //-------------------------------------------------------------

  public function desactivando(){
    $db = \Config\Database::connect();
    $id = $this->request->getPost('id');
    $model = new UsuarioModel();
    $query1 = $db->query('select * from usuario where id='.$id);
    $usuario= $query1->getRowArray();
      $msj="";
    try{
      if($usuario["estado"]!=0 && $usuario["estado"]==1){
        $msj="desactivando";
        $data = [
          "estado" => 2
        ];
        $model->update($id,$data);
      }else{
        $msj="error";
      }
    }catch(\Exception $e){
      $msj="";
    }
    echo json_encode($msj);
    exit();
  }
  //-------------------------------------------------------------

  public function eliminarUsuario(){
    $id = $this->request->getGet('id');
    $db = \Config\Database::connect();

    if($id==""){
      return redirect()->to(base_url().'/usuario');
    }else{
      try{
        $model = new UsuarioModel();
        $data = [
          "estado" => 0
        ];
        $model->update($id,$data);

        //GUARDADO DE ACTIVIDAD-----------------
        $hoyguardar = getdate();
        $fechaguardar ="";
        $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
        $guardar = new SeguimientoModel();
        $dataguardar = [
          "usuario" =>session("idUsuario"),
          "accion" =>"SE ELIMINO AL USUARIO CON ID ".$id,
          "fecha" =>$fechaguardar
        ];
        $guardar->save($dataguardar);
        //-----------------------------------------------
        
        $query = $db->query('call listar_usuariosActivos()');
        $results = $query->getResult();
        $dato = [
          "lista"     =>$results,
          "correcto"  =>"Eiminado Correctamente"
        ];
        echo view('admcajas/listaUsuarios', $dato);

      }catch(\Exception $e){
        
        $query = $db->query('call listar_usuariosActivos()');
        $results = $query->getResult();
        $data = [
          "lista" => $results,
          "errorBDD" =>"Error al Eliminar"
        ];
        echo view('admcajas/listaUsuarios', $data);
      }
    }
  }
  //--------------------------------------------------------------------


}
