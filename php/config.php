<?php
include 'functions/user_functions.php';

$user = user_by_id($_COOKIE['user']);

$postsOnePage = 12;