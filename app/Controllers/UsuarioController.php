<?php

namespace App\Controllers;

use App\Models\componenteModel;
use App\Models\moduloModel;
use App\Models\usuarioModel;
use CodeIgniter\HTTP\Request;

class UsuarioController extends BaseController
{
    private $usuarioModel;
    private $db;
    public function __construct()
    {
        $this->usuarioModel = new usuarioModel();
    }

    public function listarUsuarioId()
    {
        $id = $this->request->getJSON('ID');
        $dataa = $this->usuarioModel->listarUsuarioId($id);
        return  $this->response->setJSON($dataa);
    }
    public function listarUsuarios()
    {
        $data = $this->usuarioModel->listarUsuarios();
        return  $this->response->setJSON($data);
        $CLAVE = env('JWT_SEGURA');
    }
 
}
