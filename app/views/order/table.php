<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>
<?php $database = new Database(); ?>


<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Company</th>
                <th>Delivery Fee</th>
                <th>Contact</th>
                <th>Address</th>
                <th>Action</th>
            </tr>

            <?php
            $order = $database->readAll('vw_orderall');
            // print_r($order);
            // exit;
            $number = 1;
            foreach ($order as $orderData) {
            ?>
                <tr class="tbl">
                    <td><?php echo $number++; ?></td>
                    <td><?php echo $orderData['title']; ?></td>
                    <td><?php echo $orderData['food_Price']; ?> MMK</td>
                    <td><?php echo $orderData['qty']; ?></td>
                    <td><?php echo $orderData['total']; ?> MMK</td>
                    <td><?php echo $orderData['order_date']; ?></td>
                    <td><?php echo $orderData['status']; ?></td>
                    <td><?php echo $orderData['name']; ?></td>
                    <td><?php echo $orderData['delivery_CompanyName']; ?></td>
                    <td><?php echo $orderData['delivery_Price']; ?></td>
                    <td><?php echo $orderData['phone_number']; ?></td>
                    <td><?php echo $orderData['user_address']; ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/Order/orderEdit/<?php echo $orderData['order_ID']; ?>" class="btn-secondary">Update</a>
                    </td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/Order/destroy/<?php echo base64_encode($orderData['order_ID']); ?>" class="btn-danger">Delete </a>


                    </td>

                </tr>
            <?php
            }
            ?>

        </table>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Main Content Section Ends -->
<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>