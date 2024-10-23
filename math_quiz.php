<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;
$message = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userAnswer = intval($_POST['user_answer']);
    $correctAnswer = intval($_SESSION['correct_answer']);
    
    if ($userAnswer == $correctAnswer) {
        $score++;
        $message = "Correct! Your score is now $score.";
    } else {
        $message = "Incorrect. The correct answer was $correctAnswer.";
    }
    
    $_SESSION['score'] = $score;

    generateQuestion();
} else {
    generateQuestion();
}

function generateQuestion() {
    $operations = ['+', '-', '*', '/'];
    $num1 = rand(1, 10);
    $num2 = rand(1, 10);
    $operation = $operations[array_rand($operations)];

  
    if ($operation == '/' && $num2 == 0) {
        $num2 = 1; 
    }

    $_SESSION['correct_answer'] = eval("return $num1 $operation $num2;"); 
    $_SESSION['question'] = "$num1 $operation $num2";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Math Quiz</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 50px auto;
        }
        h1 {
            color: #007bff;
        }
        .btn {
            width: 100%;
        }
        .message {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Math Quiz</h1>
        <p><?php echo $_SESSION['question']; ?></p>
        <form method="POST">
            <input type="number" name="user_answer" class="form-control" placeholder="Your answer" required>
            <button type="submit" class="btn btn-primary mt-3">Submit Answer</button>
        </form>
        <div class="message"><?php echo $message; ?></div>
        <p style="text-align:center">Your current score: <?php echo $score; ?></p>
        <a href="reasoning.php" class="btn btn-secondary mt-3">Back</a> 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
