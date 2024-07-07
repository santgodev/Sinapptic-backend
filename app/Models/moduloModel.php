<?php

namespace App\Models;

use CodeIgniter\Model;

class moduloModel extends Model
{
    protected $table = 'modulo';
    protected $primaryKey = 'ID_MODULO';
    protected $allowedFields = ['TITULO', 'ICONO'];


    public function listarModulos()
    {
        $query = $this->select(['TITULO', 'ICONO'])
            ->get();
        return $query->getResult();
    }
    public function listarModulosAutorizados($id)
    {
        $db = $this->db;
        $query = $db->table('modulo')
            ->select(['modulo.TITULO', 'modulo.ICONO', 'modulo.ID_MODULO'])
            ->join('componente', 'modulo.ID_MODULO = componente.ID_MODULO')
            ->join('permisos_componentes', 'permisos_componentes.ID_componente = componente.ID_componente')
            ->join('rol', 'permisos_componentes.ID_ROL = rol.ID_ROL')
            ->join('usuario', 'rol.ID_ROL = usuario.ID_ROL')
            ->where('permisos_componentes.VISTA', 1)
            ->where('usuario.ID', $id)
            ->groupBy('ID_MODULO')
            ->get();
        return  $query->getResult();
    }


    function listarcomponenteID($ID)
    {
        $builder = $this->db->table('componente')->select(['TITULO', 'ICONO', 'RUTA']);
        $builder->where('ID_componente', $ID);
        $query = $builder->get()->getResult();
        return $query;
    }
}
