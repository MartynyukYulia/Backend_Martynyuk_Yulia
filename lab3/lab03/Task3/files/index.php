<?php
$file1 = 'file1.txt';
$file2 = 'file2.txt';
$output1 = 'only_in_first.txt';
$output2 = 'in_both.txt';
$output3 = 'more_than_twice.txt';

function readLinesFromFile($filename) {
    $lines = [];
    if (file_exists($filename)) {
        $file = fopen($filename, 'r');
        if ($file) {
            while (($line = fgets($file)) !== false) {
                $line = trim($line);
                if (!empty($line)) {
                    if (isset($lines[$line])) {
                        $lines[$line]++;
                    } else {
                        $lines[$line] = 1;
                    }
                }
            }
            fclose($file);
        }
    }
    return $lines;
}

$lines1 = readLinesFromFile($file1);
$lines2 = readLinesFromFile($file2);

$onlyInFirstLines = array_diff_key($lines1, $lines2);
file_put_contents($output1, implode("\n", array_keys($onlyInFirstLines)));

$inBothLines = array_intersect_key($lines1, $lines2);
file_put_contents($output2, implode("\n", array_keys($inBothLines)));

$moreThanTwiceLines = [];

foreach ($lines1 as $line => $count) {
    if ($count > 2 && isset($lines2[$line]) && $lines2[$line] > 2) {
        $moreThanTwiceLines[] = $line;
    }
}

file_put_contents($output3, implode("\n", $moreThanTwiceLines));

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filename'])) {
    $fileToDelete = $_POST['filename'];

    if (in_array($fileToDelete, [$output1, $output2, $output3]) && file_exists($fileToDelete)) {
        if (unlink($fileToDelete)) {
            $message = "Файл $fileToDelete був успішно видалений.";
        } else {
            $message = "Помилка при видаленні файлу $fileToDelete.";
        }
    } else {
        $message = "Неприпустимий файл для видалення.";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Робота з файлами рядків</title>
</head>
<body>
<h1>Робота з файлами рядків</h1>

<h2>Створені файли:</h2>
<ul>
    <li><?php echo $output1; ?> - Рядки, які зустрічаються тільки в першому файлі</li>
    <li><?php echo $output2; ?> - Рядки, які зустрічаються в обох файлах</li>
    <li><?php echo $output3; ?> - Рядки, які зустрічаються в кожному файлі більше двох разів</li>
</ul>

<form method="post" action="">
    <label for="filename">Виберіть файл для видалення:</label>
    <select id="filename" name="filename" required>
        <option value="<?php echo $output1; ?>"><?php echo $output1; ?></option>
        <option value="<?php echo $output2; ?>"><?php echo $output2; ?></option>
        <option value="<?php echo $output3; ?>"><?php echo $output3; ?></option>
    </select>

    <input type="submit" value="Видалити файл">
</form>

<?php if (isset($message)): ?>
    <div class="message <?php echo strpos($message, 'успішно') !== false ? 'success' : 'error'; ?>">
        <?php echo $message; ?>
    </div>
<?php endif; ?>
</body>
</html>