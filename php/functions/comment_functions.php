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

// Считает лайки коммента
function comments_like_num($comment_id, $user_id) {
    global $connection;

    $sql        = "SELECT `id` FROM `comment_likes` WHERE `comment_id` = '$comment_id'";
    $result     = mysqli_query($connection, $sql);
    $likes_num  = mysqli_num_rows($result);

    return $likes_num;
}

// Добавляет лайк комменту
function add_comment_like($user_id, $comment_id) {
    global $connection;

    $sql = "INSERT INTO `comment_likes` (`user_id`, `comment_id`) VALUES('$user_id', '$comment_id')";
    mysqli_query($connection, $sql);
}

// Удаляет лайк комментария
function delete_comment_like($user_id, $comment_id) {
    global $connection;

    $sql = "DELETE FROM `comment_likes` WHERE `user_id` = '$user_id' AND `comment_id` = '$comment_id'";
    mysqli_query($connection, $sql);
}

// Проверяет лайкнул ли пользователь пост
function he_like_comment($user_id, $comment_id) {
    global $connection;

    $sql     = "SELECT `id` FROM `comment_likes` WHERE `user_id` = '$user_id' AND `comment_id` = '$comment_id'";
    $result  = mysqli_query($connection, $sql);
    $he_like = mysqli_num_rows($result);

    if($he_like > 0) {
        $total = true;
    }
    else {
        $total = false;
    }

    return $total;
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

    $sql = "DELETE FROM `post_comment` WHERE `post_comment`.`id` = '$comment_id'";
    mysqli_query($connection, $sql);
}
