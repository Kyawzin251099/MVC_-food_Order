<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>
<?php $database = new Database();
$statusDetails = $database->readAll('status'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <form action="<?php echo URLROOT; ?>/Order/update" method="POST">
            <input type="hidden" name="order_id" value="<?php echo $data['order']['order_ID']; ?>">
            <input type="hidden" name="food_id" value="<?php echo $data['order']['food_ID']; ?>">
            <input type="hidden" name="qty" value="<?php echo $data['order']['qty']; ?>">
            <input type="hidden" name="total" value="<?php echo $data['order']['total']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $data['order']['user_ID']; ?>">
            <input type="hidden" name="address_id" value="<?php echo $data['order']['address_ID']; ?>">
            <input type="hidden" name="deliveryPrice_id" value="<?php echo $data['order']['price_ID']; ?>">
            <input type="hidden" name="deliveryCompany_id" value="<?php echo $data['order']['company_ID']; ?>">
            <input type="hidden" name="phone_number" value="<?php echo $data['order']['phone_number']; ?>">



            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <b>
                            <p><?php echo $data['order']['title']; ?></p>
                        </b>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="text" name="price" value="<?php echo $data['order']['food_Price'] ?> MMK" class="delivery_fee" readonly>
                    </td>
                </tr>
                <tr>
                    <td>Qty:</td>
                    <td>

                        <input type="number" name="qty" value="<?php echo $data['order']['qty']; ?>" class="delivery_fee" readonly>
                    </td>
                </tr>

                <tr>
                    <td>Order Date:</td>
                    <td>

                        <input type="text" name="date" value="<?php echo $data['order']['order_date']; ?>" class="delivery_fee" readonly>
                    </td>
                </tr>

                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status" class="delivery_fee">
                            <?php
                            foreach ($statusDetails as $status) {
                            ?>
                                <option value="<?php echo $status['id']; ?>"><?php echo $status['status']; ?></option>
                            <?php
                            }
                            ?>


                        </select>
                    </td>
                </tr>

                <tr>
                    <td>User Name:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $data['order']['name'] ?>" class="delivery_fee" readonly>
                    </td>
                </tr>

                <tr>
                    <td>Company</td>
                    <td>
                        <input type="text" name="company" class="delivery_fee" readonly value="<?php echo $data['order']['delivery_CompanyName'] ?>">
                    </td>
                </tr>

                <tr>
                    <td>Delivery Fee:</td>
                    <td>
                        <input type="text" name="fee" class="delivery_fee" readonly value="<?php echo $data['order']['price_ID'] ?>">
                    </td>
                </tr>

                <tr>
                    <td>Contact:</td>
                    <td>
                        <input type="number" name="contact" class="delivery_fee" value="<?php echo $data['order']['phone_number'] ?>" readonly>
                    </td>
                </tr>

                <tr>
                    <td>Address:</td>
                    <td>
                        <input type="text" name="user_address" class="delivery_fee" value="<?php echo $data['order']['user_address'] ?>" readonly>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>


        <?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>