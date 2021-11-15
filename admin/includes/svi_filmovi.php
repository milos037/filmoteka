<?php
if(isset($_POST['checkBoxArray'])){
    foreach($_POST['checkBoxArray'] as $postValueId){
      $bulk_options  =  $_POST['bulk_options'] ;   
        
     switch($bulk_options){
         case 'objavljen':
             $query = "UPDATE filmovi SET status = '{$bulk_options}' WHERE id = '{$postValueId}' ";
             $update_to_publish = mysqli_query($connection, $query);
         break;
          case 'sakriven':
             $query = "UPDATE filmovi SET status = '{$bulk_options}' WHERE id = '{$postValueId}' ";
             $update_to_draft = mysqli_query($connection, $query);
         break;
          case 'delete':
             $query = "DELETE FROM filmovi WHERE id = '{$postValueId}' ";
             $delete_post = mysqli_query($connection, $query);
         break;
             case 'clone':
                $sql_kloniran_film="SELECT * FROM filmovi WHERE id = '{$postValueId}'";
                foreach (select_query($sql_kloniran_film) as $film):
                    $film_naziv = $film['naziv'];
                    $film_zanr = $film['zanr_id'];
                    $film_datum = $film['datum'];
                    $film_autor = $film['autor'];
                    $film_status = $film['status'];
                    $film_poster = $film['poster'];
                    $film_tagovi = $film['tagovi'];
                    $film_sadrzaj = $film['sadrzaj'];
                endforeach; 
       
                $kolinraj_sql= "INSERT INTO filmovi (zanr_id, naziv, autor, datum, poster, sadrzaj, tagovi, status)
                VALUES('{$film_zanr}','{$film_naziv}','{$film_autor}',now(),'{$film_poster}','{$film_sadrzaj}','{$film_tagovi}','{$film_status}')";
                if (!insert_update_query($kolinraj_sql))
                    die (mysqli_error($connection));
         break;
     }
}
}
?>
<form action="" method="post">
    <div id="bulkOptionsContainer" class="col-xs-4" style="margin-bottom: 20px; padding: 0;">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Izaberite opciju</option>
            <option value="clone">Kloniraj</option>
            <option value="objavljen">Objavi</option>
            <option value="sakriven">Sakrij</option>
            <option value="delete">Izbriši</option>
           
        </select>
    </div>
    <div class="col-xs-4">
        <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i>
&nbsp;Potvrdi</button>
        <a class="btn btn-primary" href="filmovi.php?source=dodaj_film"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;
Dodaj novi film</a>
    </div>
    <div class="clearfix"></div>
    <table class="table table-bordered table-hover" id="example">
        <thead>
            <tr>
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>ID</th>
                <th>Naziv</th>
                <th>Kategorija</th>
                <th>Status</th>
                <th width="100px;">Slika</th>
                <th>Ključne reči</th>
                <th>Datum</th>
                <th>Komentari</th>
                <th>Akcija</th>
                <th>Br. pregleda</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql_filmovi="SELECT * FROM filmovi ORDER BY id DESC";
            foreach (select_query($sql_filmovi) as $film):
                $film_id = $film['id'];
                $film_autor = $film['autor'];
                $film_naziv = $film['naziv'];
                $film_sadrzaj = $film['sadrzaj'];
                $film_zanr = $film['zanr_id'];
                $film_status = $film['status'];
                $film_poster = $film['poster'];
                $film_tagovi = $film['tagovi'];
                $film_prosecna_ocena = $film['prosecna_ocena'];
                $film_datum = $film['datum'];
                $film_broj_pregleda = $film['broj_pregleda'];
                //moze se ubaciti ovi dole jos
                $film_glumci = $film['glumci'];
                $film_zemlja = $film['zemlja']; 
                $film_studio = $film['studio'];
                            
                $film_status = $film_status == "objavljen" ? "Objavljen" : "Sakriven";                
            ?>   
        <tr>
            <td><input class='checkBoxes' type='checkbox' name="checkBoxArray[]" value="<?=$film_id?>"></td>
            <?php                     
                echo "<td>$film_id</td>";
                echo "<td>$film_naziv</td>";
                
                $sql_zanrovi = "SELECT naziv FROM zanrovi WHERE id = '{$film_zanr}' ; ";
                foreach (select_query($sql_zanrovi) as $zanr):
                    $naziv_kategorije = $zanr['naziv'];
                    echo "<td>$naziv_kategorije</td>";    
                endforeach;                    
                    
                echo "<td>$film_status</td>";
                echo "<td><img src='../images/$film_poster' width='100px'</td>";
                echo "<td>$film_tagovi</td>";
                echo "<td>$film_datum</td>";

                $count_comments = return_num_rows("SELECT * FROM komentari WHERE film_id = $film_id");
                echo "<td><a href='komentari.php?id=$film_id'>$count_comments</a></td>";
                    
                echo "<td style='font-size: 2em;'><a href='../film.php?f_id=$film_id'<i class='fa fa-fw fa-eye'></i></a>
                <a href='filmovi.php?source=izmeni_film&f_id={$film_id}'><i class='fa fa-fw fa-edit'></i></a>
                <a href='filmovi.php?delete={$film_id}' onclick=\"return confirm('Da li ste sigurni da želite da obrišete film?');\"><i class='fa fa-fw fa-times-circle'></i></a></td>";
                echo "<td><a href ='filmovi.php?reset={$film_id}' onclick=\"return confirm('Da li ste sigurni da želite da restartujete preglede?');\"><i class='fa fa-fw fa-refresh'></i></a><strong>&nbsp;&nbsp;&nbsp;{$film_broj_pregleda}</strong></td>";    
                
                echo "</tr>";
            endforeach;
            ?>
        </tbody>
    </table>
</form>


<?php    
    if(isset($_GET['delete'])){
    
    $film_id = $_GET['delete'];
    $query = "DELETE FROM filmovi WHERE id = {$film_id}";
    $delete_query = mysqli_query($connection, $query);
    header("Location: filmovi.php");
}

    if(isset($_GET['reset'])){
    
    $the_post_id = $_GET['reset'];
    $query = "UPDATE filmovi SET broj_pregleda = 0 WHERE id=" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
    $reset_query = mysqli_query($connection, $query);
    header("Location: filmovi.php");
}
?>
