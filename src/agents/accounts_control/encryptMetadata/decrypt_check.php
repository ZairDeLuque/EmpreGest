<?php 

function decryptData($condition, $conditionResult){
    require_once('key.php');

    //Connection to database
    $cn = mysqli_connect('localhost', 'root', 'root');

    mysqli_set_charset($cn, "UTF-8");

    if (!$cn){
        die("Aurora Studios Services: Could not connect to database. Please try again later.");
    }

    //Obtain key from database to decrypt data
    $keyfinal = gettingKey();
    $IVfinal = getIV();

    //Query
    $sql = "SELECT email FROM empregest.usersdata WHERE {$condition} = '{$conditionResult}'";

    //Results
    $res = $cn->query($sql);

    if ($res->num_rows > 0) {
        $fila = $res->fetch_assoc();
        $usuarioData = array(
            'email' => base64_decode($fila["email"])
        );
    }
    else{
        $usuarioData = array(
            'email' => "nothing"
        );
    }

    if ($keyfinal != null){
        if ($usuarioData["email"] != "nothing"){
            $result = array(
                'email' => openssl_decrypt($usuarioData["email"], 'aes-256-cbc', $keyfinal, OPENSSL_RAW_DATA, $IVfinal),
            );
        }
        else{
            $result = array(
                'email' => "nothing"
            );
        }

        return $result;
    }
    else{
        die("Aurora Studios Services: Key not found to decrypt meta data");
    }
    
}

?>