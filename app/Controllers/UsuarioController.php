<?php

namespace App\Controllers;

use App\Models\usuarioModel;

class UsuarioController extends BaseController
{
    private $usuarioModel;
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
    }

    public function insertarUsuario()
    {
        helper('secure_password_helpers');

        $request = $this->request->getJSON();

        $data = [
            'ID' => null,
            'NOMBRE' => $request->NOMBRE,
            'APELLIDO' => $request->APELLIDO,
            'CORREO' => $request->CORREO,
            'CC' => $request->CC,
            'TELEFONO' => $request->TELEFONO,
            'CONTRASEÑA' => hashPassword($request->CONTRASEÑA),
            'ID_ROL' => $request->ID_ROL,
            'IMG_URL' => $request->IMG_URL,
        ];
        $responseModel = $this->usuarioModel->insertarUsuario($data);
        return  $this->response->setJSON($responseModel);
    }
    public function actualizarUsuario()
    {
        helper('secure_password_helpers');

        $request = $this->request->getJSON();
        $data = [
            'ID' => null,
            'NOMBRE' => $request->NOMBRE,
            'APELLIDO' => $request->APELLIDO,
            'CORREO' => $request->CORREO,
            'CC' => $request->CC,
            'TELEFONO' => $request->TELEFONO,
            'CONTRASEÑA' => hashPassword($request->CONTRASEÑA),
            'ID_ROL' => $request->ID_ROL,
            'IMG_URL' => $request->IMG_URL,
        ];
        $responseModel = $this->usuarioModel->actualizarUsuario($data);
        return  $this->response->setJSON($responseModel);
    }
    public function eliminarUsuario()
    {
        $ID = $this->request->getJSON('ID');
        if ($this->usuarioModel->eliminarUsuario($ID)) {
            return $this->response->setJSON(['message' => 'usuario eliminado exitosamente']);
        } else {
            return $this->response->setJSON(['message' => 'usuario no existe']);
        }
    }
}
