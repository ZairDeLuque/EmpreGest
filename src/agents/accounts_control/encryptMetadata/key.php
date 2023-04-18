<?php

$IV2 = "";

function gettingKey(){

    global $IV2;

    $cn = mysqli_connect('localhost', 'root', 'root');

    mysqli_set_charset($cn, "UTF-8");

    if (!$cn){
        die("Aurora Studios Services: Could not connect to database. Please try again later.");
    }

    //Obtain data from server to validate encryption algorithm
    $sql = "SELECT * FROM empregest.admins_information";

    //Query
    $res = $cn->query($sql);

    //Validate data
    if ($res->num_rows > 0) {
        $fila = $res->fetch_assoc();
        $information = array(
            'Method' => $fila['Method'],
            'key' => $fila['LastKey'],
            'AKey' => $fila['BeforeKey'],
            'IV' => $fila['IV']
        );
    }
    else{
        $information = array(
            'Method' => null,
            'key' => null,
            'AKey' => null,
            'IV' => null
        );
    }

    if ($information['key'] == null && $information['AKey'] == null){
        //Create new security key
        $key = openssl_random_pseudo_bytes(32);
        //Create new security IV
        $IV = openssl_random_pseudo_bytes(16);

        //New query to server
        $sql2 = "INSERT INTO empregest.admins_information (Method, LastKey, BeforeKey, IV) VALUES ('aes-256-cbc','$key', '$key', '$IV')";

        //Result
        $res = mysqli_query($cn, $sql2);
        $IV2 = $IV;

        //Check result
        if (!$res){
            die("Aurora Studios Services: Could not encrypt data from client. Please try again later.");
        }
    }
    else if ($information['key'] == null && $information['AKey'] != null){
        $key = $information['AKey'];
        $IV2 = $information['IV'];

    }
    else if ($information['key'] != null && $information['AKey'] != null){
        $key = $information['key'];
        $IV2 = $information['IV'];
    }
    else{
        die("Aurora Studios Services: Could not recive data from server. Please try again later.");
    }

    return $key;
}

function getIV(){
    global $IV2;

    if ($IV2 != null){
        return $IV2;
    }
    else{
        die("Aurora Studios Services: IV key is null.");
    }
}
?>