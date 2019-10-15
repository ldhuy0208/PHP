<?php
    session_start();
    include_once("model/user.php");
    if(!isset($_SESSION['user']))
        header("location:login.php");

    $user = unserialize($_SESSION['user']);
    echo "Xin chào ".$user->fullName;

    
?>
<a href="logout.php">Logout</a>