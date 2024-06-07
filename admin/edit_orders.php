<?php
session_start();

include('admin_header.php');

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $order_edit = $result->fetch_assoc();
} else {
    header('Location: dashboard.php'); 
    exit;
}

// Function to get available order statuses
function getOrderStatuses() {
    return ['not paid', 'processing', 'shipped', 'delivered', 'cancelled'];
}

// Handle form submission to update order status
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];

    // Update query for order status
    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param("si", $order_status, $order_id);

    if ($stmt->execute()) {
        header('location: dashboard.php?edit_message=Edit was successful');  
        exit;
    } else {
        header('location: dashboard.php?edit_message=Edit was unsuccessful');
    }
}
?>

<body>
    <div class="admin-container">
        <aside class="sidebar">
            <?php include('navbar.php'); ?>
        </aside>
        <main class="main-content">
            <section id="order-table">
                <h2>Edit Order:</h2>
                <hr>
                <form method="POST" action="">
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Order Status</th>
                                <th>Order Date</th>
                                <th>User ID</th>
                                <th>User Phone</th>
                                <th>Specified Address</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo htmlspecialchars($order_edit['order_id']); ?></td>
                                <td>
                                    <select name="order_status">
                                        <?php
                                        $statuses = getOrderStatuses();
                                        foreach ($statuses as $status) {
                                            $selected = ($order_edit['order_status'] == $status) ? 'selected' : '';
                                            echo "<option value='$status' $selected>$status</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><?php echo htmlspecialchars($order_edit['order_date']); ?></td>
                                <td><?php echo htmlspecialchars($order_edit['user_id']); ?></td>
                                <td><?php echo htmlspecialchars($order_edit['user_phone']); ?></td>
                                <td><?php echo htmlspecialchars($order_edit['user_address']); ?></td>
                                <td>
                                    <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order_edit['order_id']); ?>">
                                    <button type="submit" class="btn">Save</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
