<?php namespace App\Controllers;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,text/html; charset=utf-8');

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\CategoriaModel;

class Categoria extends Controller
{
  protected $request;
  public $session = null;
  public $categoria = null;
  
  public function __construct()
  {
    $this->session = \Config\Services::session();
    $this->categoria = new CategoriaModel();
  }
  
  
  public function uploadImage()
  {
    $file = $this->request->getFile('file');
    
    if ($file->isValid() && !$file->hasMoved()) {
      $newName = $file->getRandomName();
      $lugar = 'uploads/categorias/' . date("d_m_y");
      $file->move($lugar, $newName, true);
      // //esto retorna todo el lugar completo
      // echo base_url()."/".$lugar."/".$newName;
      // //esto retorna solo el lugar pero no el base_url     
      echo $lugar . "/" . $newName;
    } else {
      echo false;
    }
  }
  
  public function mostrarTodasCategorias()
  {
    $result = array();
    $data = $this->categoria->mostrarTodasCategorias();
    $datos = $data->getResult();

    foreach ($datos as $key => $value) {      
      $foto = ($value->categoria_piezas_bicicleta_photo != "")
      ? ' <a href="javascript:void(0)" onclick="verImagenDetallada(\'' . base_url() . '/' . $value->categoria_piezas_bicicleta_photo . '\')">
      <img src="' . base_url() . '/' . $value->categoria_piezas_bicicleta_photo . '" alt="categoria" class="rounded-circle" width="50" />
      </a>'
      : 'sin imagen';
      
      if ($value->categoria_piezas_status == '1') {
        $typestatus = '<span class="label label-success">Habilitado</span>';
        $btnstatus = '<a class="dropdown-item" href="javascript:void(0)" onclick="bilitarcategoria(\'' . $value->categoria_piezas_bicicleta_id . '\',\'0\')">
        <i class="fas fa-eye-slash"></i> Deshabilitar
        </a>';
      } else {
        $typestatus = '<span class="label label-danger">Desabilitado</span>';
        $btnstatus = '<a class="dropdown-item" href="javascript:void(0)" onclick="bilitarcategoria(\'' . $value->categoria_piezas_bicicleta_id . '\',\'1\')">
        <i class="fas fa-eye"></i> Habilitar
        </a>';
      }
      
      $buttons = '<div class="btn-group">
      <button type="button" class="btn btn-dark dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-original-title="Opciones" aria-hidden="true">
      <i class="ti-settings"></i>
      </button>
      <div class="dropdown-menu animated slideInUp" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 35px, 0px);">
      <a class="dropdown-item" href="javascript:void(0)" onclick="editarcategoriadatatable(\'' . $value->categoria_piezas_bicicleta_id . '\',\'' . $value->categoria_piezas_bicicleta_name . '\',\'' . $value->categoria_piezas_bicicleta_photo . '\',\'' . $value->categoria_piezas_status . '\')">
      <i class="ti-pencil-alt"></i> Editar
      </a>
      ' . $btnstatus . '
      </div>
      </div>
      ';
      
      $result[] = array(
        "0" => $buttons,
        "1" => $value->categoria_piezas_bicicleta_name,
        "2" => $foto,
        "3" => $typestatus,
        "4" => $value->categoria_piezas_bicicleta_create
      );
    }
    
    $json_data = array(
      "data" => $result
    );
    
    echo json_encode($json_data);
  }
  
  public function registrarCategoria()
  {
    
    $nameCategoria = $this->request->getPost('nameCategoria', FILTER_SANITIZE_STRING);
    $urlfotoregistrocategoria = $this->request->getPost('urlfotoregistrocategoria', FILTER_SANITIZE_STRING);
    $array = [
      'categoria_piezas_bicicleta_name'   => $nameCategoria,
      'categoria_piezas_bicicleta_photo'  => $urlfotoregistrocategoria,
      'categoria_piezas_status'  => '0',
    ];
    
    $insertar = $this->categoria->registrarCategoria($array);
    if ($insertar) {
      echo json_encode(array('status' => true));
    } else {
      echo json_encode(array('status' => false));
    }
  }
  
  public function editarCategoria()
  {
    $idcategoria = $this->request->getPost('idcategoria', FILTER_SANITIZE_STRING);
    $nameCategoriaEditar = $this->request->getPost('nameCategoriaEditar', FILTER_SANITIZE_STRING);
    $urlfotoregistrocategoriaeditar = $this->request->getPost('urlfotoregistrocategoriaeditar', FILTER_SANITIZE_STRING);
    
    $array = [
      'categoria_piezas_bicicleta_id' => $idcategoria,
      'categoria_piezas_bicicleta_name'   => $nameCategoriaEditar,
      'categoria_piezas_bicicleta_photo'  => $urlfotoregistrocategoriaeditar,
    ];
    $editar = $this->categoria->editarCategoria($array);
    if ($editar == '1') {
      echo json_encode(array('status' => true));
    } else {
      echo json_encode(array('status' => false));
    }
  }
  
  public function bilitarCategoria()
  {
    $id = $this->request->getPost('id', FILTER_SANITIZE_STRING);
    $tipo = $this->request->getPost('tipo', FILTER_SANITIZE_STRING);
    $array = [
      'categoria_piezas_bicicleta_id' => $id,
      'categoria_piezas_status' => $tipo,
    ];
    $editar = $this->categoria->bilitarCategoria($array);
    
    if ($editar == '1') {
      echo json_encode(array('status' => true));
    } else {
      echo json_encode(array('status' => false));
    }
  }
  
  
  public function selectCategoria()
  {
    $data = $this->categoria->selectCategoria();
    $datos = $data->getResult();
    echo "<option value='' disabled selected>Selecciona una categoria</option>";
    foreach ($datos as $key => $value) {
      echo "<option value='" . $value->categoria_piezas_bicicleta_id . "'>" . $value->categoria_piezas_bicicleta_name . "</option>";
    }
  }
}
