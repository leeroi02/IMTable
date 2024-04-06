<?php
include 'connect.php';

$loginMessage = "";
$messageClass= "";
 
if(isset($_POST['btnLogin'])){
    $uname = mysqli_real_escape_string($connection, $_POST['txtusername']);
    $pword = mysqli_real_escape_string($connection, $_POST['txtpassword']);
 
    $query = "SELECT * FROM tbluseraccount WHERE username = '$uname'";
    $result = mysqli_query($connection, $query);
 
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $dbHashedPassword = $row['password'];
 
        if($pword == $row['password']) {
            session_start();
            $_SESSION['username'] = $uname;
            $messageClass = "Login successful.";
        } else if(password_verify($pword, $dbHashedPassword)){
            session_start();
            $_SESSION['username'] = $uname;
            $messageClass = "Login successful.";
        } else {
            $loginMessage = "Invalid password.";
        }
    } else {
        $loginMessage = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CuriousKey-Pie</title>
    <link rel="stylesheet" href="css/loginStyle.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="wrapper">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h1>LOG IN</h1>


        <div class="message-box <?php echo ($loginMessage != "") ? 'active' : ''; ?>">
            <span class="close-btn" onclick="this.parentElement.classList.remove('active');">&times;</span>
            <?php echo $loginMessage; ?>
        </div>

        <div class="message-box2 <?php echo ($messageClass != "") ? 'active' : ''; ?>">
            <span class="close-btn2" onclick="this.parentElement.classList.remove('active');">&times;</span>
            <?php echo $messageClass; ?>
        </div>


            <div class="input-box">
                <input type="text" name="txtusername" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" name="txtpassword" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <button type="submit" name="btnLogin" class="btn">Log In</button>
            
            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>

            <?php if(isset($error)) { ?>
                <div class="error"><?php echo $error; ?></div>
            <?php } ?>
        </form>
    </div>

    <footer>
        
            <div class="fillers">
                <p>Felicity V. Orate BSCS 2</p>
            </div>
      
    </footer>

    <script>
    window.onload = function() {
        var messageBox2 = document.querySelector('.message-box2');
        if (messageBox2.classList.contains('active')) {
            setTimeout(function() {
                window.location.href = 'indexLogged.php';
            }, 2000); 
        }
    };

    

</script>


</body>
</html>