<form action="" method="post">
    <div class="form-group">
        <label for="cat_title">Izmeni izabrani žanr
        </label>
        <?php
            //prikazuje sve kategorije
            if (isset($_GET['edit'])) {
            $cat_id               = $_GET['edit'];
            $query                = "SELECT * FROM categories WHERE cat_id = '{$cat_id}'";
            $select_categories_id = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_categories_id)) {
            $cat_id    = $row['cat_id'];
            $cat_title = $row['cat_title'];
            ?>
                    <input value="<?php
                            if (isset($cat_title)) {
                            echo $cat_title;
                            }
                            ?>" type="text" class="form-control" name="cat_title">
                    <?php
            }
            }
            if (isset($_POST['update'])) {
            $the_cat_title = $_POST['cat_title'];
            $query         = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = '{$cat_id}'";
            $update_query  = mysqli_query($connection, $query);
            if (!$update_query) {
            die(mysqli_error($connection));
            } else {      echo "<script>alert('Uspešno ste izmenili žanr!');window.location = './categories.php';</script>"; }
            }
            ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Izmeni">
    </div>
</form>
