<?php
session_start();

if (isset($_POST['score']) && isset($_POST['game'])) {
    $score = intval($_POST['score']);
    $game = intval($_POST['game']);

   
    if ($game === 1) {
        if (!isset($_SESSION['high_score_game1']) || $score > $_SESSION['high_score_game1']) {
            $_SESSION['high_score_game1'] = $score; 
        }
    }
   
    if ($game === 2) {
        if (!isset($_SESSION['high_score_game2']) || $score > $_SESSION['high_score_game2']) {
            $_SESSION['high_score_game2'] = $score;
        }
    }
    echo json_encode(['status' => 'success']);
}
?>
