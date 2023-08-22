<?php

namespace App\Controllers\ContactController;
require_once __DIR__ . '../../../../vendor/autoload.php';

use App\Controllers\Controller;
class StoreController extends Controller
{

    private $result;
    private $json;
    private $data;
    public function __invoke(){
        $jsonData = file_get_contents('php://input');
        $this->data = json_decode($jsonData,true);
        $this->result = $this->validate($this->data);
        $this->insertData($this->data);
        header('Content-Type: application/json');
        header('Cache-Control: no-cache');
        $this->getData("SELECT * FROM contact_list WHERE isActive ='1' ORDER BY id DESC");
        $this->json = $this->getResult();
        echo json_encode($this->json);


    }
}
$store = new StoreController('localhost','root','','contacts');
$store();




