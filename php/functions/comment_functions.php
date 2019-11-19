<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$root .= '/php/db/db.php';
include_once $root;

//  Создаёт комментарий
function add_post_comment($post_id, $text, $user_id) {
    global $connection;

    $sql = "INSERT INTO `post_comment` (`post_id`, `text`, `user_id`) VALUES('$post_id', '$text', '$user_id')";
    mysqli_query($connection, $sql);
}

// Выводит коментарии под постом
function get_post_comment($post_id) {
    global $connection;

    $sql = "SELECT * FROM `post_comment` WHERE `post_id` = '$post_id' ORDER BY `id` DESC";
    $result = mysqli_query($connection, $sql);

    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $posts;
}

// Считает комментарии
/*
function comment_num($post_id) {
    global $connection;

    $sql = "SELECT `id` FROM `post_comment` WHERE `post_id` = '$post_id'";
    $result = mysqli_query($connection, $sql);
    $comment_num = mysqli_num_rows($result);

    return $comment_num;
}
*/

// Удаляет коммент
function delete_comment($comment_id) {
    global $connection;

    $sql = "DELETE FROM `post_comment` WHERE `id` = '$comment_id'";
    mysqli_query($connection, $sql);
}
