<?php namespace App\Models;
use CodeIgniter\Model;
class CajaChicaCModel extends Model
{
    protected $table = "cajaChicaC";
    protected $primaryKey = "id";
    protected $returnType = "array";
    protected $useSoftDeletes = true;
    protected $allowedFields = ["codigo","fecha_apertura","fecha_cierre","asignado","creado","montoTotal","montoCompra","caja_estado","totalConsumido","ultsaldo","cajaUltSaldo","proyecto"];
}
