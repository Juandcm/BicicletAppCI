<?php namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,text/html; charset=utf-8');

use CodeIgniter\HTTP\RequestInterface;


class Buscador extends BaseController
{
	protected $request;
	public function __construct(){
		$this->session= \Config\Services::session();
	}

}
