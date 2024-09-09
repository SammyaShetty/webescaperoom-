<?php 
session_start();
include('server.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process registration form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    
    // Your registration logic here
    $errors = array(); // Initialize error array
    
    // Validate form inputs
    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) { array_push($errors, "The two passwords do not match"); }
    
    // Check if the user already exists
    $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "Email already exists");
        }
    }
    
    // Register user if no errors
    if (count($errors) == 0) {
        $password = md5($password_1); // Encrypt the password before saving in the database

        $query = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
        mysqli_query($db, $query);
        
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('Location: home.php');
        exit();
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
    <h2>Register</h2>
  </div>
   
  <form method="post" action="register.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>">
    </div>
    <div class="input-group">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="input-group">
        <label>Password</label>
        <input type="password" name="password_1">
    </div>
    <div class="input-group">
        <label>Confirm password</label>
        <input type="password" name="password_2">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="reg_user">Register</button>
    </div>
    <p>
        Already a member? <a href="login.php">Sign in</a>
    </p>
  </form>
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
  backdrop-filter: blur(10px); /* Apply the blur effect */
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
  background: white; /* Ensure input background is clear */
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
</body>
</html>
