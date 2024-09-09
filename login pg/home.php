<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
      $_SESSION['msg'] = "You must log in first";
      header('location: login.php');
  }
  if (isset($_GET['logout'])) {
      session_destroy();
      unset($_SESSION['username']);
      header("location: login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Puzzle Game Homepage</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .background-image {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url("./img/welcome.jpg");
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      filter: blur(1.5px);
      z-index: -1;
    }

    header {
      background-color: rgba(0, 0, 0, 0.5);
      color: #fff;
      padding: 20px;
      text-align: center;
    }

    h1 {
      margin: 0;
    }

    .content-container {
      position: relative;
      z-index: 1;
      max-height: calc(100vh - 92px);
      overflow-y: auto;
      padding-bottom: 20px;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      flex-wrap: wrap;
    }

    .puzzle {
      margin: 20px;
      padding: 20px;
      border: 2px solid #333;
      text-align: center;
      cursor: pointer;
      transition: all 0.3s ease;
      background-color: rgba(255, 255, 255, 0.8);
      max-width: 300px;
    }

    .puzzle:hover {
      background-color: rgba(240, 240, 240, 0.8);
    }

    .puzzle-image {
      max-width: 100%;
      height: auto;
    }

    .puzzle-description {
      margin-bottom: 20px;
      text-align: center;
    }
    
    .back-button, .logout-button {
      position: fixed;
      top: 20px;
      font-size: 24px;
      cursor: pointer;
      background-color: transparent;
      color: #ffffff;
      border: none;
      transition: color 0.3s ease;
    }

    .back-button {
      left: 20px;
    }

    .logout-button {
      right: 20px;
    }

    .back-button:hover, .logout-button:hover {
      color: #ffffff;
    }
  </style>
</head>
<body>
  <div class="background-image"></div>
  <header>
    <h1>Welcome to Escape Room Game</h1>
  </header>
  <div class="content-container">
    <div class="container">
      <div class="puzzle" id="story1">
        <img src="./img/stry1.jpeg" alt="Puzzle Set 1" class="puzzle-image">
        <h2>"The Treasure Hunter's Quest"</h2>
        <p class="puzzle-description">In a forgotten castle atop an abandoned hill, a brave treasure hunter discovers an old map leading to hidden riches. His journey begins with a river, where a lone tower rises from the water. Inside the tower, he must solve puzzles to unlock a secret locker wall. After overcoming these challenges, he finally finds a gold treasure box, marking the end of his thrilling adventure.</p>
        <button onclick="startPuzzle('index.html')">Play</button>
      </div>
      <div class="puzzle" id="story2">
        <img src="./img/stry2.jpeg" alt="Puzzle Set 2" class="puzzle-image">
        <h2>"The Forgotten Asylum"</h2>
        <p class="puzzle-description">Urban explorer Alex delves into a haunted, abandoned hospital to uncover its dark secrets. As Alex navigates eerie corridors and solves cryptic puzzles, they uncover a hidden lab where unethical experiments were conducted. Venturing deeper, they face restless spirits and discover the asylum's true purpose: dark rituals aimed at harnessing supernatural powers. In a final showdown, Alex must perform a counter-ritual to free the spirits and escape the collapsing asylum.</p>
        <button onclick="startPuzzle('index2.html')">Play</button>
      </div>
      <div class="puzzle" id="story3">
        <img src="./img/stry3.png" alt="Puzzle Set 3" class="puzzle-image">
        <h2>"The Haunting of Ravenswood Manor"</h2>
        <p class="puzzle-description">This story tells the tale of a cursed estate where the vengeful spirit of Madame Isabella seeks retribution. Paranormal investigators unwittingly unleash her during a séance, prompting a desperate race to uncover secrets hidden in haunted corridors and forbidden wings. As ghostly apparitions and spectral puzzles unfold, they confront the spirit in a climactic showdown, banishing her but leaving behind echoes of a haunting past in the lingering shadows of Ravenswood Manor.</p>
        <button onclick="startPuzzle('index3.html')">Play</button>
      </div>
    </div>
  </div>
  <button class="back-button" onclick="goBack()">&#8592; Back</button>
  <button class="logout-button" onclick="logout()">Logout</button>

  <script>
    function goBack() {
      window.location.href = "index1.html";
    }

    function startPuzzle(puzzleSet) {
      window.location.href = puzzleSet;
    }

    function logout() {
      window.location.href = "home.php?logout='1'";
    }
  </script>
</body>
</html>
