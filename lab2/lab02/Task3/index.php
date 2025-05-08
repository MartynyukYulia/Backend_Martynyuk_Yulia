<?php

session_start();

if (isset($_GET['lang'])) {
    setcookie('lang', $_GET['lang'], time() + (180 * 24 * 60 * 60));
    header('Location: ' . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}
$lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'ukr';

function getTranslation($text) {
    global $lang;

    $translations = [
        'ukr' => [
            'login' => 'Логін',
            'password' => 'Пароль',
            'repeat_password' => 'Повторіть пароль',
            'gender' => 'Стать',
            'male' => 'Чоловік',
            'female' => 'Жінка',
            'city' => 'Місто',
            'games' => 'Улюблені ігри',
            'submit' => 'Зареєструватися',
            'selected_language' => 'Вибрана мова: Українська',
            'about' => 'Про себе',
            'photo' => 'Фото',
            'no_file' => 'Файл не вибрано',
            'zhytomyr' => 'Житомир',
            'kyiv' => 'Київ',
            'odesa' => 'Одеса',
            'vinnytsia' => 'Вінниця',
            'ternopil' => 'Тернопіль',
            'football' => 'Футбол',
            'basketball' => 'Баскетбол',
            'volleyball' => 'Волейбол',
            'chess' => 'Шахи'
        ],
        'eng' => [
            'login' => 'Login',
            'password' => 'Password',
            'repeat_password' => 'Repeat password',
            'gender' => 'Gender',
            'male' => 'Male',
            'female' => 'Female',
            'city' => 'City',
            'games' => 'Favorite games',
            'submit' => 'Register',
            'selected_language' => 'Selected language: English',
            'about' => 'About yourself',
            'photo' => 'Photo',
            'no_file' => 'No file selected',
            'zhytomyr' => 'Zhytomyr',
            'kyiv' => 'Kyiv',
            'odesa' => 'Odesa',
            'vinnytsia' => 'Vinnytsia',
            'ternopil' => 'Ternopil',
            'football' => 'Football',
            'basketball' => 'Basketball',
            'volleyball' => 'Volleyball',
            'chess' => 'Chess'
        ],
        'pl' => [
            'login' => 'Login',
            'password' => 'Hasło',
            'repeat_password' => 'Powtórz hasło',
            'gender' => 'Płeć',
            'male' => 'Mężczyzna',
            'female' => 'Kobieta',
            'city' => 'Miasto',
            'games' => 'Ulubione gry',
            'submit' => 'Zarejestruj się',
            'selected_language' => 'Wybrany język: Polski',
            'about' => 'O sobie',
            'photo' => 'Zdjęcie',
            'no_file' => 'Nie wybrano pliku',
            'zhytomyr' => 'Żytomierz',
            'kyiv' => 'Kijów',
            'odesa' => 'Odessa',
            'vinnytsia' => 'Winnica',
            'ternopil' => 'Tarnopol',
            'football' => 'Piłka nożna',
            'basketball' => 'Koszykówka',
            'volleyball' => 'Siatkówka',
            'chess' => 'Szachy'
        ],
        'fr' => [
            'login' => 'Identifiant',
            'password' => 'Mot de passe',
            'repeat_password' => 'Répétez le mot de passe',
            'gender' => 'Sexe',
            'male' => 'Homme',
            'female' => 'Femme',
            'city' => 'Ville',
            'games' => 'Jeux préférés',
            'submit' => "S'inscrire",
            'selected_language' => 'Langue sélectionnée : Français',
            'about' => 'À propos de vous',
            'photo' => 'Photo',
            'no_file' => 'Aucun fichier choisi',
            'zhytomyr' => 'Jytomyr',
            'kyiv' => 'Kiev',
            'odesa' => 'Odessa',
            'vinnytsia' => 'Vinnytsia',
            'ternopil' => 'Ternopil',
            'football' => 'Football',
            'basketball' => 'Basketball',
            'volleyball' => 'Volleyball',
            'chess' => 'Échecs'
        ]
    ];

    return isset($translations[$lang][$text]) ? $translations[$lang][$text] : $text;
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo getTranslation('submit'); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="radio"],
        input[type="checkbox"] {
            margin-right: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .language-selector {
            margin-top: 20px;
            text-align: center;
        }
        .language-selector a {
            margin: 0 5px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>

<h1><?php echo getTranslation('selected_language'); ?></h1>

<form action="process.php" method="POST" enctype="multipart/form-data">
    <label for="login"><?php echo getTranslation('login'); ?>:</label>
    <input type="text" id="login" name="login" required><br><br>

    <label for="password"><?php echo getTranslation('password'); ?>:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="repeat_password"><?php echo getTranslation('repeat_password'); ?>:</label>
    <input type="password" id="repeat_password" name="repeat_password" required><br><br>

    <label><?php echo getTranslation('gender'); ?>:</label>
    <input type="radio" id="male" name="gender" value="male" required><label for="male"><?php echo getTranslation('male'); ?></label>
    <input type="radio" id="female" name="gender" value="female" required><label for="female"><?php echo getTranslation('female'); ?></label><br><br>

    <label for="city"><?php echo getTranslation('city'); ?>:</label>
    <select name="city" id="city" required>
        <option value="Zhytomyr"><?php echo getTranslation('zhytomyr'); ?></option>
        <option value="Kyiv"><?php echo getTranslation('kyiv'); ?></option>
        <option value="Odesa"><?php echo getTranslation('odesa'); ?></option>
        <option value="Vinnytsia"><?php echo getTranslation('vinnytsia'); ?></option>
        <option value="Ternopil"><?php echo getTranslation('ternopil'); ?></option>
    </select><br><br>

    <label><?php echo getTranslation('games'); ?>:</label><br>
    <input type="checkbox" name="games[]" value="football"> <?php echo getTranslation('football'); ?><br>
    <input type="checkbox" name="games[]" value="basketball"> <?php echo getTranslation('basketball'); ?><br>
    <input type="checkbox" name="games[]" value="volleyball"> <?php echo getTranslation('volleyball'); ?><br>
    <input type="checkbox" name="games[]" value="chess"> <?php echo getTranslation('chess'); ?><br><br>

    <label for="about"><?php echo getTranslation('about'); ?>:</label><br>
    <textarea id="about" name="about" rows="4" cols="50"></textarea><br><br>

    <label for="photo"><?php echo getTranslation('photo'); ?>:</label>
    <input type="file" id="photo" name="photo"><br><br>

    <input type="submit" value="<?php echo getTranslation('submit'); ?>">
</form>

<!-- Мови -->
<div class="language-selector">
    <a href="?lang=ukr"><img src="flags/Україна.png" width="40" title="Українська" alt="Українська"></a>
    <a href="?lang=pl"><img src="flags/Польща.png" width="40" title="Polski" alt="Polski"></a>
    <a href="?lang=eng"><img src="flags/Англія.png" width="40" title="English" alt="English"></a>
    <a href="?lang=fr"><img src="flags/Франція.png" width="40" title="Français" alt="Français"></a>
</div>

</body>
</html>
