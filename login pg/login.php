<?php 
session_start();
include('server.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process login form
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Your login logic here
    $errors = array(); // Initialize error array
    
    // Validate form inputs
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($password)) { array_push($errors, "Password is required"); }
    
    if (count($errors) == 0) {
        $password = md5($password); // Encrypt the password before comparing with the database
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('Location: home.php');
            exit();
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  
</head>
<body>
<h1 style="color: white; text-align: center;">Welcome To Escape Room Game</h1>
  <div class="header">
    <h2>Login</h2>
  </div>
   
  <form method="post" action="login.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" >
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="login_user">Login</button>
    </div>
    <p>
        Not yet a member? <a href="register.php">Sign up</a>
    </p>
  </form>
  <head>
 
  <style>
  * {
    margin: 0px;
    padding: 0px;
  }

  body {
    margin: 0;
    padding: 0;
    background-image: url("./img/loginpg.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    font-family: Verdana, Tahoma, sans-serif;
    height: 100vh;
    overflow: hidden;
  }

  .header {
    width: 30%;
    margin: 50px auto 0px;
    color: white;
    text-align: center;
    border: 1px solid #B0C4DE;
    border-bottom: none;
    border-radius: 10px 10px 0px 0px;
    padding: 20px;
  }

  form, .content {
    width: 30%;
    margin: 0px auto;
    padding: 20px;
    border: 1px solid #B0C4DE;
    border-radius: 0px 0px 10px 10px;
    background: rgba(255, 255, 255, 0.5);
    backdrop-filter: blur(10px);
  }

  .input-group {
    margin: 10px 0px 10px 0px;
  }

  .input-group label {
    display: block;
    text-align: left;
    margin: 3px;
  }

  .input-group input {
    height: 30px;
    width: 93%;
    padding: 5px 10px;
    font-size: 16px;
    border-radius: 5px;
    border: 1px solid gray;
    background: white;
  }

  .btn {
    padding: 10px;
    font-size: 15px;
    color: white;
    background: #1a1919;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .error {
    width: 92%;
    margin: 0px auto;
    padding: 10px;
    border: 1px solid #a94442;
    color: #a94442;
    background: #f2dede;
    border-radius: 5px;
    text-align: left;
  }

  .success {
    color: #3c763d;
    background: #dff0d8;
    border: 1px solid #3c763d;
    margin-bottom: 20px;
  }
  </style>
</head>
</body>
</html>
