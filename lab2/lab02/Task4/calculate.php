<?php
require_once "Function/func.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $x = floatval($_POST["x"]);
    $y = intval($_POST["y"]);

    $xy = power($x, $y);
    $x_factorial = factorial(round($x));
    $tg_x = tangent($x);
    $sin_x = my_sin($x);
    $cos_x = my_cos($x);
    $tg_x_php = my_tg($x);
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Обчислення функцій</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<table border="1">
    <tr>
        <th>xʸ</th>
        <th>x!</th>
        <th>my_tangent(x)</th>
        <th>sin(x)</th>
        <th>cos(x)</th>
        <th>tangent(x)</th>
    </tr>
    <tr>
        <td><?= isset($xy) ? $xy : '' ?></td>
        <td><?= isset($x_factorial) ? $x_factorial : '' ?></td>
        <td><?= isset($tg_x) ? $tg_x : '' ?></td>
        <td><?= isset($sin_x) ? $sin_x : '' ?></td>
        <td><?= isset($cos_x) ? $cos_x : '' ?></td>
        <td><?= isset($tg_x_php) ? $tg_x_php : '' ?></td>
    </tr>
</table>
<br>
<a href="index.php">Назад</a>
</body>
</html>