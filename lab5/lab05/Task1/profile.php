<?php
session_start();
require_once 'db_config.php';

if (!isset($pdo)) {
    die("Неможливо підключитися до бази даних. Перевірте файл db_config.php.");
}

// Перевірка авторизації
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Отримання даних користувача
$stmt_select = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt_select->bindParam(':id', $user_id);
$stmt_select->execute();
$user = $stmt_select->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Користувача не знайдено.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $phone = $_POST['phone'];

    $stmt_update = $pdo->prepare("UPDATE users SET first_name = :first_name, last_name = :last_name, birth_date = :birth_date, gender = :gender, city = :city, country = :country, phone = :phone WHERE id = :id");
    $stmt_update->bindParam(':first_name', $first_name);
    $stmt_update->bindParam(':last_name', $last_name);
    $stmt_update->bindParam(':birth_date', $birth_date);
    $stmt_update->bindParam(':gender', $gender);
    $stmt_update->bindParam(':city', $city);
    $stmt_update->bindParam(':country', $country);
    $stmt_update->bindParam(':phone', $phone);
    $stmt_update->bindParam(':id', $user_id);

    if ($stmt_update->execute()) {
        $success = "Дані профілю успішно оновлено.";
        // Оновлення даних користувача для відображення
        $stmt_select->execute();
        $user = $stmt_select->fetch(PDO::FETCH_ASSOC);
    } else {
        $error = "Помилка при оновленні профілю.";
    }
}
?>

<h1>Редагування профілю</h1>

<link rel="stylesheet" href="style1.css">

<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>

<?php if (isset($success)): ?>
    <p style="color: green;"><?php echo $success; ?></p>
<?php endif; ?>

<form action="" method="post">
    <div>
        <label for="first_name">Ім'я:</label>
        <input type="text" id="first_name" name="first_name" value="<?php echo $user['first_name']; ?>">
    </div>
    <div>
        <label for="last_name">Прізвище:</label>
        <input type="text" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>">
    </div>
    <div>
        <label for="birth_date">Дата народження:</label>
        <input type="date" id="birth_date" name="birth_date" value="<?php echo $user['birth_date']; ?>">
    </div>
    <div>
        <label for="gender">Стать:</label>
        <select id="gender" name="gender">
            <option value="male" <?php if ($user['gender'] === 'male') echo 'selected'; ?>>Чоловік</option>
            <option value="female" <?php if ($user['gender'] === 'female') echo 'selected'; ?>>Жінка</option>
            <option value="other" <?php if ($user['gender'] === 'other') echo 'selected'; ?>>Інше</option>
        </select>
    </div>
    <div>
        <label for="city">Місто:</label>
        <input type="text" id="city" name="city" value="<?php echo $user['city']; ?>">
    </div>
    <div>
        <label for="country">Країна:</label>
        <input type="text" id="country" name="country" value="<?php echo $user['country']; ?>">
    </div>
    <div>
        <label for="phone">Телефон:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $user['phone']; ?>">
    </div>
    <button type="submit">Зберегти зміни</button>
</form>

<p><a href="index.php">Назад на головну</a></p>
<p><a href="delete_profile.php">Видалити профіль</a></p>
<p><a href="logout.php">Вийти</a></p>