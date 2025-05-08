<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "company_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET['id'];
    if (isset($id) && is_numeric($id)) {
        $stmt = $conn->prepare("DELETE FROM employees WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: index.php");
        exit();

    } else {
        echo "<p>Некоректний ID працівника.</p>";
    }

} catch (PDOException $e) {
    echo "Помилка видалення працівника: " . $e->getMessage();
} finally {
    $conn = null;
}
?>