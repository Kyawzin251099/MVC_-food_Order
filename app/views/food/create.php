<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>

        <form action="<?php echo URLROOT; ?>/Food/store" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>
                        <label for="title">Title :</label>
                    </td>
                    <td>
                        <input type="text" id="title" name="title" placeholder="Title of the food" required>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="des">Description:</label>
                    </td>
                    <td>
                        <textarea name="description" id="des" cols="30" rows="5" placeholder="Description of the food" required></textarea>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="price">Price:</label>
                    </td>
                    <td>
                        <input type="number" id="price" name="price" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="image">Select Image:</label>
                    </td>
                    <td>
                        <input type="file" id="image" name="image" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Category:</label>
                    </td>
                    <td>
                        <select name="category">

                            <?php
                            foreach ($data['categoryFood'] as $category) {

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
                        <input type="radio" checked name="featured" value="Yes" required>Yes
                        <input type="radio" name="featured" value="No" required>No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" required>Yes
                        <input type="radio" name="active" value="No" required>No

                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>


        <?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>