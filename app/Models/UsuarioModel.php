<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $db;
    protected $DBGroup = 'default';
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $returnType = 'object';
    protected $useTimestamps = true;
    protected $allowedFields = ['user_name', 'user_password', 'user_email'];
    protected $createdField = 'user_create';
    protected $updatedField = 'user_update';
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;


    public function __construct()
    {
        $this->db = \Config\Database::connect($DBGroup);
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function login_admin($email)
    {
        $builder = $this->db->table($this->table)
            ->select('*')
            ->where('user_email', '' . $email . '')
            ->limit(1);
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }

    public function comprobarCodigoCorreo($arrayDatos)
    {
        $builder = $this->db->table($this->table)
            ->select('*')
            ->where('user_email', $arrayDatos['user_email'])
            ->where('user_code_verificacion', $arrayDatos['user_code_verificacion'])
            ->limit(1);
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }

    public function getUserById($id)
    {
        $builder = $this->db->table($this->table)
            ->select('*')
            ->where('user_id', '' . $id . '')
            ->limit(1);
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }

    public function login_user($email)
    {
        $builder = $this->db->table($this->table)
            ->select('*')
            ->where('user_email', '' . $email . '')
            ->limit(1);
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }


    public function mostrarTodosUsuario()
    {
        $builder = $this->db->table($this->table)
            ->select('*');
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }

    public function registrarUsuario($arrayDatos)
    {
        $builder = $this->db->table($this->table)
            ->select('*')
            ->where('user_email', '' . $arrayDatos['user_email'] . '');

        if ($builder->countAllResults() >= '1') {
            return false;
        } else {
            if ($arrayDatos['user_photo'] != '') {
                $foto = $arrayDatos['user_photo'];
            } else {
                $foto = '';
            }
            $builder = $this->db->table($this->table)
                ->set('user_name', $arrayDatos['user_name'])
                ->set('user_email', $arrayDatos['user_email'])
                ->set('user_password', $arrayDatos['user_password'])
                ->set('user_remenber_password', $arrayDatos['user_remenber_password'])
                ->set('user_photo', $foto)
                ->set('user_phone', $arrayDatos['user_phone'])
                ->set('user_push_token', $arrayDatos['user_push_token'])
                ->set('user_type', $arrayDatos['user_type'])
                ->set('user_status', $arrayDatos['user_status'])
                ->insert();
            if ($this->db->resultID) {
                return json_encode(array('status' => true, 'usuarioid' => $this->db->insertID()));
            } else {
                return json_encode(array('status' => false));
            }
        }
    }

    public function editarUsuario($arrayDatos)
    {
        if ($arrayDatos['user_photo'] != '') {
            if ($arrayDatos['user_password'] != '') {
                $pass = password_hash($arrayDatos['user_password'], PASSWORD_BCRYPT);
                $builder = $this->db->table($this->table)
                    ->set('user_name', $arrayDatos['user_name'])
                    ->set('user_email', $arrayDatos['user_email'])
                    ->set('user_password', $pass)
                    ->set('user_photo', $arrayDatos['user_photo'])
                    ->set('user_phone', $arrayDatos['user_phone'])
                    ->set('user_type', $arrayDatos['user_type'])
                    ->where('user_id', $arrayDatos['user_id'])
                    ->update();
            } else {
                $builder = $this->db->table($this->table)
                    ->set('user_name', $arrayDatos['user_name'])
                    ->set('user_email', $arrayDatos['user_email'])
                    ->set('user_photo', $arrayDatos['user_photo'])
                    ->set('user_phone', $arrayDatos['user_phone'])
                    ->set('user_type', $arrayDatos['user_type'])
                    ->where('user_id', $arrayDatos['user_id'])
                    ->update();
            }
        } else {
            if ($arrayDatos['user_password'] != '') {
                $pass = password_hash($arrayDatos['user_password'], PASSWORD_BCRYPT);
                $builder = $this->db->table($this->table)
                    ->set('user_name', $arrayDatos['user_name'])
                    ->set('user_email', $arrayDatos['user_email'])
                    ->set('user_password', $pass)
                    ->set('user_phone', $arrayDatos['user_phone'])
                    ->set('user_type', $arrayDatos['user_type'])
                    ->where('user_id', $arrayDatos['user_id'])
                    ->update();
            } else {
                $builder = $this->db->table($this->table)
                    ->set('user_name', $arrayDatos['user_name'])
                    ->set('user_email', $arrayDatos['user_email'])
                    ->set('user_phone', $arrayDatos['user_phone'])
                    ->set('user_type', $arrayDatos['user_type'])
                    ->where('user_id', $arrayDatos['user_id'])
                    ->update();
            }
        }
        return $this->db->affectedRows($arrayDatos);
    }


    public function editarUsuarioApp($arrayDatos)
    {
        if ($arrayDatos['user_photo'] != '') {
            if ($arrayDatos['user_password'] != '') {
                $pass = password_hash($arrayDatos['user_password'], PASSWORD_BCRYPT);
                $builder = $this->db->table($this->table)
                    ->set('user_name', $arrayDatos['user_name'])
                    ->set('user_email', $arrayDatos['user_email'])
                    ->set('user_password', $pass)
                    ->set('user_photo', $arrayDatos['user_photo'])
                    ->set('user_phone', $arrayDatos['user_phone'])
                    ->where('user_id', $arrayDatos['user_id'])
                    ->update();
            } else {
                $builder = $this->db->table($this->table)
                    ->set('user_name', $arrayDatos['user_name'])
                    ->set('user_email', $arrayDatos['user_email'])
                    ->set('user_photo', $arrayDatos['user_photo'])
                    ->set('user_phone', $arrayDatos['user_phone'])
                    ->where('user_id', $arrayDatos['user_id'])
                    ->update();
            }
        } else {
            if ($arrayDatos['user_password'] != '') {
                $pass = password_hash($arrayDatos['user_password'], PASSWORD_BCRYPT);
                $builder = $this->db->table($this->table)
                    ->set('user_name', $arrayDatos['user_name'])
                    ->set('user_email', $arrayDatos['user_email'])
                    ->set('user_password', $pass)
                    ->set('user_phone', $arrayDatos['user_phone'])
                    ->where('user_id', $arrayDatos['user_id'])
                    ->update();
            } else {
                $builder = $this->db->table($this->table)
                    ->set('user_name', $arrayDatos['user_name'])
                    ->set('user_email', $arrayDatos['user_email'])
                    ->set('user_phone', $arrayDatos['user_phone'])
                    ->where('user_id', $arrayDatos['user_id'])
                    ->update();
            }
        }
        return $this->db->affectedRows($arrayDatos);
    }

    public function bilitarUsuario($arrayDatos)
    {
        $builder = $this->db->table($this->table)
            ->set('user_status', $arrayDatos['user_status'])
            ->where('user_id', $arrayDatos['user_id'])
            ->update();
        return $this->db->affectedRows();
    }

    public function actualizarcodigouser($arrayDatos)
    {
        $builder = $this->db->table($this->table)
            ->set('user_code_verificacion', $arrayDatos['user_code_verificacion'])
            ->where('user_email', $arrayDatos['user_email'])
            ->update();
        return $this->db->affectedRows();
    }

    public function restaurarUsuario($arrayDatos)
    {
        $builder = $this->db->table($this->table)
            ->set('user_code_verificacion', $arrayDatos['user_code_verificacion'])
            ->set('user_status', $arrayDatos['user_status'])
            ->where('user_email', $arrayDatos['user_email'])
            ->update();
        return $this->db->affectedRows();
    }
}
