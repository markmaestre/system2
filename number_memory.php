<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

$random_number = isset($_SESSION['random_number']) ? $_SESSION['random_number'] : '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_input = $_POST['user_input'];
    
    if ($user_input == $random_number) {
        $message = "Correct! You remembered the number.";
    } else {
        $message = "Incorrect. The correct number was: " . $random_number;
    }
    
    $_SESSION['random_number'] = '';
} else {
   
    $random_number = strval(rand(10000, 99999)); 
    $_SESSION['random_number'] = $random_number;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Number Memory Test</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .game-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #007bff;
        }
        h2 {
            font-size: 48px;
            color: #343a40;
        }
        .message {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 20px;
        }
        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn-custom:hover {
            background-color: #0056b3;
        }
        .number-container {
            padding: 15px;
            background-color: #f0f8ff;
            border: 2px dashed #007bff;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="game-container">
        <h1>Number Memory Test</h1>

        <?php if ($_SERVER['REQUEST_METHOD'] != 'POST' && $random_number != ''): ?>
            <p class="message">Memorize this number:</p>
            <div class="number-container">
                <h2 id="number"><?php echo $random_number; ?></h2>
            </div>
            <p class="text-muted">The number will disappear in 3 seconds. Prepare yourself!</p>

            <script>
                setTimeout(function() {
                    document.getElementById('number').style.display = 'none';
                }, 3000);
            </script>
        <?php else: ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>

        <?php if ($_SERVER['REQUEST_METHOD'] != 'POST'): ?>
            <form method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" name="user_input" placeholder="Enter the number" required>
                </div>
                <button type="submit" class="btn btn-custom">Submit</button>
            </form>
        <?php else: ?>
            <a href="number_memory.php" class="btn btn-custom">Try Again</a>
        <?php endif; ?>
 <br>
        <a href="attention.php" class="btn btn-custom">Back to Attention Menu</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
