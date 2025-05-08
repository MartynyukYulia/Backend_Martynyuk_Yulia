<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Додати новий товар</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

<h1>Додати новий товар</h1>
<form action="insert_process.php" method="post">
    <div>
        <label for="name">Назва товару:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="cost">Ціна:</label>
        <input type="number" id="cost" name="cost" required>
    </div>
    <div>
        <label for="kol">Кількість:</label>
        <input type="number" id="kol" name="kol" required>
    </div>
    <div>
        <label for="note">Примітка:</label>
        <input type="text" id="note" name="note">
    </div>
    <button type="submit">Додати товар</button>
</form>

<a href="index.php" class="back-link">Назад до списку товарів</a>

</body>
</html>