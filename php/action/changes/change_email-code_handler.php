<?php
session_start();
require_once '../../config.php';
require_once '../../functions/user_functions.php';

$header = 'Location: ../../../pages/profile/change_email.php?change=';

if(isset($_POST['code'])) {
    $user_code = htmlspecialchars($_POST['code']);
    $new_email = $_SESSION['new_email'];
    $real_code = $_SESSION['code'];

    if(isset($real_code) && $user_code == $real_code) {

        change($new_email, 'email', $user['id']);

        $header .= 'happy';
    }
    else {
        $header .= 'code_false';
    }
}

header($header);
session_destroy();