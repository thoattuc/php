<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Lab 1</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<h1>Hello</h1>
<!--Nhúng mã PHP:-->
<?php
$name = "Niam";
echo "Xin chào, $name!";
echo "<br>"
?>

<!--Toán tử trong PHP:-->
<?php
$quantity = 5;
$b = 0b10;
echo $b;
echo "<br>";
?>

<?php
$t1 = 5+3;
echo $t1;
echo " ";
$t2 = 5**3;
echo $t2;
echo " ";
echo gettype($t2);
echo " ";
$t3 = (float) $t2;
echo gettype($t3);
echo "<br>";
?>

<?php
// In ra rồi mới tăng lên một đơn vị:
$i=1;
echo $i++;
echo " ";
// Tăng 1 đơn vị rồi mới thực hiện in ra:
$j=1;
echo ++$j;
?>
</body>
</html>
