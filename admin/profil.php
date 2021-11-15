<?php include "includes/admin_header.php"; ?>
<?php include_once "functions.php"; ?>

<?php 
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $query = "SELECT * FROM korisnici WHERE username = '{$username}' ";
        $select_user_profile = mysqli_query($connection, $query);
    }
    while ($row = mysqli_fetch_array($select_user_profile)){
          $user_id = $row['id'];
          $username = $row['username'];
          $user_password = $row['password'];
          $user_firstname = $row['ime'];
          $user_lastname = $row['prezime'];
          $user_email = $row['email'];
          $user_image = $row['avatar'];
          $user_role = $row['uloga'];
        
    }

?>
<?php
if(isset($_POST['update_profile'])){
    global $connection;
    $username = $_POST['username'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
      
    $user_image = $_FILES['user_image']['name'];  
    $user_image_temp = $_FILES['user_image']['tmp_name'];  
      
    $user_email = $_POST['user_email'];  
   
      
    move_uploaded_file($user_image_temp, "../images/$user_image");
      
    if (empty($user_image))  {
        $query = "SELECT * FROM korisnici WHERE id = $user_id ";
        $select_user_image = mysqli_query($connection,$query);
        
        while($row=mysqli_fetch_assoc($select_user_image)){
            $user_image = $row['avatar'];
        }
        
    } 
      
    $query = "UPDATE korisnici SET ime='{$user_firstname}', prezime='{$user_lastname}', email='{$user_email}', avatar='{$user_image}' WHERE id = {$user_id} ";
    
      
    $edit_user_profile= mysqli_query($connection,$query);
    confirmQuery($edit_user_profile);

     echo "<script>alert('Uspesno ste izmenili Vaš profil');</script>";
  } 

  if(isset($_POST["promeni_sifru"])){
    $stara_sifra = $_POST['stara_sifra'];
    $nova_sifra = $_POST['nova_sifra'];

    if(password_verify($stara_sifra, $user_password)){
        $nova_sifra = password_hash($nova_sifra, PASSWORD_DEFAULT);   
        $query = "UPDATE korisnici SET password = '$nova_sifra' WHERE id = $user_id";
        insert_update_query($query);
        echo "<script>alert('Uspesno ste promenili Vašu šifru');</script>";
    }else echo "<script>alert('Stara sifra nije dobra');</script>";    
    
    
  }
?>

    <?php include "includes/admin_navigation.php"; ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                   <h1 class="page-header">
                    VAŠ PROFIL
                        <small><?php echo $_SESSION['username'];?></small>
                    </h1>
                    
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
        <div class="col-md-1"></div>  
        <div class="col-md-4"> 
            <div class="form-group">
                <label for="user_role">Uloga</label><br>
                <select  class="form-control" name="user_role" id="user_role" readonly>
                <option value="<?php echo $user_role;?>">Trenutno - <?php echo $user_role;?></option>
                </select>
            </div>
        </div>
        <div class="col-md-3 text-center">
            <img width="150" src="../images/<?php echo $user_image; ?>"alt="">
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="user_firstname">Ime</label><br>
                <input value="<?php echo $user_firstname;?>" type="text" class="form-control" name="user_firstname">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="user_lastname">Prezime</label><br>
                <input value="<?php echo $user_lastname;?>" type="text" class="form-control" name="user_lastname">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="user_email">Email</label><br>
                <input value="<?php echo $user_email;?>" type="email" class="form-control" name="user_email">
            </div>
        </div>
        <div class="text-center">
            <div class="form-group">
                <input class="btn btn-success btn-lg" type="submit" name="update_profile" value="Izmeni profil">
            </div>
        </div>
    </div>
    <hr>
        </div>
</form>
        <h1 class="page-header">PROMENA ŠIFRE</h1>
        <form action="" method="post">
            <div class="row" style="display:flex;align-items:center;">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="user_email">Stara sifra</label><br>
                        <input type="password" class="form-control" name="stara_sifra">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="user_email">Nova sifra</label><br>
                        <input type="password" class="form-control" name="nova_sifra">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" style="margin:0;">
                        <button class="btn btn-primary btn-lg" type="submit" name="promeni_sifru">Promeni sifru</button>
                    </div>
                </div>
            </div>
        </form>
    
    </div>
</div>

        </div>
  
    </div>
 
<?php include "includes/admin_footer.php"; ?>
