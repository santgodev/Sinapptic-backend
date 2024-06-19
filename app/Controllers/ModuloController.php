<?php

namespace App\Controllers;

use App\Models\moduloModel;
use CodeIgniter\HTTP\Request;

class ModuloController extends BaseController
{
    private $moduloModel;
    private $db;
    public function __construct()
    {
        $this->moduloModel = new moduloModel();
        $this->db = \config\Database::connect();
    }
    public function listarModulo()
    {
        $resultado = $this->moduloModel->select("`TITULO`, `ICONO`, `RUTA`")->findAll();
        return $this->response->setJSON($resultado);
    }
    function listarModuloID()
    {
        $id = $this->request->getJSON('ID_MODULO');
        $db = $this->db;
        $builder = $db->table('modulo')->select(['TITULO', 'ICONO', 'RUTA']);
        $builder->where('ID_MODULO', $id);
        $query = $builder->get()->getResult();
        return $this->response->setJSON($query);
    }
    public function listarModulosAutorizados()
    {
        $db = $this->db;
        $nombreUsuario = $this->request->getJSON('nombre');
    
        $query = $db->table('modulo')
            ->select(['TITULO', 'ICONO', 'RUTA'])
            ->join('permisos_modulos', 'permisos_modulos.ID_MODULO = modulo.ID_MODULO')
            ->join('rol', 'permisos_modulos.ID_ROL = rol.ID_ROL')
            ->join('usuario', 'rol.ID_ROL = usuario.ID_ROL')
            ->where('permisos_modulos.VISTA', 1)
            ->where('usuario.NOMBRE', $nombreUsuario)
            ->get();
    
        $resultados = $query->getResult();
        return $this->response->setJSON($resultados);
    }
}
