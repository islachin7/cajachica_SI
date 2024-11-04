<?php namespace App\Controllers;
use App\Models\SeguimientoModel;
class Seguimientoc extends BaseController
{
  	public function index(){
  		$db = \Config\Database::connect();
  		$query = $db->query('SELECT s.fecha,s.accion,concat(u.nombre," ",u.apellido) as usuario FROM seguimiento s left join usuario u on s.usuario = u.id order by s.fecha desc');
  		$results = $query->getResult();
  		$data =[
  			"lista" => $results
  		];
  		echo view('gerencia/listaSeguimiento', $data);
  	}

	public function index2(){
		$db = \Config\Database::connect();
		$query = $db->query('SELECT s.fecha as Fecha,
									concat(u.nombre," ",u.apellido) as Usuario,
									s.accion  as Actividad
								FROM seguimiento s 
							left join usuario u on s.usuario = u.id 
							order by s.fecha desc');
		$results = $query->getResult();

		$data =[
			"data" => $results
		];
		echo json_encode($data);
        exit();
	}
//--------------------------------------------------------------------
}
