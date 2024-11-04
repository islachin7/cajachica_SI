<?php namespace App\Models;
use CodeIgniter\Model;
class previoDetalleFacturaModel extends Model
{
    protected $table = 'previoDetalleFactura';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['cantidad','precio','item','usuario','idFactura'];
}
