<?php
session_start();
require_once '../functions/user_functions.php';

$header = 'Location: ../../pages/registration.php?regist=';

if(isset($_POST['code'])) {
    $user_code = $_POST['code'];

    if(isset($_SESSION['code']) && $user_code == $_SESSION['code']) {

        add_user($_SESSION['name_surname'], $_SESSION['email'], null, $_SESSION['username'], $_SESSION['password']);

        $header .= 'happy';

        $user_id_array = get_user_id_by_username($_SESSION['username']);
        $user_id = $user_id_array['id'];

        setcookie('user', $user_id, time() + 7 * 64 * 64 * 24 * 365 * 365, '/');
    }
    else {
        $header .= 'code_false';
    }
}

header($header);
session_destroy();