<?php namespace App\Controllers;
use App\Models\CajaChicaCModel;
use App\Models\ProyectoTempModel;
use App\Models\ProveedorTempModel;
use App\Models\SeguimientoModel;
use App\Models\previoDetalleFacturaModel;
use App\Models\FacturaModel;
use App\Models\DetalleFacturaModel;
use App\Models\MovilidadModel;
use App\Models\RefrigerioModel;
use App\Models\AumentoModel;

class CajaChicac extends BaseController
{

    public function __construct(){
      if(session('correo')==""){
        echo view('login');
      }
    }

    //--------------------------------------------

    public function index(){
        $db = \Config\Database::connect();

        $numeroregi = 9;
        $pag = 1;
        $empieza = ($pag-1)*$numeroregi;

        $queryT = $db->query("call listar_cajachicaC_total(0,-1)");
        $cajasT = $queryT->getResult();

        $query = $db->query("call listar_cajachicaC_total(".$empieza.",".$numeroregi.")");
        $cajas = $query->getResult();

        $query2 = $db->query("call listar_usuariosFiltro()");
        $usuariosFiltro = $query2->getResult();

        $query3 = $db->query("call listar_usuariosAsignar()");
        $usuarios = $query3->getResult();

        $query4T = $db->query("call listar_cajachicaC_porUsuario(".session("idUsuario").",0,-1)");
        $cajasAsigT = $query4T->getResult();

        $query4 = $db->query("call listar_cajachicaC_porUsuario(".session("idUsuario").",".$empieza.",".$numeroregi.")");
        $cajasAsig = $query4->getResult();

        $query5 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
        $proyectos = $query5->getResult();

        $totalRegistros = count($cajasT);
        $totalPaginas = ceil($totalRegistros/$numeroregi);

        $totalRegistros2 = count($cajasAsigT);
        $totalPaginas2 = ceil($totalRegistros2/$numeroregi);

        $hoy = date("d/m/Y");     

        if(session("tipo")==11 || session("tipo")==10){
          $data = [
            "lista"       => $cajas,
            "usuarios"    => $usuariosFiltro,
            "usuarioAsig" => $usuarios,
            "fecha"       => $hoy,
            "numero"      => (count($cajasT)+1),
            "pagi"        => $totalPaginas,
            "proyectos"   => $proyectos
          ];
        }

        if(session("tipo")==1 || session("tipo")==8){
          $data = [
            "lista" => $cajasAsig,
            "pagi"  => $totalPaginas2
          ];
        }

        switch(session("tipo")){
          case 1:  echo view('listaCajas', $data);
            break;
          case 8:  echo view('residente/listaCajas', $data);
            break;
          case 10:  echo view('gerencia/listaCajas', $data);
            break;
          case 11:  echo view('admcajas/listaCajas', $data);
            break;
          default:  return redirect()->to(base_url().'');
        }

    }

    //--------------------------------------------

    public function pagina(){

      helper(['form','url']);
      $numeroregi = 9;
      $pag = "";
      $filtro = "";

      if(isset($filtro)){
        $filtro = $this->request->getPost('filtro');
      }else{
        $filtro = "";
      }

      if(isset($pag)){
        $pag = $this->request->getPost('pag');
      }else{
        $pag = 1;
      }

      $empieza = ($pag-1)*$numeroregi;

      $respuestas = "";
      $cajas = null;

      $db = \Config\Database::connect();

      if(session("tipo")==11 || session("tipo")==10){
        if($filtro != ""){
          $query = $db->query("call listar_cajachicaC_porUsuario(".$filtro.",".$empieza.",".$numeroregi.")");
          $cajas = $query->getResult();
        }else{
          $query = $db->query("call listar_cajachicaC_total(".$empieza.",".$numeroregi.")");
          $cajas = $query->getResult();
        }
        
      }else{
        $query = $db->query("call listar_cajachicaC_porUsuario(".session("idUsuario").",".$empieza.",".$numeroregi.")");
        $cajas = $query->getResult();
      }

      foreach ($cajas as $row){
          
      $respuestas.='
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
                      <a class="editar dropdown-item" href="'.base_url().'/cajaChicac/detalleCaja/'.$row->id.'">Revisar</a>';

       
        
        if($row->estado == "Abierta" && session("tipo")==11){
          $respuestas.='             
                      <a class="editar dropdown-item" data-toggle="modal" data-target="#edicion" href="" valor="'.$row->id.'" >Editar</a>
                      <a class="aumentar dropdown-item" data-toggle="modal" data-target="#aumentar" href="" valor="'.$row->id.'" >Aumentar</a>
                      <a class="cerrar dropdown-item" data-toggle="modal" data-target="#cerrar" href="" valor="'.$row->id.'">Cerrar</a>
                    ';
          
        }

        if(session("tipo")==11){
          $respuestas.='             
          <a class="dropdown-item" href="'.base_url().'/cajaChicac/excelDetalladoCaja/'.$row->id.'"><i class="far fa-file-excel"></i> Exportar</a>';
        }

      $respuestas.=' 
                  </div>
                </div>
              </div>

              <div class="col-3 py-2">
                <h1 class="display-4 card-title"><i class="fas fa-cash-register"></i>&nbsp;</h1>
              </div>

              <div class="col-7 text-left">
                <p><strong>N°   :</strong> '.$row->codigo.'<br>
                  <strong>Asign:</strong>  '.$row->asignado_card.'<br>
                  <strong>Fecha:</strong>  '.$row->fecha_apertura.'</p>
              </div>
              <div class="col-sm-12 text-center">';

        if($row->estado == "Abierta"){
          $respuestas.='<h4 class="text-success">'.$row->estado.'</h4>';
        }else{
          $respuestas.='<h4 class="text-danger">'.$row->estado.'</h4>';
        }

      
      $respuestas.='           
              </div>
            </div>
          </div>
        </div>
      </div>';
        }
        
      $envio = [
        "html" => $respuestas
      ];

      echo json_encode($envio);
      exit();

    }

    //--------------------------------------------

    public function filtrar(){
      $db = \Config\Database::connect();

      $numeroregi = 9;
      $pag = 1;
      $empieza = ($pag-1)*$numeroregi;
      
      $usu = $this->request->getPost('filusuario');

      if($usu == ""){

        return redirect()->to(base_url().'/cajaChicac');

      }else{

        $query2 = $db->query("call listar_usuariosFiltro()");
        $usuariosFiltro = $query2->getResult();

        $query3 = $db->query("call listar_usuariosAsignar()");
        $usuarios = $query3->getResult();

        $query4T = $db->query("call listar_cajachicaC_porUsuario(".$usu.",0,-1)");
        $cajasAsigT = $query4T->getResult();

        $query5 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
        $proyectos = $query5->getResult();

        $totalRegistros = count($cajasAsigT);
        $totalPaginas = ceil($totalRegistros/$numeroregi);


        $hoy = date("d/m/Y");     

        if(session("tipo")==11 || session("tipo")==10){
          $data = [
            "lista"       => $cajasAsigT,
            "usuarios"    => $usuariosFiltro,
            "usuarioAsig" => $usuarios,
            "fecha"       => $hoy,
            "numero"      => (count($cajasAsigT)+1),
            "pagi"        => $totalPaginas,
            "fil"         => $usu,
            "proyectos"   => $proyectos
          ];
        }

        switch(session("tipo")){
          case 10:  echo view('gerencia/listaCajas', $data);
            break;
          case 11:  echo view('admcajas/listaCajas', $data);
            break;
          default:  return redirect()->to(base_url().'');
        }

      }

    }

    //--------------------------------------------

    public function nuevaCaja(){
        $db = \Config\Database::connect();
        if($this->request->getMethod()=="post"){
          helper(['form','url']);
          $datavalid = [];
          $rules = [
            'asig' => 'required|numeric',
            'montoTotal' => 'required|decimal',
            'montoCompra' => 'required|decimal'
          ];

          $queryValida = $db->query("call listar_cajachicaC_porUsuario_Activas(".$this->request->getPost('asig').")");
          $cajasExistente = $queryValida->getResult();

          $queryValida2 = $db->query("call listar_usuariosAsignar()");
          $listaTips = $queryValida2->getResult();

          $tipusu = 0;

          foreach($listaTips as $valor){
            if($this->request->getPost('asig') == $valor->id){
              $tipusu = $valor->tipousuario;
            }
          }

          if(!$this->validate($rules)) {

            $numeroregi = 9;
            $pag = 1;
            $empieza = ($pag-1)*$numeroregi;
    
            $queryT = $db->query("call listar_cajachicaC_total(0,-1)");
            $cajasT = $queryT->getResult();
    
            $query = $db->query("call listar_cajachicaC_total(".$empieza.",".$numeroregi.")");
            $cajas = $query->getResult();
    
            $query2 = $db->query("call listar_usuariosFiltro()");
            $usuariosFiltro = $query2->getResult();
    
            $query3 = $db->query("call listar_usuariosAsignar()");
            $usuarios = $query3->getResult();

            $query5 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
            $proyectos = $query5->getResult();

            $totalRegistros = count($cajasT);
            $totalPaginas = ceil($totalRegistros/$numeroregi);
    
            $hoy = date("d/m/Y");     
    
            if(session("tipo")==11){
              $datavalid = [
                "lista"       => $cajas,
                "usuarios"    => $usuariosFiltro,
                "usuarioAsig" => $usuarios,
                "fecha"       => $hoy,
                "numero"      => (count($cajasT)+1),
                "pagi"        => $totalPaginas,
                "proyectos"   => $proyectos,
                "validation"  => $this->validator
              ];
    
              echo view('admcajas/listaCajas',$datavalid);
            }
            
          }elseif($tipusu == 8 && $this->request->getPost('proyecto')==""){

            $numeroregi = 9;
            $pag = 1;
            $empieza = ($pag-1)*$numeroregi;
    
            $queryT = $db->query("call listar_cajachicaC_total(0,-1)");
            $cajasT = $queryT->getResult();
    
            $query = $db->query("call listar_cajachicaC_total(".$empieza.",".$numeroregi.")");
            $cajas = $query->getResult();
    
            $query2 = $db->query("call listar_usuariosFiltro()");
            $usuariosFiltro = $query2->getResult();
    
            $query3 = $db->query("call listar_usuariosAsignar()");
            $usuarios = $query3->getResult();

            $query5 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
            $proyectos = $query5->getResult();

            $totalRegistros = count($cajasT);
            $totalPaginas = ceil($totalRegistros/$numeroregi);
    
            $hoy = date("d/m/Y");     
    
            if(session("tipo")==11){
              $data = [
                "lista"       => $cajas,
                "usuarios"    => $usuariosFiltro,
                "usuarioAsig" => $usuarios,
                "fecha"       => $hoy,
                "numero"      => (count($cajasT)+1),
                "pagi"        => $totalPaginas,
                "proyectos"   => $proyectos,
                "mensaje"     => "Debe seleccionar un proyecto para el Residente"
              ];
    
              echo view('admcajas/listaCajas',$data);
            }
    

          }elseif($cajasExistente != null){

            $numeroregi = 9;
            $pag = 1;
            $empieza = ($pag-1)*$numeroregi;
    
            $queryT = $db->query("call listar_cajachicaC_total(0,-1)");
            $cajasT = $queryT->getResult();
    
            $query = $db->query("call listar_cajachicaC_total(".$empieza.",".$numeroregi.")");
            $cajas = $query->getResult();
    
            $query2 = $db->query("call listar_usuariosFiltro()");
            $usuariosFiltro = $query2->getResult();
    
            $query3 = $db->query("call listar_usuariosAsignar()");
            $usuarios = $query3->getResult();

            $query5 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
            $proyectos = $query5->getResult();

            $totalRegistros = count($cajasT);
            $totalPaginas = ceil($totalRegistros/$numeroregi);
    
            $hoy = date("d/m/Y");     
    
            if(session("tipo")==11){
              $data = [
                "lista"       => $cajas,
                "usuarios"    => $usuariosFiltro,
                "usuarioAsig" => $usuarios,
                "fecha"       => $hoy,
                "numero"      => (count($cajasT)+1),
                "pagi"        => $totalPaginas,
                "proyectos"   => $proyectos,
                "mensaje"     => "Existe una caja Abierta para el usuario"
              ];
    
              echo view('admcajas/listaCajas',$data);
            }
    

          }else{
            $model = new CajaChicaCModel();
            $hoy2 = date("Y-m-d"); 

            $queryT = $db->query("call listar_cajachicaC_porUsuario_conteo(".$this->request->getPost('asig').")");
            $cajasT = $queryT->getResult();

            $data = [
              "codigo"          => "C-00".$this->request->getPost('asig')."-".(count($cajasT)+1),
              "fecha_apertura"  => $hoy2,
              "asignado"        => $this->request->getPost('asig'),
              "creado"          => session('idUsuario'),
              "montoTotal"      => $this->request->getPost('montoTotal') + $this->request->getPost('ultSaldo'),
              "montoCompra"     => $this->request->getPost('montoCompra'),
              "ultsaldo"        => $this->request->getPost('ultSaldo'),
              "cajaUltSaldo"    => $this->request->getPost('cajaUltSaldo'),
              "proyecto"        => $this->request->getPost('proyecto'),
              "caja_estado"     => 0
            ];
            $model->save($data);


            //GUARDADO DE ACTIVIDAD-----------------
            $hoyguardar = getdate();
            $fechaguardar ="";
            $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
            $guardar = new SeguimientoModel();
            $dataguardar = [
              "usuario" =>session("idUsuario"),
              "accion" =>"SE HA REGISTRADO UNA NUEVA CAJA: "."C-00".$this->request->getPost('asig')."-".(count($cajasT)+1),
              "fecha" =>$fechaguardar
            ];
            $guardar->save($dataguardar);
            //-----------------------------------------------
            return redirect()->to(base_url().'/cajaChicac');
        }
      }
    }

