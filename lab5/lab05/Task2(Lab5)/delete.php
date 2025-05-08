<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результат видалення</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idToDelete = $_POST['id'];

    if (!empty($idToDelete) && is_numeric($idToDelete)) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=slim_db;charset=utf8', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM tov WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':id', $idToDelete, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "<p class='success'>Запис з ID " . $idToDelete . " успішно видалено.</p>";
            } else {
                echo "<p class='error'>Запис з ID " . $idToDelete . " не знайдено.</p>";
            }

        } catch (PDOException $e) {
            echo "<p class='error'>Помилка видалення запису: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p class='error'>Будь ласка, введіть коректний ID для видалення.</p>";
    }
} else {
    header("Location: index.php");
    exit();
}

echo "<p><a href='index.php' class='back-link'>Назад до списку товарів</a></p>";

?>

</body>
</html>