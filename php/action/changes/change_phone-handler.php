<?php
require_once '../../config.php';
require_once '../../functions/user_functions.php';

// Функция для проверки номера телефона
function checkPhoneNumber($phoneNumber)
{

    $phoneNumber = preg_replace('/\s|\+|-|\(|\)/','', $phoneNumber); // удалим пробелы, и прочие не нужные знаки

    if(is_numeric($phoneNumber))
    {
        if(strlen($phoneNumber) < 5) // если длина номера слишком короткая, вернем false
        {
            return FALSE;
        }
        elseif(strlen($phoneNumber) > 17) {
            return false;
        }
        else
        {
            return $phoneNumber;
        }
    }
    else
    {
        return FALSE;
    }
}

$header = 'Location: ../../../pages/profile/change_phone.php?change=';

if(count($_POST) > 0) {
    $new_phone = trim($_POST['new_phone']);
    $new_phone = checkPhoneNumber($new_phone);
    $user_id   = $_GET['user_id'];
    $user_info = user_by_id($user_id);


    if($new_phone == false) {
        $header .= 'fail';
    }
    else {
        change($new_phone, 'phone', $user['id']);
        $header .= 'happy';
    }
}
//echo $old_pass;
//echo $new_pass;
header($header);