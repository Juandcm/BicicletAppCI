<?php namespace App\Controllers;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,text/html; charset=utf-8');

use CodeIgniter\HTTP\RequestInterface;


class Route extends BaseController
{
	protected $request;
	public $session = null;
	public function __construct()
	{
		$this->session = \Config\Services::session();
	}
	public function index()
	{
		if ($this->session->has('user_id')) {
			return view('dentro_session');
		} else {
			return view('fuera_session');
		}
	}
	
	public function verificarSession($vista)
	{
		if ($this->session->has('user_id')) {
			return $vista;
		} else {
			return 'errors/html/sin_permiso';
		}
	}
	
	public function usuarios()
	{
		$vista = $this->verificarSession('administracion/usuarios/administradorusuario');
		return view($vista);
	}
	
	public function categorias()
	{
		$vista = $this->verificarSession('administracion/categorias/administradorcategoria');
		return view($vista);
	}
	
	public function piezas()
	{
		$vista = $this->verificarSession('administracion/piezas/administradorpieza');
		return view($vista);
	}
	
	public function foro()
	{
		$vista = $this->verificarSession('administracion/foro/administradorforo');
		return view($vista);
	}
	
	public function quiz()
	{
		$vista = $this->verificarSession('administracion/quiz/administradorquiz');
		return view($vista);
	}
	
	public function buscador()
	{
		//Tengo que crear un modelo que tenga el buscador
		$buscadorpalabra = $this->request->uri->getSegment(2);
		$buscadorpalabra = ['buscadorpalabra' => $buscadorpalabra, 'datosbuscador' => 'respuesta'];
		$vista = $this->verificarSession('administracion/buscador/buscadorprincipal');
		
		return view($vista, $buscadorpalabra);
	}
	
	public function administrarbuscador()
	{
		$vista = $this->verificarSession('administracion/buscador/administradorbuscador');
		return view($vista);
	}
	//--------------------------------------------------------------------
	
}
