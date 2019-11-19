<?php
require_once '../functions/subscribe_functions.php';

$prev_page = $_SERVER['HTTP_REFERER'];
$header = "Location: $prev_page";

if(isset($_GET['subscriber_id']) && isset($_GET['subscribe_object'])) {
    if( isset($_GET['unsubscribe']) ) {
        $subscriber_id = htmlspecialchars($_GET['subscriber_id']);
        $subscribe_object = htmlspecialchars($_GET['subscribe_object']);

        un_subscribe($subscriber_id, $subscribe_object);
    }
    else {
        $subscriber_id = htmlspecialchars($_GET['subscriber_id']);
        $subscribe_object = htmlspecialchars($_GET['subscribe_object']);

        subscribe($subscriber_id, $subscribe_object);
    }
}

//print_r($_GET);

header($header);