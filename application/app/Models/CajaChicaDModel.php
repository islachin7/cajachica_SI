<?php namespace App\Models;
use CodeIgniter\Model;
class CajaChicaDModel extends Model
{
    protected $table = "cajaChicaD";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $useSoftDeletes = true;
    protected $allowedFields = ["id_cajachicac","id_orden_compra"];
}
