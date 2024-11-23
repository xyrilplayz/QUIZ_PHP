<?php
$conn = new mysqli("localhost", "root", "", "quiz_db");

$result = $conn->query("
    SELECT u.username, s.score, s.quiz_date
    FROM scores s
    JOIN users u ON s.user_id = u.id
    ORDER BY s.score DESC, s.quiz_date ASC
");

echo "<h2>Leaderboard</h2>";
echo "<table border='1'>
<tr><th>Username</th><th>Score</th><th>Date</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['username']}</td>
        <td>{$row['score']}</td>
        <td>{$row['quiz_date']}</td>
    </tr>";
}

echo "</table>";
?>
