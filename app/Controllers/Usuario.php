<?php namespace App\Controllers;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,text/html; charset=utf-8');

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\UsuarioModel;

class Usuario extends Controller
{
  protected $request;
  public $session = null;
  public $user = null;
  public $email = null;
  
  public function __construct()
  {
    $this->session = \Config\Services::session();
    $this->email = \Config\Services::email();
    $this->user = new UsuarioModel();
  }
  
  public function login_admin()
  {
    $user_email = $this->request->getPost('correo', FILTER_SANITIZE_STRING);
    $user_password = $this->request->getPost('contrasena', FILTER_SANITIZE_STRING);
    $data = $this->user->login_admin($user_email);
    $datos = $data->getResult();
    if (count($datos) >= 1) {
      foreach ($datos as $row) {
        if (password_verify($user_password, $row->user_password) && $row->user_type == '1') {
          $dataUser = array(
            'user_id' => $row->user_id,
            'user_name' => $row->user_name,
            'user_email' => $row->user_email,
            'user_password' => $row->user_password,
            'user_phone' => $row->user_phone,
            'user_photo' => $row->user_photo,
            'user_type' => $row->user_type
          );
          $this->session->set($dataUser);
          echo json_encode(array('status' => true, 'user' => $dataUser));
        } else {
          echo json_encode(array('status' => false));
        }
      }
    } else {
      echo json_encode(array('status' => false));
    }
  }
  
  public function uploadImage()
  {
    $file = $this->request->getFile('file');
    
    if ($file->isValid() && !$file->hasMoved()) {
      $newName = $file->getRandomName();
      $lugar = 'uploads/foto_usuario/' . date("d_m_y");
      $file->move($lugar, $newName, true);
      echo $lugar . "/" . $newName;
    } else {
      echo false;
    }
  }
  
  public function mostrarTodosUsuario()
  {
    $result = array();
    $data = $this->user->mostrarTodosUsuario();
    $datos = $data->getResult();
    foreach ($datos as $key => $value) {
      if ($value->user_photo != "") {
        $foto = '<img src="' . base_url() . '/' . $value->user_photo . '" class="rounded-circle" width="50" />';
        $nombre = '<a href="javascript:void(0)" onclick="verImagenDetallada(\'' . base_url() . '/' . $value->user_photo . '\')">' . $foto . ' ' . $value->user_name . '</a>';
      } else {
        $nombre = '<a href="javascript:void(0)">' . $value->user_name . '</a>';
      }
      
      $typeuser = ($value->user_type == '1') ? '<span class="label label-success">Administrador</span>' : '<span class="label label-warning">General</span>';
      if ($value->user_status == '1') {
        $typestatus = '<span class="label label-success">Habilitado</span>';
        $btnstatus = '<a class="dropdown-item" href="javascript:void(0)" onclick="bilitarusuario(\'' . $value->user_id . '\',\'0\')">
        <i class="fas fa-eye-slash"></i> Desabilitar
        </a>';
      } else {
        $typestatus = '<span class="label label-danger">Desabilitado</span>';
        $btnstatus = '<a class="dropdown-item" href="javascript:void(0)" onclick="bilitarusuario(\'' . $value->user_id . '\',\'1\')">
        <i class="fas fa-eye"></i> Habilitar
        </a>';
      }
      
      $buttons = '<div class="btn-group">
      <button type="button" class="btn btn-dark dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-original-title="Opciones" aria-hidden="true">
      <i class="ti-settings"></i>
      </button>
      <div class="dropdown-menu animated slideInUp" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
      <a class="dropdown-item" href="javascript:void(0)" onclick="editarusuariodatatable(\'' . $value->user_id . '\',\'' . $value->user_name . '\',\'' . $value->user_email . '\',\'' . $value->user_phone . '\',\'' . $value->user_type . '\',\'' . $value->user_photo . '\')">
      <i class="ti-pencil-alt"></i> Editar
      </a>
      ' . $btnstatus . '
      </div>
      </div>
      ';
      
      $result[] = array(
        "0" => $buttons,
        "1" => $nombre,
        "2" => $value->user_email,
        "3" => $value->user_phone,
        "4" => $typeuser,
        "5" => $typestatus,
        "6" => $value->user_create,
      );
    }
    $json_data = array(
      "data" => $result
    );
    echo json_encode($json_data);
  }
  
