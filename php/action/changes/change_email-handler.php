<?php
session_start();
require_once '../../config.php';
require_once '../../functions/user_functions.php';

$prev_page = $_SERVER['HTTP_REFERER'];
$header    = "Location: $prev_page&change=";

if(count($_POST) > 0) {
    $new_email = htmlspecialchars(trim($_POST['new_email']));
    $user_id   = $_GET['user_id'];
    $user_info = user_by_id($user_id);

    if(!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $header .= 'email-fail';
    }
    elseif($user_info['email'] == $new_email) {
        $header .= 'uncorrect';
    }
    else {
        if($user['is_admin'] == 1 && $user_info['id'] != $user['id']) { // Если ты админ и это не твой аккаунт
            change($new_email, 'email', $user_id);
            $header .= 'happy';
        }
        else {
            $code = generate_code($new_email);
            mail($new_email, 'Смена email', "Код подтверждения: $code");

            $_SESSION['code']      = $code;
            $_SESSION['new_email'] = $new_email;
            $header                .= 'give_code';
        }

    }
}
else {
    $header .= 'input-fail';
}

header($header);