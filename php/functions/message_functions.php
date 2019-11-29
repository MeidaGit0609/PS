<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$root .= '/php/db/db.php';
require_once $root;

// Выдаёт сообщения человека человеку
function get_message($recipient_id, $sender_id) {
    global $connection;

    $sql = "SELECT * FROM `messages` WHERE `sender_id` = :sender_id AND `recipient_id` = :recipient_id OR `recipient_id` = :sender_id AND `sender_id` = :recipient_id ORDER BY `id`";

    $result = $connection->prepare($sql);
    $result->execute([
        'sender_id' => $sender_id,
        'recipient_id' => $recipient_id
    ]);
    $messages = $result->fetchAll();

    return $messages;
}


// Добавляет сообщение в базу данных
function add_message($recipient_id, $sender_id, $message) {
    global $connection;

    $time = date('i H d m Y');
    $sql  = "INSERT INTO `messages` (`sender_id`, `recipient_id`, `text`, `time`) VALUES(:sender_id, :recipient_id, :message, :time)";
    $result = $connection->prepare($sql);
    $result->execute([
        'sender_id' => $sender_id,
        'recipient_id' => $recipient_id,
        'message' => $message,
        'time' => $time
    ]);
}

// Выдаёт диалоги пользователя
function get_dialogs($my_id) {
    global $connection;

    $sql = "SELECT * FROM `messages` WHERE `recipient_id` = :my_id OR `sender_id` = :my_id";
    $result = $connection->prepare($sql);
    $result->execute([
        'my_id' => $my_id
    ]);
    $messages = $result->fetchAll();

    for($i = 0;$i < count($messages);$i++) {
        if($messages[$i]['sender_id'] == $my_id) {
            $apponent_id[] = $messages[$i]['recipient_id'];
        }
        else {
            $apponent_id[] = $messages[$i]['sender_id'];
        }
    }

    $apponent_id = array_unique($apponent_id); // Удаляю повторяющиеся id

    // Записываю с нормальными ключами
    foreach($apponent_id as $apponent_id_i) {
        $dialogs[] = $apponent_id_i;
    }
    // Записываю данные пользователей
    for($i = 0;$i < count($dialogs);$i++) {
        $dialogs_users[] = user_by_id($dialogs[$i]);
    }

    return $dialogs_users;
}