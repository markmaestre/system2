<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}

$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['increment_score'])) {
    $score++;
    $_SESSION['score'] = $score;
    echo $score;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ball Dodge Game</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            overflow: hidden;
            background-color: #f0f8ff;
        }

        .player {
            width: 50px;
            height: 50px;
            background-color: red;
            position: absolute;
            bottom: 10px;
            left: calc(50% - 25px);
        }

        .ball {
            width: 30px;
            height: 30px;
            background-color: blue;
            border-radius: 50%;
            position: absolute;
            top: 0;
        }

        #score {
            position: fixed;
            top: 10px;
            left: 10px;
            font-size: 18px;
        }

        .back-button {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div id="score">Score: <?php echo $score; ?></div>
    <div class="player" id="player"></div>

    <button class="back-button" onclick="window.location.href='coordination.php'">Back to Coordination Menu</button>

    <script>
        const player = document.getElementById('player');
        const playerWidth = 50;
        const windowWidth = window.innerWidth;
        let playerPosition = (windowWidth / 2) - (playerWidth / 2);

        document.addEventListener('mousemove', (event) => {
            playerPosition = event.clientX - (playerWidth / 2);
            if (playerPosition < 0) playerPosition = 0;
            if (playerPosition > windowWidth - playerWidth) playerPosition = windowWidth - playerWidth;
            player.style.left = playerPosition + 'px';
        });

        function createBall() {
            const ball = document.createElement('div');
            ball.classList.add('ball');
            ball.style.left = Math.random() * (windowWidth - 30) + 'px';
            document.body.appendChild(ball);

            let ballFallInterval = setInterval(() => {
                let ballTop = parseInt(ball.style.top) || 0;
                ball.style.top = (ballTop + 5) + 'px';

              
                if (ballTop >= window.innerHeight - 50 && 
                    playerPosition <= parseInt(ball.style.left) && 
                    playerPosition + 50 >= parseInt(ball.style.left)) {
                    clearInterval(ballFallInterval);
                    ball.remove();
                    alert("Game Over! Your score: " + document.getElementById('score').innerText.split(": ")[1]);
                    window.location.href = "game_over.php";
                }

            
                if (ballTop > window.innerHeight) {
                    clearInterval(ballFallInterval);
                    ball.remove();
                    incrementScore();
                }
            }, 50);
        }

        function incrementScore() {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('score').innerText = "Score: " + this.responseText;
                }
            };
            xhr.send('increment_score=true');
        }

        setInterval(createBall, 1000); 
    </script>
</body>
</html>
