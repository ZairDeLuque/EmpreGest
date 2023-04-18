<?php 

function checkSessionLogin(){
    session_start();

    if (!isset($_SESSION['username']) || empty($_SESSION['username'])){
        header('Location:../../../stages/sign_in.php');
        exit;
    }
    else{
        //Code for dashboard logged
    }
}

function createSession($user, $namefull){
    session_start();

    $_SESSION['username'] = $user;
    $_SESSION['name'] = $namefull;
    
    exit;
}

function destroySession(){
    session_start();
    session_unset();
    session_destroy();

    header('Location:../../../../main.html');
    exit;
}
?>