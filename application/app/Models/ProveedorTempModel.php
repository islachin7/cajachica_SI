<?php namespace App\Models;
use CodeIgniter\Model;
class ProveedorTempModel extends Model
{
    protected $table = 'proveedor_temp';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['descripcion','dniRuc','estado'];
}
