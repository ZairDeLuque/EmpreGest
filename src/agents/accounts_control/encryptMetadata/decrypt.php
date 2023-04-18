<?php 

function decryptMetaData($condition, $conditionResult){
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
    $sql = "SELECT * FROM empregest.usersdata WHERE {$condition} = '{$conditionResult}'";

    //Results
    $res = $cn->query($sql);

    if ($res->num_rows > 0) {
        $fila = $res->fetch_assoc();
        $usuarioData = array(
            'name' => base64_decode($fila["name"]),
            'lastname' => base64_decode($fila["lastname"]),
            'age' => $fila["age"],
            'genre' => $fila["genre"],
            'number' => base64_decode($fila["number"]),
            'email' => base64_decode($fila["email"]),
            'pass' => base64_decode($fila["password"]),
            'data' => $fila["accountdata"],
            'id' => $fila["ID"]
        );
    }
    else{
        die("Aurora Studios Services: User information not found or invalid.");
    }

    if ($keyfinal != null){
        $result = array(
            'name' => openssl_decrypt($usuarioData["name"], 'aes-256-cbc', $keyfinal, OPENSSL_RAW_DATA, $IVfinal),
            'lastname' => openssl_decrypt($usuarioData["lastname"], 'aes-256-cbc', $keyfinal, OPENSSL_RAW_DATA, $IVfinal),
            'age' => $usuarioData["age"],
            'genre' => $usuarioData["genre"],
            'number' => openssl_decrypt($usuarioData["number"], 'aes-256-cbc', $keyfinal, OPENSSL_RAW_DATA, $IVfinal),
            'email' => openssl_decrypt($usuarioData["email"], 'aes-256-cbc', $keyfinal, OPENSSL_RAW_DATA, $IVfinal),
            'pass' => openssl_decrypt($usuarioData["pass"], 'aes-256-cbc', $keyfinal, OPENSSL_RAW_DATA, $IVfinal),
            'data' => $usuarioData["data"],
            'id' => $usuarioData["id"]
        );

        return $result;
    }
    else{
        die("Aurora Studios Services: Key not found to decrypt meta data");
    }
    
}

?>