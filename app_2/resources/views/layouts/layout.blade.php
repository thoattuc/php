<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Niam Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Sweetalert2 css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.min.css">
    <!-- Jquery CDN-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
            integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Sweetalert2 js-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0/dist/sweetalert2.all.min.js"></script>
    <style>
        .logo {
            text-align: center;
            background: #555555;
        }

        .sidebar {
            position: fixed;
            width: 250px;
            height: 100%;
            background: #333;
            color: #fff;
            padding-top: 10px;
        }

        span {
            color: black;
        }

        span:hover {
            text-decoration: none;
            color: red;
        }

        .sidebar a {
            padding: 10px 20px;
            display: block;
            color: #fff;
        }

        .sidebar a:hover {
            background: #555;
            text-decoration: none;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .border-none {
            border: solid 1px;
            border-radius: unset;
        }

        .account-icon {
            color: white;
        }

        .swal2-modal, .swal2-toast {
            border-radius: unset !important;

        }
        .swal2-modal button {
            border-radius: unset !important;
        }
    </style>
    <script>
        // Sweetalert
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        // CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>

<body>
<div class="container-fluid m-auto">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark row">
        <div class="col-md-2 logo">
            <a class="navbar-brand m-auto" href="#">Niam Dashboard</a>
        </div>

        <div class="input-group search_bar col-md-8">
            <input type="text" class="form-control border-none" placeholder="Tìm kiếm" aria-label="Tìm kiếm"
                   aria-describedby="searchIcon">
            <button class="input-group-append btn input-group-text border-none" id="searchIcon"><i
                    class="fas fa-search"></i></button>
        </div>

        <div class="col-md-2">
            @yield('btn')
            <button class="btn btn-danger border-none m-1">
                <i class="fas fa-user account-icon"></i>
            </button>
        </div>
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
            @yield('main')
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // code
</script>
</body>
</html>
