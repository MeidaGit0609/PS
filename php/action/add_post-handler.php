<?php
require_once '../functions/posts_functions.php';
require_once '../config.php';

$prev_page   = $_SERVER['HTTP_REFERER']; // Предыдущая страница
$prev_page   = explode('?', $prev_page);
$prev_page   = $prev_page[0];

$header = "Location: ${prev_page}?upload=";

if(count($_POST) > 0) {
    $description = htmlspecialchars(trim($_POST['description']));
    $img         = $_FILES['post_image'];


    // Проверка файла с картинкой
    $whitelist = ['.png', '.jpg', '.jpeg'];
    if(!preg_match("/.png$/", $img['name']) && !preg_match("/.jpg$/", $img['name']) && !preg_match("/.jpeg$/", $img['name'])) {
        header($header . 'img_false');
        die();
    }
    elseif($img && $img['type'] != 'image/png' && $img['type'] != 'image/jpeg') {
        header($header . 'img_false');
        die();
    }
    // Проверка на размер
    elseif($img['size'] < 1000) {
        header($header . 'img_very-mini');
        die();
    }
    elseif($img['size'] > 1000000) {
        header($header . 'img_very-big');
        die();
    }


//  Заносим пост в базу данных
    $add_post = add_post("/resource/img/post_img/${img['name']}", $description, $user['id']);
    $header .= $add_post;

    if($add_post == 'happy') {
        $way = '../../resource/img/post_img/' . $img['name'];
        move_uploaded_file($img['tmp_name'], $way);
    }

    header($header);
}
else {
    header($header . 'input_false');
}