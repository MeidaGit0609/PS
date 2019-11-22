<?php
require_once '../functions/message_functions.php';

$prev_page = $_SERVER['HTTP_REFERER'];
$header    = 'Location: ' . $prev_page;

if(count($_POST) > 0) {
    $sender_id    = strip_tags($_POST['sender_id']);
    $recipient_id = strip_tags($_POST['recipient_id']);
    $message      = htmlspecialchars(trim($_POST['message']));

    if(strlen($message) < 1) {
        $header .= '?message=characters_fail';
    }
    else {
        add_message($recipient_id, $sender_id, $message);
    }
}

header($header);