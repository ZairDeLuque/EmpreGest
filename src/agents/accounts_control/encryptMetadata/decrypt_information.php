<?php 

function decryptToSql($condition, $conditionResult, $getLabel){
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
    $sql = "SELECT ". $getLabel ." FROM empregest.usersdata WHERE {$condition} = '{$conditionResult}'";

    //Results
    $res = $cn->query($sql);

    if ($res->num_rows > 0) {
        $fila = $res->fetch_assoc();
        $usuarioData = array(
            $getLabel => base64_decode($fila["{$getLabel}"]),
        );
    }
    else{
        $usuarioData = array(
            $getLabel => "nothing"
        );
    }

    if ($keyfinal != null){
        if ($usuarioData["{$getLabel}"] != "nothing"){
            $result = array(
                $getLabel => openssl_decrypt($usuarioData["{$getLabel}"], 'aes-256-cbc', $keyfinal, OPENSSL_RAW_DATA, $IVfinal),
            );
        }
        else{
            $result = array(
                $getLabel => "nothing"
            );
        }

        return $result;
    }
    else{
        die("Aurora Studios Services: Key not found to decrypt meta data");
    }
    
}

?>