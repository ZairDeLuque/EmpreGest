<?php 

function obtainSessionData($obtain){
    if (session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }

    if (empty($_SESSION['name']) || empty($_SESSION['email']) || empty($_SESSION['username'])){
        header('Location:../../../../main.html');
        exit;
    }
    else{
        if($obtain == 0){
            return $_SESSION['name'];
        }
        else if ($obtain == 1){
            return $_SESSION['username'];
        }
        else{
            return $_SESSION['email'];
        }
    }
}

function checkSessionActive(){
    if (session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }

    if (!empty($_SESSION['username'])){
        return true;
    }
    else{
        return false;
    }
}

function destroySession(){
    session_start();
    session_unset();
    session_destroy();

    header('Location:../../../../../main.html');
    exit;
}
?>