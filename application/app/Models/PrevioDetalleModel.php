<?php namespace App\Models;

use CodeIgniter\Model;

class PrevioDetalleModel extends Model
{

    protected $table = 'previoDetalle';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['codigo','material','usuario',"idmaterial","medida"];

}
