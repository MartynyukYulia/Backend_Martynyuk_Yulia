<?php
$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $uploadDir = 'uploads/images/';

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fileName = basename($_FILES['image']['name']);
    $uploadFile = $uploadDir . $fileName;
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($imageFileType, $allowedExtensions)) {
        $message = 'Дозволені лише файли з розширеннями JPG, JPEG, PNG і GIF.';
        $messageType = 'error';
    } else {
        if ($_FILES['image']['size'] > 5000000) {
            $message = 'Файл занадто великий. Максимальний розмір - 5MB.';
            $messageType = 'error';
        } else {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $message = 'Зображення успішно завантажено!';
                $messageType = 'success';
            } else {
                $message = 'Помилка при завантаженні зображення.';
                $messageType = 'error';
            }
        }
    }
}

$images = [];
$uploadDir = 'uploads/images/';

if (file_exists($uploadDir)) {
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    $files = scandir($uploadDir);
    foreach ($files as $file) {
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if ($file != '.' && $file != '..' && in_array($extension, $allowedExtensions)) {
            $images[] = $uploadDir . $file;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завантаження зображень</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1, h2 {
            color: #333;
        }
        form {
            margin-bottom: 30px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="file"] {
            margin-bottom: 15px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .success {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .error {
            background-color: #f2dede;
            color: #a94442;
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }
        .gallery img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
<h1>Завантаження зображень</h1>

<?php if (!empty($message)): ?>
    <div class="message <?php echo $messageType; ?>">
        <?php echo $message; ?>
    </div>
<?php endif; ?>

<form method="post" action="" enctype="multipart/form-data">
    <label for="image">Виберіть зображення для завантаження:</label>
    <input type="file" id="image" name="image" accept="image/*" required>
    <input type="submit" value="Завантажити">
</form>

<?php if (!empty($images)): ?>
    <h2>Галерея завантажених зображень:</h2>
    <div class="gallery">
        <?php foreach ($images as $image): ?>
            <img src="<?php echo $image; ?>" alt="Завантажене зображення">
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Немає завантажених зображень.</p>
<?php endif; ?>
</body>
</html>