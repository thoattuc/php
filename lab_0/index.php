<?php
    $page = '';
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    else {
        $page = 'home';
    }
    switch ($page) {
        case 'home':
            require_once("home.php");
            break;
        case 'auth':
            require_once("auth.php");
            break;
        default:
            require_once("notfound.php");
            break;
    }