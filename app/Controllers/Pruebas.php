<?php namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json,text/html; charset=utf-8');

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\I18n\Time;

class Pruebas extends BaseController
{
	protected $request;

	public function time()
	{
		// 2020-01-18 21:07:33
		$time = Time::parse('2020-03-18 1:07:33', 'America/Caracas');
		$tiempo = $time->toLocalizedString('d MMMM yyyy, HH:mm'); 
		echo "Time: ".$time;
		echo "<br>";
		echo "Tiempo: ".$tiempo;
		$valoractual = Time::now('America/Caracas', 'es_VE');
		echo "<br>";
		echo $valoractual->toLocalizedString('d MMMM yyyy, HH:mm');

		// $lunch  = Time::createFromTime(11, 30);       // 11:30 am today
		// $dinner = Time::createFromTime(18, 00, 00);  // 6:00 pm today
		// $timenew = $time->setHour(14);
		// echo $lunch."--".$dinner."---".$timenew;
	}

}
