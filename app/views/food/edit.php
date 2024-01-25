<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="<?php echo URLROOT; ?>/Food/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data['food']['id']; ?>">
            <input type="hidden" name="image" value="<?php echo $data['food']['image']; ?>">


            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food" value="<?php echo $data['food']['title']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the food"><?php echo $data['food']['description']; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $data['food']['price']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        // $categoryImage = $category['image'];
                        if ($data['food']['image'] != "") {
                        ?>
                            <img src="<?php echo URLROOT; ?>/public/food_images/<?php echo $data['food']['image']; ?>" width="200px">
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
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php
                            foreach ($data['category'] as $category) {

                                $foodCategory = $category['featured'];
                                if ($foodCategory == 'Yes') {
                                    $categoryID = $category['id'];
                                    $categoryTitle = $category['title'];
                            ?>
                                    <option value="<?php echo $categoryID; ?>"><?php echo $categoryTitle; ?></option>
                            <?php
                                }
                            }
                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($data['food']['featured'] == "Yes") {
                                    echo "checked";
                                }  ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($data['food']['featured'] == "No") {
                                    echo "checked";
                                }  ?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($data['food']['active'] == "Yes") {
                                    echo "checked";
                                }  ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($data['food']['active'] == "No") {
                                    echo "checked";
                                }  ?> type="radio" name="active" value="No">No

                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>


        <?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>