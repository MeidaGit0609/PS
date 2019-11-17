<?php
require_once '../../config.php';
require_once '../../functions/user_functions.php';

$header = 'Location: ../../../pages/profile/change_email.php?change=';

if(count($_POST) > 0) {
    $new_email = htmlspecialchars(trim($_POST['new_email']));

    if(!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        $header .= 'email-fail';
    }
    else {
        change($new_email, 'email', $user['id']);
        $header .= 'happy';
    }
}
else {
    $header .= 'input-fail';
}

header($header);