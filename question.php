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
    ],
    [
        "question" => "What is the equivalent of (print in pyhton) in PHP?",
        "options" => json_encode(["print", "echo", "Console.wwriteline", "Show"]),
        "answer" => 1
    ],
    [
        "question" => "What are the symbol of single line comment for PHP?",
        "options" => json_encode(["com.(),<--", "comment,-->", "//,#", "<--,-->"]),
        "answer" => 2
    ],
    [
        "question" => "What is the symbol of Multi line comment for PHP?",
        "options" => json_encode(["com.()", "/*", "//", "<---->"]),
        "answer" => 1
    ],
    [
        "question" => "Can PHP be use in Offline?",
        "options" => json_encode(["True","False"]),
        "answer" => 0
    ],
    [
        "question" => "Is PHP case Sensitive?",
        "options" => json_encode(["True","False"]),
        "answer" => 0
    ],
    [
        "question" => "what does this code Show echo. I Love PHP?",
        "options" => json_encode(["echo. I Love PHP", "I Love PHP", "echo ILovePHP", "ILovePHP"]),
        "answer" => 1
    ],
    [
        "question" => "What is the best PHP Syntax?",
        "options" => json_encode(["<?PHP?>", "<php?>", "<?php?>", "<?php>"]),
        "answer" => 2
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
