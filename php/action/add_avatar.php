<?php
require_once '../functions/user_functions.php';

$prev_page = $_SERVER['HTTP_REFERER'];
if(stristr($prev_page, 'upload=') !== false) {
    $prev_page = explode('upload=', $prev_page);
    $prev_page = $prev_page[0];
}

// Для красивого url
if(substr($prev_page, (strlen($prev_page) - 1), 1) == '&') { // Не заканчиваеться ли url на &
    $header = "Location: ${prev_page}upload=";
}
elseif(stristr($prev_page, '?') !== false) { // В url есть get запросы
    $header = "Location: ${prev_page}&upload=";
}
else {
    $header = "Location: ${prev_page}?upload=";
}


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
        $code = substr(rand(12345678, 657653841123), 2, 50);
        $upload = "../../resource/img/avatars/" . $file['name'].$code;
        move_uploaded_file($file['tmp_name'], $upload);

        $avatar_way = '/resource/img/avatars/' . $file['name'].$code;
        add_avatar($user_id, $avatar_way);
        header($header . 'happy');
    }
}




?>



