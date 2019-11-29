<?php
require_once 'db_config.php';

//$connection = mysqli_connect(HOST, USER, PASSWORD, DB);
$connection = new PDO("mysql:host=".HOST.";dbname=".DB, USER, PASSWORD);