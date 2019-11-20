<?php
require_once '../functions/comment_functions.php';

if(count($_POST) > 0) {
    $user_id    = $_POST['user_id'];
    $comment_id = $_POST['comment_id'];

    if(he_like_comment($user_id, $comment_id)) {
        delete_comment_like($user_id, $comment_id);
    }
    else {
        add_comment_like($user_id, $comment_id);
    }

}

$prev_page = $_SERVER['HTTP_REFERER'];
$header = "Location: $prev_page";
header($header);