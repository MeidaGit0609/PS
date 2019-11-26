<?php
require_once '../functions/user_functions.php';

$prev_page = $_SERVER['HTTP_REFERER'];
$prev_page = explode('?', $prev_page);
$prev_page = $prev_page[0];

$header = "Location: ${prev_page}?upload=";

$root = $_SERVER['DOCUMENT_ROOT'];

$user_id = $_GET['user_id'];

if(isset($_POST['enter'])) {
    $file = $_FILES['avatar'];

// Проверка файла аватарки
    $whitelist = ['.png', '.jpg', '.jpeg'];
    if(!preg_match("/.png$/", $file['name']) && !preg_match("/.jpg$/", $file['name']) && !preg_match("/.jpeg$/", $file['name'])) {
        header($header . 'expansion_false');
        die();
    }
    elseif($file && $file['type'] != 'image/png' && $file['type'] != 'image/jpeg') {
        header($header . 'mime_false');
        die();
    }
    elseif($file['size'] > 100000) {
        header($header . 'big');
        die();
    }
    else {
        $upload = "../../resource/img/avatars/" . $file['name'];
        move_uploaded_file($file['tmp_name'], $upload);

        $avatar_way = '/resource/img/avatars/' . $file['name'];
        add_avatar($user_id, $avatar_way);
        header($header . 'happy');
    }
}




?>



