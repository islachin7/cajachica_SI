<?php namespace App\Models;
use CodeIgniter\Model;
class MovilidadModel extends Model
{
    protected $table = "movilidad";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $useSoftDeletes = true;
    protected $allowedFields = ["fecha","motivo","origen","destino","creador","proyecto","caja","monto","movilidadEdit","comprobante"];
}
