<?php
require_once '../../config.php';
require_once '../../functions/user_functions.php';

$header = 'Location: ../../../pages/profile/change_username.php?change=';

if(count($_POST) > 0) {
    $new_username = htmlspecialchars(trim($_POST['new_username']));
    $user_id      = $_GET['user_id'];
    $user_info    = user_by_id($user_id);

    if(strlen($new_username) < 3) {
        $header .= 'fail';
    }
    elseif(strlen($new_username) > 50) {
        $header .= 'very_big';
    }
    else {
        change($new_username, 'username', $user_info['id']);
        $header .= 'happy';
    }
}
else {
    $header .= 'input-fail';
}

//echo strlen($new_username);
header($header);