  public function registrarUsuario()
  {
    $nameRegistro = $this->request->getPost('nameRegistro', FILTER_SANITIZE_STRING);
    $emailRegistro = $this->request->getPost('emailRegistro', FILTER_SANITIZE_STRING);
    $passwordRegistro = $this->request->getPost('passwordRegistro', FILTER_SANITIZE_STRING);
    $phoneRegistro = $this->request->getPost('phoneRegistro', FILTER_SANITIZE_STRING);
    $urlfotoregistro = $this->request->getPost('urlfotoregistro', FILTER_SANITIZE_STRING);
    $selectRolRegistro = $this->request->getPost('selectRolRegistro', FILTER_SANITIZE_STRING);
    $pass = password_hash($passwordRegistro, PASSWORD_BCRYPT);
    $array = [
      'user_name'   => $nameRegistro,
      'user_email'  => $emailRegistro,
      'user_password' => $pass,
      'user_remenber_password' => null,
      'user_photo' => $urlfotoregistro,
      'user_phone' => $phoneRegistro,
      'user_push_token' => null,
      'user_type' => $selectRolRegistro,
      'user_status' => '1'
    ];
    
    $insertar = $this->user->registrarUsuario($array);
    if ($insertar) {
      echo json_encode(array('status' => true));
    } else {
      echo json_encode(array('status' => false));
    }
  }
  
  public function editarUsuario()
  {
    $iduserEditar = $this->request->getPost('iduserEditar', FILTER_SANITIZE_STRING);
    $nameEditar = $this->request->getPost('nameEditar', FILTER_SANITIZE_STRING);
    $emailEditar = $this->request->getPost('emailEditar', FILTER_SANITIZE_STRING);
    $passwordEditar = $this->request->getPost('passwordEditar', FILTER_SANITIZE_STRING);
    $phoneEditar = $this->request->getPost('phoneEditar', FILTER_SANITIZE_STRING);
    $urlfotoEditar = $this->request->getPost('urlfotoEditar', FILTER_SANITIZE_STRING);
    $selectRolEditar = $this->request->getPost('selectRolEditar', FILTER_SANITIZE_STRING);
    $tipodeaccion = $this->request->getPost('tipodeaccion', FILTER_SANITIZE_STRING);
    $array = [
      'user_id' => $iduserEditar,
      'user_name'   => $nameEditar,
      'user_email'  => $emailEditar,
      'user_password' => $passwordEditar,
      'user_photo' => $urlfotoEditar,
      'user_phone' => $phoneEditar,
      'user_type' => $selectRolEditar,
    ];
    if ($selectRolEditar == "nocambiar") {
      $editar = $this->user->editarUsuarioApp($array);
    } else {
      $editar = $this->user->editarUsuario($array);
    }
    if ($editar == '1') {
      $mostrarUser = $this->user->getUserById($iduserEditar);
      $datosUser = $mostrarUser->getResult();
      if ($tipodeaccion == '1') {
        $this->session->set($array);
        echo json_encode(array('status' => true, 'user' => $datosUser[0]));
      } else {
        echo json_encode(array('status' => true, 'user' => $datosUser[0]));
      }
    } else {
      echo json_encode(array('status' => false, 'user' => $array));
    }
  }
  
  public function bilitarUsuario()
  {
    $id = $this->request->getPost('id', FILTER_SANITIZE_STRING);
    $tipo = $this->request->getPost('tipo', FILTER_SANITIZE_STRING);
    
    $array = [
      'user_id' => $id,
      'user_status' => $tipo,
    ];
    $editar = $this->user->bilitarUsuario($array);
    if ($editar == '1') {
      echo json_encode(array('status' => true, 'data' => $enviarsocket));
    } else {
      echo json_encode(array('status' => false));
    }
  }
  
