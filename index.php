<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task 1</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<b>Завдання 1</b>
<?php
echo "<pre>Полину в мріях в купель океану,
Відчую <b>шовковистість</b> глибини,
Чарівні мушлі з дна собі дістану,
 Щоб <b><i>взимку</i></b>
    <u>тішили</u>
       мене
          вони…</pre>";
?>

<b>Завдання 2</b>
<?php
$hryvnias = 2000;
$dollar = 42.02;
$result = number_format($hryvnias / $dollar, 2);

echo "<pre>$hryvnias грн. можна обміняти на $result долар  </pre>";
?>

<b>Завдання 3</b>
<?php
$month = 6;
$season = "";

if ($month == 12 || $month == 1 || $month == 2) {
    $season = "ЗИМНЬОМУ";
} elseif ($month >= 3 && $month <= 5) {
    $season = "ВЕСНЯНОМУ";
} elseif ($month >= 6 && $month <= 8) {
    $season = "ЛІТНЬОМУ";
} else {
    $season = "ОСІННЬОМУ";
}

echo "<p>$month місяць знаходиться в $season сезоні</p>";
?>

<b>Завдання 4</b>
<?php
$letter = 'О';
$vowels = ['а', 'е', 'є', 'и', 'і', 'ї', 'о', 'у', 'ю', 'я'];

if (in_array(mb_strtolower($letter), $vowels)) {
    echo "<p>Буква $letter є голосною.</p>";
} else {
    echo "<p>Буква $letter є приголосною.</p>";
}
?>

<b>Завдання 5</b>
<?php
$number = mt_rand(100, 999);
$broken_numbers = str_split($number);
$sum = array_sum($broken_numbers);
$reverse_order = strrev($number);
sort($broken_numbers);
$largest = implode('', array_reverse($broken_numbers));

echo "<pre>Число: $number
Сума: $sum
Число у зворотньому порядку: $reverse_order
Найбільше число: $largest</pre>";
?>

<b>Завдання 6</b><br>
<b>Частина 1</b>
<?php
function createTable($rows, $cols) {
    $colors = ['#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#800080', '#FFA500'];

    echo "<table style='border: 2px solid black; border-collapse: collapse;'>";

    for ($i = 0; $i < $rows; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            $color = $colors[rand(0, count($colors) - 1)];
            echo "<td style='background-color: $color; width: 50px; height: 50px; border: 1px solid black;'></td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
createTable(4, 4);
?>

<b>Частина 2</b>
<?php
function createSquares($n) {
    $containerWidth = 800;
    $containerHeight = 600;

    echo "<div style='background-color: black; position: relative; width: {$containerWidth}px; height: {$containerHeight}px;'>";

    for ($i = 0; $i < $n; $i++) {
        $size = rand(50, 150);
        $top = rand(0, $containerHeight - $size);
        $left = rand(0, $containerWidth - $size);

        echo "<div style='position: absolute; top: {$top}px; left: {$left}px; width: {$size}px; height: {$size}px; background-color: red;'></div>";
    }

    echo "</div>";
}

createSquares(4);
?>
</body>
</html>
