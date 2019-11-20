<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$root .= '/php/db/db.php';
require_once $root;

// Выдаёт сообщения человека человеку
function get_message($recipient_id, $sender_id) {
    global $connection;

    $sql = "SELECT * FROM `messages` WHERE `sender_id` = '$sender_id' AND `recipient_id` = '$recipient_id' OR `recipient_id` = '$sender_id' AND `sender_id` = '$recipient_id' ORDER BY `id`";
    $result = mysqli_query($connection, $sql);
    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $messages;
}


// Добавляет сообщение в базу данных
function add_message($recipient_id, $sender_id, $message) {
    global $connection;

    $time = date('i H d m Y');
    $sql  = "INSERT INTO `messages` (`sender_id`, `recipient_id`, `text`, `time`) VALUES('$sender_id', '$recipient_id', '$message', '$time')";
    mysqli_query($connection, $sql);
}

// Выдаёт диалоги пользователя
function get_dialogs($me) {
    global $connection;

    $sql = "SELECT * FROM `messages` WHERE `recipient_id` = '$me' OR `sender_id` = '$me'";
    $result = mysqli_query($connection, $sql);
    $messages = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $messages;
}