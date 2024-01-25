<?php

require_once APPROOT . '/views/inc/header.php'; ?>

<?php $database = new Database(); ?>


<?php
$sessionEmail = $_SESSION['email'];

$user = $database->getBySessionEmail('users', $sessionEmail);
$userId = $user['id'];
$userName = $user['name'];
$userEmail = $user['email'];
$userPhoneNumber = $user['phone_number'];

$userDetails = $database->getByEmail('vw_userprofile', $sessionEmail);

?>


<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admin.css">

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">User Information</h2>


        <form action="" method="POST" class="order">

            <fieldset>
                <legend>
                    <b>
                        Profile Information
                    </b>
                </legend>


                <table class="tbl-31">

                    <tr>
                        <td>Name:</td>
                        <td>
                            <input type="text" name="name" class="input-profile" readonly value="<?php echo $userName; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Email:</td>
                        <td>
                            <input type="text" name="email" class="input-profile" readonly value="<?php echo $userEmail; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Phone Number:</td>
                        <td>
                            <input type="text" name="phone_number" class="input-profile" readonly value="<?php echo $userPhoneNumber; ?>">
                        </td>
                    </tr>

                    <?php
                    $count = 1;
                    foreach ($userDetails as $userAddress) {
                    ?>
                        <tr>

                            <td>Address: <?php echo $count++; ?></td>
                            <td>

                                <input type="text" name="address" class="input-profile" readonly value="  <?php echo $userAddress['user_address']; ?>">

                            </td>
                        </tr>

                    <?php
                    }
                    ?>


                </table><br>
                <a href="<?php echo URLROOT; ?>/pages/edit_profile/?id=<?php echo $userId; ?>" class="btn-secondary">Edit</a>

            </fieldset>
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php require_once APPROOT . '/views/inc/footer.php'; ?>