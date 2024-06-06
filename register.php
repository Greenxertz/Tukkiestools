<?php
session_start();

include('server/connection.php');

if (isset($_SESSION['logged_in'])) {
    header('location: account.php');
    exit;
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirm-password'];

    if ($password !== $confirmpassword) {
        header('location: register.php?error=Passwords do not match!');
    } else if (strlen($password) < 6) {
        header('location: register.php?error=Password must be at least 6 characters long');
    } else {
        // Check if the user already exists
        $stmt1 = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_email=?");
        if ($stmt1 === false) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->store_result();
        $stmt1->fetch();
        $stmt1->close();

        if ($num_rows != 0) {
            header('location: register.php?error=User already exists');
        } else {
            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
            if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            // Use password_hash for secure password storage
            $hashed_password = md5($password);
            $stmt->bind_param('sss', $name, $email, $hashed_password);

            if ($stmt->execute()) {
                $user_id = $stmt->insert_id;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                header('location: account.php?register=You have registered successfully');
            } else {
                header('location: register.php?error=Could not create an account at the moment');
            }

            $stmt->close();
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
    <title>Tukkies Tools website</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" /> 
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/mediaqueries.css">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/images/website-assets/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/website-assets/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/website-assets/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="assets/images/website-assets/favicon_io/site.webmanifest">

 
</head>

<body >
   <header></header>
   
    <section>
        <div class="user-container" >
            <h2>Register</h2>
            <hr>
        </div>
        <div class="container">
            <form id="register-form" method="POST" action="register.php">
               <span><?php if(isset($_GET['error']))echo $_GET['error'];?></span>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required>
                    <i class="fas fa-eye-slash toggle-password1" id="toggle-password1"></i> 
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirm-password" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn" id="register-btn" name="register">Register</button> 
                </div>
                <div class="form-group">
                    <a href="login.php" class="register-url">Do you have an Account? Login</a>    
                </div>
            </form>
        </div>
    </section>
   


    <footer></footer>


    <script>
    document.getElementById('toggle-password1').addEventListener('click', function() {
    var passwordField = document.getElementById('register-password');
    var confirmPasswordField = document.getElementById('register-confirm-password');
    var icon = this;
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        confirmPasswordField.type = 'text';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    } else {
        passwordField.type = 'password';
        confirmPasswordField.type = 'password';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }
});
    </script>
    <script src="assets/js/header-footer.js"></script>
    <script src="assets/js/navbar.js"></script>
    
</body>

</html> 