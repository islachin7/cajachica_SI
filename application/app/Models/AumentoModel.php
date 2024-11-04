<?php namespace App\Models;
use CodeIgniter\Model;
class AumentoModel extends Model
{
    protected $table = 'aumentoCaja';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['fecha','monto','caja','origen','observacion'];
}
