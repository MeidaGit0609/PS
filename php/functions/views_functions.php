<?php

// Добавляет просмотр к записи
function add_views($views, $post_id) {
    global $connection;

    $views += 1;

    $sql = "UPDATE `posts` SET `views` = '$views' WHERE `posts`.`id` = '$post_id';";
    mysqli_query($connection, $sql);
}