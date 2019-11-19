<?php
session_start();
require_once '../../config.php';
require_once '../../functions/user_functions.php';

$header = 'Location: ../../../pages/profile/change_email.php?change=';

if(count($_POST) > 0) {
    $new_email = htmlspecialchars(trim($_POST['new_email']));

    if(!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $header .= 'email-fail';
    }
    elseif($user['email'] == $new_email) {
        $header .= 'uncorrect';
    }
    else {
        $code = generate_code($new_email);
        mail($new_email, 'Смена email', "Код подтверждения: $code");

        $_SESSION['code']      = $code;
        $_SESSION['new_email'] = $new_email;
        $header               .= 'give_code';
    }
}
else {
    $header .= 'input-fail';
}

header($header);