  public function recuperarContrasena()
  {
    $restaurarcorreo = $this->request->getPost('restaurarcorreo', FILTER_SANITIZE_STRING);
    $restaurarapp = $this->request->getPost('restaurarapp', FILTER_SANITIZE_STRING);
    $data = $this->user->login_admin($restaurarcorreo);
    $datos = $data->getResult();
    $codigo = rand(1000, 10000);
    $mensaje = '<br/>Recientemente se envió una solicitud para restablecer una contraseña para su cuenta. Si esto fue un error, simplemente ignore este correo electrónico y no pasará nada. <br/>Para restablecer su contraseña, ingrese el siguiente código en el sistema: ' . $codigo;
    
    if (count($datos) >= 1) {
      // $enviaremail = $this->enviarCorreo($restaurarcorreo, 'Recuperar contraseña', $mensaje);
      $array = [
        'user_email' => $restaurarcorreo,
        'user_code_verificacion' => $codigo,
      ];
      $actualizarcodigouser = $this->user->actualizarcodigouser($array);
      // if ($enviaremail && $actualizarcodigouser == '1') {
      if ($actualizarcodigouser == '1') {
        if ($restaurarapp != '') {
          echo json_encode(array('status' => true, 'data' => $array));
        } else {
          echo json_encode(array('status' => true));
        }
      } else {
        echo json_encode(array('status' => false));
      }
    } else {
      echo json_encode(array('status' => false));
    }
  }
  
  public function restaurarUsuario()
  {
    $verificarcorreo = $this->request->getPost('verificarcorreo', FILTER_SANITIZE_STRING);
    $codigoverificacion = $this->request->getPost('codigoverificacion', FILTER_SANITIZE_STRING);
    $tipoverificacion = $this->request->getPost('tipoverificacion', FILTER_SANITIZE_STRING);
    $array = [
      'user_email' => $verificarcorreo,
      'user_code_verificacion' => $codigoverificacion,
    ];
    $data = $this->user->comprobarCodigoCorreo($array);
    $datos = $data->getResult();
    
    if (count($datos) >= 1) {
      $arrayNew = [
        'user_email' => $verificarcorreo,
        'user_code_verificacion' => '',
        'user_status' => '1'
      ];
      $dataNew = $this->user->restaurarUsuario($arrayNew);
      if ($dataNew == '1') {
        foreach ($datos as $row) {
          $dataUser = array(
            'user_id' => $row->user_id,
            'user_name' => $row->user_name,
            'user_email' => $row->user_email,
            'user_password' => $row->user_password,
            'user_push_token' => $row->user_push_token,
            'user_phone' => $row->user_phone,
            'user_photo' => $row->user_photo,
            'user_type' => $row->user_type
          );
          if ($tipoverificacion == 'web') {
            $this->session->set($dataUser);
            echo json_encode(array('status' => true, 'user' => $dataUser));
          } else {
            echo json_encode(array('status' => true, 'user' => $dataUser));
          }
        }
      }
    } else {
      echo json_encode(array('status' => false, 'datos' => $array));
    }
  }
  
  public function enviarCorreo($email, $subjecto, $mensaje)
  {
    $config = array(
      'protocol' => 'smtp',
      'SMTPHost' => 'smtp.gmail.com',
      'SMTPPort' => 465,
      'SMTPUser' => 'bicicletaplicacion@gmail.com',
      'SMTPPass' => '$Bicicletapp*',
      'mailType' => 'html',
      'charset' => 'utf-8',
      'newline' => "\r\n",
      'SMTPCrypto' => "ssl"
    );
    $this->email->initialize($config);
    $this->email->setFrom('bicicletaplicacion@gmail.com', 'BicicletApp');
    $this->email->setTo($email);
    $this->email->setSubject($subjecto);
    $this->email->setMessage($mensaje);
    
    if ($this->email->send()) {
      return array('status' => true);
    } else {
      return array('status' => false, 'dataerror' => $this->email->printDebugger());
    }
  }
  
  public function logout()
  {
    $this->session->destroy();
  }
}
