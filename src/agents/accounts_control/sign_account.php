<?php

$email = $_POST['email'];
$password = $_POST['pass'];

require_once('encryptMetadata/decrypt_information.php');
require_once('encryptMetadata/key.php');

$mailDecrypt = decryptToSql("email", base64_encode(openssl_encrypt($email, 'aes-256-cbc', gettingKey(), OPENSSL_RAW_DATA, getIV())),"email");
$passDecrypt = decryptToSql("password", base64_encode(openssl_encrypt($password, 'aes-256-cbc', gettingKey(), OPENSSL_RAW_DATA, getIV())),"password");

if(!$mailDecrypt && !$passDecrypt){
    die("Aurora Studios Services: Unable server.");
}
else{
    if($email == $mailDecrypt["email"]){
        if ($password == $passDecrypt["password"]){
            echo ("Ready to session.");
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