<?php
require_once('pdo.php');
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'create':
            if (!isset($_POST['username']) || !isset($_POST['password']) || isset($_POST['username']) == '' || isset($_POST['password']) == '') {
                $data = ['check' => false, 'msg' => 'Thiếu thông tin tài khoản'];
                header('Content-Type: application/json');
                echo json_encode($data);
                exit();
            } else {
                $password = $_POST['password'];
                $password_crypt = password_hash($password, PASSWORD_BCRYPT, [10]);
                $sql = "SELECT * FROM users where name = ' " . $_POST['username'] . " ' ";
                $email = $_POST['email'];
                $result = pdo_query_one($sql);
                if (count($result) == 0) {
                    $date = date('Y-m-d H:i:s');
                    $sql = "INSERT INTO users (name, password, email, created_at) VALUES ('" . $_POST['username'] . "', '" . $password_crypt . "','" .$email."', '" . $date . "')";
                    pdo_execute($sql);
                    $data = ['check' => true, 'msg' => 'Thêm thành công'];
                    header('Content-Type: application/json');
                    echo json_encode($data);
                    exit();
                }
            }
            break;
        case 'checkLogin':
            if (!isset($_POST['username']) || isset($_POST['username']) == '' || isset($_POST['password']) == '') {
                $data = ['check' => false,'msg' => 'Thiếu thông tin tài khoản'];
                header('Content-Type: application/json');
                echo json_encode($data);
                exit();
            }else{
                $sql = "SELECT * FROM users WHERE name='".$_POST['username']."'";
                $result = pdo_query_one($sql);
                $check = count($result);
                if ($check == 0) {
                    $data = ['check' => false,'msg' => 'Tài khoản không tồn tại'];
                    header('Content-Type: application/json');
                    echo json_encode($data);
                    exit();
                }else{
                    $password = $result['password'];

                    $checkPass = password_verify($_POST['password'], $password);
                    if($checkPass === true) {
                        $_SESSION['user'] = $_POST['username'];
                        $data = ['check' => true,'msg' => 'Đăng nhập thành công'];
                    }else {
                        $data = ['check' => false,'msg' => 'Sai mật khẩu'];
                    }
                    header('Content-Type: application/json');
                    echo json_encode($data);
                    exit();
                }
            }
        default:
            break;
    }
}