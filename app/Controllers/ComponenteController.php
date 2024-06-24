<?php

namespace App\Controllers;

use App\Models\componenteModel;
use CodeIgniter\HTTP\Request;

class ComponenteController extends BaseController
{
    private $componenteModel;
    public function __construct()
    {
        $this->componenteModel = new componenteModel();
    }
    public function listarcomponentesAutorizados(){
        $idUsuario = $this->request->getJSON('ID');
        $componentes = $this->componenteModel->listarcomponentesAutorizados($idUsuario);
        if ($componentes) {
            return $this->response->setJSON($componentes);
        } else {
            return $this->response->setJSON(['error' => 'No se encontraron componentes autorizados']);
        }
    }
}