<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class usuarioModel extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'ID';
    protected $allowedFields = ['NOMBRE', 'APELLIDO', 'CORREO'];

    public function obtenerUsuarioPorCorreo($correo)
    {
        $query = $this->db->table('usuario')
            ->select('usuario.*, rol.DESCRIPCION as ROL_DESCRIPCION')
            ->join('rol', 'rol.ID_ROL = usuario.ID_ROL', 'left')
            ->where('usuario.CORREO', $correo)
            ->get();

        return $query->getRowArray();
    }
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
    public function insertarUsuario($data)
    {
        $query = $this->db->table('usuario')->insert($data);
        if ($query) {
            $userData =  $this->db->table('usuario')
                ->select("*")
                ->where('CORREO', $data['CORREO'])
                ->get()
                ->getRowArray();
            return [
                'message' => 'Update exitoso',
                'userData' => $userData
            ];
        } else {
            return ['Message' => 'No se pudo completar el insert'];
        }
    }
    public function actualizarUsuario($data)
    {
        $query = $this->db->table('usuario')->update($data, ['CORREO' => $data['CORREO']]);

        if ($query) {
            $userData =  $this->db->table('usuario')
                ->select("*")
                ->where('CORREO', $data['CORREO'])
                ->get()
                ->getRowArray();
            return [
                'message' => 'Update exitoso',
                'userData' => $userData
            ];
        } else {
            return ['message' => 'No se pudo completar el update'];
        }
    }
    public function eliminarUsuario($id)
    {
        $query = $this->select('*')
            ->where('ID', $id)
            ->get();
        $usuarioEliminado = $query->getRowArray();
        if ($usuarioEliminado) {
            $this->db->table('deleted_users')->insert($usuarioEliminado);
            $this->db->table('usuario')->delete(['ID' => $id]);
            return true;
        } else {
            return false;
        }
    }
}
