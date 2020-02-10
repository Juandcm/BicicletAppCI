<?php namespace App\Controllers;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,text/html; charset=utf-8');

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\QuizModel;

class Quiz extends Controller
{
  protected $request;
  public $session = null;
  public $quiz = null;
  
  public function __construct()
  {
    $this->session = \Config\Services::session();
    $this->quiz = new QuizModel();
  }
  
  
  public function uploadImage()
  {
    $file = $this->request->getFile('file');
    
    if ($file->isValid() && !$file->hasMoved()) {
      $newName = $file->getRandomName();
      $lugar = 'uploads/quiz_preguntas/' . date("d_m_y");
      $file->move($lugar, $newName, true);
      echo $lugar . "/" . $newName;
    } else {
      echo false;
    }
  }
  
  
  public function mostrarTodosNiveles()
  {
    $result = array();
    $data = $this->quiz->mostrarTodosNiveles();
    $datos = $data->getResult();
    foreach ($datos as $key => $value) {
      
      if ($value->nivel_quiz_status == '1') {
        $status = '<span class="label label-success">Activo</span>';
        $btnstatus = '<a class="dropdown-item" href="javascript:void(0)" onclick="bilitarnivel(\'' . $value->nivel_quiz_id . '\',\'0\')">
        <i class="fas fa-eye-slash"></i> Deshabilitar
        </a>';
      } else {
        $status = '<span class="label label-danger">Inactivo</span>';
        $btnstatus = '<a class="dropdown-item" href="javascript:void(0)" onclick="bilitarnivel(\'' . $value->nivel_quiz_id . '\',\'1\')">
        <i class="fas fa-eye"></i> Habilitar
        </a>';
      }
      
      $buttons = '<div class="btn-group">
      <button type="button" class="btn btn-dark dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-original-title="Opciones" aria-hidden="true">
      <i class="ti-settings"></i>
      </button>
      <div class="dropdown-menu animated slideInUp" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
      <a class="dropdown-item" href="javascript:void(0)" onclick="editarNivel(\'' . $value->nivel_quiz_id . '\',\'' . $value->nivel_quiz_nivel . '\')">
      <i class="ti-pencil-alt"></i> Editar
      </a>
      ' . $btnstatus . '
      </div>
      </div>
      ';
      
      $result[] = array(
        "0" => $buttons,
        "1" => $value->nivel_quiz_nivel,
        "2" => $status
      );
    }
    $json_data = array(
      "data" => $result
    );
    echo json_encode($json_data);
  }
  
  
  public function mostrarTodasPreguntas()
  {
    $result = array();
    $data = $this->quiz->mostrarTodasPreguntas();
    $datos = $data->getResult();
    foreach ($datos as $key => $value) {
      $buttons = '<div class="btn-group">
      <button type="button" class="btn btn-dark dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-original-title="Opciones" aria-hidden="true">
      <i class="ti-settings"></i>
      </button>
      <div class="dropdown-menu animated slideInUp" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
      <a class="dropdown-item" href="javascript:void(0)" onclick="editarPregunta(\'' . $value->quiz_bicicleta_id . '\',\'' . $value->quiz_bicicleta_pregunta . '\',\'' . $value->quiz_bicicleta_file . '\',\'' . $value->nivel_quiz_id . '\')">
      <i class="ti-pencil-alt"></i> Editar
      </a>
      
      <a class="dropdown-item" href="javascript:void(0)" onclick="verRespuestas(\'' . $value->quiz_bicicleta_id . '\',\'' . $value->quiz_bicicleta_pregunta . '\')">
      <i class="fas fa-search"></i> Ver respuestas
      </a>
      <a class="dropdown-item" href="javascript:void(0);"  onclick="eliminarPregunta(\'' . $value->quiz_bicicleta_id . '\')">
      <i class="mdi mdi-delete"></i> Eliminar
      </a>
      </div>
      </div>
      ';
      
      $foto = ($value->quiz_bicicleta_file != "")
      ? ' <a href="javascript:void(0)" onclick="verImagenDetallada(\'' . base_url() . '/' . $value->quiz_bicicleta_file . '\')">
      <img src="' . base_url() . '/' . $value->quiz_bicicleta_file . '" alt="categoria" class="rounded-circle" width="50" />
      </a>'
      : 'sin imagen';
      
      $result[] = array(
        "0" => $buttons,
        "1" => $value->quiz_bicicleta_pregunta,
        "2" => $foto,
        "3" => $value->quiz_bicicleta_create,
        "4" => $value->nivel_quiz_nivel
      );
    }
    $json_data = array(
      "data" => $result
    );
    echo json_encode($json_data);
  }
  
