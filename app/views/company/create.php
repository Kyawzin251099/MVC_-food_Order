<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add Company</h1>
        <br><br>
        <br>

        <!-- Add category form start -->
        <form action="<?php echo URLROOT; ?>/Company/store" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">

                <tr>
                    <td>Company Logo:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Company:</td>
                    <td>
                        <input type="text" name="name" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" class="btn-secondary" value="AddCategory">
                    </td>
                </tr>

            </table>


        </form>
        <!-- Add category form end -->



    </div>
</div>

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>