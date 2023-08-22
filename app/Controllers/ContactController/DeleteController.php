<?php
namespace App\Controllers\ContactController;
require_once __DIR__ . '../../../../vendor/autoload.php';


use App\Controllers\Controller;;

class DeleteController extends Controller {
    private $data;
    private $json;
     public function __invoke(){
         $jsonData = file_get_contents('php://input');
         $this->data = json_decode($jsonData,true);
         $this->deleteData($this->data['contact_id']);
         header('Content-Type: application/json');
         header('Cache-Control: no-cache');
        $this->getData("SELECT * FROM contact_list WHERE isActive ='1' ORDER BY id DESC");

         $this->json = $this->getResult();
         echo json_encode($this->json);

}

}
$delete = new DeleteController('localhost','root','','contacts');
$delete();

?>