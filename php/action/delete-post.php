<?php
require_once '../functions/posts_functions.php';

if(count($_POST) > 0) {
    $post_id = $_POST['post_id'];
    delete_post($post_id);
}
header("Location: ${_SERVER['HTTP_REFERER']}");