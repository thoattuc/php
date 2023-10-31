<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user'] == '') {
    header('location:index.php?page=login');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
</head>
<body>
Home !
</body>
</html>