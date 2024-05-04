<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include 'connect.php';
include 'headerLogged.php';

$username = $_SESSION['username'];
$query = "SELECT * FROM tbluseraccount WHERE username = '$username'";
$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

   
    $sql = "SELECT q.QuestionText, a.AnswerText
            FROM tblquestion q
            LEFT JOIN tblanswer a ON q.QuestionID = a.QuestionID
            ORDER BY q.QuestionID DESC
            LIMIT 1";
    $result = mysqli_query($connection, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $latestQuestion = $row['QuestionText'];
        $latestAnswer = $row['AnswerText'];
    } else {
        $latestQuestion = "No questions found";
        $latestAnswer = "No answer found";
    }
} else {
    $error = "User data not found.";
}

mysqli_close($connection);
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles.css"> 
    <style>
        
        .container2 {
            text-align: center;
            margin-top: 350px; 
            margin-bottom: 100px; 
        }

        .btn2 {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 10px;
            margin-top: 50px;
        }

        .btn2:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

<div class="container2">
    <h1>Welcome, <?php echo $user['username']; ?>!</h1>
    
 
    <h2>Latest Question:</h2>
    <p><?php echo $latestQuestion; ?></p>
    <h2>Latest Answer:</h2>
    <p><?php echo $latestAnswer; ?></p>
    
    <a href="question.php" class="btn2">Ask a Question</a>
    <a href="Userquestion.php" class="btn2">View Questions</a>
    <a href="reports.php" class="btn2">Reports</a>
</div>

</body>
</html>