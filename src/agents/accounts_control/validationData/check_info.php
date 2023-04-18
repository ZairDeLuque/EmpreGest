<?php 

//Get data personal from form
$name = $_POST['name'];
$lastname = $_POST['lastname'];
$age = $_POST['age'];
$genre = $_POST['genre'];

if (!empty($_POST['number'])){
    $number = $_POST['number'];
}
else{
    $number = "none";
}

//Get data account from form
$email = $_POST['email'];
$pass = $_POST['pass'];
$id = random_int(10000,100000);

//Code validation from Worker Account
if (!empty($_POST['code'])){
    $code = $_POST['code'];
}
else{
    $code = "none";
}

function check($mail){
    require_once('../encryptMetadata/decrypt_check.php');
    require_once('../encryptMetadata/key.php');

    $array = decryptData("email", base64_encode(openssl_encrypt($mail, 'aes-256-cbc', gettingKey(), OPENSSL_RAW_DATA, getIV())));

    if ($array){
        if ($mail != $array["email"]){
            return true;
        }
        else{
            return false;
        }
    }
    else{
        die("Aurora Studios Services: Could decrypt metadata.");
    }


}

if (check($email) == true){
    require_once ('../add_account.php');

    agreementAccount($name, $lastname, $age, $genre, $number, $email, $pass, $id, $code);
}
else{
    die("Aurora Studios Services: El correo ya existe en la base de datos.");
}


?>