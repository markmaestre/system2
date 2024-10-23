<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}


$cards = isset($_SESSION['cards']) ? $_SESSION['cards'] : [];
$flippedCards = isset($_SESSION['flippedCards']) ? $_SESSION['flippedCards'] : [];
$matches = isset($_SESSION['matches']) ? $_SESSION['matches'] : 0;
$matchedCards = isset($_SESSION['matchedCards']) ? $_SESSION['matchedCards'] : [];


if (empty($cards)) {
    $cardValues = range(1, 8); 
    $cards = array_merge($cardValues, $cardValues);
    shuffle($cards);
    $_SESSION['cards'] = $cards;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cardIndex = intval($_POST['card_index']);
    if (!in_array($cardIndex, $flippedCards) && !in_array($cardIndex, $matchedCards)) {
        $flippedCards[] = $cardIndex;
        $_SESSION['flippedCards'] = $flippedCards;

        if (count($flippedCards) == 2) {
            if ($cards[$flippedCards[0]] == $cards[$flippedCards[1]]) {
                $matches++;
                $_SESSION['matches'] = $matches;
                $matchedCards = array_merge($matchedCards, $flippedCards);
                $_SESSION['matchedCards'] = $matchedCards;
            }
        
            $_SESSION['flippedCards'] = [];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Card Game</title>
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
            padding: 20px;
        }

        .game-container {
            display: grid;
            grid-template-columns: repeat(4, 100px);
            gap: 15px;
            justify-content: center;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 10px;
            font-size: 2em;
            color: #007bff;
        }

        p {
            font-size: 1.2em;
            margin: 5px 0 20px;
        }

        .card {
            width: 100px;
            height: 100px;
            background-color: #6c757d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .card:hover {
            background-color: #5a6268;
        }

        .flipped {
            background-color: #ffc107;
            color: #fff;
        }

        .matched {
            background-color: #28a745;
            color: #fff;
            cursor: default;
        }

        .btn-back {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1.2em;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="game-container">
        <h1>Memory Card Game</h1>
        <p>Matches found: <?php echo $matches; ?></p>
        <?php foreach ($cards as $index => $value): ?>
            <form method="POST" style="display: inline;">
                <input type="hidden" name="card_index" value="<?php echo $index; ?>">
                <button type="submit" class="card 
                    <?php echo in_array($index, $flippedCards) || in_array($index, $matchedCards) ? 'flipped' : ''; ?>
                    <?php echo in_array($index, $matchedCards) ? 'matched' : ''; ?>">
                    <?php echo in_array($index, $flippedCards) || in_array($index, $matchedCards) ? $value : '?'; ?>
                </button>
            </form>
        <?php endforeach; ?>
    </div>

    <a href="memory.php" class="btn-back">Back to Game Menu</a>

    <script>
       
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            card.addEventListener('click', function() {
                setTimeout(() => {
                    card.classList.add('flipped');
                }, 100);
            });
        });
    </script>
</body>
</html>
