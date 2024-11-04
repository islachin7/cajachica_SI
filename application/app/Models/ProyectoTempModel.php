<?php namespace App\Models;
use CodeIgniter\Model;
class ProyectoTempModel extends Model
{
    protected $table = 'proyecto_temp';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['descripcion','estado'];
}
