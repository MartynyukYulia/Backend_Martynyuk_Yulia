<?php
$file = 'words.txt';
$sorted_file = 'sorted_words.txt';
$message = '';

if (file_exists($file)) {
    $content = file_get_contents($file);

    $words = preg_split('/\s+/', $content, -1, PREG_SPLIT_NO_EMPTY);

    sort($words, SORT_STRING | SORT_FLAG_CASE);

    if (file_put_contents($sorted_file, implode(' ', $words))) {
        $message = "Слова успішно відсортовані за алфавітом та збережені у файлі '$sorted_file'.";
    } else {
        $message = "Помилка при збереженні відсортованих слів.";
    }
} else {
    $message = "Файл '$file' не знайдено.";
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Сортування слів</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        .message {
            padding: 10px;
            margin-top: 20px;
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
        pre {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            overflow-x: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
<h1>Сортування слів за алфавітом</h1>

<div class="message <?php echo strpos($message, 'успішно') !== false ? 'success' : 'error'; ?>">
    <?php echo $message; ?>
</div>

<?php if (file_exists($file)): ?>
    <h2>Слова:</h2>
    <pre><?php echo file_get_contents($file); ?></pre>
<?php endif; ?>

<?php if (file_exists($sorted_file)): ?>
    <h2>Відсортовані слова:</h2>
    <pre><?php echo file_get_contents($sorted_file); ?></pre>
<?php endif; ?>
</body>
</html>