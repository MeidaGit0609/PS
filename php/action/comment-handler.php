<?php
require_once '../functions/posts_functions.php';
require_once '../functions/user_functions.php';
require_once '../functions/comment_functions.php';

$prev = $_SERVER['HTTP_REFERER'];
$prev = explode('comment', $prev);
$header = "Location: $prev[0]" . ' &comment=';





if(!isset($_COOKIE['user'])) {
    $header .= 'login_fail';
    header($header);
    die();
}

if(count($_POST) > 0) {
    $text = htmlspecialchars($_POST['text']);
    $user_id = $_COOKIE['user'];

    $user = user_by_id($user_id);
    $username = $user['username'];
    $avatar = $user['avatar'];

    $post_id = $_GET['post_id'];

    if(strlen($text) < 2) {
        $header .= 'text_fail';
    }
    else {
        add_post_comment($post_id, $text, $user_id);
        $header .= 'happy';
    }
}

header($header);