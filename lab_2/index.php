<?php
    $page='';
    if(isset($_GET['page'])){
        $page=$_GET['page'];
    }else{
        $page='home';
    }
    switch ($page) {
        case 'home':
            require_once('home.php');
            break;
        case 'login':
            require_once('login.php');
            break;
        case 'register':
            require_once('register.php');
            break;   
        default:
            require_once('notfound.php');
            break;
    }