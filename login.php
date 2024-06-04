<?php
session_start();

include('server/connection.php');

if (isset($_SESSION['logged_in'])) {
    header('location: account.php');
    exit;
}

if (isset($_POST['login_btn'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    
    $stmt = $conn->prepare("SELECT user_id, user_name, user_password FROM users WHERE user_email = ? AND user_password = ? LIMIT 1");
    
    $stmt->bind_param('ss', $email, $password);

    if ($stmt->execute()) {
        // Bind result variables for the selected columns
        $stmt->bind_result($user_id, $user_name, $user_password);
        $stmt->store_result();

        if ($stmt->num_rows() == 1) {
            $stmt->fetch();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['logged_in'] = true;  
            header('location: account.php?message=logged in successfully!');
        } else {
            header('location: login.php?error=Account does not exist!');
        }
    } else {
        header('location: login.php?error=Something went wrong');
    }

    $stmt->close();
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


</head>

<body >
    <header></header>

    <section>
        <div class="user-container">
            <h2>Sign In</h2>
            <hr>
        </div>
        <div >
            <form id="login-form" action="login.php" method="POST">
            <span><?php if(isset($_GET['error']))echo $_GET['error'];?></span>    
            <div class="form-group">
                    <label for="login-email">Email</label>
                    <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
                    <i class="fas fa-eye-slash toggle-password" id="toggle-password"></i>            

                    <button type="submit" class="btn" id="login-btn" name="login_btn">Sign In</button>
               
                    
                </div>
                <div class="form-group">
                    <a href="register.php" class="register-url">Don't have an account? Register</a>
                </div>
            </form>
        </div>
    </section>
    



    <footer></footer>
    

    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            var passwordField = document.getElementById('login-password');
            var icon = this;
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    </script>
    <script src="assets/js/header-footer.js"></script>
    <script src="assets/js/navbar.js"></script>
    
</body>

</html> 