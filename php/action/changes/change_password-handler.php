<?php
require_once '../../config.php';
require_once '../../functions/user_functions.php';

$prev_page = $_SERVER['HTTP_REFERER'];
$header    = "Location: $prev_page&change=";

if(count($_POST) > 0) {
    $old_pass        = md5(htmlspecialchars($_POST['old_pass']));
    $new_pass        = md5(htmlspecialchars($_POST['new_pass']));
    $new_pass_repeat = md5(htmlspecialchars($_POST['new_pass-repeat']));
    $user_id         = $_GET['user_id']; // id пользователя пароль которого меняеться
    $user_info       = user_by_id($user_id); // Информация о пользователе пароль которого меняеться

    if($old_pass != $user_info['password']) {
        $header .= 'old_pass-fail';
    }
    elseif($new_pass != $new_pass_repeat) {
        $header .= 'pass_repeat-fail';
    }
    elseif($old_pass == $new_pass) {
        $header .= 'pass_repeating';
    }
    else {
        change($new_pass, 'password', $user_id);
        $header .= 'happy';
    }
}
//echo $old_pass;
//echo $new_pass;
header($header);