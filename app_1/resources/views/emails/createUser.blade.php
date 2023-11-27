<!DOCTYPE html>
<html lang="en">
<head>
    <title>Email tạo tài khoản</title>
</head>
<body>
<div>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p>
    <ul>
        <li><strong>Tên đăng nhập: </strong>{{$mailData['name']}}</li>
        <li><strong>Email: </strong>{{$mailData['email']}}</li>
        <li><strong>Mật khẩu: </strong>{{$mailData['password']}}</li>
    </ul>
    <p>Thank you!</p>
</div>
</body>
</html>
