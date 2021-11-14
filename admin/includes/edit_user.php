 <?php
if(isset($_GET['u_id'])){
$the_user_id = $_GET['u_id'];
}
 $query = "SELECT * FROM users  WHERE user_id = $the_user_id;";
                        $select_user_by_id = mysqli_query($connection, $query);
                 
                        while($row = mysqli_fetch_assoc($select_user_by_id)){
                        $user_id = $row['user_id'];
                        $username = $row['username'];
                        $user_password = $row['user_password'];
                        $user_firstname = $row['user_firstname'];
                        $user_lastname = $row['user_lastname'];
                        $user_email = $row['user_email'];
                        $user_image = $row['user_image'];
                        $user_role = $row['user_role'];
                      
                        }



  if(isset($_POST['update_user'])){
    global $connection;
    $username = $_POST['username'];
//   $user_password = $_POST['user_password']; 
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];  
    $user_image = $_FILES['user_image']['name'];  
    $user_image_temp = $_FILES['user_image']['tmp_name'];  
      
    $user_email = $_POST['user_email'];  
    $user_role = $_POST['user_role'];
   
      
    move_uploaded_file($user_image_temp, "../images/$user_image");
      
    if (empty($user_image))  {
        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
        $select_user_image = mysqli_query($connection,$query);
        
        while($row=mysqli_fetch_array($select_user_image)){
            $user_image = $row['user_image'];
        }
        
    } 
      
      //kriptovanje sifre
    $query = "SELECT user_randSalt FROM users " ;
    $select_randsalt_query = mysqli_query($connection, $query);
    if(!$select_randsalt_query){
        die(mysqli_error($connectio));
    }
    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['user_randSalt'];
    $hashed_password = crypt($user_password, $salt);
      
      
      
    $query = "UPDATE users SET user_firstname='{$user_firstname}', user_lastname='{$user_lastname}', user_email='{$user_email}', user_image='{$user_image}', user_role='{$user_role}' WHERE user_id = {$the_user_id} ";
    
      
    $edit_user_query= mysqli_query($connection,$query);
    confirmQuery($edit_user_query);

     echo "<script>alert('Uspešno ste izmeni podatke korisnika.');window.location = './users.php';</script>";
  } 

  if ($user_role == 'subscriber'){
    $user_role = 'korisnik';
  }


?>
<!--  <div class="col-md-4">
            <img width="150" src="../images/<?php echo $user_image; ?>"alt="">
        </div>  -->
   <form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="user_image">Korisnička slika</label><br>
                <input type="file" name="user_image" value="<?php echo $user_image; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="user_firstname">Username</label><br>
                <input value="<?php echo $username;?>" type="text"  class="form-control" name="username" readonly>
            </div>
        </div>
       
        <div class="col-md-4">
            <div class="form-group">
                <label for="user_role">Uloga</label><br>
                <select  class="form-control" name="user_role" id="user_role">
                <option value="<?php echo $user_role;?>">Trenutno - <?php echo $user_role;?></option>
                <option value="admin">Admin</option>
                <option value="subscriber">Korisnik</option>
                </select>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-3 text-center">
            <img width="150" src="../images/<?php echo $user_image; ?>"alt="">
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="user_firstname">Ime</label><br>
                <input value="<?php echo $user_firstname;?>" type="text" class="form-control" name="user_firstname">
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <label for="user_lastname">Prezime</label><br>
                <input value="<?php echo $user_lastname;?>" type="text" class="form-control" name="user_lastname">
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="user_email">Email</label><br>
                <input value="<?php echo $user_email;?>" type="email" class="form-control" name="user_email">
            </div>
        </div>
        </div>
    
        <div class="text-center">
            <div class="form-group">
                <input class="btn btn-success btn-lg" type="submit" name="update_user" value="Izmeni podatke">
            </div>
        </div>    
    
</form>