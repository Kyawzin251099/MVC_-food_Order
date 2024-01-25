<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>
<?php $database = new Database();
$price = $database->readAll('price');
$price_id = $data['delivery_price']['deliveryPrice_ID'];
// echo $price_id;
// exit;
$priceDetails = $database->getById('delivery_price', $price_id);
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <br>

        <!-- Add category form start -->
        <form action="<?php echo URLROOT; ?>/Delivery_Fee/update" method="POST">
            <input type="hidden" name="deliveryPrice_id" value="<?php echo $price_id; ?>">
            <input type="hidden" name="street_id" value="<?php echo $priceDetails['street_id']; ?>">
            <input type="hidden" name="township_id" value="<?php echo $priceDetails['township_id']; ?>">
            <input type="hidden" name="city_id" value="<?php echo $priceDetails['city_id']; ?>">
            <input type="hidden" name="deliveryCompany_id" value="<?php echo $priceDetails['deliveryCompany_id']; ?>">



            <table class="tbl-30">
                <tr>
                    <td>Address :</td>
                    <td>
                        <b>
                            <p><?php echo $data['delivery_price']['delivery_address']; ?></p>
                        </b>
                    </td>
                </tr>

                <tr>
                    <td>Company :</td>
                    <td>
                        <b>
                            <p><?php echo $data['delivery_price']['deliveryCompany_Name'] ?></p>
                        </b>
                    </td>
                </tr>

                <tr>
                    <td>Delivery Fee</td>
                    <td>
                        <select name="price" class="delivery_fee">
                            <?php
                            foreach ($price as $deliveryfee) {
                            ?>
                                <option value="<?php echo $deliveryfee['id'] ?>">
                                    <?php echo $deliveryfee['price'] ?></option>
                            <?php
                            } ?>
                        </select>

                    </td>
                </tr>



                <tr>
                    <td colspan="2">
                        <input type="submit" class="btn-secondary" value="Update Category">
                    </td>
                </tr>

            </table>


        </form>
        <!-- Add category form end -->



    </div>
</div>

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>