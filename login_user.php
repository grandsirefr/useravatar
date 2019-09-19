<?php
include 'vendor/autoload.php';
dump($_POST);

if(!empty($_POST)){
    $user_Email=$_POST["email"];
    $user_Password=$_POST["password"];
}
include 'template/login_user.phtml';