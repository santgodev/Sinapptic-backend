<?php

namespace App\Controllers;

use App\Models\componenteModel;

class ComponenteController extends BaseController
{
    private $componenteModel;
    public function __construct()
    {
        $this->componenteModel = new componenteModel();
    }

    public function listarComponentes(){
        $componentes=$this->componenteModel->listarcomponentes();
        return $this->response->setJSON($componentes);
    }


    public function listarcomponentesAutorizados(){
        $request = $this->request->getJSON();
        $idUsuario=$request->ID;
        $componentes = $this->componenteModel->listarcomponentesAutorizados($idUsuario);
        if ($componentes) {
            return $this->response->setJSON($componentes);
        } else {
            return $this->response->setJSON(['error' => 'No se encontraron componentes autorizados']);
        }
    }
}