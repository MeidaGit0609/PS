<?php
$prev_page = $_SERVER['HTTP_REFERER'];
setcookie('user', '', time() - 7 * 64 * 64 * 24 * 365 * 365, '/');
header("Location: $prev_page");