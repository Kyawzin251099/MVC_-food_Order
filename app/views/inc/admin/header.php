<?php
session_start();
?>
<html>

<head>
    <title>Food Order Website - Home Page</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/admin.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
</head>

<body>
    <!--Menu Section Starts  -->
    <div class="menu text-center">
        <div class="wrapper">
            <ul>
                <li><a href="<?php echo URLROOT; ?>/dashboard/index">Home</a></li>
                <li><a href="<?php echo URLROOT; ?>/dashboard/admin">Admin</a></li>
                <li><a href="<?php echo URLROOT; ?>/dashboard/categories">Category</a></li>
                <li><a href="<?php echo URLROOT; ?>/dashboard/food">Food</a></li>
                <li><a href="<?php echo URLROOT; ?>/dashboard/order">Order</a></li>
                <li><a href="<?php echo URLROOT; ?>/dashboard/company">Company</a></li>
                <li><a href="<?php echo URLROOT; ?>/dashboard/delivery_fee">Delivery Fee</a></li>
                <li><a href="<?php echo URLROOT; ?>/Pages/index">Logout</a></li>

            </ul>
        </div>
    </div>
    <!--Menu Section Ends  -->