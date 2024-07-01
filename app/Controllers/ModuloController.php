<?php

namespace App\Controllers;

use App\Models\componenteModel;
use App\Models\moduloModel;
use CodeIgniter\HTTP\Request;

class ModuloController extends BaseController
{
    private $componenteModel;
    public function __construct()
    {
        $this->componenteModel = new moduloModel();
    }

    public function listarModulosAutorizados(){
        $idUsuario = $this->request->getJSON('ID');
        $componentes = $this->componenteModel->listarModulos($idUsuario);
        if ($componentes) {
            return $this->response->setJSON($componentes);
        } else {
            return $this->response->setJSON(['error' => 'No se encontraron componentes autorizados']);
        }
    }
}
