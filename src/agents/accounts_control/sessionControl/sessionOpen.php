<?php

if (session_status() != PHP_SESSION_ACTIVE){
    session_start();
}

if (!empty($_SESSION['username'])){
    header('Location:../../../stages/session/dashboard.php');
}
else{
    header('Location:../../../stages/sign_in.html');
}

?>