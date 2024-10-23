<?php
session_start();
$highScore = isset($_SESSION['high_score_game1']) ? $_SESSION['high_score_game1'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Memory Game 1</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: skyblue;
        }
        .card {
            cursor: pointer;
            width: 100px;
            height: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2rem;
            background-color: white;
            border: 2px solid #d96b7c;
            margin: 10px;
        }
        #score {
            font-size: 1.5rem;
            margin-top: 20px;
        }
        #backButton {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h1>Memory Game 1</h1>
        <h2>Your High Score: <?php echo $highScore; ?></h2>

        <div id="gameArea" class="d-flex flex-wrap justify-content-center">
           
        </div>
        <div id="score">Score: 0</div>

        <div>
            <button class="btn btn-primary mt-3" onclick="resetGame()">Reset Game</button>
        </div>

        <div id="backButton">
            <a href="memory.php" class="btn btn-secondary">Back to Game Menu</a>
        </div>
    </div>

    <script>
        const cards = ['A', 'B', 'C', 'D', 'A', 'B', 'C', 'D'];
        let score = 0;
        let cardValues = [];
        let cardIds = [];

        // Shuffle cards
        cards.sort(() => 0.5 - Math.random());

        function createBoard() {
            const gameArea = document.getElementById('gameArea');
            for (let i = 0; i < cards.length; i++) {
                const card = document.createElement('div');
                card.className = 'card';
                card.dataset.id = i;
                card.innerHTML = '?';
                card.addEventListener('click', flipCard);
                gameArea.appendChild(card);
            }
        }

        function flipCard() {
            const selected = this;
            const selectedId = selected.dataset.id;
            cardValues.push(cards[selectedId]);
            cardIds.push(selectedId);
            selected.innerHTML = cards[selectedId];

            if (cardValues.length === 2) {
                setTimeout(checkMatch, 1000);
            }
        }

        function checkMatch() {
            const cardsElements = document.querySelectorAll('.card');
            const [firstValue, secondValue] = cardValues;
            const [firstId, secondId] = cardIds;

            if (firstValue === secondValue && firstId !== secondId) {
                score++;
                document.getElementById('score').innerText = `Score: ${score}`;
            } else {
                cardsElements[firstId].innerHTML = '?';
                cardsElements[secondId].innerHTML = '?';
            }

            cardValues = [];
            cardIds = [];

            if (score === 4) { 
                alert('You won! Your score: ' + score);
                updateHighScore();
                window.location.href = 'memory.php'; 
            }
        }

        function updateHighScore() {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_high_score.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('score=' + score);
        }

        function resetGame() {
            score = 0;
            document.getElementById('score').innerText = 'Score: 0';
            document.getElementById('gameArea').innerHTML = '';
            createBoard();
        }

        window.onload = createBoard;
    </script>
</body>
</html>
