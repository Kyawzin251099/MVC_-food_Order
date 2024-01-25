<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>


<!--Main Content Section Starts  -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage-Admin</h1>
        <br>


        <br><br>


        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>User Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Action</th>
            </tr>

            <?php
            $number = 1;
            foreach ($data['user'] as $user) {
                $role = $user['role'];
                if ($role == 1) {
            ?>
                    <tr class="tbl">
                        <td><?php echo $number++;  ?></td>
                        <td><?php echo $user['name'];  ?></td>
                        <td><?php echo $user['phone_number'];  ?></td>
                        <td><?php echo $user['email'];  ?></td>
                        <td>
                            <a href="<?php echo URLROOT; ?>/Users/destroy/<?php echo base64_encode($user['id']); ?>" class="btn-danger">Delete Admin</a>
                        </td>
                    </tr>

            <?php

                }
            }

            ?>

        </table>

    </div>

</div>
<!--Main Content Section Ends  -->

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>