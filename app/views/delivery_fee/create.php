<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>
<?php $database = new Database(); ?>

<?php
$sessionEmail  = $_SESSION['email'];

$user = $database->getBySessionEmail('users', $sessionEmail);

$userId = $user['id'];

$userDetails = $database->getByEmail('vw_userprofileupdate', $sessionEmail);

$companyDetails = $database->readAll('delivery_company');

$priceDetails = $database->readAll('price');

$phoneNumber = $database->getById('users', $userId);
$uerPhoneNumber = $phoneNumber['phone_number'];

?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Delivery Fee</h1>
        <br><br>


        <!-- Add category form start -->
        <form action="<?php echo URLROOT; ?>/Delivery_Fee/store" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
            <table class="tbl-30">
                <tr>
                    <td>City</td>
                    <td>
                        <select class="delivery_fee" id="city_list" name="city" required onchange='GetTownshipListByCityId(this.value)'>

                            <option selected="selected">Select City</option>
                            <?php
                            $city_names = $database->readAll('city');
                            if ($city_names) {
                                foreach ($city_names as $city) {
                                    $city_name = $city['name'];
                                    $city_id = $city['id'];
                                    echo "<option value=$city_id>$city_name</option>";
                                }
                            } else {
                                echo "<option value=''> </option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Township</td>
                    <td>
                        <select class="delivery_fee" id="township_list" name="township" required onchange='GetStreetNameListByTownshipId(this.value)'>
                            <option selected="selected">Select Township</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Street</td>
                    <td>
                        <select class="delivery_fee" id="street_name_list" name="street" required>
                            <option selected="selected">Select Street Name</option>
                        </select>


                    </td>
                </tr>

                <!-- fOOD sEARCH Section Ends Here -->

                <tr>
                    <td>Company:</td>
                    <td>
                        <select name="company_id" class="delivery">
                            <?php
                            foreach ($companyDetails as $companyName) {
                            ?>
                                <option value="<?php echo $companyName['id'] ?>">
                                    <?php echo $companyName['name']; ?>
                                </option>

                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <select name="price_id" class="delivery">
                            <?php
                            foreach ($priceDetails as $price) {
                            ?>
                                <option value="<?php echo $price['id'] ?>">
                                    <?php echo $price['price']; ?>
                                </option>

                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>

            </table>

            <input type="submit" name="submit" value="Add Delivery Fee" class="btn btn-primary">

        </form>
        <!-- Add category form end -->
    </div>
</div>

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>

<script>
    $(document).ready(function() {
        GetTownshipListByCityId(cityId);
        GetStreetNameListByTownshipId(townshipId);

    });

    // Pull out township list by city id
    function GetTownshipListByCityId(cityId) {
        var url = 'pages';
        var form_url = '<?php echo URLROOT; ?>/' + url + '/township';
        $.ajax({
            url: form_url,
            type: 'GET',
            data: jQuery.param({
                cityId: cityId
            }),
            success: function(townshipList) {
                document.getElementById("township_list").innerHTML = townshipList;
                GetStreetNameListByTownshipId(0);
            }
        });
    }

    // Pull out street name list by township id
    function GetStreetNameListByTownshipId(townshipId) {
        var url = 'pages';
        var form_url = '<?php echo URLROOT; ?>/' + url + '/street';
        $.ajax({
            url: form_url,
            type: 'GET',
            data: jQuery.param({
                townshipId: townshipId
            }), //parse parameter 
            success: function(streetNameList) {
                document.getElementById("street_name_list").innerHTML = streetNameList;
            }
        });
    }
</script>