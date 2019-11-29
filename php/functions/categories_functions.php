<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$root .= '/php/db/db.php';
include_once $root;

// Выдаёт массив со всеми категориями
function get_categories() {
    global $connection;

    $sql = "SELECT * FROM `categories`";
    $result = $connection->prepare($sql);
    $categories = $result->fetchAll();

    return $categories;
}