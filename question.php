<!DOCTYPE html>
<html>
<head>
    <title>Question</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('3.png');
            background-size: cover;
            font-family: Arial, sans-serif;
            height: 100vh;
            text-align: center; 
        }

        .container2 {
            background-color: #f9f9f9;
            margin: 100px auto !important;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 700px;
        }

        h1 {
            text-align: center;
            color: #000000;
        }

        form {
            text-align: center;
        }

        label {
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-submit2-btn {
            padding: 10px 20px;
            background: rgba(162, 0, 255, 0.63);
            color: white;
            border: 1px solid transparent;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s; 
           
        }

        .form-submit2-btn:hover {
            background-color: #00FFFF;
        }

    </style>
    
</head>

<body>

<?php include 'headerLogged.php'; ?>

    <div class="container2">
        <h1>Curious about something?</h1>
        <form action="question.php" method="post">
            <label for="question">Question:</label><br>
            <input type="text" id="question" name="question" required><br><br>
            <div class="form-submit2-btn">
                <input type="submit" name="btnSubmit2" value="Submit">
            </div>
        </form>

        
         <div class="form-view-questions-btn">
            <a href="userquestion.php" class="view-questions-btn">View Questions</a>
         </div>


    </div>

    <?php
include 'connect.php';

if(isset($_POST['btnSubmit2'])){
    $QuestionText = $_POST['question'];
    $stmt = $connection->prepare("INSERT INTO tblquestion (QuestionText) VALUES (?)");
    $stmt->bind_param("s", $QuestionText);
    if($stmt->execute()){
        echo "<script>alert('Question submitted successfully');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $connection->close();
}
?>


</body>
</html>