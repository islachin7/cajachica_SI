<?php namespace App\Models;
use CodeIgniter\Model;
class RefrigerioModel extends Model
{
    protected $table = "refrigerio";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $useSoftDeletes = true;
    protected $allowedFields = ["fecha","motivo","creador","proyecto","caja","monto","refrigerioEdit","comprobante"];
}
