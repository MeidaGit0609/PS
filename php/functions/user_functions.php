<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$root .= '/php/db/db.php';
include_once $root;

// Добавляет пользователя
function add_user($name_surname, $email, $phone, $username, $password) {
    global $connection;

    $email = isset($email) ? $email : 'Email не указан';
    $phone = isset($phone) ? $phone : 'Телефон не указан';

    $sql = "INSERT INTO `users` ( `email`, `phone`, `username`, `password`, `name_surname`) VALUES( '$email', '$phone', '$username', '$password', '$name_surname');";

    mysqli_query($connection, $sql);
}

// Выдаёт всех пользователей
function get_users() {
    global $connection;

    $sql = "SELECT * FROM `users`";
    $result = mysqli_query($connection, $sql);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $users;
}

// Ищет пользователя в базе по id
function get_user_id_by_id($id) {
    global $connection;

    $sql = "SELECT * FROM `users` WHERE `id` = '$id'";

    $result = mysqli_query($connection, $sql);

    $user = mysqli_fetch_assoc($result);

    return $user;
}

// Ищет пользователя в базе по username'y
function get_user_id_by_username($username) {
    global $connection;

    $sql = "SELECT `id` FROM `users` WHERE `username` = '$username'";

    $result = mysqli_query($connection, $sql);

    $user_id = mysqli_fetch_assoc($result);

    return $user_id;
}

// Авторизует пользователя
function auth_user($username, $password) {
    global $connection;

    $sql = "SELECT `id` FROM `users` WHERE `username` = '$username' and `password` = '$password'";

    $result = mysqli_query($connection, $sql);

    $user = mysqli_num_rows($result);

    if($user) {
        return mysqli_fetch_assoc($result);
    }
}

// Возвращает юзера которого мы ищем по id
function user_by_id($id) {
    global $connection;

    $sql = "SELECT * FROM `users` WHERE `id` = '$id'";
    $result = mysqli_query($connection, $sql);
    $user = mysqli_fetch_assoc($result);

    return $user;
}


// Добавляет путь к аватару в базу данных
function add_avatar($user_id, $way) {
    global $connection;

    $sql = "UPDATE `users` SET `avatar` = '$way' WHERE `id` = '$user_id';";
    mysqli_query($connection, $sql);
}


// Меняет что-либо
function change($new_info, $who, $user_id) {
    global $connection;

    $sql = "UPDATE `users` SET `$who` = '$new_info' WHERE `id` = '$user_id';";
    mysqli_query($connection, $sql);
}

// Создаёт код для подтверждения пользователя
function generate_code($string) {
    $code = substr(md5($string), 0, 8);

    return $code;
}

?>