  public function selectNivel()
  {
    $data = $this->quiz->selectNivel();
    $datos = $data->getResult();
    echo "<option value='' disabled selected>Selecciona un nivel</option>";
    foreach ($datos as $key => $value) {
      echo "<option value='" . $value->nivel_quiz_id . "'>" . $value->nivel_quiz_nivel . "</option>";
    }
  }
  
  public function crearNivel()
  {
    $nameNivel = $this->request->getPost('nameNivel', FILTER_SANITIZE_STRING);
    $array = [
      'nivel_quiz_nivel'   => $nameNivel,
      'nivel_quiz_status' => '1'
    ];
    $insertar = $this->quiz->registrarNivel($array);
    if ($insertar != '') {
      echo json_encode(array('status' => true));
    } else {
      echo json_encode(array('status' => false));
    }
  }
  
  public function editarNivel()
  {
    $idnivel = $this->request->getPost('idnivel', FILTER_SANITIZE_STRING);
    $nameNivelEditar = $this->request->getPost('nameNivelEditar', FILTER_SANITIZE_STRING);
    $array = [
      'nivel_quiz_id'   => $idnivel,
      'nivel_quiz_nivel'   => $nameNivelEditar
    ];
    $editar = $this->quiz->editarNivel($array);
    if ($editar == '1') {
      echo json_encode(array('status' => true));
    } else {
      echo json_encode(array('status' => false));
    }
  }
  
