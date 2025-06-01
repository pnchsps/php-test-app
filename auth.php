<?php
session_start();
$valid_password = "admin123";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["password"] === $valid_password) {
        $_SESSION["auth"] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Неверный пароль";
    }
}
?>
<form method="post">
    <h2>Вход администратора</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <input type="password" name="password" required>
    <button type="submit">Войти</button>
</form>