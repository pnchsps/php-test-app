<?php
session_start();
if (!isset($_SESSION["auth"])) {
    header("Location: auth.php");
    exit;
}
$results = json_decode(file_get_contents("storage/results.json"), true);
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Результаты</title></head>
<body>
<h1>Результаты пользователей</h1>
<table border="1">
    <tr><th>Имя</th><th>Баллы</th><th>Дата</th></tr>
    <?php foreach ($results as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r["username"]) ?></td>
            <td><?= $r["percent"] ?>%</td>
            <td><?= $r["date"] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="logout.php">Выйти</a>
</body>
</html>