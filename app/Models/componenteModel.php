<?php
namespace App\Models;

use CodeIgniter\Model;

class componenteModel extends Model
{
    protected $table = 'componente';
    protected $primaryKey = 'ID_componente';
    protected $allowedFields = ['TITULO','ICONO'];
    public function listarcomponentes()
    {
        $db = $this->db;    
        $query = $db->table('componente')->select('*')->get();
        return  $query->getRowArray();
    }
    public function listarcomponentesAutorizados($id)
    {
        $db = $this->db;    
        $query = $db->table('componente')
            ->select(['componente.NOMBRE_COMPONENTE', 'componente.ICONO AS ICONO_COMPONENTE', 'componente.RUTA', 'modulo.ID_MODULO'])
            ->join('modulo','modulo.ID_MODULO = componente.ID_MODULO')
            ->join('permisos_componentes', 'permisos_componentes.ID_componente = componente.ID_componente')
            ->join('rol', 'permisos_componentes.ID_ROL = rol.ID_ROL')
            ->join('usuario', 'rol.ID_ROL = usuario.ID_ROL')
            ->where('permisos_componentes.VISTA', 1)
            ->where('usuario.ID', $id)
            ->get();
        return  $query->getResult();
    }

}