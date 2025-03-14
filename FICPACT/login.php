<?php
session_start();
include 'config.php';

if(isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
    $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');
    $select2 = mysqli_query($conn, "SELECT * FROM `admin` WHERE admin_email = '$email' AND admin_password = '$pass'") or die('query failed');

    if(mysqli_num_rows($select) > 0) {
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id'] = $row['id'];
        header('location:home.php');
    } else if(mysqli_num_rows($select2) > 0) {
        $row = mysqli_fetch_assoc($select2);
        $_SESSION['admin_id'] = $row['admin_id'];
        header('location:adminside/dashboard.php');
    } else {
        $message[] = 'Incorrect email or password!';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="css/images/logo.png">
    <link rel="stylesheet" href="css/login.css">

</head>
<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3 style="font-size:23px; color:rgb(255, 255, 255); word-spacing:3px; border-radius: 5px; color:rgb(255, 255, 255); box-shadow:0 10px 10px rgba(0,0,0,.1);"
                class="headertext">
                WELCOME BACK TO THE ARTCEPTRIS
            </h3>
            <a href="index.php" class="back-button"><i class="fas fa-arrow-left"></i> Back</a>

            <img src="css/images/logo.png" style="width: 300px; " class="movielogo">
            <h3 style="text-decoration:underline; text-decoration-thickness: 5px; text-decoration-color:rgba(255, 0, 0, 0.71);">User Login</h3>
            <?php
            if(isset($message)) {
                foreach($message as $message)
                    echo '<div class="message">'.$message.'</div>';
            }
            ?>
            <div class="input-container">
                <input type="email" name="email" placeholder="Enter Email" class="box" required>
            </div>
            <div class="input-container">
                <input type="password" name="password" placeholder="Enter Password" class="box" required>
            </div>

            <input type="submit" name="submit" value="Login Now" class="btn">
            <input type="button" name="forgot" value="Forgot Password?" class="btn" style="background-color:#000000"
                onclick="redirectToForgotPage()">
            <p>Don't have an account? <a href="register.php">Register now</a></p>
        </form>
        <div class="card-container">
        <div class="card">
            <h3>Apa saja keuntungan ketika saya masuk ▼</h3>
            <p class="p1">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Anda dapat mengakses langsung apa saja film kami yang tersedia dan dapat langsung mengakses untuk pembayaran
            </p>
        </div>
        <div class="card2">
            <h3>Detail fitur yang ditawarkan dari website ini ▼</h3>
            <p class="p2">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Anda dapat mengakses film terbaik dari kami dan melihat fitur fitur seperti booking dan lain lain
            </p>
        </div>
        <div class="card3">
            <h3>Apa saja yang ada dalam fitur admin ▼</h3>
            <p class="p3">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Karena anda dapat mengakses langsung ke pembayaran dan akses penting ke admin untuk mengecek saluran pembayaran dan orderan
            </p>
        </div>
    </div>
    </div>
    </div>
</body>
<script>
    function redirectToForgotPage() {
        window.location.href = "forgot.php";
    }
</script>

</html>