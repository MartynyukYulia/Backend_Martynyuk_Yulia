<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Додати нового працівника</title>
    <link rel="stylesheet" href="style3.css">
</head>
<body>
<h1>Додати нового працівника</h1>
<form action="process_add_employee.php" method="post">
    <label for="name">Ім'я:</label>
    <input type="text" id="name" name="name" required>

    <label for="position">Посада:</label>
    <input type="text" id="position" name="position">

    <label for="salary">Зарплата:</label>
    <input type="number" id="salary" name="salary" step="0.01">

    <button type="submit">Додати працівника</button>
</form>
<a href="index.php" class="back-link">Назад до списку працівників</a>
</body>
</html>