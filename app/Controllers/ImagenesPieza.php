<?php namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,text/html; charset=utf-8');

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\ImagenesPiezaModel;

class ImagenesPieza extends Controller
{
  protected $request;
  public $session=null;
  public $pieza=null;

  public function __construct(){
    $this->session = \Config\Services::session();
    $this->imagenespieza = new ImagenesPiezaModel();
  }


}