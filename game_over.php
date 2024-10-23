<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

$finalScore = isset($_SESSION['score']) ? $_SESSION['score'] : 0;

session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Over</title>
    <link rel="stylesheet" href="css/design.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #dc3545;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 20px;
        }

        .button {
            padding: 10px 20px;
            background-color: #007bff; 
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Game Over</h1>
        <p>Your final score: <?php echo $finalScore; ?></p>
        <p>Thank you for playing!</p>
        <a href="home.php" class="button">Back to Home</a>
        <a href="attention.php" class="button">Play Again</a>
    </div>
</body>
</html>
