<?php
session_start();
include('server/connection.php');
 
if (!isset($_SESSION['logged_in'])) {
    header('location: login.php');
    exit;
}

if (isset($_GET['logout'])) {
    if (isset($_SESSION['logged_in'])) {
        unset($_SESSION['logged_in']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        header('location: login.php');
        exit;
    }
}

if (isset($_POST['change_password'])) {
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $user_email = $_SESSION['user_email'];        

    if ($password !== $confirmpassword) {
        header('location: account.php?error=Passwords do not match!');
    } else if (strlen($password) < 6) {
        header('location: account.php?error=Password must be at least 6 characters long');
    } else {
        // Use password_hash for secure password storage
        $hashed_password = md5($password);
        $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
        $stmt->bind_param('ss', $hashed_password, $user_email);

        if ($stmt->execute()) {
            header('location: account.php?message=Password has been updated successfully!');
        } else {
            header('location: account.php?error=Could not update password!');
        }
        $stmt->close();
    }
    
}

// Get orders
if (isset($_SESSION['logged_in'])) {
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ORDER BY order_date DESC");
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $orders = $stmt->get_result();
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

    <section class="account-container">
        <div class="account-info">
            <h3>Account Information</h3>
            <hr>
            <p style="color:black">Name: <span><?php if (isset($_SESSION['user_name'])) { echo $_SESSION['user_name']; } ?></span></p>
            <p style="color:black">Email: <span><?php if (isset($_SESSION['user_email'])) { echo $_SESSION['user_email']; } ?></span></p>
            <p><a href="#orders" class="btn">Track your orders</a></p>
            <p><a href="account.php?logout=1" class="btn">Logout</a></p>
        </div>

        <div class="change-password">
            <form action="account.php" method="POST">
                <h3>Change password</h3>
                <hr>
                <div>
                    <label>Password</label>
                    <input type="password" name="password" id="account-password" placeholder="new password" required>
                </div>

                <div>
                    <label>Confirm Password</label>
                    <input type="password" name="confirmpassword" id="account-password-confirm" placeholder="Confirm new password" required>
                </div>
                <div class="btn-container">
                    <input type="submit" name="change_password" class="btn" id="change_pass_btn">
                </div>
            </form>
            <p style="color:black"><?php if (isset($_GET['error'])) { echo $_GET['error']; } ?></p>
            <p style="color:black"><?php if (isset($_GET['message'])) { echo $_GET['message']; } ?></p>

        </div>
        
    </section>

    <section id="orders">
        <div>
            <h2>Keep track of your orders</h2>
            <hr>
        </div>

        <table>
            <tr>
                <th>Order ID</th>
                <th>Order Cost (R)</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>Order Info</th>
            </tr>

            <?php while ($row = $orders->fetch_assoc()) { ?>
                <tr>
                    <td>
                        <p style="color: black"><?php echo $row['order_id'] ?></p>
                    </td>

                    <td>
                        <p style="color: black"><?php echo $row['order_cost'] ?></p>
                    </td>

                    <td>
                    <p style="color: <?php echo ($row['order_status'] == 'not paid') ? 'red' : (($row['order_status'] == 'delivered') ? 'green' : ''); ?>"><?php echo $row['order_status']; ?></p>
                    </td>

                    <td>
                        <p style="color: black" ><?php echo $row['order_date'] ?></p>
                    </td>

                    <td>
                        <form action="order_details.php" method="POST">
                            <input type="hidden" value="<?php echo $row['order_status']; ?>" name="order_status">
                            <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                            <input name="order_details_btn" type="submit" class="btn" value="Order Details">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </section>

    <footer></footer>

  

    <script src="assets/js/header-footer.js"></script>
    <script src="assets/js/navbar.js"></script>

    </body>
</html> 