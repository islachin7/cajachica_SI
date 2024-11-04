<?php namespace App\Models;
use CodeIgniter\Model;
class DetalleFacturaModel extends Model
{
    protected $table = 'detalleFactura';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['cantidad','precio','item','factura'];
}
