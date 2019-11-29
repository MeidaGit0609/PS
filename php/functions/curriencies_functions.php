<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$root .= '/php/db/db.php';
require_once $root;

function get_currencies() {
    global $connection;

    $sql        = "SELECT `value`, `pub_date` FROM `currencies`";
    $result     = $connection->query($sql);
    $currencies = $result->fetchAll();

    return $currencies;
}