<?php namespace App\Controllers;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,text/html; charset=utf-8');
// header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
//Codeigniter
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\API\ResponseTrait;
//Modelos
use App\Models\CategoriaModel, App\Models\PiezaModel, App\Models\UsuarioModel, App\Models\ImagenesPiezaModel, App\Models\ForoModel, App\Models\QuizModel;


class Apis extends Controller
{
	use ResponseTrait;
	protected $request;
	public $pieza = null;
	public $user = null;
	public $categoria = null;
	public $foro = null;
	public $quiz = null;
	
	
	public function __construct()
	{
		$this->categoria = new CategoriaModel();
		$this->pieza = new PiezaModel();
		$this->user = new UsuarioModel();
		$this->imagenespieza = new ImagenesPiezaModel();
		$this->foro = new ForoModel();
		$this->quiz = new QuizModel();
	}
	
	public function uploadImageForo()
	{
		$file = $this->request->getFile('file');
		
		if ($file->isValid() && !$file->hasMoved()) {
			$newName = $file->getRandomName();
			$lugar = 'uploads/foros/' . date("d_m_y");
			$file->move($lugar, $newName, true);
			//esto retorna todo el lugar completo
			$ubicacionfile = base_url() . "/" . $lugar . "/" . $newName;
			echo json_encode(array('respuesta' => 'Se subio el archivo en: ' . $ubicacionfile, 'lugararchivo' => $ubicacionfile, 'urldinamica' => $lugar . "/" . $newName));
		} else {
			echo false;
		}
	}
	
	public function uploadImageUsuario()
	{
		$file = $this->request->getFile('file');
		
		if ($file->isValid() && !$file->hasMoved()) {
			$newName = $file->getRandomName();
			$lugar = 'uploads/foto_usuario/' . date("d_m_y");
			$file->move($lugar, $newName, true);
			// //esto retorna todo el lugar completo
			// echo base_url()."/".$lugar."/".$newName;
			// //esto retorna solo el lugar pero no el base_url     
			// echo $lugar."/".$newName;
			$ubicacionfile = base_url() . "/" . $lugar . "/" . $newName;
			echo json_encode(array('respuesta' => 'Se subio el archivo en: ' . $ubicacionfile, 'lugararchivo' => $ubicacionfile, 'urldinamica' => $lugar . "/" . $newName));
		} else {
			echo false;
		}
	}
	
	//USER API PART 
	public function login_user()
	{
		$user_email = $this->request->getPost('user_email', FILTER_SANITIZE_STRING);
		$user_password = $this->request->getPost('user_password', FILTER_SANITIZE_STRING);
		$user_push_token = $this->request->getPost('user_push_token', FILTER_SANITIZE_STRING);
		
		$data = $this->user->login_user($user_email);
		$datos = $data->getResult();
		
		if (count($datos) >= 1) {
			foreach ($datos as $row) {
				if (password_verify($user_password, $row->user_password)) {
					$dataUser = array(
						'user_id' => $row->user_id,
						'user_name' => $row->user_name,
						'user_email' => $row->user_email,
						'user_password' => $row->user_password,
						'user_push_token' => $user_push_token,
						'user_phone' => $row->user_phone,
						'user_photo' => $row->user_photo,
						'user_type' => $row->user_type
					);
					$this->user->update_push_token($dataUser);
					echo json_encode(array('status' => true, 'user' => $dataUser));
				} else {
					echo json_encode(array('status' => false));
				}
			}
		} else {
			echo json_encode(array("status" => FALSE));
		}
	}
	
	public function signup_user()
	{
		$nameRegistro = $this->request->getPost('nameRegistro', FILTER_SANITIZE_STRING);
		$emailRegistro = $this->request->getPost('emailRegistro', FILTER_SANITIZE_STRING);
		$passwordRegistro = $this->request->getPost('passwordRegistro', FILTER_SANITIZE_STRING);
		$phoneRegistro = $this->request->getPost('phoneRegistro', FILTER_SANITIZE_STRING);
		$urlfotoregistro = $this->request->getPost('urlfotoregistro', FILTER_SANITIZE_STRING);
		$user_push_token = $this->request->getPost('user_push_token', FILTER_SANITIZE_STRING);
		
		$pass = password_hash($passwordRegistro, PASSWORD_BCRYPT);
		
		$array = [
			'user_name'   => $nameRegistro,
			'user_email'  => $emailRegistro,
			'user_password' => $pass,
			'user_remenber_password' => null,
			'user_photo' => $urlfotoregistro,
			'user_phone' => $phoneRegistro,
			'user_push_token' => $user_push_token,
			'user_type' => '0',
			'user_status' => '1'
		];
		$insertar = $this->user->registrarUsuario($array);
		$datainsertar = json_decode($insertar);
		
		if ($datainsertar->status) {
			$array['user_id'] = $datainsertar->usuarioid;
			echo json_encode(array('status' => true, 'user' => $array));
		} else {
			echo json_encode(array('status' => false));
		}
	}
	
