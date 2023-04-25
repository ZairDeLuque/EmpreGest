<?php

function workers($user){
    $cn = mysqli_connect('localhost', 'root', 'root');

    mysqli_set_charset($cn, "UTF-8");

    if (!$cn){
        die("Aurora Studios Services: Could not connect to database. Please try again later.");
    }

    $persSQL = "SELECT * FROM empregest.usersdata WHERE Assosied='" . $user . "'";

    $arrayC = array();

    $result = mysqli_query($cn, $persSQL);

    while ($row = mysqli_fetch_assoc($result)){
        array_push($arrayC, $row["ID"]);
    };

    $c = count($arrayC);

    return $c;
}
?>