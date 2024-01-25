<?php require_once APPROOT . '/views/inc/header.php'; ?>

<?php $database = new Database(); ?>

<?php

$sessionEmail = $_SESSION['email'];

$user = $database->getBySessionEmail('users', $sessionEmail);
$userId = $user['id'];
$userPhonenumber = $user['phone_number'];
$address = $database->getAddressByUserId('address', $userId);

// $addressId = $address['id'];

$userDetails = $database->getByEmail('vw_userprofile', $sessionEmail);


?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search-profile">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>


        <form action="<?php echo URLROOT; ?>/Order/store" method="POST" class="order">
            <input type="hidden" name="food_id" value="<?php echo $data['food']['id']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $userId; ?>">
            <input type="hidden" name="address_id" value="<?php echo $addressId; ?>">


            <fieldset class="text-white">
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <img src="<?php echo URLROOT; ?>/food_images/<?php echo $data['food']['image']; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $data['food']['title']; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $data['food']['id']; ?>">

                    <p class="food-price"><?php echo $data['food']['price']; ?> MMK</p>
                    <input type="hidden" name="price" value="<?php echo $data['food']['price']; ?>">

                    <div class="order-label"> Quantity</div>
                    <input type="number" name="qty" class="qty" value="1" required min="1">

                </div>

            </fieldset>

            <fieldset>
                <legend class="text-white">Choose Address</legend>


                <table class="tbl-30">

                    <tr>
                        <td>
                            <div class="order-label"><b>Company</b></div>
                        </td>
                        <td>
                            <select name="company" class="input-company" id="company" onchange="GetCompany(this.value)">
                                <option selected="selected" disabled>Select Company</option>

                                <?php
                                $company_name = $database->readAll('delivery_company');

                                foreach ($company_name as $company) {
                                ?>
                                    <option value="<?php echo $company['id']; ?>">
                                        <?php echo $company['name']; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <div class="order-label"><i>Address</i></div>

                        </td>
                        <td>
                            <select class="input-company" name="user_address" id="address_list" onchange="GetPrice(this.value,document.getElementById('company').value)">
                                <option selected="selected" disabled>Select Address</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="order-label">Price</div>
                        </td>
                        <td>
                            <select name="delivery_fee" id="price_name" class="input-company">
                                <option selected="selected">Delivery Fee</option>
                            </select>
                        </td>
                    </tr>

                </table>
                <br>
                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">

            </fieldset>

        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<script>
    $(document).ready(function() {
        GetCompany(CompanyName);
        GetPrice(Price);

    });

    // Pull out township list by city id
    function GetCompany(CompanyName) {
        var url = 'pages';
        var form_url = '<?php echo URLROOT; ?>/' + url + '/address';

        $.ajax({
            url: form_url,
            type: 'GET',
            data: jQuery.param({
                CompanyName: CompanyName
            }),
            success: function(address_list) {
                // console.log(address_list);
                document.getElementById("address_list").innerHTML = address_list;
            }
        });
    }

    function GetPrice(addressId, CompanyName) {
        var url = 'pages';
        var form_url = '<?php echo URLROOT; ?>/' + url + '/price';
        // alert(form_url);
        $.ajax({
            url: form_url,
            type: 'GET',
            data: jQuery.param({
                addressId: addressId,
                CompanyName: CompanyName
            }),
            success: function(price) {
                console.log(price);

                document.getElementById("price_name").innerHTML = price;
            }
        });
    }
</script>