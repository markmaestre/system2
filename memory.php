<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Memory Games</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: skyblue;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
        }

        h1 {
            color: #007bff;
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        .game-option {
            margin: 20px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
            margin-bottom: 10px;
            font-size: 1.8rem;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            font-size: 1.1rem;
        }

        .back-btn {
            margin-top: 30px;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center"  style = color:red>Choose a Memory Game</h1>
        <div class="row">
          
            <div class="col-md-6 game-option">
                <h2>Memory Game 1</h2>
                <a class="btn btn-primary" href="game1.php">Easy  Start  </a><br>
                <button class="btn btn-info mt-2" data-bs-toggle="modal" data-bs-target="#guideGame1Modal">Guides</button>
            </div>

          
            <div class="col-md-6 game-option">
                <h2>Memory Game 2</h2>
                <a class="btn btn-primary" href="game2.php">Medium Start</a>
                <button class="btn btn-info mt-2" data-bs-toggle="modal" data-bs-target="#guideGame2Modal">Guides</button>
            </div>
        </div>

    
        <div class="back-btn">
            <a class="btn btn-secondary" href="user.php">Back to Dashboard</a>
        </div>
    </div>

    <div class="modal fade" id="guideGame1Modal" tabindex="-1" aria-labelledby="guideGame1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="guideGame1Label">Game 1 Guide</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Match all the card pairs to win. Click on two cards to reveal them. If they match, your score increases. If they don't, the cards will flip back. You win when you find all the pairs!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

   
    <div class="modal fade" id="guideGame2Modal" tabindex="-1" aria-labelledby="guideGame2Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="guideGame2Label">Game 2 Guide</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>In Game 2, the goal is to memorize the cards as quickly as possible. The faster you match the cards, the higher your score will be. Be careful not to waste time on wrong guesses!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
