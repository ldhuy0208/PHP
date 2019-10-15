<?php
    include_once('model/user.php');
    $username = $_REQUEST['username'];
    $user = new User($username, '123', 'Lê Huy');
    $jsonUser = json_encode($user);
    echo $jsonUser;
?>