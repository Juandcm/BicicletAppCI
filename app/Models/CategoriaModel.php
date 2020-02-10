<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class CategoriaModel extends Model
{

    protected $db;
    protected $DBGroup = 'default';
    protected $table = 'categorias_piezas_bicicleta';
    protected $primaryKey = 'categoria_piezas_bicicleta_id';
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


    public function mostrarTodasCategorias()
    {
        $builder = $this->db->table($this->table)
            ->select('*');
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }

    public function selectCategoria()
    {
        $builder = $this->db->table($this->table)
            ->select('*');
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }


    public function registrarCategoria($arrayDatos)
    {
        $builder = $this->db->table($this->table)
            ->set('categoria_piezas_bicicleta_name', $arrayDatos['categoria_piezas_bicicleta_name'])
            ->set('categoria_piezas_bicicleta_photo ', $arrayDatos['categoria_piezas_bicicleta_photo'])
            ->set('categoria_piezas_status', $arrayDatos['categoria_piezas_status'])
            ->insert();
        return $this->db->resultID;
    }

    public function editarCategoria($arrayDatos)
    {

        if ($arrayDatos['categoria_piezas_bicicleta_photo'] != '') {
            $builder = $this->db->table($this->table)
                ->set('categoria_piezas_bicicleta_name', $arrayDatos['categoria_piezas_bicicleta_name'])
                ->set('categoria_piezas_bicicleta_photo ', $arrayDatos['categoria_piezas_bicicleta_photo'])
                ->set('categoria_piezas_status', $arrayDatos['categoria_piezas_status'])
                ->where('categoria_piezas_bicicleta_id', $arrayDatos['categoria_piezas_bicicleta_id'])
                ->update();
        } else {
            $builder = $this->db->table($this->table)
                ->set('categoria_piezas_bicicleta_name', $arrayDatos['categoria_piezas_bicicleta_name'])
                ->set('categoria_piezas_status', $arrayDatos['categoria_piezas_status'])
                ->where('categoria_piezas_bicicleta_id', $arrayDatos['categoria_piezas_bicicleta_id'])
                ->update();
        }
        return $this->db->affectedRows();
    }

    public function bilitarCategoria($arrayDatos)
    {
        $builder = $this->db->table($this->table)
            ->set('categoria_piezas_status', $arrayDatos['categoria_piezas_status'])
            ->where('categoria_piezas_bicicleta_id', $arrayDatos['categoria_piezas_bicicleta_id'])
            ->update();
        return $this->db->affectedRows();
    }
}
