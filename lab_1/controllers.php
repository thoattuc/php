<?php
    if(isset($_GET['action'])) {
        $action = $_GET['action'];
        switch($action) {
            case 'createUser':
                if(isset($_POST['username']) && $_POST['password']) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    echo "Tên người dùng: ".$username."<br>";
                    echo "Mật khẩu: ".$password."<br>";
                }
                break;
            default;
                break;
        }
    }