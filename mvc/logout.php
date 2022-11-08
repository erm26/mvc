<?php 
if (!empty($_COOKIE)) {
    setcookie('login', '', -10, '/');
    setcookie('password', '', -10, '/');
    header('Location: index.php');
}

