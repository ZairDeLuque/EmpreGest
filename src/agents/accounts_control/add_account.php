<?php

function agreementAccount($username, $a, $b, $c, $d, $e, $f, $g, $id, $code){
    
    $cn = mysqli_connect('localhost', 'root', 'root');

    mysqli_set_charset($cn, "UTF-8");

    if (!$cn){
        die("Aurora Studios Services: Could not connect to database. Please try again later.");
    }

    include('encryptMetadata/encrypt.php');
    include('update_code_invitation.php');

    $sqlCodes = "SELECT * FROM empregest.activecodes WHERE email = '$f'";
    $resC = $cn->query($sqlCodes);

    if ($resC->num_rows > 0) {
        $fila = $resC->fetch_assoc();

        $codeObtain = $fila['code'];

        $creatorCode = $fila['createdBy'];
    }
    else{
        $codeObtain = "nothing";
    }


    if ($code != $codeObtain){
        $sql = "INSERT INTO empregest.usersdata (name, lastname, age, genre, number, email, password, accountdata, ID, Assosied, StatusAccount, ActiveRightNow, username) VALUES ('".encrypt($a)."','".encrypt($b)."','$c','$d','".encrypt($e)."','".encrypt($f)."','".encrypt($g)."','Boss', '$id','none','Active','Yes', '".encrypt($username) ."')";
    }
    else{
        $sql = "INSERT INTO empregest.usersdata (name, lastname, age, genre, number, email, password, accountdata, ID, Assosied, StatusAccount, ActiveRightNow, username) VALUES ('".encrypt($a)."','".encrypt($b)."','$c','$d','".encrypt($e)."','".encrypt($f)."','".encrypt($g)."','Worker', '$id','$creatorCode','Active','Yes', '".encrypt($username) ."')";
        update_code($code);
    }

    $res = mysqli_query($cn, $sql);

    if (!$res){
        die("Aurora Studios Services: Error to agree new account to service." . mysqli_error($cn));
    }
    else{
        require_once('sessionControl/SessionControl.php');

        createSession($a, $e, $username);
    }
}

?>