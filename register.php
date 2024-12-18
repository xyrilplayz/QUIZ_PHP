
<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
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
        <h2>Register</h2>
        <label for="username">Username</label><br>
        <input type="text" name="username" id="username" required><br>
        <br>
        <label for="passwords">Password</label><br>
        <input type="password" name="passwords" id="passwords" required><br>
        <br>
        <button type="submit">Register</button>
    </form>
    </div>
    <?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['passwords'], PASSWORD_BCRYPT);

    $host = 'localhost';    
    $user = 'root';
    $pass = '';
    $dbname = 'quiz_db';  
    $port = 3307;
 
    $conn = new mysqli($host, $user, $pass, $dbname, $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO users (username, passwords) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "Registration successful! <a href='login.php'>Login</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
</body>
</html>