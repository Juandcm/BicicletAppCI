<?php namespace App\Controllers;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,text/html; charset=utf-8');

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\I18n\Time;
use App\Models\ForoModel;
use App\Models\UsuarioModel;

class Foro extends Controller
{
  protected $request;
  public $session = null;
  public $foro = null;
  
  public function __construct()
  {
    $this->session = \Config\Services::session();
    $this->foro = new ForoModel();
    $this->usuario = new UsuarioModel();
  }
  
  
  public function uploadImage()
  {
    $file = $this->request->getFile('file');
    
    if ($file->isValid() && !$file->hasMoved()) {
      $newName = $file->getRandomName();
      $lugar = 'uploads/foros/' . date("d_m_y");
      $file->move($lugar, $newName, true);
      // //esto retorna todo el lugar completo
      // echo base_url()."/".$lugar."/".$newName;
      // //esto retorna solo el lugar pero no el base_url     
      echo $lugar . "/" . $newName;
    } else {
      echo false;
    }
  }
  
  
  public function registrarForo()
  {
    $nameForo = $this->request->getPost('nameForo', FILTER_SANITIZE_STRING);
    $urlfotoregistroforo = $this->request->getPost('urlfotoregistroforo', FILTER_SANITIZE_STRING);
    
    $iduserapp = $this->request->getPost('iduserapp', FILTER_SANITIZE_STRING);
    $iduserweb = $this->session->get('user_id');
    $userid = ($iduserweb != '') ? $iduserweb : $iduserapp;
    
    $time = Time::parse(Time::now(), 'America/Caracas', 'es');
    $tiempo = $time->toLocalizedString('MMMM d, yyyy');
    $array = [
      'foro_name'   => $nameForo,
      'foro_file'  => $urlfotoregistroforo,
      'foro_create' => null,
      'foro_update' => null,
      'foro_eliminado'  => '1', //0 = eliminado; 1 = activo
      'user_id'  => $userid
    ];
    $insertar = $this->foro->registrarForo($array);
    $datosinsert = json_decode($insertar);
    
    if ($datosinsert->status) {
      if ($iduserapp != '') {
        $arrayFinal = array(
          'idforo' => $datosinsert->idinsert,
          'nameforo'   => $nameForo,
          'fileforo'  => $urlfotoregistroforo,
          'createforo' => $tiempo,
          'statusforo' => '1',
          'userforo'  => $userid,
          'creadoApp' => true
        );
      } else {
        $arrayFinal = array(
          'idforo' => $datosinsert->idinsert,
          'nameforo'   => $nameForo,
          'fileforo'  => $urlfotoregistroforo,
          'createforo' => $tiempo,
          'statusforo' => '1',
          'userforo'  => $userid,
          'creadoApp' => false
        );
      }
      echo json_encode(array('status' => true, 'data' => $arrayFinal));
    } else {
      echo json_encode(array('status' => false));
    }
  }
  
