<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>
<?php
$database = new Database();
$deliveryFee =  $database->readAll('vw_deliveryprice');
// print_r($deliveryFee);
// exit;
?>


<!--Main Content Section Starts  -->
<div class="main-content">
    <div class="wrapper">
        <h1>Delivery</h1>
        <br>
        <a href="<?php echo URLROOT; ?>/dashboard/add_delivery_fee" class="btn-primary">Add Delivery Fee</a>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Address</th>
                <th>Company</th>
                <th>Delivery Price</th>
                <th>Action</th>
            </tr>

            <?php
            $number = 1;
            foreach ($deliveryFee as $fee) {
            ?>
                <tr class="tbl">
                    <td><?php echo $number++; ?></td>
                    <td><?php echo $fee['delivery_address']; ?></td>
                    <td><?php echo $fee['deliveryCompany_Name']; ?></td>
                    <td><?php echo $fee['delivery_Price']; ?></td>
                    <td>
                        <a href="<?php echo URLROOT; ?>/Delivery_Fee/deliverfee_Edit/<?php echo $fee['deliveryPrice_ID']; ?>" class="btn-secondary">Update</a>
                    </td>
                </tr>
            <?php
            }
            ?>


        </table>

    </div>

</div>
<!--Main Content Section Ends  -->

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>