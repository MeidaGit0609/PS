<?php
require_once 'db_config.php';

//$connection = mysqli_connect(HOST, USER, PASSWORD, DB);
$connection = new PDO("mysql:host=localhost;dbname=instagram", 'root', 'mediagay0609');