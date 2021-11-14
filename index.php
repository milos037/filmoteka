<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>
<link href="css/zvezdice-samo-prikaz.css" rel="stylesheet">
<?php include 'includes/navigation.php'; ?>
<div class="container">
    <div class="row">
        <h1 class="text-center" style="margin-top: 60px;margin-bottom: 10px;"><?= isset($_GET['pretrazi']) ? "REZULTATI PRETRAGE" : "FILMOVI"?></h1>
        <?php if(!isset($_GET['pretrazi'])): ?>
        <div class="row">
            <div class="col-lg-12">
                <ul class="categories-list text-center list-unstyled list-inline">
                <?php 
                foreach (select_zanrovi() as $zanr):
                    $naziv_kategorije = $zanr['naziv'];
                    $id_kategorije = $zanr['id'];

                    echo "<li><a href='zanr.php?id={$id_kategorije}'>{$naziv_kategorije}</a></li>";
                endforeach;
                ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<!-- Sadrzaj -->
<div class="row" style="width: 80%;margin: 0 auto;">
    <section class="main products-list">
        <?php
        $per_page = 8 ;
        $page =  isset($_GET['str']) ? $_GET['str'] : "";
        $page_1 = $page == "" || $page == 1 ? 0 : ($page * $per_page) - $per_page;
                
        if(isset($_GET['pretrazi'])):
            $search = ltrim(mysqli_escape_string($connection, $_GET['pretrazi']));
            $sql_filmovi="SELECT * FROM filmovi WHERE 
            tagovi LIKE '%$search%' OR
            naziv LIKE '%$search%' OR
            autor LIKE '%$search%' 
            ORDER BY id DESC LIMIT {$page_1},{$per_page}";
        else:
            $count = return_num_rows("SELECT id FROM filmovi");
            $sql_filmovi="SELECT * FROM filmovi ORDER BY id DESC LIMIT {$page_1},{$per_page} ";
        endif;    
        if($count == 0) {

            echo '<h1 class="text-center" style="padding: 20vh;"><i class="fa fa-times" aria-hidden="true" style="color: red;font-size:50px;"></i><br><br>Nema rezultata<br><br>
            <a href="./index.php?str=1" style="background-color: #f2f2f2; color: red; text-decoration: none; font-weight: bold;border-radius: 10px;padding: 5px 10px;">Pogledajte druge filmove</a></h1>';

        } 
        
        $count = ceil($count / 8) ;
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
</div>
<hr>
<ul class="pager">
    <?php  
        $queries_url = array();
        parse_str($_SERVER['QUERY_STRING'], $queries_url);
        unset($queries_url["str"]);
        unset($queries_url["submit"]);
        $page_query = count($queries_url) > 0 ? "&".http_build_query($queries_url) : "";
        for ($i = 1; $i <= $count ; $i++):
            if ($i == $page)
                echo "<li><a class='active_link' href='index.php?str={$i}'>{$i}</a></li>";
            else
                echo "<li><a href='index.php?str={$i}{$page_query}'>{$i}</a></li>";
        endfor;
    ?>
</ul>
<?php include 'includes/footer.php'; ?>