  public function editarForo()
  {
    $idforoeditar = $this->request->getPost('idforoeditar', FILTER_SANITIZE_STRING);
    $iduserforoeditar = $this->request->getPost('iduserforoeditar', FILTER_SANITIZE_STRING);
    $nameForoEditar = $this->request->getPost('nameForoEditar', FILTER_SANITIZE_STRING);
    $urlfotoeditarforo = $this->request->getPost('urlfotoeditarforo', FILTER_SANITIZE_STRING);
    $iduserweb = $this->session->get('user_id');
    $iduserapp = $this->request->getPost('iduserapp', FILTER_SANITIZE_STRING);
    $userid = ($iduserweb != '') ? $iduserweb : $iduserapp;
    
    $array = [
      'foro_id' => $idforoeditar,
      'foro_name' => $nameForoEditar,
      'foro_file' => $urlfotoeditarforo,
    ];
    
    if ($iduserforoeditar == $userid) {
      $editar = $this->foro->editarForo($array);
      if ($editar == '1') {
        $arrayFinal = array(
          'idforo' => $idforoeditar,
          'nameforo'   => $nameForoEditar,
          'fileforo'  => $urlfotoeditarforo,
        );
        echo json_encode(array('status' => true, 'data' => $arrayFinal));
      } else {
        echo json_encode(array('status' => false));
      }
    } else {
      echo json_encode(array('status' => false, 'dataerror' => 'No puedes editarlo porque no eres el creador del foro'));
    }
  }
  public function bilitarforo()
  {
    $idforo = $this->request->getPost('idforo', FILTER_SANITIZE_STRING);
    $iduser = $this->request->getPost('iduser', FILTER_SANITIZE_STRING);
    $tipodeaccion = $this->request->getPost('tipodeaccion', FILTER_SANITIZE_STRING);
    
    $iduserweb = $this->session->get('user_id');
    $iduserapp = $this->request->getPost('iduserapp', FILTER_SANITIZE_STRING);
    $userid = ($iduserweb != '') ? $iduserweb : $iduserapp; 
    $array = [
      'foro_id' => $idforo,
      'foro_eliminado' => $tipodeaccion
    ];
    
    if ($iduser == $userid) {
      $editar = $this->foro->bilitarforo($array);
      if ($editar == '1') {
        echo json_encode(array('status' => true));
      } else {
        echo json_encode(array('status' => false));
      }
    } else {
      echo json_encode(array('status' => false, 'dataerror' => 'No puedes editarlo porque no eres el creador del foro'));
    }
  }
  
  public function mostrarTodosForos()
  {
    $result = array();
    $data = $this->foro->mostrarTodosForos();
    $datos = $data->getResult();
    foreach ($datos as $key => $value) {
      $time = Time::parse($value->foro_create, 'America/Caracas', 'es');
      $tiempo = $time->toLocalizedString('MMMM d, yyyy');
      
      $result[] = array(
        "idforo" => $value->foro_id,
        "nameforo" => $value->foro_name,
        "fileforo" => $value->foro_file,
        "createforo" => $tiempo,
        "statusforo" => $value->foro_eliminado,
        "userforo" => $value->user_id
      );
    }
    $json_data = array(
      "data" => $result
    );
    
    echo json_encode($json_data);
  }
  
  public function mostrarTodosMensajesForo()
  {
    $idforo = $this->request->getPost('idforo', FILTER_SANITIZE_STRING);
    $iduserapp = $this->request->getPost('iduserapp', FILTER_SANITIZE_STRING);
    $iduserweb = $this->session->get('user_id');
    $valoriduser = ($iduserweb != '') ? $iduserweb : $iduserapp;
    
    $array = [
      'foro_id'   => $idforo
    ];
    $data = $this->foro->mostrarTodosMensajesForo($array);
    $datos = $data->getResult();
    if (empty($data->resultObject)) {
      echo json_encode(array('status' => false, 'data' => $data->resultObject));
    } else {
      foreach ($datos as $key => $value) {        
        $time = Time::parse($value->mensaje_foro_create, 'America/Caracas');
        $tiempo = $time->toLocalizedString('d MMMM yyyy, HH:mm');
        
        if ($valoriduser == $value->user_id) {
          $json_data[] = array(
            "mensaje_foro_id" => $value->mensaje_foro_id,
            "mensaje_foro_mens" => $value->mensaje_foro_mens,
            "mensaje_foro_file" => $value->mensaje_foro_file,
            "mensaje_foro_create" => $tiempo,
            "mensaje_eliminado" => $value->mensaje_eliminado,
            "user_id" => $value->user_id,
            "user_name" => $value->user_name,
            "user_photo" => $value->user_photo,
            "tipodemensaje" => 'enviado'
          );
        } else {
          $json_data[] = array(
            "mensaje_foro_id" => $value->mensaje_foro_id,
            "mensaje_foro_mens" => $value->mensaje_foro_mens,
            "mensaje_foro_file" => $value->mensaje_foro_file,
            "mensaje_foro_create" => $tiempo,
            "mensaje_eliminado" => $value->mensaje_eliminado,
            "user_id" => $value->user_id,
            "user_name" => $value->user_name,
            "user_photo" => $value->user_photo,
            "tipodemensaje" => 'recibido'
          );
        }
      }
      echo json_encode(array('status' => true, 'data' => $json_data));
    }
  }
  
