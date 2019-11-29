<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$root .= '/php/db/db.php';
include_once $root;

// Добавляет пользователя
function add_user($name_surname, $email, $phone, $username, $password) {
    global $connection;

    $email = isset($email) ? $email : 'Email не указан';
    $phone = isset($phone) ? $phone : 'Телефон не указан';

    $sql = "INSERT INTO `users` ( `email`, `phone`, `username`, `password`, `name_surname`) VALUES( :email, :phone, :username, :password, :name_surname);";

    $result = $connection->prepare($sql);
    $result->execute([
        'email' => $email,
        'phone' => $phone,
        'username' => $username,
        'password' => $password,
        'name_surname' => $name_surname,
    ]);
}

// Выдаёт всех пользователей
function get_users() {
    global $connection;

    $sql = "SELECT * FROM `users`";
    $result = $connection->query($sql);
    $users = $result->fetch($result);

    return $users;
}

// Выдаёт пользователей по поиску
function get_users_by_search($query, $page) {
    global $connection, $postsOnePage;

    $query = htmlspecialchars($query, ENT_QUOTES);

    $offset = ($page - 1) * $postsOnePage;

    if($offset == 0) {
        $sql    = "SELECT `username`, `id`, `avatar` FROM `users` WHERE `username` LIKE '%$query%' OR `name_surname` LIKE '%$query%' LIMIT 12";
    }
    else {
        $sql    = "SELECT `username`, `id`, `avatar` FROM `users` WHERE `username` LIKE  '%$query%' OR `name_surname` LIKE  '%$query%' LIMIT $postsOnePage OFFSET  $offset";
    }

    $result = $connection->query($sql);

    $users = $result->fetchAll();

    return $users;
}


// Ищет пользователя в базе по username'y
function get_user_id_by_username($username) {
    global $connection;

    $sql = "SELECT `id` FROM `users` WHERE `username` = :username";

    $result = $connection->prepare($sql);
    $result->execute([
        'username' => $username
    ]);

    $user_id = $result->fetch();

    return $user_id;
}

// Авторизует пользователя
function auth_user($username, $password) {
    global $connection;

    $sql = "SELECT `id` FROM `users` WHERE `username` = :username and `password` = :password";

    $result = $connection->prepare($sql);
    $result->execute([
        'username' => $username,
        'password' => $password,
    ]);

    $user = $result->rowCount();

    if($user) {
        return $result->fetch();
    }
}

// Возвращает юзера которого мы ищем по id
function user_by_id($id) {
    global $connection;

    $sql = "SELECT * FROM `users` WHERE `id` = :id";
    $result = $connection->prepare($sql);
    $result->execute([
        'id' => $id
    ]);
    $user = $result->fetch();

    return $user;
}


// Добавляет путь к аватару в базу данных
function add_avatar($user_id, $way) {
    global $connection;

    $sql = "UPDATE `users` SET `avatar` = :way WHERE `id` = :user_id;";
    $result = $connection->prepare($sql);
    $result->execute([
        'way'     => $way,
        'user_id' => $user_id,
    ]);
}


// Меняет что-либо
function change($new_info, $who, $user_id) {
    global $connection;

    $sql = "UPDATE `users` SET `$who` = :new_info WHERE `id` = :user_id;";
    $result = $connection->prepare($sql);
    $result->execute([
        'new_info' => $new_info,
        'user_id'  => $user_id,
    ]);
}

// Создаёт код для подтверждения пользователя
function generate_code($string) {
    $code = substr(md5($string), 0, 8);

    return $code;
}

?>