<?php
include('db.php');

$sql = "SELECT q.text AS question, a.text AS answer, a.is_correct
        FROM questions q
        JOIN answers a ON q.id = a.question_id
        ORDER BY q.id, a.id";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<div class='box'>";
    echo "<h2>Jautājumi un atbildes</h2>";

    $currentQuestion = null;

    while ($row = $result->fetch_assoc()) {

        if ($currentQuestion !== $row['question']) {
            echo "<p><strong>Jautājums:</strong> " . $row['question'] . "</p>";
            $currentQuestion = $row['question'];
        }

        echo "<p>Atbilde: " . $row['answer'] . " - Pareiza: " . ($row['is_correct'] ? 'Jā' : 'Nē') . "</p>";
    }

    echo "</div>";
} else {
    echo "Nav atrasts neviens jautājums ar atbildēm.";
}


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Eksamens - Jautājumi un atbildes</title>
</head>

<body>
    <div class="box">
        <h2>Jautājumi un atbildes</h2>
    </div>
</body>

</html>
