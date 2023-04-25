<?php 
function createSession($name, $mail, $username){
    if (session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }

    $_SESSION['name'] = $name;
    $_SESSION['email'] = $mail;
    $_SESSION['username'] = $username;
    
    header('Location:../../stages/session/dashboard.php');

    exit;
}

?>