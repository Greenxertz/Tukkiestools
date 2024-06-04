<?php 

session_start();

if(!isset($_SESSION['logged_in'])){
    header('location: login.php');
    exit;
}

if(isset($_GET['logout'])){
    if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    header('location: login.php');
    exit;
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

</head>

<body >
    <header></header>

    <section>
    <div>
        <div>
            <h3></h3>
            <hr>
            <div>
                <p>Name: <span><?php if(isset($_SESSION['user_name'])){echo $_SESSION['user_name'];}?></span></p>
                <p>Email: <span><?php if(isset($_SESSION['user_email'])){echo $_SESSION['user_email'];}?></span></p>
                <p><a href="#orders" class="btn">Track your orders</a></p>
                <p><a href="account.php?logout=1" class="btn">Logout</a></p>
            </div>
        </div>
    </div>


    <div>
        <form action="">
            <h3></h3>
            <hr>
            <div>
                <label for=""></label>
                <input type="text" name="" id="">
            </div>

            <div>
                <label for=""></label>
                <input type="text" name="" id="">
            </div>
            <div>
                <input type="submit" name="" class="btn" id="">
            </div>
        </form>
    </div>

    </section>
    <section>
        <div>
            <h2>oonononon</h2>
            <hr>
        </div>
    </section>

    <section id="orders">
        <table>
            <tr>
                <th>Product</th>
                <th>Date</th>
            </tr>
            <tr>
                <td>
                    <div>
                        <img src="" alt="">
                        <div>
                            <p></p>
                        </div>
                    </div>
                </td>
                <td>
                    
                </td>
            </tr>
        </table>
    </section>

    <footer></footer>
    <script src="assets/js/header-footer.js"></script>
    <script src="assets/js/navbar.js"></script>
    
</body>

</html> 