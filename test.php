<?php
$questions = json_decode(file_get_contents("data/questions.json"), true);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Тест</title>
</head>
<body>
    <h1>Пройдите тест</h1>
    <form action="submit.php" method="post">
        <label>Введите ваше имя:
            <input type="text" name="username" required>
        </label><br><br>
        <?php foreach ($questions as $index => $q): ?>
            <fieldset>
                <legend><?= htmlspecialchars($q["question"]) ?></legend>
                <?php foreach ($q["options"] as $option): ?>
                    <label>
                        <input type="<?= $q["type"] === "checkbox" ? "checkbox" : "radio" ?>"
                               name="<?= $q["type"] === "checkbox" ? "answers[$index][]" : "answers[$index]" ?>"
                               value="<?= htmlspecialchars($option) ?>">
                        <?= htmlspecialchars($option) ?>
                    </label><br>
                <?php endforeach; ?>
            </fieldset><br>
        <?php endforeach; ?>
        <button type="submit">Завершить</button>
    </form>
</body>
</html>