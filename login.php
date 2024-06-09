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

    if (strtolower($email) == 'admin@email.com' ){

        header('location: admin/admin_login.php');

    } else {
        // Fetch user details from database
        $stmt = $conn->prepare("SELECT user_id, user_name, user_password FROM users WHERE user_email = ? LIMIT 1");
        $stmt->bind_param('s', $email);

        if ($stmt->execute()) {
            $stmt->bind_result($user_id, $user_name, $user_password);
            $stmt->store_result();
            

            if ($stmt->num_rows == 1) {
                $stmt->fetch();  
                // Verify the password          
                if ($password == $user_password) {
                    
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_name'] = $user_name;
                    $_SESSION['user_email'] = $email;
                    $_SESSION['logged_in'] = true;
                    header('location: account.php?message=Logged in successfully!');
                } else {
                    header('location: login.php?error=Invalid email or password!');
                }
            } else {
                header('location: login.php?error=Account does not exist!');
            }
        } else {
            header('location: login.php?error=Something went wrong');
        }
    }
    $stmt->close();
}
?>

<?php include('header.php'); ?> 

    <section>
        <div class="user-container">
            <h2>Sign In</h2>
            <hr>
        </div>
        <div >
            <form id="login-form" action="login.php" method="POST">
            <span><?php if(isset($_GET['error']))echo $_GET['error'];?></span>
            <span><?php if(isset($_GET['message']))echo $_GET['message'];?></span>        
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
<?php include('footer.php'); ?>