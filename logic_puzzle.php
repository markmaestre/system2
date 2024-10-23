<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;
$message = '';


$questions = [
    [
        'question' => 'What is the capital of the Philippines?',
        'answers' => ['Manila', 'Quezon City', 'Cebu City'],
        'correct' => 0
    ],
    [
        'question' => 'What is the national flower of the Philippines?',
        'answers' => ['Sampaguita', 'Rafflesia', 'Orchid'],
        'correct' => 0
    ],
    [
        'question' => 'Which sea is located to the west of the Philippines?',
        'answers' => ['Philippine Sea', 'South China Sea', 'Sulu Sea'],
        'correct' => 1
    ],
    [
        'question' => 'Who is the national hero of the Philippines?',
        'answers' => ['Andres Bonifacio', 'Emilio Aguinaldo', 'José Rizal'],
        'correct' => 2
    ],
    [
        'question' => 'What is the official currency of the Philippines?',
        'answers' => ['Peso', 'Dollar', 'Yen'],
        'correct' => 0
    ],
    [
        'question' => 'Which festival is celebrated in Cebu City every January?',
        'answers' => ['Sinulog', 'Ati-Atihan', 'Pahiyas'],
        'correct' => 0
    ],
    [
        'question' => 'What is the largest island in the Philippines?',
        'answers' => ['Luzon', 'Mindanao', 'Visayas'],
        'correct' => 0
    ],
    [
        'question' => 'What is the national animal of the Philippines?',
        'answers' => ['Carabao', 'Philippine Eagle', 'Tamaraw'],
        'correct' => 1
    ],
    [
        'question' => 'Which historical event is celebrated on June 12?',
        'answers' => ['Philippine Independence Day', 'Bonifacio Day', 'National Heroes Day'],
        'correct' => 0
    ],
    [
        'question' => 'What is the official language of the Philippines?',
        'answers' => ['English', 'Tagalog', 'Both'],
        'correct' => 2
    ],
];


$currentIndex = isset($_SESSION['current_index']) ? $_SESSION['current_index'] : 0;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userAnswer = intval($_POST['user_answer']);
    $correctAnswer = $questions[$currentIndex]['correct'];
    
   
    if ($userAnswer === $correctAnswer) {
        $score++;
        $message = "Correct! Your score is now $score.";
    } else {
        $message = "Incorrect. The correct answer was: " . $questions[$currentIndex]['answers'][$correctAnswer] . ".";
    }
    
    $_SESSION['score'] = $score;


    $currentIndex++;
    if ($currentIndex >= count($questions)) {
       
        session_destroy(); 
        header("Location: end.php"); 
        exit();
    }
    
    $_SESSION['current_index'] = $currentIndex; 
} else {
    
    $_SESSION['current_index'] = 0; 
}

$currentQuestion = $questions[$currentIndex];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Philippines Trivia Game</title>
    <link rel="stylesheet" href="css/design.css">
</head>
<body>
    <div class="container">
        <h1>Philippines Trivia Game</h1>
        <p><?php echo $currentQuestion['question']; ?></p>
        <form method="POST">
            <?php foreach ($currentQuestion['answers'] as $index => $answer): ?>
                <label>
                    <input type="radio" name="user_answer" value="<?php echo $index; ?>" required>
                    <?php echo $answer; ?>
                </label>
                <br>
            <?php endforeach; ?>
            <button type="submit">Submit Answer</button>
        </form>
        <p><?php echo $message; ?></p>
        <p style="text-align:center">Your current score: <?php echo $score; ?></p>
        <a href="reasoning.php" class="btn btn-secondary mt-3">Back</a>
    </div>
</body>
</html>
