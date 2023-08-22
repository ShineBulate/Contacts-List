<?php
namespace App\Controllers\ContactController;
require_once __DIR__ . '../../../../vendor/autoload.php';

use App\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke(){
            $this->getData("SELECT * FROM contact_list  WHERE isActive ='1' ORDER BY id DESC");
    }


}


