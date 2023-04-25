<?php

function getDataServer(){
    $cn = mysqli_connect('localhost', 'root', 'root');

    mysqli_set_charset($cn, "UTF-8");

    if (!$cn){
        die("Aurora Studios Services: Could not connect to database. Please try again later.");
    }

    $sql = "SELECT * FROM empregest.information_app";

    $res = mysqli_query($cn, $sql);

    if ($res->num_rows > 0) {
        $fila = $res->fetch_assoc();
        $information = array(
            'Ver' => $fila['version'],
            'Update' => $fila['updateNew']
        );

        return $information;
    }
}

?>