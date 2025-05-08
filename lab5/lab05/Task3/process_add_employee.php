<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "company_db";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    $stmt = $conn->prepare("INSERT INTO employees (name, position, salary) VALUES (:name, :position, :salary)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':salary', $salary);
    $stmt->execute();

    header("Location: index.php");
    exit();

} catch (PDOException $e) {
    echo "Помилка додавання працівника: " . $e->getMessage();
} finally {
    $conn = null;
}
?>