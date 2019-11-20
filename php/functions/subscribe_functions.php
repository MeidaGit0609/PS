<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$root .= '/php/db/db.php';
include_once $root;

require_once 'user_functions.php';

// Подписывает пользователя
function subscribe($subscriber_id, $subscribe_object) {
    global $connection;

    $sql = "INSERT INTO `subscribes` (`subscriber_id`, `subscribe_object`) VALUES('$subscriber_id', '$subscribe_object')";
    mysqli_query($connection, $sql);
}

// Проверяет подписан ли один на другого
function is_subscribe($subscriber_id, $subscribe_object) {
    global $connection;

    $sql = "SELECT * FROM `subscribes` WHERE `subscriber_id` = '$subscriber_id' AND `subscribe_object` = '$subscribe_object';";
    $result = mysqli_query($connection, $sql);
    $is_subscribe = mysqli_num_rows($result) > 0 ? true : false;

    return $is_subscribe;
}

// Отписывает пользователя
function un_subscribe($subscriber_id, $subscribe_object) {
    global $connection;

    $sql = "DELETE FROM `subscribes` WHERE `subscriber_id` = '$subscriber_id' AND `subscribe_object` = '$subscribe_object'";
    mysqli_query($connection, $sql);
}

// Выдаёт массив с подписчиками человека
function get_subscribers($subscribe_object) {
    global $connection;

    $sql = "SELECT `subscriber_id` FROM `subscribes` WHERE `subscribe_object` = '$subscribe_object'";
    $result = mysqli_query($connection, $sql);
    $subscribers_id = mysqli_fetch_all($result, MYSQLI_ASSOC);

    for($i = 0;$i < count($subscribers_id);$i++) {
        $subscribers[$i] = user_by_id($subscribers_id[$i]['subscriber_id']);
    }

    return $subscribers;
}

// Выдаёт массив с подписками человека
function get_subscribes($subscriber_id) {
    global $connection;

    $sql = "SELECT `subscribe_object` FROM `subscribes` WHERE `subscriber_id` = '$subscriber_id'";
    $result = mysqli_query($connection, $sql);
    $subscribes_id = mysqli_fetch_all($result, MYSQLI_ASSOC);

    for($i = 0;$i < count($subscribes_id);$i++) {
        $subscribes[$i] = user_by_id($subscribes_id[$i]['subscribe_object']);
    }

    return $subscribes;
}

// Считает подписки или подписчиков, что захочешь
function count_subscribe($user_id, $who) {
    global $connection;

    $sql               = "SELECT `id` FROM `subscribes` WHERE `$who` = '$user_id'";
    $result            = mysqli_query($connection, $sql);
    $subscribers_count = mysqli_num_rows($result);

    return $subscribers_count;
}