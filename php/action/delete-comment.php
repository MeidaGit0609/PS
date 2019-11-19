<?php
require_once '../functions/comment_functions.php';

$comment_id = htmlspecialchars($_GET['comment_id']);

delete_comment($comment_id);

$prev_page = $_SERVER['HTTP_REFERER'];
header("Location: $prev_page");