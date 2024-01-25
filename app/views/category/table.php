<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>


<!--Main Content Section Starts  -->
<div class="main-content">
    <div class="wrapper">
        <h1>Manage-Category</h1>
        <br><br>

        <br>
        <a href="<?php echo URLROOT; ?>/dashboard/addCategories" class="btn-primary">Add Category</a>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Active</th>
                <th>Actions</th>

            </tr>


            <?php
            $number = 1;
            foreach ($data['category'] as $category) {

            ?>
                <tr class="tbl">
                    <td><?php echo $number++;  ?></td>
                    <td><?php echo $category['title'];  ?></td>
                    <td>
                        <?php
                        // $categoryImage = $types['image'];
                        if ($category['image'] != "") {
                        ?>
                            <img src="<?php echo URLROOT; ?>/public/category_images/<?php echo $category['image']; ?>" width="100px">
                        <?php
                        } else {
                            echo setMessage('error', 'Image not available');
                        }
                        ?>
                    </td>

                    <td><?php echo $category['active'];  ?></td>

                    <td>
                        <a href="<?php echo URLROOT; ?>/Category/edit/<?php echo $category['id']; ?>" class="btn-secondary">Update Category</a>

                        <a href="<?php echo URLROOT; ?>/Category/destroy/<?php echo base64_encode($category['id']); ?>" class="btn-danger">Delete Category</a>
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