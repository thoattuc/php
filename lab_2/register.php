<!DOCTYPE html>
<html lang="">
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
          crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
</head>
<body>

<div class="container card mt-3">
    <div class="row justify-content-center card-body">
        <div class="col-md-6">
            <h2 class="mt-5 mb-3">Đăng ký tài khoản</h2>
            <form method="post" action="create">
                <div class="mb-3">
                    <label for="username" class="form-label">Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập địa chỉ email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                </div>
                <div class="mb-3">
                    <label for="password_confirm" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Xác nhận mật khẩu">
                </div>
                <button id="registerBtn" type="submit" class="btn btn-primary">Đăng ký</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        register()
    });
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    function register() {
        $('#registerBtn').click(function(e) {
            e.preventDefault();
            var username = $('#username').val().trim();
            var email = $('#email').val().trim();
            var password = $('#password').val().trim();
            var password_confirm = $('#password_confirm').val().trim();
            if (username === '') {
                Toast.fire({
                    icon: 'error',
                    title: 'Vui lòng nhập tên đăng nhập'
                })
            } else if (password === '') {
                Toast.fire({
                    icon: 'error',
                    title: 'Vui lòng nhập mật khẩu'
                })
            } else if (password_confirm === '') {
                Toast.fire({
                    icon: 'error',
                    title: 'Vui lòng xác nhận mật khẩu'
                })
            } else if (password !== password_confirm) {
                Toast.fire({
                    icon: 'error',
                    title: 'Mật khẩu nhập lại không đúng'
                })
            } else {
                $.ajax({
                    url: 'controllers.php?action=create',
                    type: 'POST',
                    data: {
                        username: username,
                        email: email,
                        password: password,
                    },
                    dataType: "JSON",
                    success: function(res) {
                        if (res.check ==='true') {
                            Toast.fire({
                                icon:'success',
                                title: "Đăng ký thành công"
                            }).then(() => {
                                window.location.replace('?page=login');
                            });
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: res.message
                            })
                        }
                    },
                    error: function(response) {
                        Toast.fire({
                            icon: 'error',
                            title: 'Có lỗi xảy ra'
                        })
                    }
                })
            }

        })
    }
</script>
</body>
</html>
