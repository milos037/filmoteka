<?php
  if(isset($_POST['dodaj_film'])){
    global $connection;
    $film_naziv = $_POST['naziv'];
    $film_autor = $_POST['film_autor']; 
    $film_zanr = $_POST['film_zanr'];
    $film_status = $_POST['film_status'];
    $film_datum = $_POST['film_datum'];
    $film_poster = $_FILES['image']['name'];  
    $film_poster_temp = $_FILES['image']['tmp_name'];  
    $film_zemlja = $_POST['film_zemlja'];
    $film_glumci = $_POST['film_glumci']; 
    $film_tagovi = $_POST['film_tagovi'];  
    $film_sadrzaj = $_POST['film_sadrzaj'];
    $film_studio = $_POST['film_studio'];
      
    move_uploaded_file($film_poster_temp, "../images/$film_poster");
  
    $query = "INSERT INTO filmovi (zanr_id, naziv, datum, autor , poster, sadrzaj, tagovi, status, glumci, zemlja, studio) ";
    $query .= "VALUES('{$film_zanr}','{$film_naziv}','{$film_datum}','{$film_autor}','{$film_poster}','{$film_sadrzaj}','{$film_tagovi}','{$film_status}', '{$film_glumci}', '{$film_zemlja}', '{$film_studio}')";
      
    $dodaj_film= mysqli_query($connection,$query);
    confirmQuery($dodaj_film);
      $new_film_id = mysqli_insert_id($connection);
      echo "<script>alert('Uspešno ste dodali film!');</script>";
      echo "<p class='bg-success' style='padding: 10px; width: 18%;'>Film je ubačen.<br><a href='../film.php?f_id={$new_film_id}'>Pogledaj objavu</a>
    ili
    <a href='./filmovi.php?source=dodaj_film'>Dodaj još jedan</a>
</p>";
   
  } 
?>
   <form action="" method="post" enctype="multipart/form-data">
   <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="naziv">Naziv filma</label>
            <input type="text" class="form-control" name="naziv">
        </div>
    </div> 
    <div class="col-md-4">   
        <div class="form-group">
        <label for="film_zanr">Žanr&nbsp;&nbsp;</label><br>
        <select  class="form-control" name="film_zanr" id="film_zanr">
            <?php
                $query = "SELECT * FROM zanrovi";
                $select_categories = mysqli_query($connection, $query);
                confirmQuery($select_categories);
                while ($row = mysqli_fetch_assoc($select_categories)) {
                    $naziv_kategorije = $row['naziv'];
                    $id_kategorije = $row['id'];
                    
                    echo "<option value='{$id_kategorije}'>{$naziv_kategorije}</option>";
                }
            ?>
            
            </select>
        </div>
    </div>  
    <div class="col-md-4"> 
      <div class="form-group">
       <label for="film_status">Status</label><br>
       <select  class="form-control" name="film_status" id="film_status">
          <option value="objavljen">** izaberite opciju **</option>
          <option value="objavljen">Objavi</option>
          <option value="sakriven">Sakrij</option>
          
        </select>
        </div> 
    </div>  
    <div class="col-md-4"> 
        <div class="form-group">
            <label for="image">Producent</label>
            <input type="text" class="form-control" name="film_autor">
        </div> 
    </div> 
    <div class="col-md-4"> 
        <div class="form-group">
            <label for="image">Glumci</label>
            <input type="text" class="form-control" name="film_glumci">
        </div>  
    </div>             
    <div class="col-md-4"> 
        <div class="form-group">
            <label for="image">Poster filma</label>
            <input type="file" name="image">
        </div>
    </div>
    <div class="col-md-12"> 
        <div class="form-group">
            <label for="film_tagovi">Ključne reči za pretragu</label>
            <input type="text" class="form-control" name="film_tagovi">
        </div>
    </div>   
    <div class="col-md-4">      
        <div class="form-group">
            <label >Datum objavljivanja</label>
            <div class="input-group date" data-date-format="dd.mm.yyyy">
                <input name="film_datum" type="text" class="form-control" placeholder="dd.mm.yyyy">
                <div class="input-group-addon" >
                    <span class="fa fa-table"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4"> 
        <div class="form-group">
            <label>Zemlja nastanka filma</label>
            <input type="text" class="form-control" name="film_zemlja">
        </div>
    </div>
    <div class="col-md-4"> 
        <div class="form-group">
            <label>Studio snimanja</label>
            <input type="text" class="form-control" name="film_studio">
        </div>
    </div>
    <div class="col-md-12"> 
        <div class="form-group">
            <label for="film_sadrzaj">Opis filma</label>
            <textarea class="form-control" name="film_sadrzaj" id="body" cols="30" rows="10"></textarea>
        </div>
    </div>
    </div>
    <div class="text-center">
        <div class="form-group">
            <button class="btn btn-primary btn-lg" type="submit" name="dodaj_film">OBJAVI NOVI FILM&nbsp;&nbsp;<i class="fa fa-plus"></i></button>
        </div>
    </div>        
    
</form>
