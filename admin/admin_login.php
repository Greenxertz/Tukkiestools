<?php

session_start();

include('../server/connection.php');

if (isset($_SESSION['admin_logged_in'])) {
    header('Location: dashboard.php');
    exit;
}

if (isset($_POST['login_btn'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
 

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: admin_login.php?error=Invalid email format!');
        exit;
    }

    // Fetch user details from database
    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_password FROM admins WHERE admin_email = ? LIMIT 1");
    $stmt->bind_param('s', $email);

    if ($stmt->execute()) {
        $stmt->bind_result($admin_id, $admin_name, $admin_password);
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->fetch();

            // Verify the password
            if (md5($password)== $admin_password) {
                session_regenerate_id(true);
                $_SESSION['admin_id'] = $admin_id;
                $_SESSION['admin_name'] = $admin_name;
                $_SESSION['admin_email'] = $email;
                $_SESSION['admin_logged_in'] = true;
                header('Location: dashboard.php?message=Logged in successfully!');
            } else {
               header('Location: admin_login.php?error=Invalid email or password!');
            }
        } else {
            header('Location: admin_login.php?error=Account does not exist!');
        }
    } else {
        // Log the error for debugging purposes
        error_log('Database query error: ' . $stmt->error);
        header('Location: admin_login.php?error=Something went wrong');
    }

    $stmt->close();
}
?>

<?php include('admin_header.php'); ?>

<body >
    <section>
        <div class="user-container">
            <h2>Admin Login</h2>
            <hr>
        </div>
        <div >
            <form id="login-form" enctype="multipart/form-data"  action="admin_login.php" method="POST">
            <span><?php if(isset($_GET['error']))echo $_GET['error'];?></span>       
            <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>         
                    <button type="submit" class="btn" id="login-btn" name="login_btn">Sign In</button>
                </div>
              
            </form>
        </div>
    </section>
    

</body>

</html> 