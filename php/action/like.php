<?php
require_once '../functions/posts_functions.php';
require_once '../functions/like_functions.php';

if(count($_POST) > 0) {
    $likes   = $_POST['likes'];
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    add_like($post_id, $user_id, $likes); // Добавляю лайк(Проверка на наличие лайка в функции)
}

$prev_page = $_SERVER['HTTP_REFERER']; // Предыдущая страница
header("Location: $prev_page");