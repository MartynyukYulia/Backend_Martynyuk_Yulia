<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Робота з рядками в PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="task">
    <h3>1. Заміна символів</h3>
    <form method="post">
        <label for="original_text">Текст:</label>
        <input type="text" name="original_text" id="original_text">

        <label for="find_text">Знайти:</label>
        <input type="text" name="find_text" id="find_text">

        <label for="replace_text">Замінити:</label>
        <input type="text" name="replace_text" id="replace_text">

        <input type="submit" name="replace" value="Замінити">
    </form>
    <?php
    if(isset($_POST['replace'])) {
        $original = $_POST['original_text'];
        $find = $_POST['find_text'];
        $replace = $_POST['replace_text'];
        $result = str_replace($find, $replace, $original);
        echo "<div class='result'>Результат: $result</div>";
    }
    ?>
</div>

<div class="task">
    <h3>2. Сортування міст</h3>
    <form method="post">
        <label for="cities">Введіть назви міст через пробіл:</label>
        <input type="text" name="cities" id="cities">
        <input type="submit" name="sort_cities" value="Сортувати">
    </form>
    <?php
    if(isset($_POST['sort_cities'])) {
        $cities = explode(' ', $_POST['cities']);
        sort($cities);
        $sorted = implode(' ', $cities);
        echo "<div class='result'>Відсортовані міста: $sorted</div>";
    }
    ?>
</div>

<div class="task">
    <h3>3. Виділення імені файлу</h3>
    <form method="post">
        <label for="filepath">Повний шлях до файлу:</label>
        <input type="text" name="filepath" id="filepath" value="D:\WebServers\home\testsite\www\myfile.txt">
        <input type="submit" name="extract_filename" value="Виділити">
    </form>
    <?php
    if(isset($_POST['extract_filename'])) {
        $path = $_POST['filepath'];
        $filename = pathinfo($path, PATHINFO_FILENAME);
        echo "<div class='result'>Ім'я файлу: $filename</div>";
    }
    ?>
</div>

<div class="task">
    <h3>4. Різниця між датами</h3>
    <form method="post">
        <label for="date1">Перша дата (DD-MM-YYYY):</label>
        <input type="text" name="date1" id="date1" placeholder="наприклад, 01-01-2023">

        <label for="date2">Друга дата (DD-MM-YYYY):</label>
        <input type="text" name="date2" id="date2" placeholder="наприклад, 10-01-2023">

        <input type="submit" name="calc_dates" value="Обчислити">
    </form>
    <?php
    if(isset($_POST['calc_dates'])) {
        $date1 = DateTime::createFromFormat('d-m-Y', $_POST['date1']);
        $date2 = DateTime::createFromFormat('d-m-Y', $_POST['date2']);

        if($date1 && $date2) {
            $diff = $date1->diff($date2);
            echo "<div class='result'>Різниця: " . abs($diff->days) . " днів</div>";
        } else {
            echo "<div class='result error'>Помилка: Введіть дати у форматі DD-MM-YYYY</div>";
        }
    }
    ?>
</div>

<div class="task">
    <h3>5. Генератор паролів</h3>
    <form method="post">
        <label for="length">Довжина пароля:</label>
        <input type="number" name="length" id="length" min="8" value="12">
        <input type="submit" name="generate" value="Згенерувати">
    </form>
    <?php
    function generatePassword($length) {
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';
        $numbers = '0123456789';
        $special = '!@#$%^&*()_+-=[]{}|';

        $password = '';
        $password .= $uppercase[rand(0, strlen($uppercase) - 1)];
        $password .= $lowercase[rand(0, strlen($lowercase) - 1)];
        $password .= $numbers[rand(0, strlen($numbers) - 1)];
        $password .= $special[rand(0, strlen($special) - 1)];

        $all = $uppercase . $lowercase . $numbers . $special;
        while(strlen($password) < $length) {
            $password .= $all[rand(0, strlen($all) - 1)];
        }

        return str_shuffle($password);
    }

    if(isset($_POST['generate'])) {
        $length = max(8, intval($_POST['length']));
        $password = generatePassword($length);
        echo "<div class='result'>Згенерований пароль: <strong>$password</strong></div>";
    }
    ?>
</div>

<div class="task">
    <h3>6. Перевірка надійності пароля</h3>
    <form method="post">
        <label for="check_password">Введіть пароль:</label>
        <input type="text" name="password" id="check_password" placeholder="Введіть пароль для перевірки">
        <input type="submit" name="check" value="Перевірити">
    </form>

    <?php
    function checkPasswordStrength($password) {
        $criteria = [
            'length' => strlen($password) >= 8,
            'uppercase' => preg_match('/[A-Z]/', $password),
            'lowercase' => preg_match('/[a-z]/', $password),
            'number' => preg_match('/[0-9]/', $password),
            'special' => preg_match('/[!@#$%^&*()_+\-=\[\]{}|;:,.<>?]/', $password)
        ];

        $isStrong = array_reduce($criteria, function($carry, $item) {
            return $carry && $item;
        }, true);

        return $isStrong;
    }

    if(isset($_POST['check'])) {
        $password = $_POST['password'];
        $isStrong = checkPasswordStrength($password);
        echo "<div class='result'>";
        echo "Пароль: <strong>$password</strong> - ";
        echo $isStrong ? "<span style='color: green;'>Надійний</span>" : "<span style='color: red;'>Ненадійний</span>";
        echo "</div>";
    }
    ?>
</div>

<a href="pages/main.php">Назад</a>
</body>
</html>