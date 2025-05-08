<?php
session_start();

if (empty($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'ukr';

$translations = [
    'ukr' => [
        'title' => 'Введені дані',
        'data' => 'Введені дані:',
        'login' => 'Логін: ',
        'gender' => 'Стать: ',
        'male' => 'Чоловіча',
        'female' => 'Жіноча',
        'city' => 'Місто: ',
        'games' => 'Ігри: ',
        'no_games' => 'Не вибрано',
        'about' => 'Про себе: ',
        'photo' => 'Фото: ',
        'no_photo' => 'Не завантажено',
        'change_data' => 'Змінити дані',
        'no_data' => 'Дані не знайдено',
        'return_form' => 'Повернутись до форми'
    ],
    'eng' => [
        'title' => 'Entered Data',
        'data' => 'Entered data:',
        'login' => 'Login: ',
        'gender' => 'Gender: ',
        'male' => 'Male',
        'female' => 'Female',
        'city' => 'City: ',
        'games' => 'Games: ',
        'no_games' => 'None selected',
        'about' => 'About: ',
        'photo' => 'Photo: ',
        'no_photo' => 'Not uploaded',
        'change_data' => 'Change data',
        'no_data' => 'Data not found',
        'return_form' => 'Return to form'
    ],
    'pl' => [
        'title' => 'Wprowadzone dane',
        'data' => 'Wprowadzone dane:',
        'login' => 'Login: ',
        'gender' => 'Płeć: ',
        'male' => 'Mężczyzna',
        'female' => 'Kobieta',
        'city' => 'Miasto: ',
        'games' => 'Gry: ',
        'no_games' => 'Nie wybrano',
        'about' => 'O sobie: ',
        'photo' => 'Zdjęcie: ',
        'no_photo' => 'Nie przesłano',
        'change_data' => 'Zmień dane',
        'no_data' => 'Nie znaleziono danych',
        'return_form' => 'Powrót do formularza'
    ],
    'fr' => [
        'title' => 'Données saisies',
        'data' => 'Données saisies:',
        'login' => 'Identifiant: ',
        'gender' => 'Sexe: ',
        'male' => 'Homme',
        'female' => 'Femme',
        'city' => 'Ville: ',
        'games' => 'Jeux: ',
        'no_games' => 'Non sélectionné',
        'about' => 'À propos: ',
        'photo' => 'Photo: ',
        'no_photo' => 'Non téléchargé',
        'change_data' => 'Modifier les données',
        'no_data' => 'Données non trouvées',
        'return_form' => 'Retour au formulaire'
    ]
];

function getTranslation($key) {
    global $translations, $lang;
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $key;
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <title><?php echo getTranslation('title'); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h2 {
            color: #4CAF50;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        p {
            margin: 10px 0;
        }
        strong {
            color: #333;
        }
        img {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            max-width: 300px;
            height: auto;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            padding: 10px;
            background-color: #ffeeee;
            border-left: 4px solid #ff0000;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h2><?php echo getTranslation('data'); ?></h2>

<p><strong><?php echo getTranslation('login'); ?></strong><?php echo htmlspecialchars($_SESSION['login']); ?></p>
<p><strong><?php echo getTranslation('gender'); ?></strong><?php echo $_SESSION['gender'] === 'male' ? getTranslation('male') : getTranslation('female'); ?></p>
<p><strong><?php echo getTranslation('city'); ?></strong><?php echo htmlspecialchars($_SESSION['city']); ?></p>
<p><strong><?php echo getTranslation('games'); ?></strong><?php echo !empty($_SESSION['games']) ? implode(', ', $_SESSION['games']) : getTranslation('no_games'); ?></p>
<p><strong><?php echo getTranslation('about'); ?></strong><?php echo htmlspecialchars($_SESSION['about']); ?></p>

<?php
if (isset($_SESSION['photo']) && !empty($_SESSION['photo_name'])) {
    echo '<p><strong>' . getTranslation('photo') . '</strong><img src="uploads/' . htmlspecialchars($_SESSION['photo_name']) . '" alt="Фото користувача" width="200"></p>';
} else {
    echo '<p><strong>' . getTranslation('photo') . '</strong>' . getTranslation('no_photo') . '</p>';
}
?>

<a href="../Task3/index.php"><?php echo getTranslation('return_form'); ?></a>

</body>
</html>
