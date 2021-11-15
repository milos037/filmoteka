<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Izmeni izabrani žanr
        </label>
            <?php
            //prikazuje sve kategorije
            if (isset($_GET['izmeni'])) {
            $id_zanra               = $_GET['izmeni'];
            foreach (select_zanrovi(" id = $id_zanra ") as $zanr):
                $naziv_kategorije = $zanr['naziv'];
                $id_zanra = $zanr['id'];
            ?>
            <input value="<?=isset($naziv_kategorije) ? $naziv_kategorije : ""?>" type="text" class="form-control" name="naziv_kategorije">
            <?php
            endforeach;
            }
            if (isset($_POST['update'])) {
            $novi_naziv_kategorije = $_POST['naziv_kategorije'];
            $query         = "UPDATE zanrovi SET naziv = '{$novi_naziv_kategorije}' WHERE id = '{$id_zanra}'";
            $update_query  = mysqli_query($connection, $query);
            if (!$update_query) {
            die(mysqli_error($connection));
            } else {      echo "<script>alert('Uspešno ste izmenili žanr!');window.location = './zanrovi.php';</script>"; }
            }
            ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Izmeni">
    </div>
</form>
