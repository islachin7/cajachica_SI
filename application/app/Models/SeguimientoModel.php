<?php namespace App\Models;

use CodeIgniter\Model;

class SeguimientoModel extends Model
{

    protected $table = 'seguimiento';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['usuario','accion','fecha'];

}
