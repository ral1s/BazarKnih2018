<?php
include_once 'dbconfig.php';
include_once 'class.user.php';


    $user->logout();
    $user->redirect('index.php');



?>