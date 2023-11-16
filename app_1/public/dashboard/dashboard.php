<?php
    //
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Niam Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
<div class="container-fluid">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark row">
        <a class="navbar-brand col-md-2" href="#">Niam Dashboard</a>

        <div class="input-group">
            <input type="text" class="border-none" placeholder="Tìm kiếm" aria-label="Tìm kiếm" aria-describedby="searchIcon">
            <button class="input-group-append btn input-group-text border-none" id="searchIcon"><i class="fas fa-search"></i></button>
        </div>

        <button class="btn btn-danger col-md-1 border-none">
            <i class="fas fa-user account-icon"></i>
        </button>
    </nav>
    <div class="row">
        <div class="col-md-2 sidebar">
            <a href="#">Home</a>
            <a href="#">Tài khoản</a>
            <a href="#">Sản phẩm</a>
            <a href="#">Bài viết</a>
            <a href="#">Phản hồi</a>
        </div>
        <div class="col-md-10 content">
            <!-- Content Area -->
            <h2>Nội dung sẽ được hiển thị ở đây</h2>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
