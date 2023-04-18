<?php

require_once('key.php');

function encrypt($data){

    $key = gettingKey();
    $iv = getIV();

    if ($key != null) {
        
        $encryptData = openssl_encrypt($data, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

        return base64_encode($encryptData);

    }
    else{
        die("Aurora Studios Services: Key encryption is null or not supported"); 
    }
}

?>