<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Робота з масивами</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Робота з масивами</h1>

<div class="task">
    <h3>1. Пошук повторюваних елементів</h3>
    <?php
    function findDuplicates($arr) {
        $counts = array_count_values($arr);
        $duplicates = array_filter($counts, function($count) {
            return $count > 1;
        });
        return array_keys($duplicates);
    }

    $testArray = [1, 2, 3, 2, 4, 3, 5, 6, 5];
    $duplicates = findDuplicates($testArray);

    echo "<div class='result'>";
    echo "Тестовий масив: " . implode(", ", $testArray) . "<br>";
    echo "Повторювані елементи: " . implode(", ", $duplicates);
    echo "</div>";
    ?>
</div>

<div class="task">
    <h3>2. Генератор імен тварин</h3>
    <?php
    function generatePetName($syllables) {
        $nameLength = rand(2, 3);
        $name = '';

        for ($i = 0; $i < $nameLength; $i++) {
            $name .= $syllables[array_rand($syllables)];
        }

        return ucfirst(strtolower($name));
    }

    $syllables = ['ра', 'ма', 'лі', 'ка', 'о', 'та', 'мі', 'па', 'ві', 'ся'];

    echo "<div class='result'>";
    echo "Згенеровані імена:<br>";
    for ($i = 0; $i < 5; $i++) {
        echo generatePetName($syllables) . "<br>";
    }
    echo "</div>";
    ?>
</div>

<div class="task">
    <h3>3. Операції з масивами</h3>
    <?php
    function createArray() {
        $length = rand(3, 7);
        $array = [];
        for ($i = 0; $i < $length; $i++) {
            $array[] = rand(10, 20);
        }
        return $array;
    }

    function processArrays($arr1, $arr2) {
        // З'єднання масивів
        $result = array_merge($arr1, $arr2);
        // Видалення дублікатів
        $result = array_unique($result);
        // Сортування
        sort($result);
        return $result;
    }

    $array1 = createArray();
    $array2 = createArray();
    $processed = processArrays($array1, $array2);

    echo "<div class='result'>";
    echo "Перший масив: " . implode(", ", $array1) . "<br>";
    echo "Другий масив: " . implode(", ", $array2) . "<br>";
    echo "Результат обробки: " . implode(", ", $processed);
    echo "</div>";
    ?>
</div>

<div class="task">
    <h3>4. Сортування користувачів</h3>
    <?php
    function sortUsers($users, $sortBy = 'name') {
        if ($sortBy === 'name') {
            ksort($users);
        } else if ($sortBy === 'age') {
            asort($users);
        }
        return $users;
    }

    $users = [
        'Анна' => 25,
        'Петро' => 30,
        'Марія' => 22,
        'Іван' => 28,
        'Олена' => 24
    ];

    echo "<div class='result'>";
    echo "Оригінальний список:<br>";
    foreach ($users as $name => $age) {
        echo "$name: $age років<br>";
    }

    echo "<br>Сортування за іменем:<br>";
    $sortedByName = sortUsers($users, 'name');
    foreach ($sortedByName as $name => $age) {
        echo "$name: $age років<br>";
    }

    echo "<br>Сортування за віком:<br>";
    $sortedByAge = sortUsers($users, 'age');
    foreach ($sortedByAge as $name => $age) {
        echo "$name: $age років<br>";
    }
    echo "</div>";
    ?>
</div>
<br>
<a href="pages/main.php">Назад</a>
</body>
</html>