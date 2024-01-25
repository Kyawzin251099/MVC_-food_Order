<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>


<!--Main Content Section Starts  -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage-Food</h1>
        <br>
        <a href="<?php echo URLROOT; ?>/dashboard/addFood" class="btn-primary">Add Food</a>

        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>

            </tr>


            <?php
            $number = 1;
            foreach ($data['food'] as $food) {

            ?>
                <tr class="tbl">
                    <td><?php echo $number++;  ?></td>
                    <td><?php echo $food['title'];  ?></td>
                    <td><?php echo $food['price'];  ?> MMK</td>

                    <td>
                        <?php
                        // $categoryImage = $types['image'];
                        if ($food['image'] != "") {
                        ?>
                            <img src="<?php echo URLROOT; ?>/public/food_images/<?php echo $food['image']; ?>" width="100px">
                        <?php
                        } else {
                            echo setMessage('error', 'Image not available');
                        }
                        ?>
                    </td>

                    <td><?php echo $food['featured'];  ?></td>
                    <td><?php echo $food['active'];  ?></td>

                    <td>
                        <a href="<?php echo URLROOT; ?>/Food/edit/<?php echo $food['id']; ?>" class="btn-secondary">Update Food</a>

                        <a href="<?php echo URLROOT; ?>/Food/destroy/<?php echo base64_encode($food['id']); ?>" class="btn-danger">Delete Food</a>
                    </td>
                </tr>

            <?php

            }

            ?>


        </table>

    </div>

</div>
<!--Main Content Section Ends  -->


<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>