	//PIEZA API PART
	public function mostrarTodasPiezasCategorias()
	{
		$result = array();
		$data = $this->pieza->mostrarTodasPiezasCategorias();
		$datosdecodificados = json_decode($data);
		echo json_encode(array('dataCategoria' => $datosdecodificados->datacategoria, 'dataPieza' => $datosdecodificados->datapieza));
	}
	
	public function seleccionarPieza()
	{
		$pieza_bicicleta_id = $this->request->getPost('pieza_bicicleta_id', FILTER_SANITIZE_STRING);
		$categoria_piezas_bicicleta_name = $this->request->getPost('categoria_piezas_bicicleta_name', FILTER_SANITIZE_STRING);
		$categoria_piezas_bicicleta_photo = $this->request->getPost('categoria_piezas_bicicleta_photo', FILTER_SANITIZE_STRING);
		$imagen_pieza_bicicleta_file = $this->request->getPost('imagen_pieza_bicicleta_file', FILTER_SANITIZE_STRING);
		$pieza_bicicleta_description = $this->request->getPost('pieza_bicicleta_description', FILTER_SANITIZE_STRING);
		$pieza_bicicleta_name = $this->request->getPost('pieza_bicicleta_name', FILTER_SANITIZE_STRING);
		
		$array = [
			'pieza_bicicleta_id' => $pieza_bicicleta_id,
			'imagen_pieza_bicicleta_tipo' => '0',
		];
		$verImagenesPieza = $this->pieza->verImagenesPieza($array);
		$datos = $verImagenesPieza->getResult();
		$datapieza = [
			'pieza_bicicleta_id' => $pieza_bicicleta_id,
			'categoria_piezas_bicicleta_name' => $categoria_piezas_bicicleta_name,
			'categoria_piezas_bicicleta_photo' => $categoria_piezas_bicicleta_photo,
			'imagen_pieza_bicicleta_file' => $imagen_pieza_bicicleta_file,
			'pieza_bicicleta_description' => $pieza_bicicleta_description,
			'pieza_bicicleta_name' => $pieza_bicicleta_name,
		];
		if (count($datos) >= 1) {
			echo json_encode(array('status' => true, 'datapieza' => $datapieza, 'dataimagenes' => $datos));
		} else {
			echo json_encode(array('status' => false, 'datapieza' => $datapieza));
		}
	}
	
	
	
	public function mostrarTodasCategorias()
	{
		$data = $this->categoria->mostrarTodasCategorias();
		$datos = $data->getResult();
		echo json_encode($datos);
	}
	
	public function unique_multidim_array($array, $key)
	{
		$temp_array = array();
		$i = 0;
		$key_array = array();
		
		foreach ($array as $val) {
			if (!in_array($val[$key], $key_array)) {
				$key_array[$i] = $val[$key];
				$temp_array[$i] = $val;
			}
			$i++;
		}
		return $temp_array;
	}
	
	public function array_flatten($array)
	{
		if (!is_array($array)) {
			return FALSE;
		}
		$result = array();
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$result = array_merge($result, array_flatten($value));
			} else {
				$result[$key] = $value;
			}
		}
		return $result;
	}
	
	//Quiz
	public function mostrarTodosNivelesQuiz()
	{
		$data = $this->quiz->mostrarTodosNivelesQuiz()->getResult();
		echo json_encode(array('data' => $data));
	}

	public function mostrarPreguntasNivel()
	{
		$nivel_quiz_id = $this->request->getPost('nivel_quiz_id', FILTER_SANITIZE_STRING);
		$array = [
			'nivel_quiz_id'   => $nivel_quiz_id,
		];
		$data = $this->quiz->mostrarPreguntasNivel($array);
		$datos = $data->getResult();

		echo json_encode(array('data' => $datos));
	}

}
