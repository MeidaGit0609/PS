<?php
require '../functions/user_functions.php';

$header = 'Location: ../../pages/registration.php?regist=';

if(count($_POST) > 0) {
    $user_name       = htmlspecialchars(trim($_POST['user_name']));
    $name_surname    = htmlspecialchars(trim($_POST['name_and_surname']));
    $email_phone     = htmlspecialchars(trim($_POST['email_or_phone']));
    $password        = htmlspecialchars($_POST['password']);
    $password_repeat = htmlspecialchars($_POST['password-repeat']);
    $password_code   = md5($password);

    if(preg_match("/@/",$email_phone)) {
        $email = $email_phone;
    }
    else {
        $phone = $email_phone;
    }

    $user_id_array = get_user_id_by_username($user_name);
    $user_id = $user_id_array['id'];

    if(str_word_count($name_surname) < 2 ||  strlen($name_surname) < 5) {
        $header .= 'name_surname-fail';
    }
    elseif(isset($phone) && !preg_match("/((8|\+7)-?)?\(?\d{3,5}\)?-?\d{1}-?\d{1}-?\d{1}-?\d{1}-?\d{1}((-?\d{1})?-?\d{1})?/", $email_phone)) {
        $header .= 'phone-fail';
    }
    elseif(isset($email) && !filter_var($email_phone, FILTER_VALIDATE_EMAIL)) {
        $header .= 'email-fail';
    }
    elseif(strlen($user_name) <= 2 || is_numeric($user_name)) {
        $header .= 'username-fail';
    }
    elseif(strlen($password) < 6) {
        $header .= 'password-fail';
    }
    elseif($password_repeat !== $password) {
        $header .= 'password_repeat-fail';
    }
    elseif( $user_id_array && count($user_id_array) > 0) {
        $header .= 'user_repeat';
    }
    else {
        add_user($name_surname, $email, $phone, $user_name, $password_code);

        $header .= 'happy';

        $user_id_array = get_user_id_by_username($user_name);
        $user_id = $user_id_array['id'];

        setcookie('user', $user_id, time() + 7 * 64 * 64 * 24 * 365 * 365, '/');
    }
}
else {
    $header .= 'not';
}

//print_r($user_id_array);

header($header);