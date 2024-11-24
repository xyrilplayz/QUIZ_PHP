<?php
    $host = 'localhost';    
    $user = 'root';
    $pass = '';
    $dbname = 'quiz_db';  
    $port = 3307;
 
    $conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$questions = [
    [
        "question" => "What 1 + 1",
        "options" => json_encode(["0", "11", "2", "5"]),
        "answer" => 2
    ],
    [
        "question" => "Which symbol is used for multiplication?",
        "options" => json_encode(["&", "#", ":", "*"]),
        "answer" => 3
    ],
    [
        "question" => "What is 2^4",
        "options" => json_encode(["16", "24", "32", "8"]),
        "answer" => 0
    ],
    [
        "question" => "What is the answer for this problem? (5-3)(4-3)",
        "options" => json_encode(["0", "1", "56", "12"]),
        "answer" => 1
    ],
    [
        "question" => "What is the symbol for division?",
        "options" => json_encode(["//", "÷", "**", "+"]),
        "answer" => 1
    ],
    [
        "question" => "What is the symbol for addition?",
        "options" => json_encode(["//", "÷", "**", "+"]),
        "answer" => 3
    ],
    [
        "question" => "Can Math be used in our everyday life?",
        "options" => json_encode(["True","False"]),
        "answer" => 0
    ],
    [
        "question" => "Is math a Helpful creation?",
        "options" => json_encode(["True","False"]),
        "answer" => 0
    ],
    [
        "question" => "What is the Symbol for subtraction?",
        "options" => json_encode(["//", "÷", "-", "+"]),
        "answer" => 2
    ],
    [
        "question" => "What is 12x12?",
        "options" => json_encode(["False", "144", "124", "124"]),
        "answer" => 1
    ]

    
];

foreach ($questions as $q) {
    $stmt = $conn->prepare("INSERT INTO questions (question, options, correct_answer) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $q['question'], $q['options'], $q['answer']);
    $stmt->execute();
}

echo "Questions added successfully!";
$conn->close();
?>
