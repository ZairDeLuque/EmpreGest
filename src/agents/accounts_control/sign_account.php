<?php

$email = $_POST['email'];
$password = $_POST['pass'];

require_once('encryptMetadata/decrypt_information.php');
require_once('encryptMetadata/key.php');
require_once('sessionControl/SessionControl.php');

$mailDecrypt = decryptToSql("email", base64_encode(openssl_encrypt($email, 'aes-256-cbc', gettingKey(), OPENSSL_RAW_DATA, getIV())),"email");
$passDecrypt = decryptToSql("password", base64_encode(openssl_encrypt($password, 'aes-256-cbc', gettingKey(), OPENSSL_RAW_DATA, getIV())),"password");

function getDataServer_session(){
    require_once('../connection.php');

    global $email;

    $ecrypt = base64_encode(openssl_encrypt($email, 'aes-256-cbc', gettingKey(), OPENSSL_RAW_DATA, getIV()));

    $sql = "SELECT * FROM empregest.usersdata WHERE email='$ecrypt'";

    $res = $cn->query($sql);

    if ($res->num_rows > 0) {
        $fila = $res->fetch_assoc();
        $information = array(
            'username' => $fila['username'],
            'nameA' => $fila['name'],
            'nameB' => $fila['lastname']
        );

        return $information;
    }
}


if(!$mailDecrypt && !$passDecrypt){
    die("Aurora Studios Services: Unable server.");
}
else{
    if($email == $mailDecrypt["email"]){
        if ($password == $passDecrypt["password"]){
            
            $a = getDataServer_session();

            $reconvertedArray = array(
                'username' => base64_decode($a["username"]),
                'nameA' => base64_decode($a["nameA"]),
                'nameB' => base64_decode($a["nameB"])
            );

            createSession(openssl_decrypt($reconvertedArray["nameA"], 'aes-256-cbc', gettingKey(), OPENSSL_RAW_DATA, getIV())." ".openssl_decrypt($reconvertedArray['nameB'], 'aes-256-cbc', gettingKey(), OPENSSL_RAW_DATA, getIV()), $mailDecrypt["email"], openssl_decrypt($reconvertedArray["username"], 'aes-256-cbc', gettingKey(), OPENSSL_RAW_DATA, getIV()));
        }
        else{
            die("Aurora Studios Services: Contraseña incorrecta.");
        }
    }
    else{
        die("Aurora Studios Services: Correo incorrecto.");
    }
}

?>