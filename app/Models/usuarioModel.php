<?php

namespace App\Models;

use CodeIgniter\Model;

class usuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['NOMBRE', 'APELLIDO', 'CORREO'];

    public function listarUsuarioId($id)
    {
        $query = $this->select(['NOMBRE', 'APELLIDO', 'CORREO', 'IMG_URL'])
            ->where('ID', $id)
            ->get();

        return $query->getResult();
    }
    public function listarUsuarios()
    {
        $query = $this->select(['NOMBRE', 'APELLIDO', 'CORREO', 'IMG_URL', 'DESCRIPCION'])
            ->join('rol', 'usuario.ID_ROL = rol.ID_ROL')
            ->get();

        return $query->getResult();
    }
}
