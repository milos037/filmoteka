<?php include "includes/admin_header.php"; ?>
<?php include_once "functions.php"; ?>
<?php include "includes/admin_navigation.php"; ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    ŽANROVI FILMOVA
                    <small>Ispit</small>
                </h1>
                <div class="col-xs-6">
                <?php dodaj_zanr(); ?>
                         
                <form action="" method="post">
                    <div class="form-group">
                        <label for="naziv_zanra">Dodaj žanr</label>
                        <input type="text" class="form-control" name="naziv_zanra">
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary" type="submit" name="submit" value="Dodaj žanr">
                    </div>
                </form>
                    <?php
                        if(isset($_GET['izmeni'])){
                            $zanr_id = $_GET['izmeni'];
                            include 'includes/izmeni_zanr.php';
                        }
                    ?>
                    </div> <!-- category form -->
                    <div class="col-xs-6">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Naziv žanra</th>
                                    <th>Izmena </th>
                                    <th>Brisanje </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                                svi_zanrovi(); 
                                izbrisi_zanr();              
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>        
        </div>
    </div>
</div>
<?php include "includes/admin_footer.php"; ?>
