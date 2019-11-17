<?php
require_once '../../config.php';
require_once '../../functions/user_functions.php';

$header = 'Location: ../../../pages/profile/change-info/change_password.php?change=';

if(count($_POST) > 0) {
    $old_pass = md5(htmlspecialchars($_POST['old_pass']));
    $new_pass = md5(htmlspecialchars($_POST['new_pass']));
    $new_pass_repeat = md5(htmlspecialchars($_POST['new_pass-repeat']));

    if($old_pass != $user['password']) {
        $header .= 'old_pass-fail';
    }
    elseif($new_pass != $new_pass_repeat) {
        $header .= 'pass_repeat-fail';
    }
    elseif($old_pass == $new_pass) {
        $header .= 'pass_repeating';
    }
    else {
        change($new_pass, 'password', $user['id']);
        $header .= 'happy';
    }
}
//echo $old_pass;
//echo $new_pass;
header($header);