    //--------------------------------------------

    public function detalleCaja($id){

        $db = \Config\Database::connect();
        $idSanetizado = filter_var($id,FILTER_SANITIZE_NUMBER_INT );

        $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
        $caja = $query->getRowArray();

        $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
        $results = $query2->getResult();

        $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
        $proveedores = $query3->getResult();

        $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
        $proyectos = $query4->getResult();

        $query5 = $db->query("call listar_movilidad_porCaja(".$idSanetizado.")");
        $movilidades = $query5->getResult();

        $query6 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
        $aumentos = $query6->getResult();

        $query7 = $db->query("call listar_refrigerio_porCaja(".$idSanetizado.")");
        $refrigerios = $query7->getResult();

        $consumido = 0;
        foreach($results as $valor){
          $consumido+= $valor->totalNeto;
        }

        $aumentado = 0;
        foreach($aumentos as $valor){
          $aumentado+= $valor->monto;
        }

        $data = [
          "caja"      =>$caja,
          "lista"     =>$results,
          "lista2"    =>$movilidades,
          "lista3"    =>$refrigerios,
          "proye"     =>$proyectos,
          "prove"     =>$proveedores,
          "aumento"   =>$aumentado,
          "consumido" =>$consumido
        ];

        switch(session("tipo")){
           case 1:  echo view('listaFacturas', $data);
            break;
           case 8:  echo view('residente/listaFacturas', $data);
            break;
          case 10:  echo view('gerencia/listaFacturas', $data);
            break;
          case 11:  echo view('admcajas/listaFacturas', $data);
            break;
          default:  return redirect()->to(base_url().'');
        }


    }

    //--------------------------------------------

    public function cancelarTodoFactura($id){

      $dbeli = \Config\Database::connect();
      $queryeli = $dbeli->query('DELETE FROM previoDetalleFactura where idFactura IS NULL and usuario='.session("idUsuario"));
      $resultseli = $queryeli->getResult();

      $db = \Config\Database::connect();
      $idSanetizado = filter_var($id,FILTER_SANITIZE_NUMBER_INT );

      $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $caja = $query->getRowArray();

      $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
      $results = $query2->getResult();

      $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
      $proveedores = $query3->getResult();

      $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
      $proyectos = $query4->getResult();

      $query5 = $db->query("call listar_movilidad_porCaja(".$idSanetizado.")");
      $movilidades = $query5->getResult();

      $query6 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
      $aumentos = $query6->getResult();

      $query9 = $db->query("call listar_refrigerio_porCaja(".$idSanetizado.")");
      $refrigerios = $query9->getResult();

      $consumido = 0;
      foreach($results as $valor){
        $consumido+= $valor->totalNeto;
      }


      $aumentado = 0;
      foreach($aumentos as $valor){
        $aumentado+= $valor->monto;
      }

      $data = [
        "caja"      =>$caja,
        "lista"     =>$results,
        "lista2"    =>$movilidades,
        "lista3"    =>$refrigerios,
        "proye"     =>$proyectos,
        "prove"     =>$proveedores,
        "aumento"   =>$aumentado,
        "consumido" =>$consumido
      ];

      switch(session("tipo")){
         case 1:  echo view('listaFacturas', $data);
          break;
         case 8:  echo view('residente/listaFacturas', $data);
          break;
        case 10:  echo view('gerencia/listaFacturas', $data);
          break;
        case 11:  echo view('admcajas/listaFacturas', $data);
          break;
        default:  return redirect()->to(base_url().'');
      }


    }

    //--------------------------------------------

    public function cancelarEditFactura($id){

      $db = \Config\Database::connect();
      $idSanetizado = filter_var($id,FILTER_SANITIZE_NUMBER_INT );

      $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $caja = $query->getRowArray();

      $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
      $results = $query2->getResult();

      $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
      $proveedores = $query3->getResult();

      $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
      $proyectos = $query4->getResult();

      $query5 = $db->query("call listar_movilidad_porCaja(".$idSanetizado.")");
      $movilidades = $query5->getResult();

      $query6 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
      $aumentos = $query6->getResult();

      $query9 = $db->query("call listar_refrigerio_porCaja(".$idSanetizado.")");
      $refrigerios = $query9->getResult();

      $consumido = 0;
      foreach($results as $valor){
        $consumido+= $valor->totalNeto;
      }

      $aumentado = 0;
      foreach($aumentos as $valor){
        $aumentado+= $valor->monto;
      }

      $data = [
        "caja"      =>$caja,
        "lista"     =>$results,
        "lista2"    =>$movilidades,
        "lista3"    =>$refrigerios,
        "proye"     =>$proyectos,
        "prove"     =>$proveedores,
        "aumento"   =>$aumentado,
        "consumido" =>$consumido
      ];

      switch(session("tipo")){
         case 1:  echo view('listaFacturas', $data);
          break;
         case 8:  echo view('residente/listaFacturas', $data);
          break;
        case 10:  echo view('gerencia/listaFacturas', $data);
          break;
        case 11:  echo view('admcajas/listaFacturas', $data);
          break;
        default:  return redirect()->to(base_url().'');
      }


    }

    //--------------------------------------------

    public function editCaja(){
    
      $id = $this->request->getPost('id');
      $db = \Config\Database::connect();
      $idSanetizado = filter_var($id,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $caja = $query->getRowArray();

      $data = [
        "caja" =>$caja
      ];

      echo json_encode($data);
      exit();

    }

    //--------------------------------------------

    public function editarCaja(){
        $db = \Config\Database::connect();
        if($this->request->getMethod()=="post"){
          helper(['form','url']);
          $datavalid = [];
          $rules = [
            'montoCompra' => 'required|decimal'
          ];

          if (!$this->validate($rules)) {

            $numeroregi = 9;
            $pag = 1;
            $empieza = ($pag-1)*$numeroregi;
    
            $queryT = $db->query("call listar_cajachicaC_total(0,-1)");
            $cajasT = $queryT->getResult();
    
            $query = $db->query("call listar_cajachicaC_total(".$empieza.",".$numeroregi.")");
            $cajas = $query->getResult();
    
            $query2 = $db->query("call listar_usuariosFiltro()");
            $usuariosFiltro = $query2->getResult();
    
            $query3 = $db->query("call listar_usuariosAsignar()");
            $usuarios = $query3->getResult();

            $query5 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
            $proyectos = $query5->getResult();

            $totalRegistros = count($cajasT);
            $totalPaginas = ceil($totalRegistros/$numeroregi);
    
            $hoy = date("d/m/Y");     
    
            if(session("tipo")==11){
              $datavalid = [
                "lista"       => $cajas,
                "usuarios"    => $usuariosFiltro,
                "usuarioAsig" => $usuarios,
                "fecha"       => $hoy,
                "numero"      => (count($cajasT)+1),
                "pagi"        => $totalPaginas,
                "proyectos"   => $proyectos,
                "validation"  => $this->validator
              ];
    
              echo view('admcajas/listaCajas',$datavalid);
            }
            
          }else{
            $model = new CajaChicaCModel();
            $id = $this->request->getPost('idCaja');

            $data = [
              "montoCompra"  => $this->request->getPost('montoCompra')
            ];

            $model->update($id,$data);


            //GUARDADO DE ACTIVIDAD-----------------
            $hoyguardar = getdate();
            $fechaguardar ="";
            $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
            $guardar = new SeguimientoModel();
            $dataguardar = [
              "usuario" =>session("idUsuario"),
              "accion" =>"SE HA EDITADO LA CAJA: ".$this->request->getPost('cod'),
              "fecha" =>$fechaguardar
            ];
            $guardar->save($dataguardar);
            //-----------------------------------------------
            return redirect()->to(base_url().'/cajaChicac');
        }
      }
    }

    //--------------------------------------------

    public function mensajeCerrar(){
      $db = \Config\Database::connect();
      $mensj = "";
      $opci = "";

      $idcaja = $this->request->getPost('id');
      $idSanetizado = filter_var($idcaja,FILTER_SANITIZE_NUMBER_INT );

      $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $caja = $query->getRowArray();
      
      $querycon = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
      $consumi = $querycon->getResult();

      $query6 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
      $aumentos = $query6->getResult();

      $consumidotab = 0;
      foreach($consumi as $valor){
        $consumidotab+= $valor->totalNeto;
      }

      $aumentado = 0;
      foreach($aumentos as $valor){
        $aumentado+= $valor->monto;
      }
        
      $totalConsumido = ($caja["montoTotal"]+ $aumentado) - ($consumidotab);

      if($totalConsumido==0){
        $mensj = "¿Desea cerrar la caja?";
        $opci = '<input type="hidden" value="0" name="saldito" />';
      }else{
        $mensj .= "El sistema detecto que la caja tiene un monto de ";
        $mensj .= "S/".$totalConsumido;
        $mensj .= " ,Eliga una de las opciones:";
        $opci = '<div class="col-12 text-left">
                  <div class="form-check">
                    <input value="1" type="radio" class="form-check-input" id="flexRadioDefault1" checked name="saldito">
                    <label class="form-check-label" for="flexRadioDefault1">Crear ticket restando el monto y cerrar en S/0.00 </label>
                  </div>
                </div>

                <div class="col-12 text-left mb-3">
                  <div class="form-check">
                    <input value="2" type="radio" class="form-check-input" id="flexRadioDefault1" name="saldito">
                    <label class="form-check-label" for="flexRadioDefault1">Usar saldo para la nueva caja</label>
                  </div>
                </div>';
      }
  
      $data =[
        "data" => $mensj,
        "opci" => $opci
      ];
      echo json_encode($data);
      exit();
    }

    //--------------------------------------------

    public function cerrarCaja(){

      $db = \Config\Database::connect();
      $id = $this->request->getPost('idcajace');
      $opci = $this->request->getPost('saldito');
      $idSanetizado = filter_var($id,FILTER_SANITIZE_NUMBER_INT );

      $queryValid = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $cajaValid = $queryValid->getRowArray();

      if($cajaValid["caja_estado"] == 0){

        if($opci == 0 || $opci == 2){

          $querycon = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $consumi = $querycon->getResult();

          $consumidotab = 0;
          foreach($consumi as $valor){
            $consumidotab+= $valor->totalNeto;
          }
          
          $model = new CajaChicaCModel();
          $hoy = date("Y-m-d");

          $data = [
            "caja_estado" => 1,
            "fecha_cierre" => $hoy ,
            "totalConsumido" =>$consumidotab
          ];
          $model->update($cajaValid["id"],$data);

          return redirect()->to(base_url().'/cajaChicac/detalleCaja/'.$cajaValid["id"]);
         
        }elseif($opci == 1){

          $querycon = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $consumi = $querycon->getResult();

          $query6 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
          $aumentos = $query6->getResult();

          $consumidotab = 0;
          foreach($consumi as $valor){
            $consumidotab+= $valor->totalNeto;
          }

          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }

          $totalC = ($cajaValid["montoTotal"]+ $aumentado) - ($consumidotab);    

          $proveedor= "";
          $fecha    = date("Y-m-d");
          $usuario  = session('idUsuario');
          $proyecto = "";
          $factura  = "T-INTERNO";
          $igv      = 1;
          $tipoCmpb = 4;
          
          $model5 = new FacturaModel();
          $data5 = [
            "fecha"     => $fecha,
            "totalNeto" => $totalC,
            "proveedor" => $proveedor,
            "proyecto"  => $proyecto,
            "usuario"   => $usuario,
            "factura"   => $factura,
            "caja"      => $idSanetizado,
            "igv"       => $igv,
            "tipoCmpb"  => $tipoCmpb
          ];

          $model5->save($data5);
          $idttran = $model5->getInsertID();

          $model6 = new DetalleFacturaModel();

          $data6 = [
            "cantidad"  => 1,
            "precio"    => $totalC,
            "factura"   => $idttran,
            "item"      => "INTERNO CIERRE CAJA"
          ];
          $model6->save($data6);

          $querycon2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $consumi2 = $querycon2->getResult();

          $consumidotab_2 = 0;
          foreach($consumi2 as $valor){
            $consumidotab_2+= $valor->totalNeto;
          }


          $model = new CajaChicaCModel();
          $hoy = date("Y-m-d");

          $data = [
            "caja_estado" => 1,
            "fecha_cierre" => $hoy ,
            "totalConsumido" =>$consumidotab_2
          ];
          $model->update($cajaValid["id"],$data);

          return redirect()->to(base_url().'/cajaChicac/detalleCaja/'.$cajaValid["id"]);

        }

      }else{

        $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
        $caja = $query->getRowArray();

        $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
        $results = $query2->getResult();

        $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
        $proveedores = $query3->getResult();

        $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
        $proyectos = $query4->getResult();
  
        $consumido = 0;
        foreach($results as $valor){
          $consumido+= $valor->totalNeto;
        }
  

        $data = [
          "caja"      =>$caja,
          "lista"     =>$results,
          "proye"     =>$proyectos,
          "prove"     =>$proveedores,
          "consumido" =>$consumido,
          "mensaje"   => "La caja ya se encuentra CERRADA!!"
        ];

        echo view('admcajas/listaFacturas', $data);

      }
  }

