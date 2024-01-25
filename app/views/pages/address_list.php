<?php
session_start();
$database = new Database();
if (!empty($_GET['CompanyName'])) {

    $email = $_SESSION['email'];
    // echo $email;
    // $database->readAll()
    $addressList = $database->getByEmail('vw_userprofileupdate', $email);

?>
    <option value="">Select Address</option>
    <?php foreach ($addressList as $address) { ?>
        <option value="<?php echo $address['user_address']; ?>"><?php echo $address['user_address']; ?></option>
<?php }
}
