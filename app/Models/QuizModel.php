<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class QuizModel extends Model
{
    protected $db;
    protected $DBGroup = 'default';
    protected $table = 'quiz_bicicletas';
    protected $primaryKey = 'quiz_bicicleta_id ';
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

    // Modelos de las preguntas
    public function mostrarTodasPreguntas()
    {
        $builder = $this->db->table($this->table)
        ->join('niveles_quiz', 'quiz_bicicletas.nivel_quiz_id = niveles_quiz.nivel_quiz_id')
        ->select('*');
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }

    public function mostrarTodosNivelesQuiz()
    {
        $builder = $this->db->table($this->table)
        ->join('niveles_quiz', 'quiz_bicicletas.nivel_quiz_id = niveles_quiz.nivel_quiz_id')
        ->groupBy('niveles_quiz.nivel_quiz_id')
        ->select('niveles_quiz.*');
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }

    //Modelos de las respuestas
    public function verRespuestasPregunta($arrayDatos)
    {
        $builder = $this->db->table('respuestas_quiz')
        ->where('quiz_bicicleta_id', $arrayDatos['quiz_bicicleta_id'])
        ->select('*');
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }

    public function eliminarPregunta($arrayDatos)
    {
        $builder = $this->db->table($this->table)
        ->where('quiz_bicicleta_id', $arrayDatos['quiz_bicicleta_id'])
        ->delete();
        return $this->db->affectedRows();
    }

    public function eliminarRespuestasPregunta($arrayDatos)
    {
        $builder = $this->db->table('respuestas_quiz')
        ->where('quiz_bicicleta_id', $arrayDatos['quiz_bicicleta_id'])
        ->delete();
        return $this->db->affectedRows();
    }

    // Modelos de los Niveles
    public function mostrarTodosNiveles()
    {
        $builder = $this->db->table('niveles_quiz')
        ->select('*');
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }

    public function selectNivel()
    {
        $builder = $this->db->table('niveles_quiz')
        ->where('nivel_quiz_status', '1')
        ->select('*');
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }


    public function registrarNivel($arrayDatos)
    {
        $builder = $this->db->table('niveles_quiz')
        ->set('nivel_quiz_nivel', $arrayDatos['nivel_quiz_nivel'])
        ->insert();
        return $this->db->resultID;
    }

    public function registrarPregunta($arrayDatos)
    {
        if ($arrayDatos['quiz_bicicleta_file'] == '') {
            $builder = $this->db->table($this->table)
            ->set('quiz_bicicleta_pregunta', $arrayDatos['quiz_bicicleta_pregunta'])
            ->set('nivel_quiz_id', $arrayDatos['nivel_quiz_id'])
            ->insert();
        } else {
            $builder = $this->db->table($this->table)
            ->set('quiz_bicicleta_pregunta', $arrayDatos['quiz_bicicleta_pregunta'])
            ->set('quiz_bicicleta_file', $arrayDatos['quiz_bicicleta_file'])
            ->set('nivel_quiz_id', $arrayDatos['nivel_quiz_id'])
            ->insert();
        }
        return json_encode(array('status' => $this->db->resultID, 'idinsert' => $this->db->insertID()));
    }

    public function registrarRespuestaUnica($arrayDatos)
    {
        $builder = $this->db->table('respuestas_quiz')
        ->set('respuesta_quiz_resp', $arrayDatos['respuesta_quiz_resp'])
        ->set('respuesta_quiz_correcta', $arrayDatos['respuesta_quiz_correcta'])
        ->set('respuesta_quiz_tipo', $arrayDatos['respuesta_quiz_tipo'])
        ->set('quiz_bicicleta_id', $arrayDatos['quiz_bicicleta_id'])
        ->insert();
        return $this->db->resultID;
    }


    public function registrarRespuestaMultiple($arrayDatos)
    {
        $builder = $this->db->table('respuestas_quiz')->insertBatch($arrayDatos);
        return $this->db->resultID;
    }

    public function editarNivel($arrayDatos)
    {
        $builder = $this->db->table('niveles_quiz')
        ->set('nivel_quiz_nivel', $arrayDatos['nivel_quiz_nivel'])
        ->where('nivel_quiz_id', $arrayDatos['nivel_quiz_id'])
        ->update();
        return $this->db->affectedRows();
    }

    public function bilitarNivel($arrayDatos)
    {
        $builder = $this->db->table('niveles_quiz')
        ->set('nivel_quiz_status', $arrayDatos['nivel_quiz_status'])
        ->where('nivel_quiz_id', $arrayDatos['nivel_quiz_id'])
        ->update();
        return $this->db->affectedRows();
    }

    public function editarPregunta($arrayDatos)
    {
        $builder = $this->db->table($this->table)
        ->set('quiz_bicicleta_pregunta', $arrayDatos['quiz_bicicleta_pregunta'])
        ->set('quiz_bicicleta_file', $arrayDatos['quiz_bicicleta_file'])
        ->set('nivel_quiz_id', $arrayDatos['nivel_quiz_id'])
        ->where('quiz_bicicleta_id', $arrayDatos['quiz_bicicleta_id'])
        ->update();
        return $this->db->affectedRows();
    }

    public function editarRespuestas($arrayDatos)
    {
        $builder = $this->db->table('respuestas_quiz')
        ->updateBatch($arrayDatos, 'respuesta_quiz_id');
        return $this->db->resultID;
    }

    public function editarRespuesta($arrayDatos)
    {
        $builder = $this->db->table('respuestas_quiz')
        ->set('respuesta_quiz_resp', $arrayDatos['respuesta_quiz_resp'])
        ->set('respuesta_quiz_correcta', $arrayDatos['respuesta_quiz_correcta'])
        ->where('respuesta_quiz_id', $arrayDatos['respuesta_quiz_id'])
        ->update();
        return $this->db->affectedRows();
    }

    public function mostrarPreguntasNivel($arrayDatos)
    {
        //Consulta para traer preguntas random
// SELECT * FROM quiz_bicicletas quiz INNER JOIN niveles_quiz niv ON quiz.nivel_quiz_id = niv.nivel_quiz_id WHERE niv.nivel_quiz_id=2 order by rand() limit 2 
        $builder = $this->db->table($this->table)
        ->join('niveles_quiz', 'niveles_quiz.nivel_quiz_id = quiz_bicicletas.nivel_quiz_id')
        ->where('niveles_quiz.nivel_quiz_id',  $arrayDatos['nivel_quiz_id'])
        ->orderBy('quiz_bicicletas.quiz_bicicleta_pregunta', 'RANDOM')
        ->limit(3)
        ->select('*');
        if ($query = $builder->get()) {
            return $query;
        } else {
            return false;
        }
    }

}
