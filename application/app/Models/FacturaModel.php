<?php namespace App\Models;
use CodeIgniter\Model;
class FacturaModel extends Model
{
    protected $table = 'factura';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['fecha','totalNeto','estado','factura','proveedor','usuario','proyecto','caja','igv','facturaEdit','tipoCmpb'];
}
