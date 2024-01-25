 <?php require_once APPROOT . '/views/inc/header.php'; ?>


 <!-- fOOD sEARCH Section Starts Here -->
 <section class="food-search text-center">
     <div class="container">

         <form action="food-search.html" method="POST">
             <input type="search" name="search" placeholder="Search for Food.." required>
             <input type="submit" name="submit" value="Search" class="btn btn-primary">
         </form>

     </div>
 </section>
 <!-- fOOD sEARCH Section Ends Here -->


 <!-- CAtegories Section Starts Here -->
 <section class="categories">
     <div class="container">
         <h2 class="text-center">Explore Foods</h2>

         <?php

            foreach ($data['category'] as $category) {
                if ($category['featured'] == 'Yes' && $category['active'] == 'Yes') {
            ?>
                 <a href="category-foods.html">
                     <div class="box-3 float-container">
                         <img src="<?php echo URLROOT; ?>/category_images/<?php echo $category['image'];  ?>" alt="Pizza" class="img-responsive img-curve">

                         <h3 class="float-text text-white"><?php echo $category['title'];  ?></h3>
                     </div>
                 </a>

         <?php
                }
            }

            ?>



         <div class="clearfix"></div>
     </div>
 </section>
 <!-- Categories Section Ends Here -->

 <!-- fOOD MEnu Section Starts Here -->
 <section class="food-menu">
     <div class="container">
         <h2 class="text-center">Food Menu</h2>


         <?php

            foreach ($data['food'] as $food) {
                if ($food['featured'] == 'Yes' && $food['active'] == 'Yes') {
            ?>

                 <div class="food-menu-box">
                     <div class="food-menu-img">
                         <img src="<?php echo URLROOT; ?>/food_images/<?php echo $food['image'];  ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve" width="100px">
                     </div>

                     <div class="food-menu-desc">
                         <h4><?php echo $food['title'];  ?></h4>
                         <p class="food-price"><?php echo $food['price'];  ?></p>
                         <p class="food-detail">
                             <?php echo $food['description'];  ?>
                         </p>
                         <br>
                         <a href="<?php echo URLROOT; ?>/Order/edit/<?php echo $food['id']; ?>" class="btn btn-primary">Order Now</a>
                     </div>
                 </div>
         <?php
                }
            }
            ?>




         <div class="clearfix"></div>

     </div>

     <p class="text-center">
         <a href="<?php echo URLROOT; ?>/pages/foods">See All Foods</a>
     </p>
 </section>
 <!-- fOOD Menu Section Ends Here -->
 <?php require_once APPROOT . '/views/inc/footer.php'; ?>