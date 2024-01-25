<?php
require_once APPROOT . '/views/inc/header.php'; ?>

<?php $database = new Database(); ?>


<?php


$id = $_GET['id'];
$user = $database->getById('users', $id);

?>

<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admin.css">

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">User Information</h2>


        <form action="<?php echo URLROOT; ?>/Users/update" method="POST" class="order">

            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="password" value="<?php echo $user['password']; ?>">


            <fieldset>
                <legend>Profile Information</legend>


                <table class="tbl-31">

                    <tr>
                        <td>Name:</td>
                        <td>
                            <input type="text" name="name" class="input-profile" value="<?php echo $user['name']; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Email:</td>
                        <td>
                            <input type="text" name="email" class="input-profile" value="<?php echo $user['email']; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Phone Number:</td>
                        <td>
                            <input type="text" name="phone_number" class="input-profile" value="<?php echo $user['phone_number']; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>City</td>
                        <td>
                            <select class="input-profile" id="city_list" name="city" required onchange='GetTownshipListByCityId(this.value)'>

                                <option selected="selected" disabled>Select City</option>
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
                            <select class="input-profile" id="township_list" name="township" required onchange='GetStreetNameListByTownshipId(this.value)'>
                                <option selected="selected">Select Township</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Street</td>
                        <td>
                            <select class="input-profile" id="street_name_list" name="street" required>
                                <option selected="selected">Select Street Name</option>
                            </select>


                        </td>
                    </tr>

                </table>
                <input type="submit" name="submit" value="Update" class="btn-secondary">


            </fieldset>



        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php require_once APPROOT . '/views/inc/footer.php'; ?>


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