  public function bilitarNivel()
  {
    $idnivel = $this->request->getPost('idnivel', FILTER_SANITIZE_STRING);
    $tipo = $this->request->getPost('tipo', FILTER_SANITIZE_STRING);
    $array = [
      'nivel_quiz_id' => $idnivel,
      'nivel_quiz_status' => $tipo
    ];
    $editar = $this->quiz->bilitarNivel($array);
    
    if ($editar == '1') {
      echo json_encode(array('status' => true));
    } else {
      echo json_encode(array('status' => false));
    }
  }
  
  
  public function crearPregunta()
  {
    $pregunta = $this->request->getPost('pregunta', FILTER_SANITIZE_STRING);
    $foto = $this->request->getPost('foto', FILTER_SANITIZE_STRING);
    $nivel = $this->request->getPost('nivel', FILTER_SANITIZE_STRING);
    $tipoderespuesta = $this->request->getPost('tipoderespuesta', FILTER_SANITIZE_STRING);
    $verdofalso = $this->request->getPost('verdofalso', FILTER_SANITIZE_STRING);
    $respuesta1 = $this->request->getPost('respuesta1', FILTER_SANITIZE_STRING);
    $respuesta2 = $this->request->getPost('respuesta2', FILTER_SANITIZE_STRING);
    $respuesta3 = $this->request->getPost('respuesta3', FILTER_SANITIZE_STRING);
    $respuesta4 = $this->request->getPost('respuesta4', FILTER_SANITIZE_STRING);
    $respuestaradio = $this->request->getPost('respuestaradio', FILTER_SANITIZE_STRING);
    $arrayRegistroPregunta = [
      'quiz_bicicleta_pregunta'   => $pregunta,
      'quiz_bicicleta_file'   => $foto,
      'nivel_quiz_id' => $nivel
    ];
    $insertar = $this->quiz->registrarPregunta($arrayRegistroPregunta);
    $datosinsert = json_decode($insertar);
    
    if ($datosinsert->status) {
      if ($tipoderespuesta == '1') {
        $valorrespuesta = ($verdofalso == 'true') ? '1' : '0';
        $arrayRegistroRespuestas = [
          'respuesta_quiz_resp'   => null,
          'respuesta_quiz_correcta'   => $valorrespuesta,
          'respuesta_quiz_tipo' => 'unica', // o multiple
          'quiz_bicicleta_id' => $datosinsert->idinsert
        ];
        $insertarRespuesta = $this->quiz->registrarRespuestaUnica($arrayRegistroRespuestas);
        if ($insertarRespuesta != '') {
          echo json_encode(array('status' => true, 'verdofalso' => $verdofalso));
        } else {
          echo json_encode(array('status' => false));
        }
      } else {
        $data1 = [
          'respuesta_quiz_resp' => $respuesta1,
          'respuesta_quiz_correcta' => '0',
          'respuesta_quiz_tipo' => 'multiple',
          'quiz_bicicleta_id' => $datosinsert->idinsert
        ];
        $data2 = [
          'respuesta_quiz_resp' => $respuesta2,
          'respuesta_quiz_correcta' => '0',
          'respuesta_quiz_tipo' => 'multiple',
          'quiz_bicicleta_id' => $datosinsert->idinsert
        ];
        $data3 = [
          'respuesta_quiz_resp' => $respuesta3,
          'respuesta_quiz_correcta' => '0',
          'respuesta_quiz_tipo' => 'multiple',
          'quiz_bicicleta_id' => $datosinsert->idinsert
        ];
        $data4 = [
          'respuesta_quiz_resp' => $respuesta4,
          'respuesta_quiz_correcta' => '0',
          'respuesta_quiz_tipo' => 'multiple',
          'quiz_bicicleta_id' => $datosinsert->idinsert
        ];
        
        if ($respuestaradio == '1') {
          $data1 = [
            'respuesta_quiz_resp' => $respuesta1,
            'respuesta_quiz_correcta' => '1',
            'respuesta_quiz_tipo' => 'multiple',
            'quiz_bicicleta_id' => $datosinsert->idinsert
          ];
        } elseif ($respuestaradio == '2') {
          $data2 = [
            'respuesta_quiz_resp' => $respuesta2,
            'respuesta_quiz_correcta' => '1',
            'respuesta_quiz_tipo' => 'multiple',
            'quiz_bicicleta_id' => $datosinsert->idinsert
          ];
        } elseif ($respuestaradio == '3') {
          $data3 = [
            'respuesta_quiz_resp' => $respuesta3,
            'respuesta_quiz_correcta' => '1',
            'respuesta_quiz_tipo' => 'multiple',
            'quiz_bicicleta_id' => $datosinsert->idinsert
          ];
        } elseif ($respuestaradio == '4') {
          $data4 = [
            'respuesta_quiz_resp' => $respuesta4,
            'respuesta_quiz_correcta' => '1',
            'respuesta_quiz_tipo' => 'multiple',
            'quiz_bicicleta_id' => $datosinsert->idinsert
          ];
        }
        
        $dataCompleta = [
          $data1,
          $data2,
          $data3,
          $data4
        ];
        
        $insertarRespuesta = $this->quiz->registrarRespuestaMultiple($dataCompleta);
        if ($insertarRespuesta != '') {
          echo json_encode(array('status' => true));
        } else {
          echo json_encode(array('status' => false));
        }
      }
    } else {
      echo json_encode(array('status' => false));
    }
  }
  
