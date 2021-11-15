 <?php
if(isset($_GET['k_id'])){
$korisnik_id = $_GET['k_id'];
}
    $query = "SELECT * FROM korisnici WHERE id = $korisnik_id;";
    $select_user_by_id = mysqli_query($connection, $query);       
    while($row = mysqli_fetch_assoc($select_user_by_id)){
        $username = $row['username'];
        $korisnik_sifra = $row['password'];
        $korisnik_ime = $row['ime'];
        $korisnik_prezime = $row['prezime'];
        $korisnik_email = $row['email'];
        $korisnik_avatar = $row['avatar'];
        $korisnik_uloga = $row['uloga'];
    }



  if(isset($_POST['izmeni_korisnika'])){
    global $connection;
    $username = $_POST['username'];
//   $korisnik_sifra = $_POST['user_password']; 
    $korisnik_ime = $_POST['user_firstname'];
    $korisnik_prezime = $_POST['user_lastname'];  
    $korisnik_avatar = $_FILES['user_image']['name'];  
    $korisnik_avatar_temp = $_FILES['user_image']['tmp_name'];  
      
    $korisnik_email = $_POST['user_email'];  
    $korisnik_uloga = $_POST['user_role'];
   
      
    move_uploaded_file($korisnik_avatar_temp, "../images/$korisnik_avatar");
      
    if (empty($korisnik_avatar))  {
        $query = "SELECT * FROM korisnici WHERE id = $korisnik_id ";
        $select_user_image = mysqli_query($connection,$query);
        
        while($row=mysqli_fetch_array($select_user_image)){
            $korisnik_avatar = $row['avatar'];
        }
        
    } 
      
      //kriptovanje sifre
    $query = "SELECT randSalt FROM korisnici WHERE id = $korisnik_id" ;
    $select_randsalt_query = mysqli_query($connection, $query);
    if(!$select_randsalt_query){
        die(mysqli_error($connectio));
    }
    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['randSalt'];
    $hashed_password = crypt($korisnik_sifra, $salt);
      
      
      
    $query = "UPDATE korisnici SET
        ime='{$korisnik_ime}',
        prezime='{$korisnik_prezime}',
        email='{$korisnik_email}',
        avatar='{$korisnik_avatar}',
        uloga='{$korisnik_uloga}'
    WHERE id = {$korisnik_id} ";
    
      
    $edit_user_query= mysqli_query($connection,$query);
    confirmQuery($edit_user_query);

     echo "<script>alert('Uspešno ste izmeni podatke korisnika.');window.location = './korisnici.php';</script>";
  } 

  if ($korisnik_uloga == 'subscriber')
    $korisnik_uloga = 'korisnik';

?>
   <form action="" method="post" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="user_image">Korisnička slika</label><br>
                <input type="file" name="user_image" value="<?php echo $korisnik_avatar; ?>">
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
                <option value="<?php echo $korisnik_uloga;?>">Trenutno - <?php echo $korisnik_uloga;?></option>
                <option value="admin">Admin</option>
                <option value="subscriber">Korisnik</option>
                </select>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-3 text-center">
            <img width="150" src="../images/<?php echo $korisnik_avatar; ?>"alt="">
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="user_firstname">Ime</label><br>
                <input value="<?php echo $korisnik_ime;?>" type="text" class="form-control" name="user_firstname">
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="form-group">
                <label for="user_lastname">Prezime</label><br>
                <input value="<?php echo $korisnik_prezime;?>" type="text" class="form-control" name="user_lastname">
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="user_email">Email</label><br>
                <input value="<?php echo $korisnik_email;?>" type="email" class="form-control" name="user_email">
            </div>
        </div>
        </div>
    
        <div class="text-center">
            <div class="form-group">
                <input class="btn btn-success btn-lg" type="submit" name="izmeni_korisnika" value="Izmeni podatke">
            </div>
        </div>    
    
</form>