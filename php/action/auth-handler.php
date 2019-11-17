<?php
require '../functions/user_functions.php';

$header = 'Location: ../../pages/authoriz.php?auth_total=';

if(count($_POST) > 0) {
    $username = htmlspecialchars(trim($_POST['user_name']));
    $password = md5(htmlspecialchars($_POST['password']));

    $user = auth_user($username, $password);

    if(!empty($user)) {
        setcookie('user', $user['id'], time() + 7 * 64 * 64 * 24 * 365 * 365, '/');
        $header .= 'happy';
    }
    else {
        $header .= 'error';
    }
}

header($header);