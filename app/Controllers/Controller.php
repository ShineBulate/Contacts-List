<?php

namespace App\Controllers;
require_once __DIR__ . '../../../vendor/autoload.php';

use App\Models\Contacts\Contacts;
use App\Validation\Validation;
use DataBase\Connect\DataBaseConnect;
class Controller
{
    use Validation,Contacts,DataBaseConnect;
}
