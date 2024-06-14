<?php
namespace App\Models;

use CodeIgniter\Model;

class moduloModel extends Model
{
    protected $table = 'modulo';
    protected $primaryKey = 'ID_MODULO';
    protected $allowedFields = ['TITULO','ICONO', 'RUTA'];
}