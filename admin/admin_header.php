
<?php include('../server/connection.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basic Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/mediaqueries.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/website-assets/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/website-assets/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/website-assets/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="../assets/images/website-assets/favicon_io/site.webmanifest">
</head>

<header>
    <a href="#"><img src= "../assets/images/website-assets/logo.png" class="logo" alt=""></a>
    
    <?php if(isset($_SESSION['admin_logged_in'])) { ?>
    <a href="admin_logout.php?logout=1">Sign Out</a>
    <?php } ?>
</header>