  public function editarPreguntaQuiz()
  {
    
    $tipoderespuesta = $this->request->getPost('tipoderespuesta', FILTER_SANITIZE_STRING);
    $idQuizEditar = $this->request->getPost('idQuizEditar', FILTER_SANITIZE_STRING);
    $fotoQuizEditar = $this->request->getPost('fotoQuizEditar', FILTER_SANITIZE_STRING); //VER SI ESTA VACIO
    $nameQuizEditar = $this->request->getPost('nameQuizEditar', FILTER_SANITIZE_STRING);
    $selectNivelQuizEditar = $this->request->getPost('selectNivelQuizEditar', FILTER_SANITIZE_STRING);
    
    //Unica
    $respuestaId = $this->request->getPost('respuestaId', FILTER_SANITIZE_STRING);
    $respuestaUnicaValor = $this->request->getPost('respuestaUnicaValor', FILTER_SANITIZE_STRING);
    $respuestaradioeditarunica = $this->request->getPost('respuestaradioeditarunica', FILTER_SANITIZE_STRING);
    
    //Multiple
    $respuestaradioeditarmultiple = $this->request->getPost('respuestaradioeditarmultiple', FILTER_SANITIZE_STRING);
    $respuestasIdEditar = $this->request->getPost('respuestasIdEditar', FILTER_SANITIZE_STRING);
    $respuestasNameEditar = $this->request->getPost('respuestasNameEditar', FILTER_SANITIZE_STRING);
    
    $arrayPregunta = array('quiz_bicicleta_id' => $idQuizEditar, 'quiz_bicicleta_pregunta' => $nameQuizEditar, 'quiz_bicicleta_file' => $fotoQuizEditar, 'nivel_quiz_id' => $selectNivelQuizEditar);
    
    if ($tipoderespuesta == 'unica') {
      // $arrayunica = array('' => , );
      
      if ($respuestaradioeditarunica == 'seleccionada') {
        $valorcorrecto = '1';
      } else {
        $valorcorrecto = '0';
      }
      $arrayRespuesta = array('respuesta_quiz_id' => $respuestaId[0], 'respuesta_quiz_resp' => $respuestaUnicaValor[0], 'respuesta_quiz_correcta' => $valorcorrecto);
      
      $editandorespuesta = $this->quiz->editarRespuesta($arrayRespuesta);
      $editandopregunta = $this->quiz->editarPregunta($arrayPregunta);
      
      echo json_encode(array('status' => true, 'data' => $_POST, 'tipoderespuesta' => $tipoderespuesta));
    } else {
      
      $arrayRespuestas = array();
      foreach ($respuestasIdEditar as $key => $value) {
        if ($respuestaradioeditarmultiple == $key) {
          $arrayRespuestas[] = array('respuesta_quiz_id' => $value, 'respuesta_quiz_resp' => $respuestasNameEditar[$key], 'respuesta_quiz_correcta' => '1');
        } else {
          $arrayRespuestas[] = array('respuesta_quiz_id' => $value, 'respuesta_quiz_resp' => $respuestasNameEditar[$key], 'respuesta_quiz_correcta' => '0');
        }
      }
      $editandorespuestas = $this->quiz->editarRespuestas($arrayRespuestas);
      $editandopregunta = $this->quiz->editarPregunta($arrayPregunta);
      echo json_encode(array('status' => true));
    }
  }
  
  public function verRespuestasPregunta()
  {
    $idpregunta = $this->request->getPost('idpregunta', FILTER_SANITIZE_STRING);
    $array = [
      'quiz_bicicleta_id' => $idpregunta
    ];
    $data = $this->quiz->verRespuestasPregunta($array);
    $datos = $data->getResult();
    
    if (count($datos) == '1') {
      $datofinal = array('tipodedata' => 'unica', 'data' => $datos);
    } else {
      $datofinal = array('tipodedata' => 'multiple', 'data' => $datos);
    }
    echo json_encode($datofinal);
  }
  
  public function eliminarPregunta()
  {
    $idpregunta = $this->request->getPost('idpregunta', FILTER_SANITIZE_STRING);
    $array = [
      'quiz_bicicleta_id' => $idpregunta
    ];
    $eliminarRespuestas = $this->quiz->eliminarRespuestasPregunta($array);
    
    if ($eliminarRespuestas >= 1) {
      $eliminarpregunta = $this->quiz->eliminarPregunta($array);
      if ($eliminarpregunta >= 1) {
        echo json_encode(array('status' => true));
      } else {
        echo json_encode(array('status' => false));
      }
    } else {
      echo json_encode(array('status' => false));
    }
  }
  
}

