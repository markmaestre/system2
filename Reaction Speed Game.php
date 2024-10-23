<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balance the Ball</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        canvas {
            border: 2px solid #333;
            margin-bottom: 20px;
        }
        .button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #0056b3;
        }
        #score {
            font-size: 20px;
            margin-bottom: 10px;
        }
        #message {
            margin-top: 20px;
            font-size: 18px;
            color: red;
        }
    </style>
</head>
<body>
    <div id="score">Score: 0</div>
    <canvas id="gameCanvas" width="400" height="400"></canvas>
    <button class="button" onclick="goBack()">Back</button>
    <div id="message"></div>

    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');

        const paddleWidth = 100;
        const paddleHeight = 10;
        let paddleX = (canvas.width - paddleWidth) / 2;

        const ballRadius = 10;
        let balls = [{
            x: canvas.width / 2,
            y: canvas.height - 30,
            dx: 2,
            dy: -2
        }];

        let rightPressed = false;
        let leftPressed = false;
        let score = 0;
        let gameOver = false;
        let speedIncreaseInterval = 10000; 

        function drawPaddle() {
            ctx.beginPath();
            ctx.rect(paddleX, canvas.height - paddleHeight, paddleWidth, paddleHeight);
            ctx.fillStyle = "#007bff";
            ctx.fill();
            ctx.closePath();
        }

        function drawBall(ball) {
            ctx.beginPath();
            ctx.arc(ball.x, ball.y, ballRadius, 0, Math.PI * 2);
            ctx.fillStyle = "#007bff";
            ctx.fill();
            ctx.closePath();
        }

        function movePaddle() {
            if (rightPressed && paddleX < canvas.width - paddleWidth) {
                paddleX += 7;
            }
            if (leftPressed && paddleX > 0) {
                paddleX -= 7;
            }
        }

        function updateBall(ball) {
            if (ball.x + ball.dx > canvas.width - ballRadius || ball.x + ball.dx < ballRadius) {
                ball.dx = -ball.dx;
            }
            if (ball.y + ball.dy < ballRadius) {
                ball.dy = -ball.dy;
            } else if (ball.y + ball.dy > canvas.height - ballRadius) {
                if (ball.x > paddleX && ball.x < paddleX + paddleWidth) {
                    ball.dy = -ball.dy;
                    score++;
                    document.getElementById('score').innerText = "Score: " + score;
                } else {
                    gameOver = true;
                    document.getElementById('message').innerText = "Game Over! Try Again!";
                    return;
                }
            }

            ball.x += ball.dx;
            ball.y += ball.dy;
        }

        function draw() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            drawPaddle();
            movePaddle();

            balls.forEach(ball => {
                drawBall(ball);
                updateBall(ball);
            });

            if (!gameOver) {
                requestAnimationFrame(draw);
            }
        }

        setInterval(() => {
            if (!gameOver) {
                balls.push({
                    x: canvas.width / 2,
                    y: canvas.height - 30,
                    dx: (Math.random() * 4 - 2), 
                    dy: -2 
                });
            }
        }, 15000);

        setInterval(() => {
            if (!gameOver) {
                balls.forEach(ball => {
                    ball.dx *= 1.2;
                    ball.dy *= 1.2;
                });
            }
        }, speedIncreaseInterval);

        document.addEventListener("keydown", (e) => {
            if (e.key == "Right" || e.key == "ArrowRight") {
                rightPressed = true;
            } else if (e.key == "Left" || e.key == "ArrowLeft") {
                leftPressed = true;
            }
        });

        document.addEventListener("keyup", (e) => {
            if (e.key == "Right" || e.key == "ArrowRight") {
                rightPressed = false;
            } else if (e.key == "Left" || e.key == "ArrowLeft") {
                leftPressed = false;
            }
        });

        function goBack() {
            window.location.href = "coordination.php"; 
        }

        draw();
    </script>
</body>
</html>
