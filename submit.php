<?php
$questions = json_decode(file_get_contents("data/questions.json"), true);
$answers = $_POST["answers"] ?? [];
$username = trim($_POST["username"] ?? "");

function calculateScore($userAnswers, $questions) {
    $score = 0;
    foreach ($questions as $i => $q) {
        $correct = $q["correct"];
        $user = $userAnswers[$i] ?? [];
        if ($q["type"] === "radio") $user = [$user];
        sort($user); sort($correct);
        if ($user == $correct) $score++;
    }
    return $score;
}

$score = calculateScore($answers, $questions);
$total = count($questions);
$percent = round(($score / $total) * 100);
$data = [
    "username" => $username,
    "score" => $score,
    "percent" => $percent,
    "date" => date("Y-m-d H:i:s")
];

$results = file_exists("storage/results.json") ? json_decode(file_get_contents("storage/results.json"), true) : [];
$results[] = $data;
file_put_contents("storage/results.json", json_encode($results, JSON_PRETTY_PRINT));

echo "<h1>Результаты</h1>";
echo "<p>Пользователь: " . htmlspecialchars($username) . "</p>";
echo "<p>Правильных ответов: $score из $total</p>";
echo "<p>Процент: $percent%</p>";
?>