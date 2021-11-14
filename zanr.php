<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>
<link href="css/zvezdice-samo-prikaz.css" rel="stylesheet">

<?php include 'includes/navigation.php'; ?>
    <?php
    if(isset($_GET['id'])):
        $film_zanr_id = $_GET['id'];
        $sql_zanrovi = "SELECT naziv FROM zanrovi WHERE id = '{$film_zanr_id}' ; ";
        foreach (select_query($sql_zanrovi) as $zanr):
            $naziv_kategorije = $zanr['naziv'];
            echo '<h1 class="text-center" style="margin-top: 60px;margin-bottom: 10px;text-transform:uppercase;"> ' . $naziv_kategorije . '</h1>';
        endforeach;

    ?>
    <div class="row" style="width: 80%;margin: 0 auto 100px auto;">
        <section class="main products-list">
        <?php                   
        $sql_filmovi="SELECT * FROM filmovi WHERE zanr_id =  {$film_zanr_id} ";
        foreach (select_query($sql_filmovi) as $film):
            $film_id = $film['id'];
            $film_zanr = $film['zanr_id'];
            $film_naziv = $film['naziv'];
            $film_poster = $film['poster'];
            $film_sadrzaj = substr($film['sadrzaj'], 0 , 100);
            $film_status = $film['status'];
            $film_prosecna_ocena = $film['prosecna_ocena'];
            if ($film_status == 'objavljen'):      
        ?>    
        <div class="film-kartica">
            <h2 class="film-kartiza__naziv">
                <a href="film.php?f_id=<?=$film_id?>">
                <?=$film_naziv?></a>
            </h2>

            <a href="film.php?f_id=<?=$film_id?>" class="film-kartiza__slika-wrapper">
                <img src="images/<?=$film_poster?>" alt="<?="$naziv_kategorije - $film_naziv"?>" class="film-kartiza__slika-wrapper-img">
            </a>
            <a href="zanr.php?id=<?=$film_zanr?>">
            <?php
                foreach (select_zanrovi("id = '{$film_zanr}'") as $zanr)
                    echo "-".$zanr['naziv']."-";
            ?>   
            </a>
            <div class="film-kartica__opis">
                <p>
                    <?=$film_sadrzaj?>...
                </p>
            </div>

            <div class="film-kartica__dugme">
                <span class="star-cb-group">
                    <input  type="radio" id="rating-5-<?= $film_id;?>" name="comment_stars-<?= $film_id;?>" value="5" /><label for="rating-5-<?= $film_id;?>">5</label>
                    <input type="radio" id="rating-4-<?= $film_id;?>" name="comment_stars-<?= $film_id;?>" value="4" /><label for="rating-4-<?= $film_id;?>">4</label>
                    <input type="radio" id="rating-3-<?= $film_id;?>" name="comment_stars-<?= $film_id;?>" value="3" /><label for="rating-3-<?= $film_id;?>">3</label>
                    <input type="radio" id="rating-2-<?= $film_id;?>" name="comment_stars-<?= $film_id;?>" value="2" /><label for="rating-2-<?= $film_id;?>">2</label>
                    <input type="radio" id="rating-1-<?= $film_id;?>" name="comment_stars-<?= $film_id;?>" value="1" /><label for="rating-1-<?= $film_id;?>">1</label>
                    <input type="radio" id="rating-0-<?= $film_id;?>" name="comment_stars-<?= $film_id;?>" value="0" class="star-cb-clear" /><label for="rating-0">0</label>
                </span> 
                <?php if($film_prosecna_ocena > 0): ?>
                <span style="position: relative;top: 0px;font-weight: bold;color: #fff;float:right;"><?="(".$film_prosecna_ocena.")"?></span>
                <?php endif; ?>
                <script>
                        $("input[type=radio]").prop('disabled',true);
                    <?php if($film_prosecna_ocena >= 0 && $film_prosecna_ocena <= 0.5 ){?>
                        $("#rating-0-<?=$film_id;?>").prop('checked',true);
                    <?php }
                    if($film_prosecna_ocena > 0.5 && $film_prosecna_ocena <= 1.5) {?>
                        $("#rating-1-<?=$film_id;?>").prop('checked',true);
                    <?php }
                    if($film_prosecna_ocena > 1.5 && $film_prosecna_ocena <= 2.5){?>        
                        $("#rating-2-<?=$film_id;?>").prop('checked',true);
                    <?php }
                    if($film_prosecna_ocena > 2.5 && $film_prosecna_ocena <= 3.5){?>
                        $("#rating-3-<?=$film_id;?>").prop('checked',true);
                    <?php }
                    if($film_prosecna_ocena > 3.5 && $film_prosecna_ocena <= 4.5){?>
                        $("#rating-4-<?=$film_id;?>").prop('checked',true);
                    <?php }
                    if($film_prosecna_ocena > 4.5 && $film_prosecna_ocena <= 5){?>
                        $("#rating-5-<?=$film_id;?>").prop('checked',true);
                    <?php } ?>
                </script>
            </div>
            <div class="text-center">
                <a href="film.php?f_id=<?=$film_id?>" class="btn btn-danger" style="margin: 10px 0;color:#fff">Detaljnije</a> 
            </div>   
        </div>
        <?php 
            endif; //end if status objavljen
        endforeach; //end film foreach
        ?>
    </section>
    <?php 
    else:
        
    endif;
    ?>
</div>
<?php  include 'includes/footer.php'; ?>
