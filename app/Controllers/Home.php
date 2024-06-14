<?php

namespace App\Controllers;

use App\Models\moduloModel;

class Home extends BaseController
{
    private $moduloModel;
    private $db;
    public function __construct()
    {
        $this->moduloModel = new moduloModel();
        $this->db = \config\Database::connect();
    }
    public function listarModulos()
    {
        $resultado = $this->moduloModel->select("`TITULO`, `ICONO`, `RUTA`")->findAll();
        return $this->response->setJSON($resultado);
    }
    public function index()
    {
        $nombre = $this->request->getJSON()->nombre;

$resultado = $this->moduloModel->query(
    "SELECT TITULO, ICONO, RUTA FROM `modulo`
    JOIN permisos_modulos ON permisos_modulos.ID_MODULO = modulo.ID_MODULO
    JOIN rol ON permisos_modulos.ID_ROL = rol.ID_ROL
    JOIN usuario ON rol.ID_ROL = usuario.ID_ROL
    WHERE permisos_modulos.VISTA = 1 AND usuario.NOMBRE = ?",
    [$nombre]
);

$datos = $resultado->getResultArray();

return $this->response->setJSON($datos);

}
}
