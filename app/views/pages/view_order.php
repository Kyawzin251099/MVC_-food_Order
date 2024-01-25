<?php require_once APPROOT . '/views/inc/header.php'; ?>
<?php $database = new Database(); ?>

<?php
$sessionEmail = $_SESSION['email'];

$user = $database->getBySessionEmail('users', $sessionEmail);
$userId = $user['id'];
$userDetails = $database->getByIdAll('vw_orderall', $userId);
// print_r($userDetails);
// exit;


?>
<hr>
<table class="order_table">
    <thead>
        <tr>
            <th>No</th>
            <th>User Name</th>
            <th>Item</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Status</th>
            <th>Order Date</th>
            <th>Delivery Company</th>
            <th>Delivery Fee</th>
            <th>Address</th>
            <th>Contact</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $number = 1;
        foreach ($userDetails as $orderlist) {
        ?>
            <tr>
                <td><?php echo $number++; ?></td>
                <td><?php echo $orderlist['name']; ?></td>
                <td><?php echo $orderlist['title']; ?></td>
                <td><?php echo $orderlist['food_Price']; ?></td>
                <td><?php echo $orderlist['qty']; ?></td>
                <td><?php echo $orderlist['total']; ?></td>
                <td><?php echo $orderlist['status']; ?></td>
                <td><?php echo $orderlist['order_date']; ?></td>
                <td><?php echo $orderlist['delivery_CompanyName']; ?></td>
                <td><?php echo $orderlist['delivery_Price']; ?></td>
                <td><?php echo $orderlist['user_address']; ?></td>
                <td><?php echo $orderlist['phone_number']; ?></td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<hr>
<?php require_once APPROOT . '/views/inc/footer.php'; ?>