  public function uploadImageMensajeForo()
  {
    $file = $this->request->getFile('file');
    $idforo = $this->request->getPost('idforo', FILTER_SANITIZE_STRING);
    $iduserapp = $this->request->getPost('iduserapp', FILTER_SANITIZE_STRING);
    $iduserweb = $this->session->get('user_id');
    $userid = ($iduserweb != '') ? $iduserweb : $iduserapp;
    
    $valoractual = Time::now('America/Caracas', 'es_VE');
    $hora = $valoractual->toLocalizedString('d MMMM yyyy, HH:mm');
    
    if ($file->isValid() && !$file->hasMoved()) {
      $newName = $file->getRandomName();
      $lugar = 'uploads/foros/' . date("d_m_y");
      $file->move($lugar, $newName, true);  
      $ubicacionfile = $lugar . "/" . $newName;
      $array = [
        'mensaje_foro_mens'   => null,
        'mensaje_foro_file'  => $ubicacionfile,
        'mensaje_foro_create' => null,
        'mensaje_eliminado'  => '1', //0 = eliminado; 1 = activo
        'foro_id' => $idforo,
        'user_id'  => $userid
      ];
      $insertar = $this->foro->registrarMensajeFile($array);
      $datosinsert = json_decode($insertar);
      if ($datosinsert->status) {
        $data = $this->usuario->getUserById($userid);
        $datos = $data->getResult();
        if (count($datos) >= 1) {
          foreach ($datos as $row) {
            $dataUser = array(
              'user_id' => $row->user_id,
              'user_name' => $row->user_name,
              'user_photo' => $row->user_photo,
              'user_type' => $row->user_type
            );
            echo json_encode(array('status' => true, 'mensaje_foro_id' => $datosinsert->idinsert, 'dataubicacionfile' => $ubicacionfile, 'fechactual' => $hora, 'user' => $dataUser));
          }
        } else {
          echo json_encode(array('status' => false));
        }
      } else {
        echo json_encode(array('status' => false));
      }
    } else {
      echo json_encode(array('status' => false));
    }
  }
  public function enviarMensaje()
  {
    $idforo = $this->request->getPost('idforoenviarmensaje', FILTER_SANITIZE_STRING);
    $mensajeforo = $this->request->getPost('mensajeforoenviar', FILTER_SANITIZE_STRING);
    $iduserapp = $this->request->getPost('iduserapp', FILTER_SANITIZE_STRING);
    $iduserweb = $this->session->get('user_id');
    $valoriduser = ($iduserweb != '') ? $iduserweb : $iduserapp;
    $valoractual = Time::now('America/Caracas', 'es_VE');
    $hora = $valoractual->toLocalizedString('d MMMM yyyy, HH:mm');
    
    $array = [
      'mensaje_foro_mens'   => $mensajeforo,
      'mensaje_foro_file'  => null,
      'mensaje_foro_create' => null,
      'mensaje_eliminado'  => '1', //0 = eliminado; 1 = activo
      'foro_id' => $idforo,
      'user_id'  => $valoriduser
    ];
    $insertar = $this->foro->registrarMensaje($array);
    $datosinsert = json_decode($insertar);
    if ($datosinsert->status) {
      $data = $this->usuario->getUserById($valoriduser);
      $datos = $data->getResult();
      
      if (count($datos) >= 1) {
        foreach ($datos as $row) {
          $dataUser = array(
            'user_id' => $row->user_id,
            'user_name' => $row->user_name,
            'user_photo' => $row->user_photo,
            'user_type' => $row->user_type
          );
          echo json_encode(array('status' => true, 'mensaje_foro_id' => $datosinsert->idinsert, 'mensaje_foro_mens' => $mensajeforo, 'fechactual' => $hora, 'user' => $dataUser));
        }
      } else {
        echo json_encode(array('status' => false));
      }
    } else {
      echo json_encode(array('status' => false));
    }
  }
}
