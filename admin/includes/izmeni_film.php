 <?php
if(isset($_GET['f_id'])){
    $film_id = $_GET['f_id'];
}
    $sql_detalji_filma = "SELECT * FROM filmovi WHERE id = $film_id;";
        
    foreach (select_query($sql_detalji_filma) as $film):
        $film_id = $film['id'];
        $film_zanr = $film['zanr_id'];
        $film_naziv = $film['naziv'];
        $film_poster = $film['poster'];
        $film_sadrzaj = $film['sadrzaj'];
        $film_status = $film['status'];
        $film_prosecna_ocena = $film['prosecna_ocena'];
        $film_autor = $film['autor'];
        $film_datum = $film['datum'];
        $film_glumci = $film['glumci'];
        $film_zemlja = $film['zemlja'];
        $film_studio = $film['studio'];
        $film_tagovi = $film['tagovi'];  
        $film_prosecna_ocena = $film['prosecna_ocena'];
    endforeach;


  if(isset($_POST['update_post'])){
    global $connection;
    $film_naziv = $_POST['film_naziv'];
    $film_autor = $_POST['film_autor']; 
    $film_zanr = $_POST['film_zanr'];
    $film_status = $_POST['film_status'];
    $film_datum = $_POST['film_datum'];
    $film_glumci = $_POST['film_glumci'];
    $film_poster = $_FILES['image']['name'];  
    $film_poster_temp = $_FILES['image']['tmp_name'];  
    $film_zemlja = $_POST['film_zemlja'];  
    $film_tagovi = $_POST['film_tagovi'];  
    $film_sadrzaj = $_POST['film_sadrzaj'];
    $film_studio = $_POST['film_studio'];
   
    move_uploaded_file($film_poster_temp, "../images/$film_poster");
      
    if (empty($film_poster)):
        $query = "SELECT * FROM filmovi WHERE id = $film_id ";
        $select_image = mysqli_query($connection,$query);
        while($row=mysqli_fetch_array($select_image))
            $film_poster = $row['poster'];
    endif;
      
    $query = "UPDATE filmovi SET
        naziv='{$film_naziv}',
        zanr_id='{$film_zanr}',
        datum='{$film_datum}',
        autor='{$film_autor}',
        status='{$film_status}',
        tagovi='{$film_tagovi}',
        poster='{$film_poster}',
        sadrzaj='{$film_sadrzaj}',
        glumci='{$film_glumci}',
        zemlja='{$film_zemlja}',
        studio='{$film_studio}'
    WHERE id = {$film_id} ";
    
      
    $edit_post_query= mysqli_query($connection,$query);
    confirmQuery($edit_post_query);
    
    echo "<script>alert('Uspešno ste izmenili film!');</script>";
    echo "<p class='bg-success' style='padding: 10px; width: 30%;'>Film je izmenjen.<br><a href='../film.php?f_id={$film_id}'>Pogledaj film</a>
    ili
    <a href='./filmovi.php'>Izmeni neki drugi film</a>
</p>";
  } 

?>
  <div class="movie-image">
        <img src="../images/<?=$film_poster; ?>"> 
</div>  
   <form action="" method="post" enctype="multipart/form-data">
   <div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="film_naziv">Naziv filma</label>
            <input value="<?=$film_naziv?>" type="text" class="form-control" name="film_naziv">
        </div>
    </div>    
    <div class="col-md-3">
        <div class="form-group">
        <label for="film_zanr">Kategorija</label><br>
        <select   class="form-control selectpicker" name="film_zanr" id="film_zanr">
            <?php
                foreach (select_zanrovi(" id = '{$film_zanr}'") as $zanr)
                    $naziv_kategorije = $zanr['naziv'];
            ?>    
        <option value='<?=$film_zanr?>'>Trenutno izabrano - <?=$naziv_kategorije?></option>

        <?php 
            foreach (select_zanrovi() as $zanr):
                $naziv_kategorije = $zanr['naziv'];
                $id_kategorije = $zanr['id'];

                echo "<option value='{$id_kategorije}'>{$naziv_kategorije}</option>";
            endforeach;
        ?>
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
        <label for="film_status">Status</label><br>
        <select  class="form-control selectpicker" name="film_status" id="film_status">
            <option value='<?=$film_status?>'>Trenutno - <?=$film_status?></option>
            <?php
                    echo "<option value='sakriven'>Sakrij</option>";
                    echo "<option value='objavljen'>Objavi</option>" ;
        
            ?>
            </select>
        </div>
    </div>
      
    <div class="col-md-4">
        <div class="form-group">
            <label for="image">Producent</label>
            <input type="text" class="form-control" value="<?=$film_autor; ?>" name="film_autor">
        </div> 
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="image">Glumci</label>
            <input type="text" class="form-control" value="<?=$film_glumci; ?>" name="film_glumci">
        </div> 
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="image">Poster filma</label>
            <input type="file" name="image"><br>  
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="film_tagovi">Ključne reči za pretragu</label>
            <input value="<?=$film_tagovi?>" type="text" class="form-control" name="film_tagovi">
        </div>
    </div>   
    
    <div class="col-md-4">
        <div class="form-group">
            <label for="film_tagovi">Datum objavljivanja</label>
            <div class="input-group date" data-date-format="dd.mm.yyyy">
                <input  value="<?=$film_datum?>"  name="film_datum" type="text" class="form-control" placeholder="dd.mm.yyyy">
                <div class="input-group-addon" >
                    <span class="fa fa-table"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
            <label for="film_tagovi">Zemlja nastanka filma</label>
            <input value="<?=$film_zemlja?>" type="text" class="form-control" name="film_zemlja">
        </div>
    </div>
    <div class="col-md-4">
    <div class="form-group">
            <label for="film_tagovi">Studio snimanja</label>
            <input value="<?=$film_studio?>" type="text" class="form-control" name="film_studio">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="film_sadrzaj">Opis filma</label>
        
            <textarea class="form-control" name="film_sadrzaj" id="body" cols="30" rows="10"><?=$film_sadrzaj?></textarea>
    
        </div>
    </div>
    </div>
    <div class="text-center">
        <div class="form-group">
            <button class="btn btn-success btn-lg" type="submit" name="update_post">IZMENI FILM&nbsp;&nbsp;<i class="fa fa-pencil"></i></button>
        </div>
    </div>
    
</form>