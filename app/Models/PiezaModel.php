<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class PiezaModel extends Model
{
    protected $db;
    protected $DBGroup = 'default';
    protected $table = 'piezas_bicicleta';
    protected $primaryKey = 'pieza_bicicleta_id';
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


    public function mostrarTodasPiezas()
    {
        $builder = $this->db->table($this->table)
            ->join('categorias_piezas_bicicleta', 'categorias_piezas_bicicleta.categoria_piezas_bicicleta_id = piezas_bicicleta.categoria_piezas_bicicleta_id')
            ->join('imagenes_pieza_bicicleta', 'imagenes_pieza_bicicleta.pieza_bicicleta_id = piezas_bicicleta.pieza_bicicleta_id')
            ->where('imagen_pieza_bicicleta_tipo', '1')
            ->select('*');
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }

    public function mostrarTodasPiezasCategorias()
    {
        $builderpieza = $this->db->table($this->table)
            ->join('categorias_piezas_bicicleta', 'categorias_piezas_bicicleta.categoria_piezas_bicicleta_id = piezas_bicicleta.categoria_piezas_bicicleta_id')
            ->join('imagenes_pieza_bicicleta', 'imagenes_pieza_bicicleta.pieza_bicicleta_id = piezas_bicicleta.pieza_bicicleta_id')
            ->where('pieza_bicicleta_status', '1')
            ->where('imagen_pieza_bicicleta_tipo', '1')
            ->select('*');
        $buildercategoria = $this->db->table($this->table)
            ->join('categorias_piezas_bicicleta', 'categorias_piezas_bicicleta.categoria_piezas_bicicleta_id = piezas_bicicleta.categoria_piezas_bicicleta_id')
            ->where('pieza_bicicleta_status', '1')
            ->groupBy('categorias_piezas_bicicleta.categoria_piezas_bicicleta_id')
            ->select('categorias_piezas_bicicleta.categoria_piezas_bicicleta_id categoria_id, categorias_piezas_bicicleta.categoria_piezas_bicicleta_name categoria_name, categorias_piezas_bicicleta.categoria_piezas_bicicleta_photo categoria_foto');

        $querypieza = $builderpieza->get();
        $querycategoria = $buildercategoria->get();
        if ($querypieza && $querycategoria) {
            return json_encode(array('datapieza' => $querypieza->getResult(), 'datacategoria' => $querycategoria->getResult()));
        } else {
            return false;
        }
    }


    public function registrarPieza($arrayDatos)
    {
        $builder = $this->db->table($this->table)
            ->set('pieza_bicicleta_name', $arrayDatos['pieza_bicicleta_name'])
            ->set('pieza_bicicleta_description ', $arrayDatos['pieza_bicicleta_description'])
            ->set('pieza_bicicleta_status', $arrayDatos['pieza_bicicleta_status'])
            ->set('categoria_piezas_bicicleta_id', $arrayDatos['categoria_piezas_bicicleta_id'])
            ->insert();
        return $this->db->insertID();
    }


    public function registrarFotosPiezas($arrayDatos)
    {
        $builder = $this->db->table('imagenes_pieza_bicicleta')
            ->insertBatch($arrayDatos);
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

    public function bilitarPieza($arrayDatos)
    {
        $builder = $this->db->table($this->table)
            ->set('pieza_bicicleta_status', $arrayDatos['pieza_bicicleta_status'])
            ->where('pieza_bicicleta_id', $arrayDatos['pieza_bicicleta_id'])
            ->update();

        $builderpieza = $this->db->table($this->table)
            ->join('categorias_piezas_bicicleta', 'categorias_piezas_bicicleta.categoria_piezas_bicicleta_id = piezas_bicicleta.categoria_piezas_bicicleta_id')
            ->join('imagenes_pieza_bicicleta', 'imagenes_pieza_bicicleta.pieza_bicicleta_id = piezas_bicicleta.pieza_bicicleta_id')
            ->where('imagen_pieza_bicicleta_tipo', '1')
            ->where('pieza_bicicleta_status', '1')
            ->where('piezas_bicicleta.pieza_bicicleta_id', $arrayDatos['pieza_bicicleta_id'])
            ->select('*');

        $buildercategoria = $this->db->table($this->table)
            ->join('categorias_piezas_bicicleta', 'categorias_piezas_bicicleta.categoria_piezas_bicicleta_id = piezas_bicicleta.categoria_piezas_bicicleta_id')
            ->where('pieza_bicicleta_status', '1')
            ->groupBy('categorias_piezas_bicicleta.categoria_piezas_bicicleta_id')
            ->select('categorias_piezas_bicicleta.categoria_piezas_bicicleta_id categoria_id, categorias_piezas_bicicleta.categoria_piezas_bicicleta_name categoria_name, categorias_piezas_bicicleta.categoria_piezas_bicicleta_photo categoria_foto');


        $querypieza = $builderpieza->get();
        $querycategoria = $buildercategoria->get();
        return json_encode(array('statuseditar' => $this->db->affectedRows(), 'datapieza' => $querypieza->getResult(), 'datacategoria' => $querycategoria->getResult()));
    }

    public function eliminarPieza($arrayDatos)
    {
        $builder = $this->db->table($this->table)
            ->where('pieza_bicicleta_id', $arrayDatos['pieza_bicicleta_id'])
            ->delete();
        return $this->db->affectedRows();
    }

    public function eliminarImagenesPieza($arrayDatos)
    {
        $builder = $this->db->table('imagenes_pieza_bicicleta')
            ->where('pieza_bicicleta_id', $arrayDatos['pieza_bicicleta_id'])
            ->delete();
        return $this->db->affectedRows();
    }

    public function verImagenesPieza($arrayDatos)
    {
        if ($arrayDatos['imagen_pieza_bicicleta_tipo'] != '') {
            $builder = $this->db->table('imagenes_pieza_bicicleta')
                ->where('pieza_bicicleta_id', $arrayDatos['pieza_bicicleta_id'])
                ->where('imagen_pieza_bicicleta_tipo', $arrayDatos['imagen_pieza_bicicleta_tipo'])
                ->select('*');
        } else {
            $builder = $this->db->table('imagenes_pieza_bicicleta')
                ->where('pieza_bicicleta_id', $arrayDatos['pieza_bicicleta_id'])
                ->select('*');
        }

        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }

    public function verPiezaDetallada($arrayDatos)
    {
        $builder = $this->db->table($this->table)
            ->join('categorias_piezas_bicicleta', 'categorias_piezas_bicicleta.categoria_piezas_bicicleta_id = piezas_bicicleta.categoria_piezas_bicicleta_id')
            ->join('imagenes_pieza_bicicleta', 'imagenes_pieza_bicicleta.pieza_bicicleta_id = piezas_bicicleta.pieza_bicicleta_id')
            ->where('piezas_bicicleta.pieza_bicicleta_id', $arrayDatos['pieza_bicicleta_id'])
            ->select('*');

        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }

    public function editarPieza($arrayDatos)
    {
        $builder = $this->db->table($this->table)
            ->set('categoria_piezas_bicicleta_id', $arrayDatos['categoria_piezas_bicicleta_id'])
            ->set('pieza_bicicleta_name', $arrayDatos['pieza_bicicleta_name'])
            ->set('pieza_bicicleta_description', $arrayDatos['pieza_bicicleta_description'])
            ->where('pieza_bicicleta_id', $arrayDatos['pieza_bicicleta_id'])
            ->update();
        return $this->db->affectedRows();
    }
    public function eliminarImagenesPiezaMultiple($arrayDatos)
    {
        $builder = $this->db->table('imagenes_pieza_bicicleta')
            ->where('imagen_pieza_bicicleta_id', $arrayDatos['imagen_pieza_bicicleta_id'])
            ->delete();
        return $this->db->affectedRows();
    }
    public function editarImagenesPieza($arrayDatos)
    {
        $builder = $this->db->table('imagenes_pieza_bicicleta')
            ->updateBatch($arrayDatos, 'imagen_pieza_bicicleta_id');
        return $this->db->resultID;
    }
}
