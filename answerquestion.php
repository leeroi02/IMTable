<?php


include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['question_id'])) {
    $questionID = $_POST['question_id'];

    
    $sql = "SELECT * FROM tblquestion WHERE QuestionID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $questionID);
    $stmt->execute();
    $result = $stmt->get_result();
    $question = $result->fetch_assoc();

    if ($question) {
        if (isset($_POST['submit_answer'])) {
         
            $answerText = $_POST['answer'];

            $sql = "INSERT INTO tblanswer (QuestionID, AnswerText) VALUES (?, ?)";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("is", $questionID, $answerText);

            if ($stmt->execute()) {
               
                header("Location: indexlogged.php");
                exit();
            } else {
                echo "<script>alert('Error submitting answer');</script>";
            }
        }

        echo '<div class="answer-container">';
        echo "<p>Question: " . $question["QuestionText"] . "</p>";
        echo '<form method="post">';
        echo '<input type="hidden" name="question_id" value="' . $questionID . '">';
        echo '<textarea name="answer" placeholder="Your answer..." required></textarea>';
        echo '<button type="submit" name="submit_answer" class="submit-answer-btn">Submit Answer</button>';
        echo '</form>';
        echo '</div>';
    } else {
        echo "<p>Question not found</p>";
    }
} else {
    echo "<p>Invalid request</p>";
}

$connection->close();
?>
