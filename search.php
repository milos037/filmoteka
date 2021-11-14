<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<link href="css/zvezdice-samo-prikaz.css" rel="stylesheet">
    <!-- Navigacija -->
    
    <?php  include "includes/navigation.php"; ?>
     <h1 class="text-center" style="margin-top: 60px;margin-bottom: 10px;">REZULTATI PRETRAGE</h1>   
 


       
<div class="row" style="width: 80%;margin: 0 auto 100px auto;">
        <section class="main products-list">

               
               <?php

             

            if(isset($_GET['submit'])){
                
            $search = $_GET['pretrazi'];
                
                
            $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
            $search_query = mysqli_query($connection, $query);

            if(!$search_query) {

                die("QUERY FAILED" . mysqli_error($connection));

            }

            $count = mysqli_num_rows($search_query);

            if($count == 0) {

               echo '<h1 class="text-center" style="padding: 20vh;"><i class="fa fa-times" aria-hidden="true" style="color: red;font-size:50px;"></i><br><br>Nema rezultata<br><br>
               <a href="./proizvodi.php?str=1" style="background-color: #f2f2f2; color: red; text-decoration: none; font-weight: bold;border-radius: 10px;padding: 5px 10px;">Pogledajte druge filmove</a></h1>';

            } else {

    while($row = mysqli_fetch_assoc($search_query)) {
                    $post_id = $row['post_id'];
                    $post_category = $row['post_category_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0 , 80);
                    $post_status = $row['post_status'];
                    $post_avg_mark = $row['post_avg_mark'];
                    if ($post_status == 'objavljen') {
        ?>
          
          
           <div class="product-summary">

    <h2 class="product-summary__title">
      <a href="film.php?f_id=<?php echo $post_id;?>">
       <?php echo $post_title; ?></a>

    </h2>

    <a href="film.php?f_id=<?php echo $post_id;?>" class="product-summary__image-wrapper">
     <img src="images/<?php echo $post_image ?>" alt="<?php echo "$cat_title - $post_title";?>" class="product-summary__image-wrapper-img">
    </a><br>
    <a href="category.php?category=<?php echo $post_category; ?>">
          <?php
                    $query = "SELECT cat_title FROM categories WHERE cat_id = '{$post_category}' ; ";
                    $select_all_categories_query = mysqli_query($connection, $query);
                   
                    while($row = mysqli_fetch_assoc($select_all_categories_query)){
                        $cat_title = $row['cat_title'];
                        
                       echo $cat_title;
                    }
                        ?>
          
      </a>
    

    <div class="product-summary__desc">
      <p>
       <?php  echo  $post_content ; ?>...
      </p>
      
    </div>

    <div class="product-summary__add-to-cart">
      
    <span class="star-cb-group">
            <input  type="radio" id="rating-5-<?php echo $post_id;?>" name="comment_stars-<?php echo $post_id;?>" value="5" /><label for="rating-5-<?php echo $post_id;?>">5</label>
            <input type="radio" id="rating-4-<?php echo $post_id;?>" name="comment_stars-<?php echo $post_id;?>" value="4" /><label for="rating-4-<?php echo $post_id;?>">4</label>
            <input type="radio" id="rating-3-<?php echo $post_id;?>" name="comment_stars-<?php echo $post_id;?>" value="3" /><label for="rating-3-<?php echo $post_id;?>">3</label>
            <input type="radio" id="rating-2-<?php echo $post_id;?>" name="comment_stars-<?php echo $post_id;?>" value="2" /><label for="rating-2-<?php echo $post_id;?>">2</label>
            <input type="radio" id="rating-1-<?php echo $post_id;?>" name="comment_stars-<?php echo $post_id;?>" value="1" /><label for="rating-1-<?php echo $post_id;?>">1</label>
            <input type="radio" id="rating-0-<?php echo $post_id;?>" name="comment_stars-<?php echo $post_id;?>" value="0" class="star-cb-clear" /><label for="rating-0">0</label>
        </span> 
        <?php if($post_avg_mark > 0){ ?>
        <span style="position: relative;top: 0px;font-weight: bold;color: #fff;float:right;"><?="(".$post_avg_mark.")"?></span>
        <?php } ?>
        
        <script>
            $("input[type=radio]").prop('disabled',true);
        <?php if($post_avg_mark >= 0 && $post_avg_mark <= 0.5 ){?>
            $("#rating-0-<?=$post_id;?>").prop('checked',true);
        <?php }
        if($post_avg_mark > 0.5 && $post_avg_mark <= 1.5) {?>
            $("#rating-1-<?=$post_id;?>").prop('checked',true);
        <?php }
        if($post_avg_mark > 1.5 && $post_avg_mark <= 2.5){?>        
            $("#rating-2-<?=$post_id;?>").prop('checked',true);
        <?php }
        if($post_avg_mark > 2.5 && $post_avg_mark <= 3.5){?>
            $("#rating-3-<?=$post_id;?>").prop('checked',true);
        <?php }
        if($post_avg_mark > 3.5 && $post_avg_mark <= 4.5){?>
            $("#rating-4-<?=$post_id;?>").prop('checked',true);
        <?php }
        if($post_avg_mark > 4.5 && $post_avg_mark <= 5){?>
            $("#rating-5-<?=$post_id;?>").prop('checked',true);
        <?php } ?>
        </script>
    </div>
    <div class="text-center">
        <a href="film.php?f_id=<?php echo $post_id;?>" class="btn btn-danger" style="margin: 10px 0;color:#fff">Detaljnije</a> 
    </div>   

  </div>


   <?php } }    }      } ?>
    
            
    </section>
</div>

   

<?php include "includes/footer.php";?>

