<?php

require_once('config/config.php');

$cn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);

mysqli_set_charset($cn, "UTF-8");

if (!$cn){
    die("Aurora Studios Services: Could not connect to database. Please try again later.");
}

?>