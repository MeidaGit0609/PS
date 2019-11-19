<?php

//Добавляет или удаляет лайк
function add_like($post_id, $user_id, $likes) {
    global  $connection;

    // Проверка наличия лайка
    $sql = "SELECT * FROM `like` WHERE `post_id` = '$post_id' and `user_id` = '$user_id'";
    $result = mysqli_query($connection, $sql);
    $is_like = mysqli_num_rows($result) > 0 ? true : false;

    if($is_like == true) {
        // Удаляем лайк
        mysqli_query($connection, "DELETE FROM `like` WHERE `post_id` = '$post_id' and `user_id` = '$user_id'");

        $likes -= 1;

        $sql = "UPDATE `posts` SET `likes` = '$likes' WHERE `posts`.`id` = '$post_id';";
        mysqli_query($connection, $sql);
    }
    else {
        // Ставим лайк
        mysqli_query($connection, "INSERT INTO `like` (`post_id`, `user_id`) VALUES('$post_id', '$user_id')");

        $likes += 1;

        $sql = "UPDATE `posts` SET `likes` = '$likes' WHERE `posts`.`id` = '$post_id';";
        mysqli_query($connection, $sql);
    }
}


//Проверяет наличие лайка
function is_like($post_id, $user_id) {
    global  $connection;

    $sql = "SELECT * FROM `like` WHERE `post_id` = '$post_id' and `user_id` = '$user_id'";
    $result = mysqli_query($connection, $sql);
    $is_like = mysqli_num_rows($result);
    $is_like = $is_like > 0 ? true : false;

    return $is_like;
}

// Считает количество лайков
function like_num($post_id) {
    global  $connection;

    $sql = "SELECT * FROM `like` WHERE `post_id` = '$post_id'";
    $result = mysqli_query($connection, $sql);
    $is_like = mysqli_num_rows($result);

    return $is_like;
}

// Выдаёт лайкнувших польщователей
function get_like_users($post_id) {
    global $connection;

    $sql           = "SELECT `user_id` FROM `like` WHERE `post_id` = '$post_id' LIMIT 5";
    $query         = mysqli_query($connection, $sql);
    $like_users_id = mysqli_fetch_all($query, MYSQLI_ASSOC); // Массив с айдишниками лакнувших людей

    // Циклом записываю данные пользователей(по их id)
    for($i = 0;$i < count($like_users_id);$i++) {
        $like_users[$i] = user_by_id($like_users_id[$i]['user_id']);
    }

    return $like_users; // Конечный массив с лайкнувшими пользователями
}