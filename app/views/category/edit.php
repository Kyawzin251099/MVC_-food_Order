<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>
        <br>

        <!-- Add category form start -->
        <form action="<?php echo URLROOT; ?>/Category/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data['category']['id']; ?>">
            <input type="hidden" name="image" value="<?php echo $data['category']['image']; ?>">


            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title" value="<?php echo $data['category']['title']; ?>">
                        <!-- <input type="hidden" name="title" value=""> -->
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        // $categoryImage = $category['image'];
                        if ($data['category']['image'] != "") {
                        ?>
                            <img src="<?php echo URLROOT; ?>/public/category_images/<?php echo $data['category']['image']; ?>" width="200px">
                        <?php
                        } else {
                            echo setMessage('error', 'Image not available');
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($data['category']['active'] == "Yes") {
                                    echo "checked";
                                }  ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($data['category']['active'] == "No") {
                                    echo "checked";
                                }  ?> type="radio" name="active" value="No">No

                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" class="btn-secondary" value="Update Category">
                    </td>
                </tr>

            </table>


        </form>
        <!-- Add category form end -->



    </div>
</div>

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>