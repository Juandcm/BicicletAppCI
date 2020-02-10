<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ForoModel extends Model
{

    protected $db;
    protected $DBGroup = 'default';
    protected $table = 'foros';
    protected $table_mensaje = 'mensajes_foro';
    protected $primaryKey = 'foro_id';
    protected $returnType = 'object';
    protected $useTimestamps = true;

    public function __construct()
    {
        $this->db = \Config\Database::connect($DBGroup);
    }

    public function __destruct()
    {
        $this->db->close();
    }


    public function mostrarTodosForos()
    {
        $builder = $this->db->table($this->table)
            ->select('*');
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }


    public function registrarForo($arrayDatos)
    {
        $builder = $this->db->table($this->table)
            ->set('foro_name', $arrayDatos['foro_name'])
            ->set('foro_file ', $arrayDatos['foro_file'])
            ->set('foro_eliminado', $arrayDatos['foro_eliminado'])
            ->set('user_id ', $arrayDatos['user_id'])
            ->insert();
        return json_encode(array('status' => $this->db->resultID, 'idinsert' => $this->db->insertID()));
    }

    public function mostrarTodosMensajesForo($arrayDatos)
    {
        $builder = $this->db->table($this->table_mensaje)
            ->join('users', 'users.user_id = mensajes_foro.user_id')
            ->where('foro_id', $arrayDatos['foro_id'])
            ->orderBy('mensajes_foro.foro_id', 'DESC')
            ->select('*');
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }


    public function editarForo($arrayDatos)
    {
        if ($arrayDatos['foro_file'] != '') {
            $builder = $this->db->table($this->table)
                ->set('foro_name', $arrayDatos['foro_name'])
                ->set('foro_file ', $arrayDatos['foro_file'])
                ->where('foro_id', $arrayDatos['foro_id'])
                ->update();
        } else {
            $builder = $this->db->table($this->table)
                ->set('foro_name', $arrayDatos['foro_name'])
                ->where('foro_id', $arrayDatos['foro_id'])
                ->update();
        }
        return $this->db->affectedRows();
    }

    public function bilitarforo($arrayDatos)
    {
        $builder = $this->db->table($this->table)
            ->set('foro_eliminado', $arrayDatos['foro_eliminado'])
            ->where('foro_id', $arrayDatos['foro_id'])
            ->update();
        return $this->db->affectedRows();
    }

    public function registrarMensajeFile($arrayDatos)
    {
        $builder = $this->db->table($this->table_mensaje)
            ->set('mensaje_foro_mens', $arrayDatos['mensaje_foro_mens'])
            ->set('mensaje_foro_file ', $arrayDatos['mensaje_foro_file'])
            ->set('mensaje_eliminado', $arrayDatos['mensaje_eliminado'])
            ->set('foro_id ', $arrayDatos['foro_id'])
            ->set('user_id ', $arrayDatos['user_id'])
            ->insert();
        return json_encode(array('status' => $this->db->resultID, 'idinsert' => $this->db->insertID()));
    }

    public function registrarMensaje($arrayDatos)
    {
        $builder = $this->db->table($this->table_mensaje)
            ->set('mensaje_foro_mens', $arrayDatos['mensaje_foro_mens'])
            ->set('mensaje_foro_file ', $arrayDatos['mensaje_foro_file'])
            ->set('mensaje_eliminado', $arrayDatos['mensaje_eliminado'])
            ->set('foro_id ', $arrayDatos['foro_id'])
            ->set('user_id ', $arrayDatos['user_id'])
            ->insert();
        return json_encode(array('status' => $this->db->resultID, 'idinsert' => $this->db->insertID()));
    }
}
