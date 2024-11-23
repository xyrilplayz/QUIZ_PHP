<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['passwords'];

    $host = 'localhost';    
    $user = 'root';
    $pass = '';
    $dbname = 'quiz_db';  
    $port = 3307;
    
    $conn = new mysqli($host, $user, $pass, $dbname, $port);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, passwords FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();

    if ($user_id && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        header("Location: quiz.php");
    } else {
        echo "Invalid credentials.";
    }

    $stmt->close();
    $conn->close();
}
?>



<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
    body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .container
        {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 225px;
        }
</style>
<body>
    <div class="container">
    <form method="post">
        <h2>Login</h2>
        <label for="username">Username</label><br>
        <input type="text" name="username" id="username" required><br>
        <br>
        <label for="password">Password</label><br>
        <input type="password" name="passwords" id="password" required><br>
        <br>
        <button type="submit">Login</button>
    </form>
    </div>
</body>
</html>