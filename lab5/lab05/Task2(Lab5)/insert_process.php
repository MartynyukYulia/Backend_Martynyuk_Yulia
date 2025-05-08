<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $cost = $_POST['cost'];
    $kol = $_POST['kol'];
    $note = $_POST['note'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=slim_db;charset=utf8', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO tov (name, cost, kol, note) VALUES (:name, :cost, :kol, :note)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':cost', $cost, PDO::PARAM_INT);
        $stmt->bindParam(':kol', $kol);
        $stmt->bindParam(':note', $note);
        $stmt->execute();

        header("Location: index.php");
        exit();

    } catch (PDOException $e) {
        echo "Помилка додавання запису: " . $e->getMessage();
    }
} else {
    header("Location: insert.php");
    exit();
}

