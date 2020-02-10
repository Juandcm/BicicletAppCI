<?php namespace App\Controllers;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,text/html; charset=utf-8');

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\PiezaModel;

class Pieza extends Controller
{
  protected $request;
  public $session = null;
  public $pieza = null;
  
  public function __construct()
  {
    $this->session = \Config\Services::session();
    $this->pieza = new PiezaModel();
  }
  
  
  public function uploadImage()
  {
    $file = $this->request->getFile('file');
    
    if ($file->isValid() && !$file->hasMoved()) {
      $newName = $file->getRandomName();
      $lugar = 'uploads/piezas/' . date("d_m_y");
      $file->move($lugar, $newName, true);  
      echo $lugar . "/" . $newName;
    } else {
      echo false;
    }
  }
  
  
  
  
  public function uploadMultipleImage()
  {
    if ($imagefile = $this->request->getFiles()) {
      foreach ($imagefile['file'] as $file) {
        if ($file->isValid() && !$file->hasMoved()) {
          $newName = $file->getRandomName();
          $lugar = 'uploads/piezas/' . date("d_m_y");
          $file->move($lugar, $newName, true);
          echo $lugar . "/" . $newName . "---";
        } else {
          echo false;
        }
      }
    }
  }
  
  public function mostrarTodasPiezas()
  {
    $result = array();
    $data = $this->pieza->mostrarTodasPiezas();
    $datos = $data->getResult();
    $valorbtn = '<button class="button is-checked waves-effect waves-light" data-filter="*">Mostrar todo</button>';
    $valorbtn = array('<button class="button is-checked waves-effect waves-light" data-filter="*">Mostrar todo</button>');
    foreach ($datos as $key => $value) {
      if ($value->pieza_bicicleta_status == '1') {
        $pieza_status = 'bg-success';
        $pieza_btn = '<li class="el-item">
        <a class="btn btn-danger el-link" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Deshabilitar" onclick="bilitarpieza(\'' . $value->pieza_bicicleta_id . '\',\'0\')">
        <i class="mdi mdi-eye-off"></i>
        </a>
        </li>';
      } else {
        $pieza_status = 'bg-danger';
        $pieza_btn = '<li class="el-item">
        <a class="btn btn-success el-link" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Habilitar" onclick="bilitarpieza(\'' . $value->pieza_bicicleta_id . '\',\'1\')">
        <i class="mdi mdi-eye"></i>
        </a>
        </li>';
      }
      
      if ($value->imagen_pieza_bicicleta_file != '') {
        $fotoprincipal = '<img src="' . base_url() . '/' . $value->imagen_pieza_bicicleta_file . '" alt="user">';
        $fotosecundaria = '<a class="btn default btn-outline image-popup-vertical-fit el-link" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Detalles"  onclick="verPieza(\'' . $value->pieza_bicicleta_id . '\')">
        <i class="icon-magnifier"></i>
        </a>';
      } else {
        $fotoprincipal = '<img src="' . base_url() . '/assets/images/background/error-bg.jpg" alt="user">';
        $fotosecundaria = '<a class="btn default btn-outline image-popup-vertical-fit el-link" href="' . base_url() . '/assets/images/background/error-bg.jpg" data-toggle="tooltip" data-placement="top" title="Detalles">
        <i class="icon-magnifier"></i>
        </a>';
      }
      
      $valorbtn[] = '<button class="button waves-effect waves-light" data-filter=".' . ucfirst($value->categoria_piezas_bicicleta_name) . '">' . ucfirst($value->categoria_piezas_bicicleta_name) . '</button>';
      
      $valordatos .= '<div class="col-lg-3 col-md-6 element-item ' . ucfirst($value->categoria_piezas_bicicleta_name) . '">
      <div class="card card-hover ' . $pieza_status . '">
      <div class="el-card-item">
      <div class="el-card-avatar el-overlay-1"> 
      ' . $fotoprincipal . '
      <div class="el-overlay">
      <ul class="list-style-none el-info">
      <li class="el-item">
      ' . $fotosecundaria . '
      </li>
      <li class="el-item">
      <a class="btn default btn-outline el-link" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Editar" onclick="editarPieza(\'' . $value->pieza_bicicleta_id . '\',\'' . $value->pieza_bicicleta_name . '\',\'' . $value->pieza_bicicleta_description . '\',\'' . $value->categoria_piezas_bicicleta_id . '\')">
      <i class="far fa-edit"></i>
      </a>
      </li>
      <li class="el-item">
      <a class="btn btn-danger el-link" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="eliminarPieza(\'' . $value->pieza_bicicleta_id . '\')">
      <i class="mdi mdi-delete"></i>
      </a>
      </li>
      ' . $pieza_btn . '
      </ul>
      </div>
      </div>
      <div class="el-card-content">
      <h4 class="m-b-0">' . ucfirst($value->categoria_piezas_bicicleta_name) . '</h4>
      <h2 class="m-b-0">' . ucfirst($value->pieza_bicicleta_name) . '</h2>
      </div>
      </div>
      </div>
      </div>';
    }
    echo json_encode(array('categorias' => implode(array_unique($valorbtn)), 'datos' => $valordatos));
  }
  
  
  public function registrarPieza()
  {
    $namePieza = $this->request->getPost('namePieza', FILTER_SANITIZE_STRING);
    $descriptionPieza = $this->request->getPost('descriptionPieza', FILTER_SANITIZE_STRING);
    $categoriaPiezaId = $this->request->getPost('categoriaPieza', FILTER_SANITIZE_STRING);
    $urlfotoregistropieza = $this->request->getPost('urlfotoregistropieza', FILTER_SANITIZE_STRING);
    $categoriaName = $this->request->getPost('categoriaName', FILTER_SANITIZE_STRING);
    $array = [
      'pieza_bicicleta_name'   => $namePieza,
      'pieza_bicicleta_description'  => $descriptionPieza,
      'pieza_bicicleta_status'  => '0',
      'categoria_piezas_bicicleta_id' => $categoriaPiezaId
    ];
    $insertar = $this->pieza->registrarPieza($array);
    if ($insertar != '') {
      $array['categoria_piezas_bicicleta_name'] = $categoriaName;
      
      if ($urlfotoregistropieza != '') {
        $imagenes = array_unique(explode("---", $urlfotoregistropieza));
        array_pop($imagenes);
        $arrayImagenes = array();
        foreach ($imagenes as $key => $value) {
          if ($key == '0') {
            $tipo = '1';
            $array['imagen_pieza_bicicleta_file'] = $value;
          } else {
            $tipo = '0';
          }
          $arrayImagenes[] = array('imagen_pieza_bicicleta_file' => $value, 'imagen_pieza_bicicleta_tipo' => $tipo, 'pieza_bicicleta_id' => $insertar);
        }
        $insertarImagenes = $this->pieza->registrarFotosPiezas($arrayImagenes);
        if ($insertarImagenes) {
          
          $pieza_btn = '<li class="el-item">
          <a class="btn btn-success el-link" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Habilitar" onclick="bilitarpieza(\'' . $insertar . '\',\'1\')">
          <i class="mdi mdi-eye"></i>
          </a>
          </li>';
          
          $fotoprincipal = '<img src="' . base_url() . '/' . $array['imagen_pieza_bicicleta_file'] . '" alt="user">';
          $fotosecundaria = '<a class="btn default btn-outline image-popup-vertical-fit el-link" href="javascript:void(0);" onclick="verPieza(\'' . $insertar . '\',\'' . $array['pieza_bicicleta_name'] . '\',\'' . $array['pieza_bicicleta_description'] . '\',\'' . $array['categoria_piezas_bicicleta_id'] . '\',\'' . $array['categoria_piezas_bicicleta_name'] . '\',\'' . $value->categoria_piezas_bicicleta_photo . '\',' . "''" . ')">
          <i class="icon-magnifier"></i>
          </a>';
          $valorbtn[] = '<button class="button waves-effect waves-light" data-filter=".' . ucfirst($categoriaName) . '">' . ucfirst($categoriaName) . '</button>';
          
          $valordatos = '<div class="col-lg-3 col-md-6 element-item ' . ucfirst($categoriaName) . '">
          <div class="card card-hover bg-danger">
          <div class="el-card-item">
          <div class="el-card-avatar el-overlay-1"> 
          ' . $fotoprincipal . '
          <div class="el-overlay">
          <ul class="list-style-none el-info">
          <li class="el-item">
          ' . $fotosecundaria . '
          </li>
          <li class="el-item">
          <a class="btn default btn-outline el-link" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Editar" onclick="verPieza(\'' . $insertar . '\',\'' . $array['pieza_bicicleta_name'] . '\',\'' . $array['pieza_bicicleta_description'] . '\',\'' . $array['categoria_piezas_bicicleta_id'] . '\',\'' . $array['categoria_piezas_bicicleta_name'] . '\',\'' . $value->categoria_piezas_bicicleta_photo . '\',' . "'editarpieza'" . ')">
          <i class="far fa-edit"></i>
          </a>
          </li>
          <li class="el-item">
          <a class="btn btn-danger el-link" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="eliminarPieza(\'' . $insertar . '\')">
          <i class="mdi mdi-delete"></i>
          </a>
          </li>
          ' . $pieza_btn . '
          </ul>
          </div>
          </div>
          <div class="el-card-content">
          <h4 class="m-b-0">' . ucfirst($categoriaName) . '</h4>
          <h2 class="m-b-0">' . ucfirst($array['pieza_bicicleta_name']) . '</h2>
          </div>
          </div>
          </div>
          </div>';
          
          echo json_encode(array('status' => true, 'data' => $valordatos));
        } else {
          echo json_encode(array('status' => false));
        }
      } else {
        echo json_encode(array('status' => true, 'data' => $array));
      }
    } else {
      echo json_encode(array('status' => false));
    }
  }
  
  public function bilitarPieza()
  {
    $idpieza = $this->request->getPost('idpieza', FILTER_SANITIZE_STRING);
    $tipo = $this->request->getPost('tipo', FILTER_SANITIZE_STRING);
    $array = [
      'pieza_bicicleta_id' => $idpieza,
      'pieza_bicicleta_status' => $tipo,
    ];
    
    $editar = $this->pieza->bilitarPieza($array);
    $datosdecodificados = json_decode($editar);
    echo json_encode(array('status' => true, 'dataCategoria' => $datosdecodificados->datacategoria, 'dataPieza' => $datosdecodificados->datapieza, 'tipodeaccion' => $tipo));
  }
  
  public function eliminarPieza()
  {
    $idpieza = $this->request->getPost('idpieza', FILTER_SANITIZE_STRING);
    $array = [
      'pieza_bicicleta_id' => $idpieza,
    ];
    $eliminarImagenesPieza = $this->pieza->eliminarImagenesPieza($array);
    
    if ($eliminarImagenesPieza >= 1) {
      $eliminarPieza = $this->pieza->eliminarPieza($array);
      if ($eliminarPieza >= 1) {
        echo json_encode(array('status' => true));
      } else {
        echo json_encode(array('status' => false));
      }
    } else {
      echo json_encode(array('status' => false));
    }
  }
  
  public function verImagenesPieza()
  {
    $idpieza = $this->request->getPost('idpieza', FILTER_SANITIZE_STRING);
    $array = [
      'pieza_bicicleta_id' => $idpieza,
      'imagen_pieza_bicicleta_tipo' => ''
    ];
    $verImagenesPieza = $this->pieza->verImagenesPieza($array);
    $datos = $verImagenesPieza->getResult();
    echo json_encode(array('status' => true, 'data' => $datos));
  }
  
  public function verPiezaDetallada()
  {
    $idpieza = $this->request->getPost('idpieza', FILTER_SANITIZE_STRING);
    $result = array();
    $resultados = array();
    $array = [
      'pieza_bicicleta_id' => $idpieza,
    ];
    $verpieza = $this->pieza->verPiezaDetallada($array);
    $datos = $verpieza->getResult();
    foreach ($datos as $key => $value) {
      
      if ($value->imagen_pieza_bicicleta_tipo == '1') {
        $result[] = $value;
      } else {
        $resultados[] = array("imagen_pieza_bicicleta_file" => $value->imagen_pieza_bicicleta_file);
      }
    }
    echo json_encode(array('status' => true, 'dataPrincipal' => $result, "dataSecundaria" => $resultados));
  }
  
  public function editarPieza()
  {
    $idPiezaEditar = $this->request->getPost('idPiezaEditar', FILTER_SANITIZE_STRING);
    $namePiezaEditar = $this->request->getPost('namePiezaEditar', FILTER_SANITIZE_STRING);
    $selectCategoriaPiezaEditar = $this->request->getPost('selectCategoriaPiezaEditar', FILTER_SANITIZE_STRING);
    $descriptionPiezaEditar = $this->request->getPost('descriptionPiezaEditar', FILTER_SANITIZE_STRING);
    $fotosRegistradasPiezas = $this->request->getPost('fotosRegistradasPiezas', FILTER_SANITIZE_STRING);
    $urlfotoeditarpieza = $this->request->getPost('urlfotoeditarpieza', FILTER_SANITIZE_STRING);
    $idImagenesEliminadas = $this->request->getPost('idImagenesEliminadas', FILTER_SANITIZE_STRING);
    
    $imagenesViejas = array();
    if (count($fotosRegistradasPiezas) > 0) {
      foreach ($fotosRegistradasPiezas as $value) {
        $imagenesOld = explode("---", $value);
        $imagenesViejas[] = array('imagen_pieza_bicicleta_id' => $imagenesOld[0], 'imagen_pieza_bicicleta_tipo' => $imagenesOld[1]);
      }
      $editarImagenes = $this->pieza->editarImagenesPieza($imagenesViejas);
    }
    
    //Agregar imagenes Nuevas
    $imagenesNuevas = array();
    $imagenesNew = array_unique(explode("---", $urlfotoeditarpieza));
    array_pop($imagenesNew);
    if (count($imagenesNew) > 0) {
      foreach ($imagenesNew as $value) {
        $imagenesNuevas[] = array('imagen_pieza_bicicleta_file' => $value, 'imagen_pieza_bicicleta_tipo' => '0', 'pieza_bicicleta_id' => $idPiezaEditar);
      }
      $insertarImagenesNuevas = $this->pieza->registrarFotosPiezas($imagenesNuevas);
    }
    
    // Eliminar imagenes seleccionadas
    $imagenesElimandoNew;
    $imagenesEliminadas = array_unique(explode("---", $idImagenesEliminadas));
    array_pop($imagenesEliminadas);
    if (count($imagenesEliminadas) > 0) {
      foreach ($imagenesEliminadas as $value) {
        $imagenesElimandoNew = array('imagen_pieza_bicicleta_id' => $value);
        $eliminarImagen = $this->pieza->eliminarImagenesPiezaMultiple($imagenesElimandoNew);
      }
    }
    
    //Editar pieza completa
    $arrayEditarPieza = [
      'pieza_bicicleta_id' => $idPiezaEditar,
      'categoria_piezas_bicicleta_id' => $selectCategoriaPiezaEditar,
      'pieza_bicicleta_name' => $namePiezaEditar,
      'pieza_bicicleta_description' => $descriptionPiezaEditar
    ];
    
    $editandoPieza = $this->pieza->editarPieza($arrayEditarPieza);
    
    $datapieza = [
      'pieza_bicicleta_id' => $idPiezaEditar,
      'pieza_bicicleta_name' => $namePiezaEditar,
      'pieza_bicicleta_description' => $descriptionPiezaEditar,
      'categoria_piezas_bicicleta_id' => $selectCategoriaPiezaEditar,
      'imagenes_editar' => $imagenesViejas,
      'urlfotoeditarpieza' => $imagenesNuevas,
      'imagenesEliminadas' => $imagenesElimandoNew,
    ];
    echo json_encode(array('status' => true, 'data' => $datapieza));
  }
}
