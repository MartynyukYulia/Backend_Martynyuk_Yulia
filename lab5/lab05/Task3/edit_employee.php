<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагувати працівника</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
<h1>Редагувати працівника</h1>
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
        $stmt = $conn->prepare("SELECT id, name, position, salary FROM employees WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($employee) {
            ?>
            <form action="process_edit_employee.php" method="post">
                <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
                <label for="name">Ім'я:</label>
                <input type="text" id="name" name="name" value="<?php echo $employee['name']; ?>" required>

                <label for="position">Посада:</label>
                <input type="text" id="position" name="position" value="<?php echo $employee['position']; ?>">

                <label for="salary">Зарплата:</label>
                <input type="number" id="salary" name="salary" step="0.01" value="<?php echo $employee['salary']; ?>">

                <button type="submit">Зберегти зміни</button>
            </form>
            <a href="index.php" class="back-link">Назад до списку працівників</a>
            <?php
        } else {
            echo "<p>Працівника з таким ID не знайдено.</p>";
        }
    } else {
        echo "<p>Некоректний ID працівника.</p>";
    }

} catch (PDOException $e) {
    echo "Помилка підключення до бази даних: " . $e->getMessage();
} finally {
    $conn = null;
}
?>
</body>
</html>