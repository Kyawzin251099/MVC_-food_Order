<?php
$database = new Database();
if (!empty($_GET['addressId']) && !empty($_GET['CompanyName'])) {

    $addressId = $_GET['addressId'];
    $companyId = $_GET['CompanyName'];
    $price = $database->getPriceByAddressNameAndCompanyName('vw_deliveryprice', 'delivery_address', $addressId, 'deliveryCompany_ID', $companyId);

?>
    <option value="<?php echo $price['Price_ID'] ?>">
        <?php echo $price['delivery_Price'] ?>
    </option>
<?php
}
