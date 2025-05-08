<?php
$file_name = 'comments.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['comment'])) {
    $name = trim(htmlspecialchars($_POST['name']));
    $comment = trim(htmlspecialchars($_POST['comment']));

    if (!empty($name) && !empty($comment)) {
        $line = "$name|$comment\n";

        file_put_contents($file_name, $line, FILE_APPEND);
    }
}

function readComments($filename) {
    $comments = [];

    if (file_exists($filename)) {
        $lines = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            $parts = explode('|', $line);
            if (count($parts) === 2) {
                $comments[] = [
                    'name' => $parts[0],
                    'comment' => $parts[1]
                ];
            }
        }
    }

    return $comments;
}

$comments = readComments($file_name);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Система коментарів</title>
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
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Система коментарів</h1>

<form method="post" action="">
    <label for="name">Ім'я:</label>
    <input type="text" id="name" name="name" required>

    <label for="comment">Коментар:</label>
    <textarea id="comment" name="comment" required></textarea>

    <input type="submit" value="Додати коментар">
</form>

<h2>Коментарі</h2>
<?php if (empty($comments)): ?>
    <p>Поки що немає коментарів.</p>
<?php else: ?>
    <table>
        <thead>
        <tr>
            <th>Ім'я</th>
            <th>Коментар</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($comments as $comment): ?>
            <tr>
                <td><?php echo $comment['name']; ?></td>
                <td><?php echo $comment['comment']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>