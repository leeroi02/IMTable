<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Questions</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('3.png');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            height: 100vh;
        }

        .container {
            padding: 20px;
            text-align: center;
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #FFFFFF;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .question-container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        p {
            color: #555;
            font-size: 16px;
            margin-bottom: 10px;
            display: inline-block;
        }

        .delete-btn {
            background-color: #ff3333;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }
        .answer-btn {
            background-color: #3Cb043;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }
        .answer-btn:hover{
            background-color: #234F1e;
        }
        .delete-btn:hover{
            background-color: #731d1d;
        }

    </style>
</head>


<body>
<?php
    include 'headerLogged.php';
?>

<div class="container">
    <h1>Curious Key Pie Questions</h1>

    <?php
        include 'connect.php';
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_question'])) {
            $questionID = $_POST['delete_question'];
            $sql = "DELETE FROM tblquestion WHERE QuestionID = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $questionID);
            if ($stmt->execute()) {
                echo "<script>alert('Question deleted successfully');</script>";
            } else {
                echo "<script>alert('Error deleting question');</script>";
            }
        }

        $sql = "SELECT * FROM tblquestion";
        $result = mysqli_query($connection, $sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="question-container">';
                echo "<p>Question: " . $row["QuestionText"] . "</p>";
                echo '<form method="post" action="answerquestion.php" style="display: inline-block;">';
                echo '<input type="hidden" name="question_id" value="' . $row["QuestionID"] . '">';
                echo '<button type="submit" class="answer-btn">Answer</button>';
                echo '</form>';
                
                echo '<form method="post" style="display: inline-block;">';
                echo '<input type="hidden" name="delete_question" value="' . $row["QuestionID"] . '">';
                echo '<button type="submit" class="delete-btn">Delete</button>';
                echo '</form>';
                echo '</div>';
            }
            
            } else {
            echo "<p>No questions found</p>";
        }

        $connection->close();
        ?>

</div>

</body>
</html>
