<?php
require_once 'db_config.php';


if (!isset($pdo)) {
    die("Неможливо підключитися до бази даних. Перевірте файл db_config.php.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);

    if (empty($login) || empty($password) || empty($email)) {
        $error = "Будь ласка, заповніть усі обов'язкові поля.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Невірний формат email.";
    } elseif (strlen($password) < 6) {
        $error = "Пароль повинен містити щонайменше 6 символів.";
    } else {
        $stmt_check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE login = :login OR email = :email");
        $stmt_check->bindParam(':login', $login);
        $stmt_check->bindParam(':email', $email);
        $stmt_check->execute();

        if ($stmt_check->fetchColumn() > 0) {
            $error = "Користувач з таким логіном або email вже існує.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $stmt_insert = $pdo->prepare("INSERT INTO users (login, password, email, first_name, last_name, birth_date, gender, city, country, phone) VALUES (:login, :password, :email, :first_name, :last_name, :birth_date, :gender, :city, :country, :phone)");
            $stmt_insert->bindParam(':login', $login);
            $stmt_insert->bindParam(':password', $hashed_password);
            $stmt_insert->bindParam(':email', $email);
            $stmt_insert->bindParam(':first_name', $_POST['first_name']);
            $stmt_insert->bindParam(':last_name', $_POST['last_name']);
            $stmt_insert->bindParam(':birth_date', $_POST['birth_date']);
            $stmt_insert->bindParam(':gender', $_POST['gender']);
            $stmt_insert->bindParam(':city', $_POST['city']);
            $stmt_insert->bindParam(':country', $_POST['country']);
            $stmt_insert->bindParam(':phone', $_POST['phone']);

            if ($stmt_insert->execute()) {
                $success = "Реєстрація успішна! Тепер ви можете <a href='index.php'>увійти</a>.";
            } else {
                $error = "Помилка при реєстрації. Будь ласка, спробуйте ще раз.";
            }
        }
    }
}
?>

    <h1>Реєстрація</h1>

    <link rel="stylesheet" href="style1.css">
<?php if (isset($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>

<?php if (isset($success)): ?>
    <p style="color: green;"><?php echo $success; ?></p>
<?php else: ?>
    <form action="" method="post">
        <div>
            <label for="login">Логін:</label>
            <input type="text" id="login" name="login" value="<?php echo isset($_POST['login']) ? $_POST['login'] : ''; ?>" required>
        </div>
        <div>
            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required>
        </div>
        <div>
            <label for="first_name">Ім'я:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : ''; ?>">
        </div>
        <div>
            <label for="last_name">Прізвище:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>">
        </div>
        <div>
            <label for="birth_date">Дата народження:</label>
            <input type="date" id="birth_date" name="birth_date" value="<?php echo isset($_POST['birth_date']) ? $_POST['birth_date'] : ''; ?>">
        </div>
        <div>
            <label for="gender">Стать:</label>
            <select id="gender" name="gender">
                <option value="male" <?php if (isset($_POST['gender']) && $_POST['gender'] === 'male') echo 'selected'; ?>>Чоловік</option>
                <option value="female" <?php if (isset($_POST['gender']) && $_POST['gender'] === 'female') echo 'selected'; ?>>Жінка</option>
                <option value="other" <?php if (isset($_POST['gender']) && $_POST['gender'] === 'other') echo 'selected'; ?>>Інше</option>
            </select>
        </div>
        <div>
            <label for="city">Місто:</label>
            <input type="text" id="city" name="city" value="<?php echo isset($_POST['city']) ? $_POST['city'] : ''; ?>">
        </div>
        <div>
            <label for="country">Країна:</label>
            <input type="text" id="country" name="country" value="<?php echo isset($_POST['country']) ? $_POST['country'] : ''; ?>">
        </div>
        <div>
            <label for="phone">Телефон:</label>
            <input type="text" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>">
        </div>
        <button type="submit">Зареєструватися</button>
    </form>
    <p><a href="index.php">Назад на головну</a></p>
<?php endif; ?>