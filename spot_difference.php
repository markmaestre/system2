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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_score'])) {
    $_SESSION['score'] = 0;
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Follow the Dot Game</title>
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

        .dot {
            width: 30px;
            height: 30px;
            background-color: blue;
            border-radius: 50%;
            position: absolute;
            cursor: pointer;
            transition: transform 0.5s ease, opacity 0.5s ease;
        }

        .hit {
            background-color: red !important; 
            transform: scale(2); 
            opacity: 0; 
        }

        #gameArea {
            position: relative;
            width: 100%;
            height: 80vh;
            overflow: hidden;
            display: none; 
        }

        .hidden {
            display: none;
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
    <h1>Follow the Dot Game</h1>
    <p>Score: <span id="score"><?php echo $score; ?></span></p>
    <p>Time left: <span id="timeLeft">60</span> seconds</p>

    <div id="gameArea"></div>

    <div id="finalMessage" class="hidden">
        <h2>Congratulations! You got <span id="finalScore"></span> score!</h2>
    </div>

    <a href="attention.php" class="btn-back">Back to Attention Menu</a> 

    <script>
        let timer;
        let timeLeft = 10; 

      
        function startGame() {
            document.getElementById('gameArea').style.display = 'block';
            timer = setInterval(updateTimer, 1000);
            setInterval(createDot, 1000);
        }

       
        function updateTimer() {
            timeLeft--;
            document.getElementById('timeLeft').innerText = timeLeft;

            if (timeLeft === 0) {
                endGame(); 
            }
        }

        function endGame() {
            clearInterval(timer);
            document.getElementById('gameArea').style.display = 'none';

           
            let finalScore = document.getElementById('score').innerText;
            document.getElementById('finalScore').innerText = finalScore;
            document.getElementById('finalMessage').classList.remove('hidden');

          
            resetScore();
        }

        function createDot() {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            dot.style.left = Math.random() * (window.innerWidth - 30) + 'px'; 
            dot.style.top = Math.random() * (window.innerHeight - 30) + 'px'; 
            document.getElementById('gameArea').appendChild(dot);

            dot.addEventListener('click', () => {
                dot.classList.add('hit');
                setTimeout(() => {
                    dot.remove(); 
                }, 500); 

                incrementScore();
            });

       
            setTimeout(() => {
                if (document.body.contains(dot)) {
                    dot.remove();
                }
            }, 1000);
        }

        function incrementScore() {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true); 
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    document.getElementById('score').innerText = this.responseText; 
                }
            };
            xhr.send('increment_score=true'); 
        }

        function resetScore() {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('reset_score=true'); 
        }

        
        window.onload = function() {
            startGame();
        };
    </script>
</body>
</html>
