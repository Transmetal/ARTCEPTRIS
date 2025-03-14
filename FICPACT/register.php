<?php
include 'config.php';

if(isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $phone = mysqli_real_escape_string($conn, $_POST['phonenum']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/'.$image;
    function isPasswordStrong($pass) {
        return preg_match('/[a-z]/', $pass) &&
            preg_match('/[A-Z]/', $pass) &&
            preg_match('/\d/', $pass) &&
            preg_match('/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/', $pass) &&
            strlen($pass) >= 8;
    }

    if(!isPasswordStrong($pass)) {
        $message[] = 'Password should be strong (include uppercase, lowercase, at least one number, at least one special character, and be at least 8 characters long)';
    } else if(!preg_match('/^[a-zA-Z ]+$/', $fullname)) {
        $message[] = "Full name should contain only alphabetic characters";
    } else if(!ctype_digit($phone)) {
        $message[] = "Phone Number should contain only numeric characters";
    } else {
        $select = mysqli_query($conn, "SELECT email FROM `user_form` WHERE email = '$email'");
        
if (!$select) {
    die("Query failed: " . mysqli_error($conn)); // Debugging error
}

if (mysqli_num_rows($select) > 0) {
    $message[] = 'User Already Exists';
}
        if(mysqli_num_rows($select) > 0) {
            $message[] = 'User Already Exists';
        } else {

            if(!strtotime($dob) || strtotime($dob) > time()) {
                $message[] = 'Invalid date of birth or future date not allowed.';
            } elseif(!preg_match('/^\d{11}$/', $phone)) {
                $message[] = 'Invalid phone number format (only 11 digits required).';
            } elseif(strlen($address) < 10 || strlen($address) > 100) {
                $message[] = 'Invalid address length (10-100 characters allowed).';
            } else {
                if($pass != $cpass) {
                    $message[] = 'Confirm password not matched';
                } elseif($image_size > 2000000) {
                    $message[] = 'Image size is too large';
                } else {
                    $accdate = date('Y-m-d H:i:s');
                    $hashed_password = md5($_POST['password']);
                    $insert = mysqli_query($conn, "INSERT INTO `user_form` (username, email, password, fullname, dob, phonenum, address, accdate, image) VALUES ('$username', '$email', '$hashed_password', '$fullname', '$dob', '$phone', '$address', '$accdate', '$image')") or die('Query failed');

                    if($insert) {
                        session_start();
                        move_uploaded_file($image_tmp_name, $image_folder);
                        $message[] = 'Registered successfully';
                        header('location: login.php');
                    } else {
                        $message[] = 'Registration failed';
                    }
                }
            }
        }

    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/x-icon" href="css/images/logo.png">
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <h3 style="text-decoration:underline; text-decoration-thickness: 5px; text-decoration-color:rgb(0, 0, 0);">
                Register now</h3> <br>
            <?php
            if(!empty($message)) {
                foreach($message as $msg) {
                    echo '<div class="message">'.$msg.'</div>';
                }
            }
            ?>
            <div class="input-group">
                <label for="username" class="lbl">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter username" class="box" required
                    maxlength="100">
            </div>

            <div class="input-group">
                <label for="email" class="lbl">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter email" class="box" required
                    maxlength="100">
            </div>

            <div class="input-group">
                <label for="fullname" class="lbl">Full Name:</label>
                <input type="text" id="fullname" name="fullname" placeholder="Enter Full Name. Ex. Juan Dela Cruz"
                    class="box" required maxlength="100">
            </div>

            <div class="input-group">
                <label for="address" class="lbl">Street Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter Street Address" class="box" required
                    maxlength="100">
            </div>

            <div class="input-group">
                <label for="dob" class="lbl">Birthdate:</label>
                <input type="date" id="dob" name="dob" class="box" required maxlength="100">
            </div>

            <div class="input-group">
                <label for="phonenum" class="lbl">Phone Number:</label>
                <input type="number" id="phonenum" name="phonenum" placeholder="Enter Phone Number. Ex. 09673411161"
                    class="box" required maxlength="11">
            </div>

            <div class="input-group">
                <label for="password" class="lbl">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter password" class="box" required
                    maxlength="100">
            </div>
            <div class="password-strength" id="password-strength"></div>


            <div class="input-group">
                <label for="cpassword" class="lbl">Confirm Password:</label>
                <input type="password" id="cpassword" name="cpassword" placeholder="Confirm password" class="box"
                    required maxlength="100">
            </div>

            <div class="input-group">
                <label for="image" class="lbl">Profile Picture:</label>
                <input type="file" id="image" name="image" class="box" accept="image/jpg, image/jpeg, image/png">
            </div>

            <input type="submit" name="submit" value="Register Now" class="btn" id="register">

            <p>Already have an account? <a href="login.php">Login now</a></p>

        <div class="card">
            <h3>Welcome</h3>
            <p class="p1">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Halo, Selamat datang di ARTCEPTRIS. Kami menyediakan berbagai layanan untuk menikmati film di hari santai anda. Dapat dilakukan secara Online maupun Offline.
                ARTCEPTRIS sendiri dibangun pada tahun 2025 yang didedikasikan untuk penayangan film lokal maupun internasional.
            </p>
        </div>
    </div>
    <div class="additionalcon">
        <script>
            document.getElementById('password').addEventListener('input', function () {
                var password = this.value;
                var strengthIndicator = document.getElementById('password-strength');
                var registerButton = document.getElementById('register');

                // Validate password strength
                var isStrong = isPasswordStrong(password);

                // Display strength indicator
                if (isStrong) {
                    strengthIndicator.textContent = 'Strong';
                    strengthIndicator.style.color = 'green';

                } else {
                    strengthIndicator.textContent =
                        'Password should be strong (include uppercase, lowercase, at least one number, at least one special character, and be at least 8 characters long)';
                    strengthIndicator.style.color = 'cyan';

                }
            });

            function isPasswordStrong(password) {
                return /[a-z]/.test(password) && /[A-Z]/.test(password) && /\d/.test(password) &&
                    /[!@#$%^&*()_+{}\[\]:;<>,.?~\\/-]/.test(password) && password.length >= 8;
            }
        </script>
</body>
</html>