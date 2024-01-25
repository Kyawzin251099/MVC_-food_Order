<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>


<!--Main Content Section Starts  -->
<div class="main-content">
    <div class="wrapper">
        <h1>Delivery Company</h1>
        <br><br>

        <br>
        <a href="<?php echo URLROOT; ?>/dashboard/delivery_company" class="btn-primary">Add Delivery Company</a>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Logo</th>
                <th>Company</th>

            </tr>

            <?php
            $number = 1;
            foreach ($data['company'] as $company) {
            ?>
                <tr class="tbl">
                    <td><?php echo $number++; ?></td>
                    <td>
                        <?php
                        if ($company['image'] != "") {
                        ?>
                            <img src="<?php echo URLROOT; ?>/company_images/<?php echo $company['image']; ?>" width="100px"">
                        <?php
                        } else {
                            echo setMessage('error', 'Image not available');
                        }
                        ?>
                    </td>
                    <td><?php echo $company['name'] ?></td>
                </tr>
            <?php
            }
            ?>
        </table>

    </div>

</div>
<!--Main Content Section Ends  -->

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>