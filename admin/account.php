<?php
session_start(); 

include('admin_header.php'); 

if(!isset($_SESSION['admin_logged_in'])) { 
    header('location: admin_login.php');
    exit;
}

?>

<body>
        
    <div class="admin-container">
        <aside class="sidebar">
            <?php include('navbar.php'); ?>
        </aside>
        <main class="main-content">
            <section id="order-table">
                <h2>Account Details</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Admin ID</th>
                            <th>Admin Name</th>
                            <th>Admin Email</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $_SESSION['admin_id']; ?></td>
                            <td><?php echo $_SESSION['admin_name']; ?></td>
                            <td><?php echo $_SESSION['admin_email']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </section>

        </main>
    </div>
</body>
</html>
