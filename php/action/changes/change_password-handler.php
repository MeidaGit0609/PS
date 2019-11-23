<?php
require_once '../../config.php';
require_once '../../functions/user_functions.php';

$prev_page = $_SERVER['HTTP_REFERER'];

if(stristr($prev_page, '&change=') != false) { // Если в url предыдущей страницы есть параметр change, я его уничтожаю
    $prev_page = explode('&change=', $prev_page);
    $prev_page = $prev_page[0];
}

$header    = "Location: $prev_page&change=";

if(count($_POST) > 0) {
    $old_pass        = md5(htmlspecialchars($_POST['old_pass']));
    $new_pass        = md5(htmlspecialchars($_POST['new_pass']));
    $new_pass_repeat = md5(htmlspecialchars($_POST['new_pass-repeat']));
    $user_id         = $_GET['user_id']; // id пользователя пароль которого меняеться
    $user_info       = user_by_id($user_id); // Информация о пользователе пароль которого меняеться

   if($user['is_admin'] == 1 && $user_id != $user['id']) { // Если ты админ и это не твой аккаунт проверки на старый пароль не будет

       if($new_pass != $new_pass_repeat) {
           $header .= 'pass_repeat-fail';
       }
       elseif(strlen($new_pass) > 40) {
           $header .= 'very_big';
       }
       else {
           change($new_pass, 'password', $user_id);
           $header .= 'happy';
       }
    }
   else {
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

}
//echo $header;
//echo '<br>';
//print_r($prev_page);
//echo $prev_page;
header($header);