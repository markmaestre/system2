<?php
session_start();


$resourceExists = true;

if (!$resourceExists) {
    header("Location: 404.php");
    exit();
}

$conn = mysqli_connect('localhost', 'root', '', 'maestre') or die('Connection failed');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    
    $admin_query = "SELECT * FROM admins WHERE username = ?";
    $stmt = mysqli_prepare($conn, $admin_query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $admin_result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($admin_result) > 0) {
        $admin = mysqli_fetch_assoc($admin_result);
        if (password_verify($password, $admin['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = 'admin';
            header("Location: dashboard.php");
            exit();
        }
    } else {
       
        $user_query = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $user_query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $user_result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($user_result) > 0) {
            $user = mysqli_fetch_assoc($user_result);
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['role'];
                header("Location: user.php");
                exit();
            }
        }
        $error_message = "Invalid username or password.";
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BrainGym</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, white, skyblue);
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .header {
            display: flex;
            align-items: center;
            padding: 20px 20px;
            width: 100%;
            background: linear-gradient(to right, white, skyblue);
        }
        .header img {
            height: 60px;
            margin-right: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .module-title {
            text-align: center;
            margin: 70px 0 10px;
            font-size: 32px;
            color: #333;
        }
        .login-container {
            width: 400px; 
            padding: 60px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container h3 {
            margin-bottom: 20px;
            font-size: 20px;
            color: #333;
        }
        .login-container hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 20px 0;
        }
        .login-container label {
            display: block;
            margin: 10px 0 5px;
            font-size: 14px;
            color: #333;
            text-align: left;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%; 
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; 
        }
        .login-container .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .login-container .actions a {
            font-size: 14px;
            color: black;
            text-decoration: none;
            padding-top: 8px;
        }
        .login-container input[type="submit"] {
            padding: 10px 20px;
            background-color: skyblue;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        .login-container input[type="submit"]:hover {
            background-color: deepskyblue;
        }
        .forgot-password {
            text-align: center;
            margin-top: 15px;
            font-size: 15px;
        }
        .forgot-password a {
            color: black;
            text-decoration: none;
        }
        .contact-info {
            margin-top: 20px;
            text-align: center;
        }
        .contact-info hr {
            border: none;
            margin: 10px 0;
        }
        .contact-info p {
            margin: 10px 0;
            font-size: 20px;
            color: #333;
        }
        .error-message {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="img/logos.jpg" alt="BrainGym Logo">
        <h1>BrainGym</h1>
    </div>

    

    <div class="login-container">
        <h3>User Authentication</h3>
        <hr>
        <?php if (isset($error_message)) : ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" placeholder="Username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            
            <div class="actions">
                <a href="register.php">Register</a>
                <input type="submit" value="Login">
            </div>
        </form>
       
        <br>
  
            <a>Forgot your password? </a> <a href="forgot.php">Click here</a>
       
    </div>

    <br><br><br>
    <a>---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</a>
    <div class="contact-info">
        <hr>
        <p>For questions and comments, email us at <a href="mailto:BrainGym@gmail.com">BrainGym@gmail.com</a></p>
    </div>

</body>
</html>
