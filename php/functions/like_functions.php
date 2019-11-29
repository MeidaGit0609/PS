<?php


//Проверяет наличие лайка
function is_like($post_id, $user_id) {
    global  $connection;

    $sql = "SELECT * FROM `like` WHERE `post_id` = :post_id and `user_id` = :user_id";
    $result = $connection->prepare($sql);
    $result->execute([
        'post_id' => $post_id,
        'user_id' => $user_id
    ]);
    $is_like = $result->rowCount();
    $is_like = $is_like > 0 ? true : false;

    return $is_like;
}

//Добавляет или удаляет лайк
function add_like($post_id, $user_id, $likes) {
    global  $connection;

//    // Проверка наличия лайка
//    $sql = "SELECT * FROM `like` WHERE `post_id` = '$post_id' and `user_id` = '$user_id'";
//    $result = $connection->prepare($sql);
    $is_like = is_like($post_id, $user_id);

    if($is_like == true) {
        // Удаляем лайк
        $result = $connection->prepare("DELETE FROM `like` WHERE `post_id` = :post_id and `user_id` = :user_id");
        $result->execute([
            'post_id' => $post_id,
            'user_id' => $user_id
        ]);
        $likes -= 1;

        $sql = "UPDATE `posts` SET `likes` = :likes WHERE `posts`.`id` = :post_id;";
        $result = $connection->prepare($sql);
        $result->execute([
            'likes' => $likes,
            'post_id' => $post_id
        ]);
    }
    else {
        // Ставим лайк
        $result = $connection->prepare("INSERT INTO `like` (`post_id`, `user_id`) VALUES(:post_id, :user_id)");
        $result->execute([
            'post_id' => $post_id,
            'user_id' => $user_id
        ]);
        $likes += 1;

        $sql = "UPDATE `posts` SET `likes` = :likes WHERE `posts`.`id` = :post_id;";
        $result = $connection->prepare($sql);
        $result->execute([
            'likes' => $likes,
            'post_id' => $post_id
        ]);
    }
}




// Считает количество лайков
function like_num($post_id) {
    global  $connection;

    $sql = "SELECT * FROM `like` WHERE `post_id` = :post_id";
    $result = $connection->prepare($sql);
    $result->execute([
        'post_id' => $post_id
    ]);
    $is_like = $result->rowCount();

    return $is_like;
}

// Выдаёт лайкнувших польщователей
function get_like_users($post_id) {
    global $connection;

    $sql            = "SELECT `user_id` FROM `like` WHERE `post_id` = :post_id LIMIT 5";
    $result         = $connection->prepare($sql);
    $result->execute([
        'post_id' => $post_id
    ]);
    $like_users_id  = $result->fetchAll(); // Массив с айдишниками лакнувших людей

    // Циклом записываю данные пользователей(по их id)
    for($i = 0;$i < count($like_users_id);$i++) {
        $like_users[$i] = user_by_id($like_users_id[$i]['user_id']);
    }

    return $like_users; // Конечный массив с лайкнувшими пользователями
}