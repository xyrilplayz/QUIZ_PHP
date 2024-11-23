<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$host = 'localhost';    
$user = 'root';
$pass = '';
$dbname = 'quiz_db';  
$port = 3307;

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $score = 0;

    foreach ($_POST as $question_id => $answer) {
        $stmt = $conn->prepare("SELECT correct_answer FROM questions WHERE id = ?");
        $stmt->bind_param("i", $question_id);
        $stmt->execute();
        $stmt->bind_result($correct_answer);
        $stmt->fetch();

        if ($correct_answer == $answer) {
            $score++;
        }
        $stmt->close();
    }

    $stmt = $conn->prepare("INSERT INTO scores (user_id, score) VALUES (?, ?)");
    $stmt->bind_param("ii", $_SESSION['user_id'], $score);
    $stmt->execute();

    echo "<h2>Your Score: $score</h2>";
    echo '<a href="leaderboard.php">View Leaderboard</a>';
    exit;
}

$result = $conn->query("SELECT * FROM questions");
?>

<!DOCTYPE html>
<html>
<head><title>Quiz</title></head>
<body>
<form method="post">
    <?php while ($row = $result->fetch_assoc()): ?>
        <fieldset>
            <legend><?php echo $row['question']; ?></legend>
            <?php foreach (json_decode($row['options']) as $index => $option): ?>
                <label>
                    <input type="radio" name="<?php echo $row['id']; ?>" value="<?php echo $index; ?>">
                    <?php echo $option; ?>
                </label><br>
            <?php endforeach; ?>
        </fieldset>
    <?php endwhile; ?>
    <button type="submit">Submit</button>
</form>
</body>
</html>
