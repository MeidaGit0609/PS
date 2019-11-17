<?php
require_once '../../config.php';
require_once '../../functions/user_functions.php';

$header = 'Location: ../../../pages/profile/change_username.php?change=';

if(count($_POST) > 0) {
    $new_username = htmlspecialchars(trim($_POST['new_username']));

    if(strlen($new_username) < 3) {
        $header .= 'fail';
    }
    else {
        change($new_username, 'username', $user['id']);
        $header .= 'happy';
    }
}
else {
    $header .= 'input-fail';
}

header($header);