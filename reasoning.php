<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reasoning Games</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #e0f7fa;
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
            color: #d32f2f; 
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        .game-option {
            margin: 20px 0;
            padding: 20px;
            background-color: #f9fbe7; 
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #1976d2;
            margin-bottom: 10px;
            font-size: 1.8rem;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #555; 
        }

        .btn {
            padding: 10px 20px;
            font-size: 1.1rem;
        }

        .back-btn {
            margin-top: 30px;
        }

        .modal-header {
            background-color: #1976d2; 
            color: white; 
        }

        .modal-body {
            font-size: 1.1rem; 
        }

        .modal-footer .btn {
            background-color: #d32f2f; 
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Choose a Reasoning Game</h1>

        <div class="game-option">
        
            <h2>Game 1: Math Quiz</h2>
            <a class="btn btn-primary" href="math_quiz.php">Play Game 1</a>
            <button class="btn btn-info mt-2" data-bs-toggle="modal" data-bs-target="#guideGame1Modal">Guides</button>
        </div>

        <div class="game-option">
          
            <h2>Game 2: Philippine Trivia</h2>
            <a class="btn btn-primary" href="logic_puzzle.php">Play Game 2</a>
            <button class="btn btn-info mt-2" data-bs-toggle="modal" data-bs-target="#guideGame2Modal">Guides</button>
        </div>

        <div class="back-btn">
        
            <a class="btn btn-secondary" href="user.php">Back to Dashboard</a>
        </div>
    </div>

    <div class="modal fade" id="guideGame1Modal" tabindex="-1" aria-labelledby="guideGame1Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="guideGame1Label">Game 1 Guide: Math Quiz</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Solve the given math problems within the time limit. Choose the correct answers to score points. Aim for a high score!</p>
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
                    <h5 class="modal-title" id="guideGame2Label">Game 2 Guide: Philippine Trivia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Answer the trivia questions correctly to score points. The faster you answer, the higher your score will be. Test your knowledge of Philippine history!</p>
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
