<?php
session_start();
require_once '../functions/user_functions.php';

$header = 'Location: ../../pages/registration.php?regist=';

if(count($_POST) > 0) {
    $user_name       = htmlspecialchars(trim($_POST['user_name']));
    $name_surname    = htmlspecialchars(trim($_POST['name_and_surname']));
    $email           = htmlspecialchars(trim($_POST['email']));
    $password        = htmlspecialchars($_POST['password']);
    $password_repeat = htmlspecialchars($_POST['password-repeat']);
    $password_code   = md5($password);



//    if(preg_match("/@/",$email_phone)) {
//        $email = $email_phone;
//    }
//    else {
//        $phone = $email_phone;
//    }


    $_SESSION['code'] = generate_code($user_name);

    $user_id_array = get_user_id_by_username($user_name);
    $user_id = $user_id_array['id'];

    if(str_word_count($name_surname) < 2 ||  strlen($name_surname) < 5 || strlen($name_surname) > 40) {
        $header .= 'name_surname-fail';
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $header .= 'email-fail';
    }
    elseif(strlen($user_name) <= 2 || is_numeric($user_name) || strlen($user_name) > 50) {
        $header .= 'username-fail';
    }
    elseif(strlen($password) < 6 || strlen($password) > 40) {
        $header .= 'password-fail';
    }
    elseif($password_repeat !== $password) {
        $header .= 'password_repeat-fail';
    }
    elseif( $user_id_array && count($user_id_array) > 0) {
        $header .= 'user_repeat';
    }
    else {
        $subject = 'Подтвердите код регистрации';
        $message = "Добро пожаловать  в PS!! \n От пользования великолепным сервисом вас отгораждает только этот код: ${_SESSION['code']}";
        mail($email, $subject, $message);

        $_SESSION['username']     = $user_name;
        $_SESSION['name_surname'] = $name_surname;
        $_SESSION['password']     = $password_code;
        $_SESSION['email']        = $email;

        $header .= 'code';
    }

}
else {
    $header .= 'not';
}


header($header);