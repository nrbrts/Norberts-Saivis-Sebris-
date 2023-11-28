<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $questionText = $_POST["name"];
    $answer1Text = $_POST["1answer"];
    $answer2Text = $_POST["2answer"];
    $correctAnswer = $_POST["number"];

    $questionInsertQuery = "INSERT INTO questions (text) VALUES ('$questionText')";
    if ($conn->query($questionInsertQuery) === TRUE) {
        $questionId = $conn->insert_id;


        $answer1InsertQuery = "INSERT INTO answers (text, question_id, is_correct) VALUES ('$answer1Text', $questionId, " . ($correctAnswer == 1 ? "1" : "0") . ")";
        $answer2InsertQuery = "INSERT INTO answers (text, question_id, is_correct) VALUES ('$answer2Text', $questionId, " . ($correctAnswer == 2 ? "1" : "0") . ")";

        if ($conn->query($answer1InsertQuery) === TRUE && $conn->query($answer2InsertQuery) === TRUE) {
            echo "Data inserted successfully";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Eksamens - Jautājuma izveide</title>
</head>

<body>
    <div class="box">
        <h2>Jautajuma izveide</h2>

        <form action="create.php" method="post">
            Jautajums: <input type="text" name="name" required><br>
            1. Atbilde: <input type="text" name="1answer" required><br>
            2. Atbilde: <input type="text" name="2answer" required><br>
            <label for="number">Pareiza atbilde?</label>
            <input type="number" id="number" name="number" min="1" max="2" required>

            <input type="submit" value="Izveidot jautājumu">
        </form>
    </div>
</body>

</html>
