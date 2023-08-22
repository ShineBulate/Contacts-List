<?php


require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\ContactController\IndexController;
$contacts = new IndexController('localhost','root','','contacts');
$contacts();
$contactsData = $contacts->getResult();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="resources/css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,400;0,500;1,100&display=swap" rel="stylesheet">
    <title>Добавить контакт</title>
</head>
<body>
    <div class="wrapper">
        <div id="modal-success" class="modal-success">
            <div class="modal-content">
                <div id="result" ></div>
            </div>
        </div>
        <div class="delete-modal" id="delete-modal-block">
            <div class="modal-box">
                <form  method="POST" id="delete-form">
            <h1>
                Вы действительно хотите удалить контакт?
            </h1>
                    <button class="delete-btn" id="delete-modal-yes">Да</button>
                    <button class="delete-btn" id="delete-modal-no"  onclick="return false Delete( . $value['id'] .)">Нет</button>
                </form>
            </div>
        </div>
        <div class="container">
        <div class="create-contact">
            <div class="description">
                <p class="small-text">Добавить контакт</p><br><hr />
            </div>
            <form id="addContactForm" method="POST"  class="form-class" onsubmit="return validateForm()">
                <input type="text" name="user_name" id="user-name" placeholder="Имя" maxlength="30" required /><br />
                <div class="container-input">

                <div class="phone-code">
                    <span>+7</span>
                <input type="text" name="user_phone" id="user-phone" placeholder="Телефон" maxlength="10"  required /><br />
                </div>
                </div>
                <p class="error-value" id="error-name">Только русские буквы в имени!</p>
                <p class="error-value" id="error-phone">Проверьте ввод телефона только цифры!</p>
                <p class="error-value" id="error-length">Имя не может быть меньше 3 символов, а номер телефона не меньше 10!</p>
                <button type="submit" class="send-btn" id="send-btn" onclick="validateForm()" name="send_form">Добавить</button>
            </form>
        </div>
        <div class="contact-list">
            <div class="contact-description">
                <p class="small-text">Список контактов </p><br><hr/>
                </div>
            <div  id="contact-data" class="contact-data">
                    <?
                    if($contactsData){
                        foreach ($contactsData as $value){
                            echo '<div id="contact-name" class="contact-id">'.$value['user_name'].'<button class="cross" onclick="delete_modal('.$value['id'].')"></button></div>';
                            echo '<p id="contact-phone" class="phone">'.$value['user_phone'].'</p></br>';

                        }
                    }
                    else{
                        echo("<span class='empty'>Пусто контактов нет!</span>");

                    }

                    ?>
        </div>
        </div>
        </div>
    </div>
        <script src="resources/js/main.js"></script>
</body>
</html>