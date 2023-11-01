<?php
// // Get params => Database => Get data => loop => fetch the view
//    if(isset($_GET["name"]) && $_GET["name"] != ""){
//        $name = $_GET["name"];
//    }
//?>

<!---->

<!--<h3>-->
<!--    Hello -->
<?php
//        if (isset($name) && $name != '') {
//            echo $name;
//        }
//?>
<!--</h3>-->

<?php
//    if(isset($_GET['submitBtn'])){
//        $name = $_GET['username'];
//        $email = $_GET['email'];
//        echo "Tên người dùng: ".$name."<br>";
//        echo "Email: ".$email."<br>";
//    }
//?>

<?php
//    if(isset($_POST['submitBtn'])){
//        $name = $_POST['username'];
//        $email = $_POST['email'];
//        echo "Tên người dùng: ".$name."<br>";
//        echo "Email: ".$email."<br>";
//}
//?>

<?php
    if(isset($_GET['action'])){
        echo $_GET['action'];
    }
?>

<?php
 include('header.php');
?>

<div class="container">
    <h1>Biểu mẫu</h1>
    <form action="controllers.php?action=createUser" method="post">
        <div class="form-group">
            <label for="name">Tên:</label>
            <label for="name"></label><input type="text" class="form-control" name="username" id="name" placeholder="Nhập tên">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Nhập email">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Nhập mật khẩu">
        </div>
        <button type="submit" class="btn btn-primary" name="submitBtn">Gửi</button>
    </form>
</div>

<?php
include('footer.php');
?>