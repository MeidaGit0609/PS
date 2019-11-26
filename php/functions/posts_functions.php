<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$root .= '/php/db/db.php';
include_once $root;


// Выдаёт все посты из базы данных
function add_post($img, $description, $user_id) {
    global $connection;


    $sql = "INSERT INTO `posts` (`image`, `description`, `user_id`) VALUES('$img', ' $description', '$user_id')";
    $result = mysqli_query($connection, $sql);

    if($result) {
        return 'happy';
    }
    else {
        return 'false';
    }
}

// Удаляет пост
function delete_post($post_id) {
    global $connection;

    $delete_likes_sql = "DELETE FROM `like` WHERE `post_id` = '$post_id'";
    mysqli_query($connection, $delete_likes_sql);

    $delete_post_sql = "DELETE FROM `posts` WHERE `id` = '$post_id'";
    mysqli_query($connection, $delete_post_sql);
}


// Выдаёт все посты из базы данных
function get_posts($page) {
    global $connection, $postsOnePage;

    $offset = ($page - 1) * $postsOnePage;

    $sql = "SELECT * FROM `posts` ORDER BY `views` DESC LIMIT $postsOnePage OFFSET $offset ;";
    $result = mysqli_query($connection, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $posts;
}

//Выдаёт нужное количество постов
function get_top_posts($num) {
    global $connection;

    $sql = "SELECT * FROM `posts` ORDER BY `likes` DESC LIMIT $num ";
    $result = mysqli_query($connection, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $posts;
}

function get_user_posts($page, $user_id) {
    global $connection, $postsOnePage;

    $offset = ($page - 1) * $postsOnePage;

    $sql = "SELECT * FROM `posts` WHERE `user_id` = '$user_id' LIMIT $postsOnePage OFFSET $offset ;";
    $result = mysqli_query($connection, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    return $posts;
}



// Выводит пост с указаным id
function get_post_by_id($post_id) {
    global $connection;

    $sql = "SELECT * FROM `posts` WHERE `id` = '$post_id'";
    $result = mysqli_query($connection, $sql);
    $post = mysqli_fetch_assoc($result);

    return $post;
}

// Считает количество статей
function posts_num() {
    global $connection;

    $sql = "SELECT * FROM `posts`";
    $result = mysqli_query($connection, $sql);
    $num_posts = mysqli_num_rows($result);

    return $num_posts;
}

// Считает количество постов одного человека
function user_posts_counter($user_id) {
    global $connection;

    $sql = "SELECT * FROM `posts` WHERE `user_id` = '$user_id'";
    $result = mysqli_query($connection, $sql);
    $count = mysqli_num_rows($result);

    return $count;
}
?>