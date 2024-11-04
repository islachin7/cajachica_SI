<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{

    protected $table = 'usuario';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['nombre', 'apellido','correo','celular','contrasena','tipousuario','estado'];

/*
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data){
    $data = $this->passwordHash($data);
    $data['data']['fecha_creacion'] = date('Y-m-d H:i:s');
    return $data;
  }

  protected function beforeUpdate(array $data){
    $data = $this->passwordHash($data);
    $data['data']['fecha_actualizacion'] = date('Y-m-d H:i:s');
    return $data;
  }

  protected function passwordHash(array $data){
    if(isset($data['data']['password']))
      $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

    return $data;
  }*/




}
