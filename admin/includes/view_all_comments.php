<?php  

if(isset($_POST['checkBoxArray'])) {

    
    foreach($_POST['checkBoxArray'] as $commentValueId ){
        
  $bulk_options = $_POST['bulk_options'];
        
        switch($bulk_options) {
        case 'approved':
        
$query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$commentValueId}  ";
        
 $update_to_approved_status = mysqli_query($connection,$query);
            
confirmQuery( $update_to_approved_status);
            
            
         break;
            
            
              case 'unapproved':
        
$query = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$commentValueId}  ";
        
 $update_to_unapproved_status = mysqli_query($connection,$query);
            
confirmQuery($update_to_unapproved_status);
            
            
         break;
            
  
            
               case 'delete':
        
$query = "DELETE FROM comments WHERE comment_id = {$commentValueId}  ";
        
 $update_to_delete = mysqli_query($connection,$query);
            
confirmQuery($update_to_delete);
            
            
         break;
        
        
        }
    
    
    } 



}




?>



<form action="" method='post'>
<div id="bulkOptionContainer" class="col-md-4" style="padding: 0;margin-bottom: 2rem">

<select class="form-control" name="bulk_options" id="">
<option value="">Izaberi opciju</option>
<option value="approved">Dozvoli</option>
<option value="unapproved">Zabrani</option>
<option value="delete">Izbriši</option>
</select>

</div> 

    
<div class="col-md-4">

<input type="submit" name="submit" class="btn btn-success" value="Potvrdi">

</div>
<div class="clearfix"></div>
               <table class="table table-bordered table-hover" id="example">
               
               

                <thead>
                    <tr>
                       <th><input id="selectAllBoxes" type="checkbox"></th>
                        <th>Id</th>
                        <th>Komentarisao</th>
                        <th>Komentar</th>
                        <th>Ocena</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Film</th>
                        <th>Datum</th>
                        <th>Dozvoli</th>
                        <th>Zabrani</th>
                        <th>Izbriši</th>
                    </tr>
                </thead>
                
                      <tbody>
                      

  <?php 
    
    $query = "SELECT * FROM comments";

    $select_comments = mysqli_query($connection,$query);
//    $select_comments=  mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($select_comments)) {
        $comment_id          = $row['comment_id'];
        $comment_post_id     = $row['comment_post_id'];
        $comment_author      = $row['comment_author'];
        $comment_content     = $row['comment_content'];
        $comment_email       = $row['comment_email'];
        $comment_status      = $row['comment_status'];
        $comment_date        = $row['comment_date'];
        $comment_stars       = $row['comment_stars'];
    
        
        echo "<tr>";
        
        ?>
        
 <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $comment_id; ?>'></td>
          
        
        <?php
        
        echo "<td>$comment_id </td>";
        echo "<td>$comment_author</td>";
        echo "<td>$comment_content</td>";
        echo "<td>$comment_stars</td>";
        echo "<td>$comment_email</td>";

        if ($comment_status == 'approved'){
            $comment_status = 'dozvoljen';
        } else {
            $comment_status = 'zabranjen';
        }

        echo "<td>$comment_status</td>";
        
        
        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
        $select_post_id_query = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_post_id_query)){
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
            
            echo "<td><a href='../film.php?f_id=$post_id'>$post_title</a></td>";
        
        
        }
        
        

        
        echo "<td>$comment_date</td>";
        echo "<td><a href='comments.php?approve=$comment_id'><i class='fa fa-check-circle' aria-hidden='true'></i>&nbsp;Dozvoli</a></td>";
        echo "<td><a href='comments.php?unapprove=$comment_id'><i class='fa fa-times-circle' aria-hidden='true'></i>&nbsp;Zabrani</a></td>";
        echo "<td><a href='comments.php?delete=$comment_id'><i class='fa fa-trash' aria-hidden='true'></i>&nbsp;Izbriši</a></td>";
        echo "</tr>";
   
    }




      ?>


   
            </tbody>
            </table>
            
            </form>
            
            
<?php

if(isset($_GET['approve'])){
    
    $the_comment_id = escape($_GET['approve']);
    
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id   ";
    $approve_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    
    
}





if(isset($_GET['unapprove'])){
    
    $the_comment_id = escape($_GET['unapprove']);
    
    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";
    $unapprove_comment_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    
    
}




if(isset($_GET['delete'])){
    
    $the_comment_id = escape($_GET['delete']);
    
    $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: comments.php");
    
    
}





?>     
            
            
            
            
            
            
            
      