    //--------------------------------------------

    public function nuevaFactura($id){

      $db = \Config\Database::connect();
      $idSanetizado = filter_var($id,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $caja = $query->getRowArray();

      $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
      $results = $query2->getResult();

      $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
      $proveedores = $query3->getResult();

      $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
      $proyectos = $query4->getResult();

      $query5 = $db->query("select * from previoDetalleFactura where idFactura IS NULL and usuario=".session("idUsuario"));
      $detalles = $query5->getResult();

      $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
      $aumentos = $query7->getResult();

      $consumido = 0;
      foreach($results as $valor){
        $consumido+= $valor->totalNeto;
      }

      $aumentado = 0;
      foreach($aumentos as $valor){
        $aumentado+= $valor->monto;
      }

      $total = 0;
      foreach($detalles as $valor){
        $total+= ($valor->precio * $valor->cantidad);
      }

      $hoy = date("Y-m-d"); 

      $data = [
        "fecha"       =>$hoy,
        "caja"        =>$caja,
        "proyectos"   =>$proyectos,
        "proveedores" =>$proveedores,
        "consumido"   =>$consumido,
        "total"       =>$total,
        "detalle"     =>$detalles,
        "aumento"     =>$aumentado
      ];

      switch(session("tipo")){
        case 1:  echo view('registroFactura', $data);
          break;
        case 8:  echo view('residente/registroFactura', $data);
          break;
        default:  return redirect()->to(base_url().'');
      }

    }

    //--------------------------------------------

    public function editFactura($id){

      $db = \Config\Database::connect();
      $idSanetizado = filter_var($id,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call cabecera_Factura_porID(".$idSanetizado.")");
      $facturaC = $query->getRowArray();

      if($facturaC["caja"]!=""){

        $query2 = $db->query("call listar_facturas_porCaja_sinFacturaId(".$idSanetizado.",".$facturaC["caja"].")");
        $results = $query2->getResult();

        $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
        $proveedores = $query3->getResult();

        $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
        $proyectos = $query4->getResult();

        $query5 = $db->query("call agregar_previoDetalle_editFactura(".$idSanetizado.",".session("idUsuario").")");
        $detalles = $query5->getResult();

        $query7 = $db->query("call listar_Aumentos_Caja(".$facturaC["caja"].")");
        $aumentos = $query7->getResult();

        $query8 = $db->query("call listar_cajachicaC_porID(".$facturaC["caja"].")");
        $caja= $query8->getRowArray();
  
        $consumido = 0;
        foreach($results as $valor){
          $consumido+= $valor->totalNeto;
        }

        $aumentado = 0;
        foreach($aumentos as $valor){
          $aumentado+= $valor->monto;
        }

        $total = 0;
        foreach($detalles as $valor){
          $total+= ($valor->precio * $valor->cantidad);
        }

        $data = [
          "caja"        =>$caja,
          "factura"     =>$facturaC,
          "proyectos"   =>$proyectos,
          "proveedores" =>$proveedores,
          "consumido"   =>$consumido,
          "total"       =>$total,
          "detalle"     =>$detalles,
          "aumento"     =>$aumentado
        ];

        switch(session("tipo")){
          case 1:  echo view('edicionFactura', $data);
            break;
          case 11:  echo view('admcajas/edicionFactura', $data);
            break;
          case 8:  echo view('residente/edicionFactura', $data);
            break;
          default:  return redirect()->to(base_url().'');
        }

      }else{
        return redirect()->to(base_url().'');
      }

    }

    //--------------------------------------------

    public function agregarProve(){
      $db = \Config\Database::connect();

      $dniruc = $this->request->getPost('para1');
      $descri = $this->request->getPost('para2');

      $queryvalid = $db->query("select * from proveedor_temp where dniRuc ='".$dniruc."' AND descripcion='".$descri."'");
      $prove = $queryvalid->getResult();

      if($prove == null && $descri!=""){

        $model = new ProveedorTempModel();
        $data = [
          "dniRuc"      => $dniruc,
          "descripcion" => $descri,
          "estado"      => 0
        ];
        $model->save($data);

        $queryObt= $db->query("select * from proveedor_temp where dniRuc ='".$dniruc."' AND descripcion='".$descri."'");
        $proveedor = $queryObt->getRowArray();

        $envio = [
          "agregado" => $proveedor,
          "men" => "agregado",
          ];
          echo json_encode($envio);
          exit();

      }else{
        $envio = [
          "men" => "error"
          ];
          echo json_encode($envio);
          exit();
      }
    }

    //--------------------------------------------

    public function eliminarProve(){
      $db = \Config\Database::connect();

      $idprove = $this->request->getPost('para1');

      $queryvalid = $db->query("select * from proveedor_temp where id=".$idprove);
      $prove = $queryvalid->getRowArray();

      if($prove != null){

        $model = new ProveedorTempModel();
        $data = [
          "estado" => 1
        ];

        $model->update($idprove,$data);

        $envio = [
          "idElim"  => $idprove,
          "men"     => "eliminado"
          ];
          echo json_encode($envio);
          exit();

      }else{
        $envio = [
          "men" => "error"
          ];
          echo json_encode($envio);
          exit();
      }
    }

    //--------------------------------------------

    public function agregarProye(){
      $db = \Config\Database::connect();

      $descri = $this->request->getPost('para1');

      $queryvalid = $db->query("select * from proyecto_temp where descripcion='".$descri."'");
      $proye = $queryvalid->getResult();

      if($proye == null && $descri!=""){

        $model = new ProyectoTempModel();
        $data = [
          "descripcion" => $descri,
          "estado"      => 0
        ];
        $model->save($data);

        $queryObt= $db->query("select * from proyecto_temp where descripcion='".$descri."'");
        $proyecto = $queryObt->getRowArray();

        $envio = [
          "agregado" => $proyecto,
          "men" => "agregado",
          ];
          echo json_encode($envio);
          exit();

      }else{
        $envio = [
          "men" => "error"
          ];
          echo json_encode($envio);
          exit();
      }
    }

    //--------------------------------------------

    public function agregarDetalleFactura(){
      $db = \Config\Database::connect();

      $item = $this->request->getPost('para1');
      $cant = $this->request->getPost('para2');
      $precio = $this->request->getPost('para3');
      $idFactura = $this->request->getPost('para4');

      if($idFactura != ""){

        $model = new previoDetalleFacturaModel();
        $data = [
          "cantidad"  => $cant,
          "precio"    => $precio,
          "item"      => $item,
          "usuario"   => session("idUsuario"),
          "idFactura" => $idFactura
        ];
        $model->save($data);

        $queryObt= $db->query("select * from previoDetalleFactura where usuario=".session("idUsuario")." and idFactura=".$idFactura);
        $lista = $queryObt->getResult();

      }else{

        $model = new previoDetalleFacturaModel();
        $data = [
          "cantidad" => $cant,
          "precio" => $precio,
          "item" => $item,
          "usuario" => session("idUsuario")
        ];
        $model->save($data);

        $queryObt= $db->query("select * from previoDetalleFactura where idFactura is null and usuario=".session("idUsuario"));
        $lista = $queryObt->getResult();

      }
      

      $resultado = '';
      $total = 0;

      foreach($lista as $valor){
        $resultado .= '
        <tr>
          <th scope="row" class="align-middle">
            <div style="width: max-content;"><input size="35" id="itemN'.$valor->id.'" type="text" class="form-control" value="'.$valor->item.'" onblur="F_editItem('.$valor->id.');" required="" /></div>
          </th>
          <td class="align-middle">
            <div style="width: max-content;"><input size="10" id="itemC'.$valor->id.'" type="text" class="form-control" value="'.$valor->cantidad.'" onblur="F_editCant('.$valor->id.');" required="" /></div>
          </td>
          <td class="align-middle">
            <div style="width: max-content;"><input size="10" id="itemP'.$valor->id.'" type="text" class="form-control" value="'.$valor->precio.'" onblur="F_editPrecio('.$valor->id.');" required="" /></div>
          </td>
          <td class="align-middle text-center"><span id="itemS'.$valor->id.'">'.$valor->cantidad*$valor->precio.'</span></td>
          <td class="align-middle text-right">
          <a onclick="F_eliminarDetalle('.$valor->id.')" title="eliminar detalle" class="eliminar btn btn-sm btn-outline-danger"><i class="fas fa-minus-circle"></i></a>
          </td>
        </tr>
        ';
        $total += ($valor->precio*$valor->cantidad);
      }
      


      $envio = [
        "html" => $resultado,
        "total" =>number_format($total, 2, '.', ''),
        "men" => "agregado"
        ];
        echo json_encode($envio);
        exit();

    }

    //-------------------------------------------

    public function eliminarDetalleFactura(){
        $db = \Config\Database::connect();
        $id = $this->request->getPost('id');

        try{
        $queryObtPrv= $db->query("select * from previoDetalleFactura where id=".$id);
        $previo = $queryObtPrv->getRowArray();

        $model = new previoDetalleFacturaModel();
        $model->delete($id,true);
        
        if($previo["idFactura"]!=""){
          $queryObt= $db->query("select * from previoDetalleFactura where idFactura=".$previo["idFactura"]." AND usuario=".session("idUsuario"));
          $lista = $queryObt->getResult();
        }else{
          $queryObt= $db->query("select * from previoDetalleFactura where idFactura IS NULL AND usuario=".session("idUsuario"));
          $lista = $queryObt->getResult();
        }

        $total = 0;
        foreach($lista as $valor){
          $total += ($valor->precio*$valor->cantidad);
        }

        $envio = [
          "total" =>number_format($total, 2, '.', ''),$total,
          "men" => "correcto"
          ];
          echo json_encode($envio);
          exit();

        }catch(\Exception $e){
          $envio = [
          "men" => "error"
          ];
          echo json_encode($envio);
          exit();
        }
        
    }

    //-------------------------------------------

    public function registrarFactura(){
      $db = \Config\Database::connect();
      helper(['form','url']);

      $idcaja = $this->request->getPost('caja');
      $idSanetizado = filter_var($idcaja,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $caja = $query->getRowArray();

      if($this->request->getMethod()=='post'){
        $rules = [
          'proveedor' => 'required|is_natural_no_zero|numeric',
          'proyecto'  => 'required|is_natural_no_zero|numeric',
          'factura'   => 'required',
          'tipoCmpb'  => 'required',
          'total'     => 'required|decimal',
          'fecha'     => 'required'
        ];

      $queryValidPrv = $db->query("select * from previoDetalleFactura where idFactura IS NULL and usuario=".session("idUsuario"));
      $validPrv = $queryValidPrv->getResult();

      $totalValidator = $this->request->getPost('total');

      $queryAum = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
      $aumentosVal = $queryAum->getResult();

      $aumentadoVal = 0;
      foreach($aumentosVal as $valor){
        $aumentadoVal+= $valor->monto;
      }

      $queryFacsValid = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
      $factVal = $queryFacsValid->getResult();

      $consumidoVal = 0;
      foreach($factVal as $valor){
        $consumidoVal+= $valor->totalNeto;
      }

      $saldoCajaval = (($aumentadoVal + $caja["montoTotal"]) - $consumidoVal) - $totalValidator;

        if ($saldoCajaval<0) {
    
          $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $results = $query2->getResult();
    
          $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
          $proveedores = $query3->getResult();
    
          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();
    
          $query5 = $db->query("select * from previoDetalleFactura where idFactura IS NULL and usuario=".session("idUsuario"));
          $detalles = $query5->getResult();

          $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
          $aumentos = $query7->getResult();
    
          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }

          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }
    
          $total = 0;
          foreach($detalles as $valor){
            $total+= ($valor->precio * $valor->cantidad);
          }
    
          $hoy = date("Y-m-d"); 
    
          $data = [
            "fecha"       =>$hoy,
            "caja"        =>$caja,
            "proyectos"   =>$proyectos,
            "proveedores" =>$proveedores,
            "consumido"   =>$consumido,
            "total"       =>$total,
            "detalle"     =>$detalles,
            "aumento"     =>$aumentado,
            "mensaje"     =>"Error Saldo Negativo en Caja"
          ];
    
          switch(session("tipo")){
            case 1:  echo view('registroFactura', $data);
              break;
            case 8:  echo view('residente/registroFactura', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

          }elseif($caja["caja_estado"]==1) {
    
          $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $results = $query2->getResult();
    
          $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
          $proveedores = $query3->getResult();
    
          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();
    
          $query5 = $db->query("select * from previoDetalleFactura where idFactura IS NULL and usuario=".session("idUsuario"));
          $detalles = $query5->getResult();

          $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
          $aumentos = $query7->getResult();
    
          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }

          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }
    
          $total = 0;
          foreach($detalles as $valor){
            $total+= ($valor->precio * $valor->cantidad);
          }
    
          $hoy = date("Y-m-d"); 
    
          $data = [
            "fecha"       =>$hoy,
            "caja"        =>$caja,
            "proyectos"   =>$proyectos,
            "proveedores" =>$proveedores,
            "consumido"   =>$consumido,
            "total"       =>$total,
            "detalle"     =>$detalles,
            "aumento"     =>$aumentado,
            "mensaje"     =>"Error Caja Cerrada"
          ];
    
          switch(session("tipo")){
            case 1:  echo view('registroFactura', $data);
              break;
            case 8:  echo view('residente/registroFactura', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

        }elseif($validPrv== null) {
    
          $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $results = $query2->getResult();
    
          $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
          $proveedores = $query3->getResult();
    
          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();
    
          $query5 = $db->query("select * from previoDetalleFactura where idFactura IS NULL and usuario=".session("idUsuario"));
          $detalles = $query5->getResult();

          $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
          $aumentos = $query7->getResult();

          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }

          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }
    
          $total = 0;
          foreach($detalles as $valor){
            $total+= ($valor->precio * $valor->cantidad);
          }
    
          $hoy = date("Y-m-d"); 
    
          $data = [
            "fecha"       =>$hoy,
            "caja"        =>$caja,
            "proyectos"   =>$proyectos,
            "proveedores" =>$proveedores,
            "consumido"   =>$consumido,
            "total"       =>$total,
            "detalle"     =>$detalles,
            "aumento"     =>$aumentado,
            "mensaje"     =>"Error No tiene ningun Item el Comprobante"
          ];
    
          switch(session("tipo")){
            case 1:  echo view('registroFactura', $data);
              break;
            case 8:  echo view('residente/registroFactura', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

        }elseif (!$this->validate($rules)) {

          $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $results = $query2->getResult();
    
          $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
          $proveedores = $query3->getResult();
    
          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();
    
          $query5 = $db->query("select * from previoDetalleFactura where idFactura IS NULL and usuario=".session("idUsuario"));
          $detalles = $query5->getResult();

          $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
          $aumentos = $query7->getResult();
    
          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }

          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }
    
          $total = 0;
          foreach($detalles as $valor){
            $total+= ($valor->precio * $valor->cantidad);
          }
    
          $hoy = date("Y-m-d");  
    
          $data = [
            "fecha"       =>$hoy,
            "caja"        =>$caja,
            "proyectos"   =>$proyectos,
            "proveedores" =>$proveedores,
            "consumido"   =>$consumido,
            "total"       =>$total,
            "detalle"     =>$detalles,
            "aumento"     =>$aumentado,
            "validation"  =>$this->validator
          ];
    
          switch(session("tipo")){
            case 1:  echo view('registroFactura', $data);
              break;
            case 8:  echo view('residente/registroFactura', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

        }else{
          $proveedor= $this->request->getPost('proveedor');
          $fecha    = $this->request->getPost('fecha');
          $usuario  = $this->request->getPost('usuario');
          $proyecto = $this->request->getPost('proyecto');
          $total    = $this->request->getPost('total');
          $factura  = $this->request->getPost('factura');
          $igv      = $this->request->getPost('igv');
          $tipoCmpb = $this->request->getPost('tipoCmpb');
          
          $model = new FacturaModel();
          $data = [
            "fecha"     => $fecha,
            "totalNeto" => $total,
            "proveedor" => $proveedor,
            "proyecto"  => $proyecto,
            "usuario"   => $usuario,
            "factura"   => $factura,
            "caja"      => $idcaja,
            "igv"       => $igv,
            "tipoCmpb"  => $tipoCmpb
          ];
          $model->save($data);

          $idttran = $model->getInsertID();
          $model2 = new DetalleFacturaModel();

          $queryDeta = $db->query("select * from previoDetalleFactura where idFactura IS NULL and usuario=".session("idUsuario"));
          $detallesIns = $queryDeta->getResult();

          foreach($detallesIns as $valor){
            $data2 = [
              "cantidad" => $valor->cantidad,
              "precio" =>$valor->precio,
              "factura" =>$idttran,
              "item" =>$valor->item
            ];
            $model2->save($data2);
          }


          $dbeli = \Config\Database::connect();
          $queryeli = $dbeli->query('DELETE FROM previoDetalleFactura where idFactura IS NULL and usuario='.session("idUsuario"));
          $resultseli = $queryeli->getResult();
    
          //GUARDADO DE ACTIVIDAD-----------------
          $hoyguardar = getdate();
          $fechaguardar ="";
          $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
          $guardar = new SeguimientoModel();
          $dataguardar = [
            "usuario" =>session("idUsuario"),
            "accion" =>"SE HA REGISTRADO EL COMPROBANTE: ".$factura,
            "fecha" =>$fechaguardar
          ];
          $guardar->save($dataguardar);
          //-----------------------------------------------

          return redirect()->to(base_url().'/cajaChicac/detalleCaja/'.$idcaja);

        }
      }

    }

    //-------------------------------------------

    public function editarFactura(){
      $db = \Config\Database::connect();
      helper(['form','url']);

      $idcaja = $this->request->getPost('caja');
      $idfactura = $this->request->getPost('idfactura');

      $idSanetizado = filter_var($idcaja,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $caja = $query->getRowArray();

      $queryValidPrv = $db->query("select * from previoDetalleFactura where idFactura =".$idfactura." and usuario=".session("idUsuario"));
      $validPrv = $queryValidPrv->getResult();

      if($this->request->getMethod()=='post'){
        $rules = [
          'proveedor' => 'required|is_natural_no_zero|numeric',
          'proyecto'  => 'required|is_natural_no_zero|numeric',
          'factura'   => 'required',
          'tipoCmpb'  => 'required',
          'total'     => 'required|decimal'
        ];

        $totalValidator = $this->request->getPost('total');

        $queryAum = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
        $aumentosVal = $queryAum->getResult();

        $aumentadoVal = 0;
        foreach($aumentosVal as $valor){
          $aumentadoVal+= $valor->monto;
        }

        $queryFacsValid = $db->query("call listar_facturas_porCaja_sinFacturaId(".$idfactura.",".$idcaja.")");
        $factVal = $queryFacsValid->getResult();

        $consumidoVal = 0;
        foreach($factVal as $valor){
          $consumidoVal+= $valor->totalNeto;
        }

        $saldoCajaval = (($aumentadoVal + $caja["montoTotal"]) - $consumidoVal) - $totalValidator;

        if ($saldoCajaval<0) {
    
          $queryf = $db->query("call cabecera_Factura_porID(".$idfactura.")");
          $facturaC = $queryf->getRowArray();
          
          $query2 = $db->query("call listar_facturas_porCaja_sinFacturaId(".$idfactura.",".$idcaja.")");
          $results = $query2->getResult();

          $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
          $proveedores = $query3->getResult();

          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();

          $query5 = $db->query("select * from previoDetalleFactura where idFactura =".$idfactura." and usuario=".session("idUsuario"));
          $detalles = $query5->getResult();

          $query7 = $db->query("call listar_Aumentos_Caja(".$idcaja.")");
          $aumentos = $query7->getResult();
    
          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }

          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }
    
          $total = 0;
          foreach($detalles as $valor){
            $total+= ($valor->precio * $valor->cantidad);
          }
    
          $data = [
            "caja"        =>$caja,
            "factura"     =>$facturaC,
            "proyectos"   =>$proyectos,
            "proveedores" =>$proveedores,
            "consumido"   =>$consumido,
            "total"       =>$total,
            "detalle"     =>$detalles,
            "aumento"     =>$aumentado,
            "mensaje"     =>"Error Saldo Negativo en Caja"
          ];
  
          switch(session("tipo")){
            case 1:  echo view('edicionFactura', $data);
              break;
            case 11: echo view('admcajas/edicionFactura', $data);
              break;
            case 8:  echo view('residente/edicionFactura', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

          }elseif ($caja["caja_estado"]==1 && session("tipo") != 11) {

          $queryf = $db->query("call cabecera_Factura_porID(".$idfactura.")");
          $facturaC = $queryf->getRowArray();
          
          $query2 = $db->query("call listar_facturas_porCaja_sinFacturaId(".$idfactura.",".$idcaja.")");
          $results = $query2->getResult();

          $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
          $proveedores = $query3->getResult();

          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();

          $query5 = $db->query("select * from previoDetalleFactura where idFactura =".$idfactura." and usuario=".session("idUsuario"));
          $detalles = $query5->getResult();

          $query7 = $db->query("call listar_Aumentos_Caja(".$idcaja.")");
          $aumentos = $query7->getResult();
    
          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }

          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }
    
          $total = 0;
          foreach($detalles as $valor){
            $total+= ($valor->precio * $valor->cantidad);
          }
    
          $data = [
            "caja"        =>$caja,
            "factura"     =>$facturaC,
            "proyectos"   =>$proyectos,
            "proveedores" =>$proveedores,
            "consumido"   =>$consumido,
            "total"       =>$total,
            "detalle"     =>$detalles,
            "aumento"     =>$aumentado,
            "mensaje"     =>"Error Caja Cerrada"
          ];
    
          switch(session("tipo")){
            case 1:  echo view('edicionFactura', $data);
              break;
            case 11: echo view('admcajas/edicionFactura', $data);
              break;
            case 8:  echo view('residente/edicionFactura', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

        }elseif($validPrv== null) {
    
          $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $results = $query2->getResult();
    
          $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
          $proveedores = $query3->getResult();
    
          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();
    
          $query5 = $db->query("select * from previoDetalleFactura where idFactura IS NULL and usuario=".session("idUsuario"));
          $detalles = $query5->getResult();

          $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
          $aumentos = $query7->getResult();
    
          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }
    

          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }
    
          $total = 0;
          foreach($detalles as $valor){
            $total+= ($valor->precio * $valor->cantidad);
          }
    
          $hoy = date("Y-m-d"); 
    
          $data = [
            "fecha"       =>$hoy,
            "caja"        =>$caja,
            "proyectos"   =>$proyectos,
            "proveedores" =>$proveedores,
            "consumido"   =>$consumido,
            "total"       =>$total,
            "detalle"     =>$detalles,
            "aumento"     =>$aumentado,
            "mensaje"     =>"Error No tiene ningun Item la factura"
          ];
    
          switch(session("tipo")){
            case 1:  echo view('edicionFactura', $data);
              break;
            case 11: echo view('admcajas/edicionFactura', $data);
              break;
            case 8:  echo view('residente/edicionFactura', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

        }elseif (!$this->validate($rules)) {
          $queryf = $db->query("call cabecera_Factura_porID(".$idfactura.")");
          $facturaC = $queryf->getRowArray();
          
          $query2 = $db->query("call listar_facturas_porCaja_sinFacturaId(".$idfactura.",".$idcaja.")");
          $results = $query2->getResult();

          $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
          $proveedores = $query3->getResult();

          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();

          $query5 = $db->query("select * from previoDetalleFactura where idFactura =".$idfactura." and usuario=".session("idUsuario"));
          $detalles = $query5->getResult();

          $query7 = $db->query("call listar_Aumentos_Caja(".$idcaja.")");
          $aumentos = $query7->getResult();

          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }
    

          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }
    
          $total = 0;
          foreach($detalles as $valor){
            $total+= ($valor->precio * $valor->cantidad);
          }
    
          $data = [
            "caja"        =>$caja,
            "factura"     =>$facturaC,
            "proyectos"   =>$proyectos,
            "proveedores" =>$proveedores,
            "consumido"   =>$consumido,
            "total"       =>$total,
            "detalle"     =>$detalles,
            "aumento"     =>$aumentado,
            "validation"  =>$this->validator
          ];

    
          switch(session("tipo")){
            case 1:  echo view('edicionFactura', $data);
              break;
            case 11: echo view('admcajas/edicionFactura', $data);
              break;
            case 8:  echo view('residente/edicionFactura', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

        }else{
          $proveedor  = $this->request->getPost('proveedor');
          $fecha      = $this->request->getPost('fecha');
          $usuario    = $this->request->getPost('usuario');
          $proyecto   = $this->request->getPost('proyecto');
          $total      = $this->request->getPost('total');
          $factura    = $this->request->getPost('factura');
          $igv        = $this->request->getPost('igv');
          $tipoCmpb   = $this->request->getPost('tipoCmpb');
          
          $model = new FacturaModel();
          $data = [
            "fecha"     => $fecha,
            "totalNeto" => $total,
            "proveedor" => $proveedor,
            "proyecto"  => $proyecto,
            "usuario"   => $usuario,
            "factura"   => $factura,
            "caja"      => $idcaja,
            "igv"       => $igv,
            "tipoCmpb"  => $tipoCmpb
          ];
          $model->save($data);

          $idttran = $model->getInsertID();


          $model2 = new DetalleFacturaModel();

          $queryDeta = $db->query("select * from previoDetalleFactura where idFactura =".$idfactura." and usuario=".session("idUsuario"));
          $detallesIns = $queryDeta->getResult();

          foreach($detallesIns as $valor){
            $data2 = [
              "cantidad"  => $valor->cantidad,
              "precio"    => $valor->precio,
              "factura"   => $idttran,
              "item"      => $valor->item
            ];
            $model2->save($data2);
          }

          $data3 = [
            "facturaEdit" => $idttran
          ];

          $model->update($idfactura,$data3);

          //EDITAR LAS MOVILIDADES O REFRIGERIOS ASOCIADOS
          $queryMovi = $db->query("call buscarMovilidadxCmpb(".$idfactura.")");
          $movi = $queryMovi->getRowArray();

          $queryRefri = $db->query("call buscarRefrigerioxCmpb(".$idfactura.")");
          $refri = $queryRefri->getRowArray();

          if($movi != null){
            $model2 = new MovilidadModel();
            $data2 = [
              "monto"       => $total,
              "comprobante" => $idttran
            ];
            $model2->update($movi["id"],$data2);
          }

          if($refri != null){
            $model3 = new RefrigerioModel();
            $data3 = [
              "monto"       => $total,
              "comprobante" => $idttran
            ];
            $model3->update($refri["id"],$data3);
          }

          $dbeli = \Config\Database::connect();
          $queryeli = $dbeli->query('DELETE FROM previoDetalleFactura where idFactura ='.$idfactura.' and usuario='.session("idUsuario"));
          $resultseli = $queryeli->getResult();
    
          //GUARDADO DE ACTIVIDAD-----------------
          $hoyguardar = getdate();
          $fechaguardar ="";
          $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
          $guardar = new SeguimientoModel();
          $dataguardar = [
            "usuario" =>session("idUsuario"),
            "accion" =>"SE HA CAMBIO EL COMPROBANTE: ".$factura,
            "fecha" =>$fechaguardar
          ];
          $guardar->save($dataguardar);
          //-----------------------------------------------

          return redirect()->to(base_url().'/cajaChicac/detalleCaja/'.$idcaja);

        }
      }

    }

    //--------------------------------------------------------

    public function mostrarDetalleFactura(){
      helper(['form','url']);

      $id = $this->request->getPost('id');
      $db = \Config\Database::connect();
      $query = $db->query('call listar_DetalleFactura_porID('.$id.')');
      $lista = $query->getResult();

      $respuestas = "";
      $contador = 0;

      foreach ($lista as $row){
        $contador++;
      }

      $fila = 0;
      $totaliti = 0;
      $igv = 0;

      foreach ($lista as $row){
        $fila++;
        $totaliti += $row->cantidad*$row->precio;
        $igv = $row->igv;
        $respuestas.='<tr>
                        <td class="text-center text-medium">'.$fila.'</td>
                        <td class="text-left"   width="1000">'.$row->item.'</td>
                        <td class="text-center text-medium" width="200">'.$row->cantidad.'</td>
                        <td class="text-center text-medium" width="200">S/'.$row->precio.'</td>
                        <td class="text-center text-medium" width="300">S/'.$row->montoCompra.'</td></tr>';
                  
      }

      if($igv == 2){

      $respuestas.='
        <tr>
          <td colspan="3"></td>
          <td class="text-center text-lg ">Total:</td>
          <td class="text-center text-lg ">S/'.sprintf('%.2f',($totaliti/1.18)).'</td>
        </tr>
        <tr>
          <td colspan="3"></td>
          <td class="text-center text-lg ">IGV:</td>
          <td class="text-center text-lg ">S/'.sprintf('%.2f',(($totaliti/1.18)*0.18)).'</td>
        </tr>
        <tr>
          <td colspan="3"></td>
          <td class="text-center text-lg "><strong>Total IGV (18%):</strong></td>
          <td class="text-center text-lg "><strong>S/'.sprintf('%.2f',$totaliti).'</strong></td>
        </tr>';

      }elseif($igv == 3){

        $respuestas.='
          <tr>
            <td colspan="3"></td>
            <td class="text-center text-lg ">Sub-Total:</td>
            <td class="text-center text-lg ">S/'.sprintf('%.2f',($totaliti/1.1)).'</td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td class="text-center text-lg ">IGV:</td>
            <td class="text-center text-lg ">S/'.sprintf('%.2f',(($totaliti/1.1)*0.1)).'</td>
          </tr>
          <tr>
            <td colspan="3"></td>
            <td class="text-center text-lg "><strong>Total IGV (10%):</strong></td>
            <td class="text-center text-lg "><strong>S/'.sprintf('%.2f',$totaliti).'</strong></td>
          </tr>';
  
        }elseif($igv == 5){

          $respuestas.='
            <tr>
              <td colspan="3"></td>
              <td class="text-center text-lg ">Total:</td>
              <td class="text-center text-lg ">S/'.sprintf('%.2f',$totaliti).'</td>
            </tr>
            <tr>
              <td colspan="3"></td>
              <td class="text-center text-lg ">RETENSIÓN:</td>
              <td class="text-center text-lg ">S/'.sprintf('%.2f',($totaliti*0.08)).'</td>
            </tr>
            <tr>
              <td colspan="3"></td>
              <td class="text-center text-lg "><strong>Total con RETENSIÓN (8%):</strong></td>
              <td class="text-center text-lg "><strong>S/'.sprintf('%.2f',($totaliti-($totaliti*0.08))).'</strong></td>
            </tr>';
    
         }else{

      $respuestas.='
        <tr>
          <td colspan="3"></td>
          <td class="text-center text-lg "><strong>Total:</strong></td>
          <td class="text-center text-lg "><strong>S/'.sprintf('%.2f',$totaliti).'</strong></td>
        </tr>';

      }
        
      $envio = [
        "cuerpo"  => $respuestas,
        "total"   => $contador,
      ];

      echo json_encode($envio);
      exit();

    }

    //----------------------------------------------

    public function buscarSaldo(){
      helper(['form','url']);

      $id = $this->request->getPost('id');
      $db = \Config\Database::connect();
      $query = $db->query('call listar_saldo_ultimaCaja('.$id.')');
      $lista = $query->getRowArray();
      $saldo = 0;
      $idcaja = "";
      $aumentado = 0;
      
      if($lista != null){
        $saldo  = $lista["saldo"];
        $idcaja = $lista["id"];

        $query6 = $db->query("call listar_Aumentos_Caja(".$lista["id"].")");
        $aumentos = $query6->getResult();
        
        foreach($aumentos as $valor){
          $aumentado+= $valor->monto;
        }
      }

      $envio = [
        "saldo"   => $saldo+$aumentado,
        "idcaja"  => $idcaja
      ];
      
      echo json_encode($envio);
      exit();
    }

    //--------------------------------------------

    public function nuevaMovilidad($id){

      $db = \Config\Database::connect();
      $idSanetizado = filter_var($id,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $caja = $query->getRowArray();

      $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
      $results = $query2->getResult();

      $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
      $proyectos = $query4->getResult();

      $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
      $aumentos = $query7->getResult();

      $consumido = 0;
      foreach($results as $valor){
        $consumido+= $valor->totalNeto;
      }

      $aumentado = 0;
      foreach($aumentos as $valor){
        $aumentado+= $valor->monto;
      }

      $hoy = date("Y-m-d"); 

      $data = [
        "fecha"     =>$hoy,
        "caja"      =>$caja,
        "proyectos" =>$proyectos,
        "consumido" =>$consumido,
        "aumento"   =>$aumentado
      ];

      switch(session("tipo")){
        case 1:  echo view('registroMovilidad', $data);
          break;
        case 8:  echo view('residente/registroMovilidad', $data);
          break;
        default:  return redirect()->to(base_url().'');
      }

    }

    //--------------------------------------------

    public function editMovilidad($id){

      $db = \Config\Database::connect();
      $idSanetizado = filter_var($id,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call movilidad_porID(".$idSanetizado.")");
      $movi = $query->getRowArray();

      if($movi["caja"]!= ""){

        $query2 = $db->query("call listar_facturas_porCaja(".$movi["caja"].")");
        $results = $query2->getResult();

        $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
        $proyectos = $query4->getResult();

        $query7 = $db->query("call listar_Aumentos_Caja(".$movi["caja"].")");
        $aumentos = $query7->getResult();

        $query8 = $db->query("call listar_cajachicaC_porID(".$movi["caja"].")");
        $caja = $query8->getRowArray();

        $consumido = 0;
        foreach($results as $valor){
          $consumido+= $valor->totalNeto;
        }

        $aumentado = 0;
        foreach($aumentos as $valor){
          $aumentado+= $valor->monto;
        }

        $data = [
          "caja"      =>$caja,
          "movi"      =>$movi,
          "proyectos" =>$proyectos,
          "consumido" =>$consumido-$movi["monto"],
          "aumento"   =>$aumentado
        ];

        switch(session("tipo")){
          case 1:  echo view('edicionMovilidad', $data);
            break;
          case 8:  echo view('residente/edicionMovilidad', $data);
            break;
          default:  return redirect()->to(base_url().'');
        }

      }else{
        return redirect()->to(base_url().'');
      }

    
    }

    //--------------------------------------------

    public function registrarMovilidad(){

      $db = \Config\Database::connect();
      helper(['form','url']);

      $idcaja = $this->request->getPost('caja');
      $idSanetizado = filter_var($idcaja,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $caja = $query->getRowArray();

      if($this->request->getMethod()=='post'){

        $rules = [
          'proyecto'      => 'required|is_natural_no_zero|numeric',
          'fecha'         => 'required|date',
          'origen'        => 'required',
          'destino'       => 'required',
          'motivo'        => 'required',
          'comprobante'   => 'required',
          'monto'         => 'required|decimal'
        ];

        if ($caja["caja_estado"]==1) {
        
          $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $results = $query2->getResult();

          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();

          $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
          $aumentos = $query7->getResult();

          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }

          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }

          $hoy = date("Y-m-d"); 

          $data = [
            "fecha"       =>$hoy,
            "caja"        =>$caja,
            "proyectos"   =>$proyectos,
            "consumido"   =>$consumido,
            "aumento"     =>$aumentado,
            "mensaje"     =>"Error Caja Cerrada"
          ];
    
          switch(session("tipo")){
            case 1:  echo view('registroMovilidad', $data);
              break;
            case 8:  echo view('residente/registroMovilidad', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

        }elseif (!$this->validate($rules)) {
        
          $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $results = $query2->getResult();

          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();

          $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
          $aumentos = $query7->getResult();

          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }

          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }

          $hoy = date("Y-m-d"); 

          $data = [
            "fecha"       =>$hoy,
            "caja"        =>$caja,
            "proyectos"   =>$proyectos,
            "consumido"   =>$consumido,
            "aumento"     =>$aumentado,
            "validation"  => $this->validator
          ];
    
          switch(session("tipo")){
            case 1:  echo view('registroMovilidad', $data);
              break;
            case 8:  echo view('residente/registroMovilidad', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

        }else{
          $fecha      = $this->request->getPost('fecha');
          $usuario    = $this->request->getPost('usuario');
          $proyecto   = $this->request->getPost('proyecto');
          $monto      = $this->request->getPost('monto');
          $origen     = $this->request->getPost('origen');
          $destino    = $this->request->getPost('destino');
          $motivo     = $this->request->getPost('motivo');
          $cerrar     = $this->request->getPost('cerrar');
          $cmpb       = $this->request->getPost('comprobante');

          $model = new MovilidadModel();
          $data = [
            "fecha"       => $fecha,
            "motivo"      => $motivo,
            "origen"      => $origen,
            "proyecto"    => $proyecto,
            "destino"     => $destino,
            "creador"     => $usuario,
            "monto"       => $monto,
            "caja"        => $idSanetizado,
            "comprobante" => $cmpb
          ];

          $model->save($data);

          $idttran = $model->getInsertID();

          //GUARDADO DE ACTIVIDAD-----------------
          $hoyguardar = getdate();
          $fechaguardar ="";
          $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
          $guardar = new SeguimientoModel();
          $dataguardar = [
            "usuario" =>session("idUsuario"),
            "accion" =>"SE HA REGISTRADO LA MOVILIDAD CON ID: ".$idttran,
            "fecha" =>$fechaguardar
          ];
          $guardar->save($dataguardar);
          //-----------------------------------------------

          if($cerrar == 1){

            $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
            $results = $query2->getResult();

            $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
            $proyectos = $query4->getResult();

            $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
            $aumentos = $query7->getResult();

            $consumido = 0;
            foreach($results as $valor){
              $consumido+= $valor->totalNeto;
            }

            $aumentado = 0;
            foreach($aumentos as $valor){
              $aumentado+= $valor->monto;
            }

            $hoy = date("Y-m-d"); 

            $data = [
              "fecha"       =>$hoy,
              "caja"        =>$caja,
              "proyectos"   =>$proyectos,
              "consumido"   =>$consumido,
              "aumento"     =>$aumentado,
              "mensaje2"     =>"Registrado Correctamente"
            ];
      
            switch(session("tipo")){
              case 1:  echo view('registroMovilidad', $data);
                break;
              case 8:  echo view('residente/registroMovilidad', $data);
                break;
              default:  return redirect()->to(base_url().'');
            }

          }else{
            return redirect()->to(base_url().'/cajaChicac/detalleCaja/'.$idSanetizado);
          }
          
        }
      }

    }

    //--------------------------------------------

    public function editarMovilidad(){

      $db = \Config\Database::connect();
      helper(['form','url']);

      $idcaja = $this->request->getPost('caja');
      $idmovi = $this->request->getPost('idmovi');

      $idSanetizado = filter_var($idcaja,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $caja = $query->getRowArray();

      if($this->request->getMethod()=='post'){
        $rules = [
          'proyecto'      => 'required|is_natural_no_zero|numeric',
          'fecha'         => 'required|date',
          'origen'        => 'required',
          'destino'       => 'required',
          'motivo'        => 'required',
          'comprobante'   => 'required',
          'monto'         => 'required|decimal'
        ];


        if ($caja["caja_estado"]== 1) {
          
          $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $results = $query2->getResult();

          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();

          $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
          $aumentos = $query7->getResult();

          $query8 = $db->query("call movilidad_porID(".$idmovi.")");
          $movi = $query8->getRowArray();

          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }

          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }

          $data = [
            "caja"        =>$caja,
            "movi"        =>$movi,
            "proyectos"   =>$proyectos,
            "consumido"   =>$consumido,
            "aumento"     =>$aumentado,
            "mensaje"     =>"Error Caja Cerrada"
          ];
    
          switch(session("tipo")){
            case 1:  echo view('edicionMovilidad', $data);
              break;
            case 8:  echo view('residente/edicionMovilidad', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

        }elseif (!$this->validate($rules)) {
          
          $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $results = $query2->getResult();

          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();

          $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
          $aumentos = $query7->getResult();

          $query8 = $db->query("call movilidad_porID(".$idmovi.")");
          $movi = $query8->getRowArray();

          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }

          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }

          $data = [
            "caja"        =>$caja,
            "movi"        =>$movi,
            "proyectos"   =>$proyectos,
            "consumido"   =>$consumido,
            "aumento"     =>$aumentado,
            "validation"  => $this->validator
          ];
    
          switch(session("tipo")){
            case 1:  echo view('edicionMovilidad', $data);
              break;
            case 8:  echo view('residente/edicionMovilidad', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

        }else{
          $fecha      = $this->request->getPost('fecha');
          $usuario    = $this->request->getPost('usuario');
          $proyecto   = $this->request->getPost('proyecto');
          $monto      = $this->request->getPost('monto');
          $origen     = $this->request->getPost('origen');
          $destino    = $this->request->getPost('destino');
          $motivo     = $this->request->getPost('motivo');
          $cmbp       = $this->request->getPost('comprobante');

          $model = new MovilidadModel();
          $data = [
            "fecha"         => $fecha,
            "motivo"        => $motivo,
            "origen"        => $origen,
            "proyecto"      => $proyecto,
            "destino"       => $destino,
            "creador"       => $usuario,
            "monto"         => $monto,
            "caja"          => $idcaja,
            "comprobante"   => $cmbp
          ];
          $model->save($data);

          $idttran = $model->getInsertID();

          $data2 = [
            "movilidadEdit"   => $idttran
          ];

          $model->update($idmovi,$data2);

          //GUARDADO DE ACTIVIDAD-----------------
          $hoyguardar = getdate();
          $fechaguardar ="";
          $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
          $guardar = new SeguimientoModel();
          $dataguardar = [
            "usuario" =>session("idUsuario"),
            "accion" =>"SE HA EDITADO LA MOVILIDAD CON ID: ".$idttran,
            "fecha" =>$fechaguardar
          ];
          $guardar->save($dataguardar);
          //-----------------------------------------------

          return redirect()->to(base_url().'/cajaChicac/detalleCaja/'.$idcaja);

        }
      }

    }

    //--------------------------------------------

    public function excelCaja($id){

      $db = \Config\Database::connect();
      $idSanetizado = filter_var($id,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $caja = $query->getRowArray();

      $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
      $results = $query2->getResult();

      $query5 = $db->query("call listar_movilidad_porCaja(".$idSanetizado.")");
      $movilidades = $query5->getResult();

      $query6 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
      $aumentos = $query6->getResult();

      $consumido = 0;
      foreach($results as $valor){
        $consumido+= $valor->totalNeto;
      }

      $consumido2 = 0;
      foreach($movilidades as $valor){
        $consumido2+= $valor->monto;
      }

      $aumento = 0;
      foreach($aumentos as $valor){
        $aumento+= $valor->monto;
      }

      $fecha = date("d-m-Y"); 

      $data = [
        "caja"            =>$caja,
        "facturas"        =>$results,
        "movilidades"     =>$movilidades,
        "totalconsumido"  =>$consumido + $consumido2,
        "consumidoF"      =>$consumido,
        "consumidoM"      =>$consumido2,
        "fecha"           =>$fecha,
        "aumentos"        =>$aumentos,
        "aumento"         =>$aumento,
        "nombre"          =>"REPORTE_DE_CAJA_".$caja["codigo"]."_FECHA_".$fecha
      ];

      echo view('admcajas/exportarCaja', $data);

    }

    //--------------------------------------------

    public function excelDetalladoCaja($id){

      $db = \Config\Database::connect();
      $idSanetizado = filter_var($id,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $caja = $query->getRowArray();

      $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
      $results = $query2->getResult();

      $query3 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
      $aumentos = $query3->getResult();

      $query4 = $db->query("call cabeceraReporte(".$idSanetizado.")");
      $cabecera = $query4->getResult();

      $query5 = $db->query("call cuerpoReporte(".$idSanetizado.")");
      $cuerpo = $query5->getResult();


      $consumido = 0;
      foreach($results as $valor){
        $consumido+= $valor->totalNeto;
      }

      $aumento = 0;
      foreach($aumentos as $valor){
        $aumento+= $valor->monto;
      }

      $fecha1 = date("d-m-Y h-i-s"); 
      $fecha = date("d-m-Y h:i:s"); 
      $fechaHasta = date("d/m/Y"); 

      $data = [
        "caja"            =>$caja,
        "totalconsumido"  =>$consumido,
        "fecha"           =>$fecha,
        "fechaH"          =>$fechaHasta,
        "aumento"         =>$aumento,
        "cabecera"        =>$cabecera,
        "cuerpo"          =>$cuerpo,
        "nombre"          =>"REPORTE_CAJA_CHICA_".$caja["codigo"]."_FECHA_".$fecha1
      ];

      echo view('admcajas/exportarDetalladoCaja', $data);

    }

    //--------------------------------------------

    public function aumentoCaja(){

      $id = $this->request->getPost('id');
      $db = \Config\Database::connect();
      $idSanetizado = filter_var($id,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
      $caja = $query->getResult();

      $respuestas = "";

      foreach($caja as $row){
        $respuestas.='
        <tr>
          <td class="text-center" width="100">'.$row->fecha.'</td>
          <td class="text-center" width="100">'.$row->monto.'</td>
          <td class="text-center" width="200">'.$row->texto.'</td>
          <td class="align-middle text-center" width="10">
            <a onclick="F_eliminarAumento('.$row->id.','.$idSanetizado.')" title="eliminar Aumento" class="eliminar btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
          </td>
        </tr>';
      }

      $hoy = date("Y-m-d"); 

      $data = [
        "fecha" => $hoy,
        "html"  => $respuestas,
        "caja"  => $id 
      ];

      echo json_encode($data);
      exit();
     
    }

    //--------------------------------------------

    public function aumentarCajachica(){

      $fecha = $this->request->getPost('para1');
      $monto = $this->request->getPost('para2');
      $cajaP = $this->request->getPost('para3');
      $orige = $this->request->getPost('para4');
      $obser = $this->request->getPost('para5');

      $msg = "";

      if($fecha == ""){
        $msg = "Error falta la Fecha" ;
      }

      if($monto <=0 || $monto == ""){
        $msg = "no se registro correctamente el monto" ;
      }

      if($msg==""){
        $model = new AumentoModel();
        $data = [
          "fecha"       => $fecha,
          "monto"       => $monto,
          "caja"        => $cajaP,
          "origen"      => $orige,
          "observacion" => $obser
        ];
        $model->save($data);
      }

      $db = \Config\Database::connect();
      $idSanetizado = filter_var($cajaP,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
      $caja = $query->getResult();

      $respuestas = "";

      foreach($caja as $row){
        $respuestas.='
        <tr>
          <td class="text-center" width="100">'.$row->fecha.'</td>
          <td class="text-center" width="100">'.$row->monto.'</td>
          <td class="text-center" width="200">'.$row->texto.'</td>
          <td class="align-middle text-center" width="10">
            <a onclick="F_eliminarAumento('.$row->id.','.$idSanetizado.')" title="eliminar Aumento" class="eliminar btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
          </td>
        </tr>';
      }

      $data = [
        "mensaje" => $msg,
        "html"    => $respuestas
      ];

      echo json_encode($data);
      exit();

    }

    //--------------------------------------------

    public function eliminarAumento(){
      $db = \Config\Database::connect();
      $idAumento = $this->request->getPost('para1');
      $cajaP = $this->request->getPost('para2');

      $msg = "";

      if($idAumento != "" || $idAumento != 0){
        $queryelimin = $db->query("delete from aumentoCaja WHERE id=".$idAumento);
        $elimi = $queryelimin->getResult();
        $msg = "Correcto";
      }else{
        $msg = "Error no se encontro el aumento";
      }

      
      $idSanetizado = filter_var($cajaP,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
      $caja = $query->getResult();

      $respuestas = "";

      foreach($caja as $row){
        $respuestas.='
        <tr>
          <td class="text-center" width="100">'.$row->fecha.'</td>
          <td class="text-center" width="100">'.$row->monto.'</td>
          <td class="text-center" width="200">'.$row->texto.'</td>
          <td class="align-middle text-center" width="10">
            <a onclick="F_eliminarAumento('.$row->id.','.$idSanetizado.')" title="eliminar Aumento" class="eliminar btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>
          </td>
        </tr>';
      }

      $data = [
        "mensaje" => $msg,
        "html"    => $respuestas
      ];

      echo json_encode($data);
      exit();

    }

    //--------------------------------------------

    public function cambiarNombre(){

      $id = $this->request->getPost('para1');
      $valor = $this->request->getPost('para2');

      if($valor != "" && $id != ""){
        $model = new previoDetalleFacturaModel();
        $data = [
          "item"   => $valor,
        ];
        $model->update($id,$data);

        $envio = [
          "men" => "correcto"
        ];
      }else{
        $envio = [
          "men" => "incorrecto"
        ];
      }

      echo json_encode($envio);
      exit();

    }

    //--------------------------------------------

    public function cambiarCantidad(){
      $db = \Config\Database::connect();

      $id = $this->request->getPost('para1');
      $valor = $this->request->getPost('para2');

      if($valor != "" && $id != "" && $valor>0){
        $model = new previoDetalleFacturaModel();
        $data = [
          "cantidad"   => $valor,
        ];
        $model->update($id,$data);

        $queryObtPrv= $db->query("select * from previoDetalleFactura where id=".$id);
        $previo = $queryObtPrv->getRowArray();

        if($previo["idFactura"]!=""){
          $queryObt= $db->query("select * from previoDetalleFactura where idFactura=".$previo["idFactura"]." AND usuario=".session("idUsuario"));
          $lista = $queryObt->getResult();
        }else{
          $queryObt= $db->query("select * from previoDetalleFactura where idFactura IS NULL AND usuario=".session("idUsuario"));
          $lista = $queryObt->getResult();
        }

        $total = 0;
        foreach($lista as $valor){
          $total += ($valor->precio*$valor->cantidad);
        }

        $envio = [
          "men"   => "correcto",
          "total" => number_format($total, 2, '.', ''),
        ];

      }else{
        $envio = [
          "men" => "incorrecto"
        ];
      }

      echo json_encode($envio);
      exit();

    }

    //--------------------------------------------

    public function cambiarPrecio(){
      $db = \Config\Database::connect();

      $id = $this->request->getPost('para1');
      $valor = $this->request->getPost('para2');

      if($valor != "" && $id != "" && $valor>0){
        $model = new previoDetalleFacturaModel();
        $data = [
          "precio"   => $valor,
        ];
        $model->update($id,$data);

        $queryObtPrv= $db->query("select * from previoDetalleFactura where id=".$id);
        $previo = $queryObtPrv->getRowArray();

        if($previo["idFactura"]!=""){
          $queryObt= $db->query("select * from previoDetalleFactura where idFactura=".$previo["idFactura"]." AND usuario=".session("idUsuario"));
          $lista = $queryObt->getResult();
        }else{
          $queryObt= $db->query("select * from previoDetalleFactura where idFactura IS NULL AND usuario=".session("idUsuario"));
          $lista = $queryObt->getResult();
        }

        $total = 0;
        foreach($lista as $valor){
          $total += ($valor->precio*$valor->cantidad);
        }

        $envio = [
          "men" => "correcto",
          "total" =>number_format($total, 2, '.', ''),
        ];

      }else{
        $envio = [
          "men" => "incorrecto"
        ];
      }

      echo json_encode($envio);
      exit();

    }

    //--------------------------------------------

    public function eliminarFactura(){
      $db = \Config\Database::connect();

      $idcaja = $this->request->getPost('idelimcaja');
      $idfactura = $this->request->getPost('idelimfactura');

      if($this->request->getMethod()=='post' && $idcaja!="" && $idfactura!=""){

        $idSanetizado = filter_var($idcaja,FILTER_SANITIZE_NUMBER_INT );
        $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
        $caja = $query->getRowArray();


        // SI se elimina la factura, se elimina la movilidad o el refrigerio
        if ($caja["caja_estado"]==0){

          $model = new FacturaModel();
          $data = [
            "facturaEdit" => 0
          ];
          $model->update($idfactura,$data);

          $queryMovi = $db->query("call buscarMovilidadxCmpb(".$idfactura.")");
          $movi = $queryMovi->getRowArray();

          $queryRefri = $db->query("call buscarRefrigerioxCmpb(".$idfactura.")");
          $refri = $queryRefri->getRowArray();

          if($movi != null){
            $model2 = new MovilidadModel();
            $data2 = [
              "movilidadEdit" => 0
            ];
            $model2->update($movi["id"],$data2);
          }

          if($refri != null){
            $model3 = new RefrigerioModel();
            $data3 = [
              "refrigerioEdit" => 0
            ];
            $model3->update($refri["id"],$data3);
          }

        }

        $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
        $results = $query2->getResult();

        $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
        $proveedores = $query3->getResult();

        $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
        $proyectos = $query4->getResult();

        $query5 = $db->query("call listar_movilidad_porCaja(".$idSanetizado.")");
        $movilidades = $query5->getResult();

        $query6 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
        $aumentos = $query6->getResult();

        $query8 = $db->query("call listar_refrigerio_porCaja(".$idSanetizado.")");
        $refrigerios = $query8->getResult();

        $consumido = 0;
        foreach($results as $valor){
          $consumido+= $valor->totalNeto;
        }

        $aumentado = 0;
        foreach($aumentos as $valor){
          $aumentado+= $valor->monto;
        }

        $data = [
          "caja"      =>$caja,
          "lista"     =>$results,
          "lista2"    =>$movilidades,
          "lista3"    =>$refrigerios,
          "proye"     =>$proyectos,
          "prove"     =>$proveedores,
          "aumento"   =>$aumentado,
          "consumido" =>$consumido,
          "mensaje"   =>"Comprobante Eliminado y asociados"
        ];

        $queryFactuid = $db->query("call cabecera_Factura_porID(".$idfactura.")");
        $facturaC = $queryFactuid->getRowArray();

        //GUARDADO DE ACTIVIDAD-----------------
        $hoyguardar = getdate();
        $fechaguardar ="";
        $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
        $guardar = new SeguimientoModel();
        $dataguardar = [
          "usuario" =>session("idUsuario"),
          "accion" =>"SE HA ElIMINADO EL COMPROBANTE: ".$facturaC["factura"],
          "fecha" =>$fechaguardar
        ];
        $guardar->save($dataguardar);
        //-----------------------------------------------

        switch(session("tipo")){
           case 1:  echo view('listaFacturas', $data);
            break;
           case 8:  echo view('residente/listaFacturas', $data);
            break;
          default:  return redirect()->to(base_url().'');
        }
      
      }


      
    }

    //--------------------------------------------

    public function eliminarMovilidad(){
      $db = \Config\Database::connect();

      $idcaja = $this->request->getPost('idelimcaja2');
      $idmovi = $this->request->getPost('idelimmovilidad');

      if($this->request->getMethod()=='post' && $idcaja!="" && $idmovi!=""){

        $idSanetizado = filter_var($idcaja,FILTER_SANITIZE_NUMBER_INT );
        $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
        $caja = $query->getRowArray();

        if ($caja["caja_estado"]==0){
          $model = new MovilidadModel();
          $data = [
            "movilidadEdit" => 0
          ];
          $model->update($idmovi,$data);
        }

        $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
        $results = $query2->getResult();

        $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
        $proveedores = $query3->getResult();

        $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
        $proyectos = $query4->getResult();

        $query5 = $db->query("call listar_movilidad_porCaja(".$idSanetizado.")");
        $movilidades = $query5->getResult();

        $query6 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
        $aumentos = $query6->getResult();

        $query8 = $db->query("call listar_refrigerio_porCaja(".$idSanetizado.")");
        $refrigerios = $query8->getResult();

        $consumido = 0;
        foreach($results as $valor){
          $consumido+= $valor->totalNeto;
        }

        $aumentado = 0;
        foreach($aumentos as $valor){
          $aumentado+= $valor->monto;
        }

        $data = [
          "caja"      =>$caja,
          "lista"     =>$results,
          "lista2"    =>$movilidades,
          "lista3"    =>$refrigerios,
          "proye"     =>$proyectos,
          "prove"     =>$proveedores,
          "aumento"   =>$aumentado,
          "consumido" =>$consumido,
          "mensaje"   =>"Movilidad Eliminada"
        ];

        //GUARDADO DE ACTIVIDAD-----------------
        $hoyguardar = getdate();
        $fechaguardar ="";
        $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
        $guardar = new SeguimientoModel();
        $dataguardar = [
          "usuario" =>session("idUsuario"),
          "accion" =>"SE HA ElIMINADO LA MOVILIDAD CON ID: ".$idmovi,
          "fecha" =>$fechaguardar
        ];
        $guardar->save($dataguardar);
        //-----------------------------------------------

        switch(session("tipo")){
           case 1:  echo view('listaFacturas', $data);
            break;
           case 8:  echo view('residente/listaFacturas', $data);
            break;
          default:  return redirect()->to(base_url().'');
        }
      
      }


      
    }    

    //--------------------------------------------

    public function traerProveedores(){
      $db = \Config\Database::connect();
      $query = $db->query('Select * From proveedor_temp Where estado = 0 Order By id DESC');
      $results = $query->getResult();
  
      $data =[
        "data" => $results
      ];
      echo json_encode($data);
      exit();
    }

    //--------------------------------------------

    public function nuevoRefrigerio($id){

      $db = \Config\Database::connect();
      $idSanetizado = filter_var($id,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $caja = $query->getRowArray();

      $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
      $results = $query2->getResult();

      $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
      $proyectos = $query4->getResult();

      $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
      $aumentos = $query7->getResult();

      $consumido = 0;
      foreach($results as $valor){
        $consumido+= $valor->totalNeto;
      }

      $aumentado = 0;
      foreach($aumentos as $valor){
        $aumentado+= $valor->monto;
      }

      $hoy = date("Y-m-d"); 

      $data = [
        "fecha"     =>$hoy,
        "caja"      =>$caja,
        "proyectos" =>$proyectos,
        "consumido" =>$consumido,
        "aumento"   =>$aumentado
      ];

      switch(session("tipo")){
        case 1:  echo view('registroRefrigerio', $data);
          break;
        case 8:  echo view('residente/registroRefrigerio', $data);
          break;
        default:  return redirect()->to(base_url().'');
      }

    }

    //--------------------------------------------

    public function editRefrigerio($id){

      $db = \Config\Database::connect();
      $idSanetizado = filter_var($id,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call refrigerio_porID(".$idSanetizado.")");
      $refri = $query->getRowArray();

      if($refri["caja"]!= ""){

        $query2 = $db->query("call listar_facturas_porCaja(".$refri["caja"].")");
        $results = $query2->getResult();

        $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
        $proyectos = $query4->getResult();

        $query7 = $db->query("call listar_Aumentos_Caja(".$refri["caja"].")");
        $aumentos = $query7->getResult();

        $query8 = $db->query("call listar_cajachicaC_porID(".$refri["caja"].")");
        $caja = $query8->getRowArray();

        $consumido = 0;
        foreach($results as $valor){
          $consumido+= $valor->totalNeto;
        }

        $aumentado = 0;
        foreach($aumentos as $valor){
          $aumentado+= $valor->monto;
        }

        $data = [
          "caja"      =>$caja,
          "refri"     =>$refri,
          "proyectos" =>$proyectos,
          "consumido" =>$consumido,
          "aumento"   =>$aumentado
        ];

        switch(session("tipo")){
          case 1:  echo view('edicionRefrigerio', $data);
            break;
          case 8:  echo view('residente/edicionRefrigerio', $data);
            break;
          default:  return redirect()->to(base_url().'');
        }

      }else{
        return redirect()->to(base_url().'');
      }

    
    }

    //--------------------------------------------

    public function registrarRefrigerio(){

      $db = \Config\Database::connect();
      helper(['form','url']);

      $idcaja = $this->request->getPost('caja');
      $idSanetizado = filter_var($idcaja,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $caja = $query->getRowArray();

      if($this->request->getMethod()=='post'){

        $rules = [
          'proyecto'      => 'required|is_natural_no_zero|numeric',
          'fecha'         => 'required|date',
          'motivo'        => 'required',
          'comprobante'   => 'required',
          'monto'         => 'required|decimal'
        ];

        if ($caja["caja_estado"]==1) {
        
          $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $results = $query2->getResult();

          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();

          $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
          $aumentos = $query7->getResult();

          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }

          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }

          $hoy = date("Y-m-d"); 

          $data = [
            "fecha"       =>$hoy,
            "caja"        =>$caja,
            "proyectos"   =>$proyectos,
            "consumido"   =>$consumido,
            "aumento"     =>$aumentado,
            "mensaje"     =>"Error Caja Cerrada"
          ];
    
          switch(session("tipo")){
            case 1:  echo view('registroRefrigerio', $data);
              break;
            case 8:  echo view('residente/registroRefrigerio', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

        }elseif (!$this->validate($rules)) {
        
          $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $results = $query2->getResult();

          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();


          $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
          $aumentos = $query7->getResult();


          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }

          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }

          $hoy = date("Y-m-d"); 

          $data = [
            "fecha"       =>$hoy,
            "caja"        =>$caja,
            "proyectos"   =>$proyectos,
            "consumido" =>$consumido,
            "aumento"     =>$aumentado,
            "validation"  => $this->validator
          ];
    
          switch(session("tipo")){
            case 1:  echo view('registroRefrigerio', $data);
              break;
            case 8:  echo view('residente/registroRefrigerio', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

        }else{
          $fecha      = $this->request->getPost('fecha');
          $usuario    = $this->request->getPost('usuario');
          $proyecto   = $this->request->getPost('proyecto');
          $monto      = $this->request->getPost('monto');
          $motivo     = $this->request->getPost('motivo');
          $cerrar     = $this->request->getPost('cerrar');
          $cmpb       = $this->request->getPost('comprobante');

          $model = new RefrigerioModel();
          $data = [
            "fecha"   => $fecha,
            "motivo"  => $motivo,
            "proyecto"=> $proyecto,
            "creador" => $usuario,
            "monto"   => $monto,
            "caja"    => $idSanetizado,
            "comprobante" => $cmpb
          ];

          $model->save($data);

          $idttran = $model->getInsertID();

          //GUARDADO DE ACTIVIDAD-----------------
          $hoyguardar = getdate();
          $fechaguardar ="";
          $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
          $guardar = new SeguimientoModel();
          $dataguardar = [
            "usuario" =>session("idUsuario"),
            "accion" =>"SE HA REGISTRADO EL REFRIGERIO CON ID: ".$idttran,
            "fecha" =>$fechaguardar
          ];
          $guardar->save($dataguardar);
          //-----------------------------------------------

          if($cerrar == 1){

            $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
            $results = $query2->getResult();

            $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
            $proyectos = $query4->getResult();

            $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
            $aumentos = $query7->getResult();

            $consumido = 0;
            foreach($results as $valor){
              $consumido+= $valor->totalNeto;
            }

            $aumentado = 0;
            foreach($aumentos as $valor){
              $aumentado+= $valor->monto;
            }

            $hoy = date("Y-m-d"); 

            $data = [
              "fecha"       =>$hoy,
              "caja"        =>$caja,
              "proyectos"   =>$proyectos,
              "consumido"   =>$consumido,
              "aumento"     =>$aumentado,
              "mensaje2"     =>"Registrado Correctamente"
            ];
      
            switch(session("tipo")){
              case 1:  echo view('registroRefrigerio', $data);
                break;
              case 8:  echo view('residente/registroRefrigerio', $data);
                break;
              default:  return redirect()->to(base_url().'');
            }

          }else{
            return redirect()->to(base_url().'/cajaChicac/detalleCaja/'.$idSanetizado);
          }
          
        }
      }

    }

    //--------------------------------------------

    public function editarRefrigerio(){

      $db = \Config\Database::connect();
      helper(['form','url']);

      $idcaja = $this->request->getPost('caja');
      $idrefri = $this->request->getPost('idrefri');

      $idSanetizado = filter_var($idcaja,FILTER_SANITIZE_NUMBER_INT );
      $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
      $caja = $query->getRowArray();

      if($this->request->getMethod()=='post'){
        $rules = [
          'proyecto'  => 'required|is_natural_no_zero|numeric',
          'fecha'     => 'required|date',
          'motivo'    => 'required',
          'comprobante'   => 'required',
          'monto'     => 'required|decimal'
        ];


        if ($caja["caja_estado"]== 1) {
          
          $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $results = $query2->getResult();

          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();

          $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
          $aumentos = $query7->getResult();

          $query8 = $db->query("call refrigerio_porID(".$idrefri.")");
          $refri = $query8->getRowArray();

          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }


          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }

          $data = [
            "caja"        =>$caja,
            "refri"       =>$refri,
            "proyectos"   =>$proyectos,
            "consumido"   =>$consumido,
            "aumento"     =>$aumentado,
            "mensaje"     =>"Error Caja Cerrada"
          ];
    
          switch(session("tipo")){
            case 1:  echo view('edicionRefrigerio', $data);
              break;
            case 8:  echo view('residente/edicionRefrigerio', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

        }elseif (!$this->validate($rules)) {
          
          $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
          $results = $query2->getResult();

          $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
          $proyectos = $query4->getResult();

          $query7 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
          $aumentos = $query7->getResult();

          $query8 = $db->query("call refrigerio_porID(".$idrefri.")");
          $refri = $query8->getRowArray();


          $consumido = 0;
          foreach($results as $valor){
            $consumido+= $valor->totalNeto;
          }


          $aumentado = 0;
          foreach($aumentos as $valor){
            $aumentado+= $valor->monto;
          }

          $data = [
            "caja"        =>$caja,
            "refri"       =>$refri,
            "proyectos"   =>$proyectos,
            "consumido"   =>$consumido,
            "aumento"     =>$aumentado,
            "validation"  => $this->validator
          ];
    
          switch(session("tipo")){
            case 1:  echo view('edicionRefrigerio', $data);
              break;
            case 8:  echo view('residente/edicionRefrigerio', $data);
              break;
            default:  return redirect()->to(base_url().'');
          }

        }else{
          $fecha      = $this->request->getPost('fecha');
          $usuario    = $this->request->getPost('usuario');
          $proyecto   = $this->request->getPost('proyecto');
          $monto      = $this->request->getPost('monto');
          $motivo     = $this->request->getPost('motivo');
          $cmbp       = $this->request->getPost('comprobante');

          $model = new RefrigerioModel();
          $data = [
            "fecha"         => $fecha,
            "motivo"        => $motivo,
            "proyecto"      => $proyecto,
            "creador"       => $usuario,
            "monto"         => $monto,
            "caja"          => $idcaja,
            "comprobante"   => $cmbp
          ];
          $model->save($data);

          $idttran = $model->getInsertID();

          $data2 = [
            "refrigerioEdit"   => $idttran
          ];

          $model->update($idrefri,$data2);

          //GUARDADO DE ACTIVIDAD-----------------
          $hoyguardar = getdate();
          $fechaguardar ="";
          $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
          $guardar = new SeguimientoModel();
          $dataguardar = [
            "usuario" =>session("idUsuario"),
            "accion" =>"SE HA EDITADO EL REFRIGERIO CON ID: ".$idttran,
            "fecha" =>$fechaguardar
          ];
          $guardar->save($dataguardar);
          //-----------------------------------------------

          return redirect()->to(base_url().'/cajaChicac/detalleCaja/'.$idcaja);

        }
      }

    }

    //--------------------------------------------

    public function eliminarRefrigerio(){
      $db = \Config\Database::connect();

      $idcaja = $this->request->getPost('idelimcaja3');
      $idrefri = $this->request->getPost('idelimrefrigerio');

      if($this->request->getMethod()=='post' && $idcaja!="" && $idrefri!=""){

        $idSanetizado = filter_var($idcaja,FILTER_SANITIZE_NUMBER_INT );
        $query = $db->query("call listar_cajachicaC_porID(".$idSanetizado.")");
        $caja = $query->getRowArray();

        if ($caja["caja_estado"]==0){
          $model = new RefrigerioModel();
          $data = [
            "refrigerioEdit" => 0
          ];
          $model->update($idrefri,$data);
        }

        $query2 = $db->query("call listar_facturas_porCaja(".$idSanetizado.")");
        $results = $query2->getResult();

        $query3 = $db->query("select * from proveedor_temp where estado=0 ORDER BY descripcion");
        $proveedores = $query3->getResult();

        $query4 = $db->query("select * from proyecto_temp where estado=0 ORDER BY descripcion");
        $proyectos = $query4->getResult();

        $query5 = $db->query("call listar_movilidad_porCaja(".$idSanetizado.")");
        $movilidades = $query5->getResult();

        $query6 = $db->query("call listar_Aumentos_Caja(".$idSanetizado.")");
        $aumentos = $query6->getResult();

        $query8 = $db->query("call listar_refrigerio_porCaja(".$idSanetizado.")");
        $refrigerios = $query8->getResult();

        $consumido = 0;
        foreach($results as $valor){
          $consumido+= $valor->totalNeto;
        }

        $aumentado = 0;
        foreach($aumentos as $valor){
          $aumentado+= $valor->monto;
        }

        $data = [
          "caja"      =>$caja,
          "lista"     =>$results,
          "lista2"    =>$movilidades,
          "lista3"    =>$refrigerios,
          "proye"     =>$proyectos,
          "prove"     =>$proveedores,
          "aumento"   =>$aumentado,
          "consumido" =>$consumido,
          "mensaje"   =>"Refrigerio Eliminado"
        ];

        //GUARDADO DE ACTIVIDAD-----------------
        $hoyguardar = getdate();
        $fechaguardar ="";
        $fechaguardar = $hoyguardar['year'].'-'.$hoyguardar['mon'].'-'.$hoyguardar['mday'].' '.$hoyguardar['hours'].':'.$hoyguardar['minutes'].':'.$hoyguardar['seconds'];
        $guardar = new SeguimientoModel();
        $dataguardar = [
          "usuario" =>session("idUsuario"),
          "accion" =>"SE HA ElIMINADO EL REFRIGERIO CON ID: ".$idrefri,
          "fecha" =>$fechaguardar
        ];
        $guardar->save($dataguardar);
        //-----------------------------------------------

        switch(session("tipo")){
           case 1:  echo view('listaFacturas', $data);
            break;
           case 8:  echo view('residente/listaFacturas', $data);
            break;
          default:  return redirect()->to(base_url().'');
        }
      
      }


      
    }  

    //--------------------------------------------

    public function buscarComprobante(){
  		$palabra = $this->request->getPost('palabra');
      $idCaja = $this->request->getPost('idCaja');
  		$db = \Config\Database::connect();
  		$query1 = $db->query("call buscarComprobante(".$idCaja.",'".$palabra."')");
  		$results1 = $query1->getResult();

      $respuestas = null;
      foreach ($results1 as $row){
        $respuestas.='<a valor="'.$row->id.'" fact="'.$row->factura.'" mont="'.$row->totalNeto.'" class="boton-pruebali compro" style="text-decoration: none;cursor: pointer;" onclick="unir()">
                        <li class="list-group-item boton-prueba">'.$row->factura.' - '.$row->proveedor.'</li>
                      </a>';
      }

      echo json_encode($respuestas);
      exit();
  	}

    //--------------------------------------------

    public function buscarComprobante2(){
  		$palabra = $this->request->getPost('palabra');
      $idCaja = $this->request->getPost('idCaja');
      $idFact = $this->request->getPost('idFact');

      if($idFact == ""){
        $idFact = null;
      }

  		$db = \Config\Database::connect();
  		$query1 = $db->query("call buscarComprobante2(".$idCaja.",'".$palabra."',".$idFact.")");
  		$results1 = $query1->getResult();

      $respuestas = null;
      foreach ($results1 as $row){
        $respuestas.='<a valor="'.$row->id.'" fact="'.$row->factura.'" mont="'.$row->totalNeto.'" class="boton-pruebali compro" style="text-decoration: none;cursor: pointer;" onclick="unir()">
                        <li class="list-group-item boton-prueba">'.$row->factura.' - '.$row->proveedor.'</li>
                      </a>';
      }

      echo json_encode($respuestas);
      exit();
  	}

//--------------------------------------------------------------------

}
