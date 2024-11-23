<?php
$conn = new mysqli("localhost", "root", "", "quiz_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$questions = [
    [
        "question" => "What does PHP stand for?",
        "options" => json_encode(["Personal Home Page", "Private Home Page", "PHP: Hypertext Preprocessor", "Public Hypertext Preprocessor"]),
        "answer" => 2
    ],
    [
        "question" => "Which symbol is used to access a property of an object in PHP?",
        "options" => json_encode([".", "->", "::", "#"]),
        "answer" => 1
    ],
    [
        "question" => "Which function is used to include a file in PHP?",
        "options" => json_encode(["include()", "require()", "import()", "load()"]),
        "answer" => 0
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
