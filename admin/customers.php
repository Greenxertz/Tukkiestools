<?php
session_start(); 

include('admin_header.php'); 

if(!isset($_SESSION['admin_logged_in'])) { 
    header('location: admin_login.php');
    exit;
}

$page_no = isset($_GET['page_no']) && $_GET['page_no'] != "" ? $_GET['page_no'] : 1;
$total_records_per_page = 10;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;

$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM users");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

$total_no_of_pages = ceil($total_records / $total_records_per_page);

$stmt2 = $conn->prepare("SELECT * FROM users LIMIT ?, ?");
$stmt2->bind_param("ii", $offset, $total_records_per_page);
$stmt2->execute();
$customer = $stmt2->get_result();
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
                            <th>user ID</th>
                            <th>user Name</th>
                            <th>user Email</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                         <?php foreach($customer as $cust) { ?>
                        <tr>
                            <td><?php echo $cust['user_id']; ?></td>
                            <td><?php echo $cust['user_name']; ?></td>
                            <td><?php echo $cust['user_email']; ?></td>
                           
                           <?php } ?>
                    </tbody>
                </table>
            </section>
            <section id="pagination" class="section-p1">
                <?php
                    $adjacents = 2; // Number of adjacent pages on each side
                    $start = ($page_no > $adjacents) ? $page_no - $adjacents : 1;
                    $end = ($page_no + $adjacents < $total_no_of_pages) ? $page_no + $adjacents : $total_no_of_pages;

                    if ($page_no > 1) {
                        echo '<a class="btn" href="?page_no=' . $previous_page . '">Previous</a>';
                    }

                    if ($start > 1) {
                        echo '<a class="btn" href="?page_no=1">1</a>';
                        if ($start > 2) {
                            echo '<span>...</span>';
                        }
                    }

                    for ($i = $start; $i <= $end; $i++) {
                        if ($i == $page_no) {
                            echo "<a class='btn active' href='?page_no=$i'>$i</a>";
                        } else {
                            echo "<a class='btn' href='?page_no=$i'>$i</a>";
                        }
                    }

                    if ($end < $total_no_of_pages) {
                        if ($end < $total_no_of_pages - 1) {
                            echo '<span>...</span>';
                        }
                        echo '<a class="btn" href="?page_no=' . $total_no_of_pages . '">' . $total_no_of_pages . '</a>';
                    }

                    if ($page_no < $total_no_of_pages) {
                        echo '<a class="btn" href="?page_no=' . $next_page . '">Next</a>';
                    }
                ?>
            </section>

        </main>
    </div>
</body>
</html>
