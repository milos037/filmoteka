<?php include "includes/admin_header.php" ?>
<?php include "includes/admin_navigation.php" ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    KOMENTARI
                    <small>Ispit</small>
                </h1>
<?php  
if(isset($_POST['checkBoxArray'])):   
    foreach($_POST['checkBoxArray'] as $commentValueId ):  
    $bulk_options = $_POST['bulk_options'];
        switch($bulk_options):
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
        endswitch;    
    endforeach;
endif;
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
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Komentarisao</th>
                <th>Komentar</th>
                <th>Ocena</th>
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
    $query = "SELECT kom.*, CONCAT (k.ime, ' ', k.prezime) as autor FROM komentari kom
    JOIN korisnici k ON (kom.autor_id = k.id)";
    $select_comments = mysqli_query($connection,$query);  
    while($row = mysqli_fetch_assoc($select_comments)) {
        $komentar_id         = $row['id'];
        $komentar_film_id    = $row['film_id'];
        $komentar_autor     = $row['autor'];
        $komentar_sadrzaj    = $row['sadrzaj'];
        $komentar_status     = $row['status'];
        $komentar_datum       = $row['datum'];
        $komentar_ocena       = $row['ocena'];
       
        echo "<tr>";
    ?>
        
    <td>
        <input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $komentar_id; ?>'></td>
    <?php
        
        echo "<td>$komentar_id </td>";
        echo "<td>$komentar_autor</td>";
        echo "<td>$komentar_sadrzaj</td>"; 
        echo "<td>$komentar_ocena</td>";       
        
        if ($komentar_status == 'approved'){
            $komentar_status = 'dozvoljen';
        } else {
            $komentar_status = 'zabranjen';
        }

        echo "<td>$komentar_status</td>";
        
        
        $query = "SELECT id, naziv FROM filmovi WHERE id = $komentar_film_id ";
        $select_post_id_query = mysqli_query($connection,$query);
        while($row = mysqli_fetch_assoc($select_post_id_query)){
            $film_id = $row['id'];
            $naziv_filma = $row['naziv'];
            echo "<td><a href='../film.php?f_id=$film_id'>$naziv_filma</a></td>";
        }

        echo "<td>$komentar_datum</td>";
        echo "<td><a href='komentari.php?odobri=$komentar_id&post=$komentar_film_id'><i class='fa fa-check-circle' aria-hidden='true'></i>&nbsp;Dozvoli</a></td>";
        echo "<td><a href='komentari.php?sakrij=$komentar_id&post=$komentar_film_id'><i class='fa fa-times-circle' aria-hidden='true'></i>&nbsp;Zabrani</a></td>";
        echo "<td><a href='komentari.php?izbrisi=$komentar_id&post=$komentar_film_id'><i class='fa fa-trash' aria-hidden='true'></i>&nbsp;Izbriši</a></td>";
        echo "</tr>";
   
    }
    ?>
    </tbody>
</table>      
</form>       
<?php

if(isset($_GET['odobri'])):
    $$id_komentara = escape($_GET['odobri']);
    
    $query = "UPDATE komentari SET status = 'approved' WHERE id = $id_komentara   ";
    $approve_comment_query = mysqli_query($connection, $query);
    header("Location: komentari.php");
endif;


if(isset($_GET['sakrij'])):
    $id_komentara = escape($_GET['sakrij']);

    $query = "UPDATE komentari SET status = 'unapproved' WHERE id = $$id_komentara ";
    $unapprove_comment_query = mysqli_query($connection, $query);
    header("Location: komentari.php");
endif;

if(isset($_GET['izbrisi'])):
    $id_komentara = escape($_GET['izbrisi']);

    $query = "DELETE FROM komentari WHERE id = {$id_komentara} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: komentari.php");
endif;  






?> 




            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

        
    <?php include "includes/admin_footer.php" ?>

            
            
            
            
            
            
            
      