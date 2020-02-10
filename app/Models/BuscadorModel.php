<?php namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class BuscadorModel extends Model
{

    protected $db;
    protected $DBGroup = 'default';


    public function __construct()
    {
        $this->db = \Config\Database::connect($DBGroup);
    }

    public function __destruct(){
        $this->db->close();
    }

}