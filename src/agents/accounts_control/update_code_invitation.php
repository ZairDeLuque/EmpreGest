<?php

function update_code($code){
    $cn = mysqli_connect('localhost', 'root', 'root');

    mysqli_set_charset($cn, "UTF-8");

    if (!$cn){
        die("Aurora Studios Services: Could not connect to database. Please try again later.");
    }

    $sql = "UPDATE empregest.activecodes SET used='true' WHERE code='$code'";

    $res = mysqli_query($cn, $sql);

    if(!$res){
        die("Aurora Studios Services: Error to update code invitation to database");
    }

}

?>