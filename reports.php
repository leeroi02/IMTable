<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Users</title>

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
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #fff;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .table-container {
            display: inline-block;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        form {
            display: inline-block;
            text-align: right;
            margin-bottom: 20px;
        }
        input[type="text"], button {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            margin-left: 4px;
        }
        h1 {
            color: #fff;
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>



<div class="container">
    <h1>Curious Key Pie Questions</h1>
    
    <div class="table-container">
    <form method="GET" action="">
            <input type="text" name="search1" placeholder="Search">
            <button type="submit">Search</button>
        </form>
        <?php
        include 'connect.php';

        $search = isset($_GET['search1']) ? $_GET['search1'] : '';
        $sql = "SELECT * FROM tblquestion WHERE QuestionID LIKE '%$search%' OR QuestionText LIKE '%$search%' OR Timestamp LIKE '%$search%'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>QuestionID</th><th>QuestionText</th><th>Timestamp";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>".$row["QuestionID"]."</td><td>".$row["QuestionText"]."</td><td>".$row["Timestamp"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No results found</p>";
        }

        mysqli_close($connection);
        ?>
       
    </div>




    <h1>Curious Key Pie Answers</h1>
    
    <div class="table-container">
    <form method="GET" action="">
            <input type="text" name="search" placeholder="Search">
            <button type="submit">Search</button>
        </form>
        <?php
        include 'connect.php';

        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $sql = "SELECT * FROM tblanswer WHERE AnswerID LIKE '%$search%' OR QuestionID LIKE '%$search%' OR AnswerText LIKE '%$search%' OR Timestamp LIKE '%$search%'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>AnswerID</th><th>QuestionID</th><th>AnswerText</th><th>Timestamp</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>".$row["AnswerID"]."</td><td>".$row["QuestionID"]."</td><td>".$row["AnswerText"]."</td><td>".$row["Timestamp"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No results found</p>";
        }

        mysqli_close($connection);
        ?>
       
    </div>
</div>



</body>
</html>
