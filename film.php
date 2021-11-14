<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navigation.php'; ?>
<!-- skripta za GOOGLE MAPU -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACsttdzuma--8b07wAksCPbg4OGGvr1uwMilos"></script>

<!-- css koji se SAMO koristi na ovoj strani -->
<style>
    .map {
        border: 2px solid #000;
        height: 20em;
        overflow: hidden;
        width: 20em;
        margin: 2em auto;
    }
    .map__inner {
        height: 20em;
        width: 20em;
    }
    .map__canvas {
        height: 100%;
        width: 100%;
    }
    .rating {
        width: 195px;
        font-size: 45px;
        overflow:hidden;
    }
    .rating input {
    float: right;
    opacity: 0;
    position: absolute;
    }
    .rating a,
    .rating label {
            float:right;
            color: #aaa;
            text-decoration: none;
            -webkit-transition: color .4s;
            -moz-transition: color .4s;
            -o-transition: color .4s;
            transition: color .4s;
        }
    .rating label:hover ~ label,
    .rating input:focus ~ label,
    .rating label:hover,
            .rating a:hover,
            .rating a:hover ~ a,
            .rating a:focus,
            .rating a:focus ~ a		{
                color: orange;
                cursor: pointer;
            }
    .ocena {
        position: absolute;
        top: -25px;
        right: 100px;
        background: #000;
        color:#fff;
        padding: 25px;
        border-radius: 50%;
        cursor: default;
    }

    /*  ZVEZDICE */
    .star-cb-group {
        font-size: 0;
        unicode-bidi: bidi-override;
        direction: rtl;
    }
    .star-cb-group * {
        font-size: 4rem;
    }
    .star-cb-group > input {
        display: none;
    }
    .star-cb-group > input + label {
        display: inline-block;
        overflow: hidden;
        text-indent: 9999px;
        width: 1em;
        white-space: nowrap;
        cursor: pointer;
    }
    .star-cb-group > input + label:before {
        display: inline-block;
        text-indent: -9999px;
        content: '\2606';
        color: #888;
    }
    .star-cb-group > input:checked ~ label:before, .star-cb-group > input + label:hover ~ label:before, .star-cb-group > input + label:hover:before {
        content: '\2605';
        color: #e52;
        text-shadow: 0 0 1px #333;
    }
    .star-cb-group > .star-cb-clear + label {
        text-indent: -9999px;
        width: 0.5em;
        margin-left: -0.5em;
    }
    .star-cb-group > .star-cb-clear + label:before {
        width: 0.5em;
    }
    .star-cb-group:hover > input + label:before {
        content: '\2606';
        color: #888;
        text-shadow: none;
    }
    .star-cb-group:hover > input + label:hover ~ label:before, .star-cb-group:hover > input + label:hover:before {
        content: '\2605';
        color: #e52;
        text-shadow: 0 0 1px #333;
    }
</style>


<!-- Sadrzaj -->
<div class="container" style="margin: 30px auto 80px auto;">
    <div class="row">        
        <div class="col-md-12">
            <?php
            if (isset($_GET['f_id'])):
                $film_id = $_GET['f_id'];

                $povecaj_pregled_za_jedan  = "UPDATE filmovi SET broj_pregleda = broj_pregleda + 1 WHERE id = {$film_id} ";
                insert_update_query($povecaj_pregled_za_jedan);

                $sql_filmovi="SELECT * FROM filmovi WHERE id =  {$film_id} ";
                $detalji_filma = select_query($sql_filmovi);

                if (count($detalji_filma) == 0):
                    echo "  <script> history.go(-1) </script> ";
                else:
                    foreach ($detalji_filma as $film):
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
                        $film_prosecna_ocena = $film['prosecna_ocena'];

                        if($film_status != "sakriven" || (isset($_SESSION["user_role"]) ? $_SESSION["user_role"] == "admin" ? true : false : false)):
            ?>
            
                  
            
            <h1 class="page-header">
            <?php if($film_status == "sakriven"): //if post is hidden ?>
                <div class="alert alert-danger" role="alert">
                    <p class="alert-heading">Ovaj film je sakriven i samo administratori mogu videti ovu stranu!</p>
                    <hr>
                    <p class="alert-heading">Ukoliko želite da objavite ovaj film, molim Vas da <a href="/filmoteka/admin/filmovi.php?source=izmeni_film&f_id=<?=$film_id?>">kliknete ovde</a>, a zatim promenite status.</p>
                </div> 
            <?php endif; ?>
                <?=$film_naziv?>
                <small>
                <a href="zanr.php?id=<?=$film_zanr?>">
                <?php
                $sql_zanrovi = "SELECT naziv FROM zanrovi WHERE id = '{$film_zanr}' ; ";
                foreach (select_query($sql_zanrovi) as $zanr):
                    $naziv_kategorije = $zanr['naziv'];
                    echo " - $naziv_kategorije";
                endforeach;
                ?>
                </a>
                </small>
                <small style="float: right; margin-top: 15px;">Zemlja snimanja: <b><?=$film_zemlja?></b></small>
                
            </h1>

            <div class="row">
            <div class="col-md-4">
            <img class="img-responsive" src="images/<?=$film_poster?>" alt="<?="$cat_title - $film_naziv"?>" style="margin: 0 auto; max-width: 300px;">
            <p class="text-center" style="margin: 1em auto;">Lokacija studija:<br><?=$film_studio?></p>
            <div class="map">
                <div class="map__inner">
                    <div id="js-map" class="map__canvas"></div>
                </div> 
            </div>  
            </div>
            <div class="col-md-8">
            <p><b>Objavljen:</b> <?=$film_datum?></p>
            <p><b>Producent:</b> <?=$film_autor?></p>
            <p><b>Glumci:</b> <?=$film_glumci?></p>
            <h3 class="ocena" title="Ocena <?=$film_prosecna_ocena?> od 5"><?=number_format($film_prosecna_ocena, 2)?></h3>
            <hr class="style18">
            <p><?=$film_sadrzaj?></p><br>
            <?php else : ?>
            <h1 class="text-center" style="padding: 20vh;"><i class="fa fa-times" aria-hidden="true" style="color: red;font-size:50px;"></i><br><br>Izabrani film ne postoji<br><br>
            <a href="./index.php?str=1" style="background-color: #f2f2f2; color: red; text-decoration: none; font-weight: bold;border-radius: 10px;padding: 5px 10px;">Pogledajte druge filmove</a></h1>
            <?php 
             endif;
        endforeach;
    endif;
else:
    header("Location: index.php");
endif;
?> 
<!-- Komentari -->
<?php
date_default_timezone_set("Europe/Belgrade");
$date = date("d.m.Y");

if (isset($_POST['create_comment'])):
    $film_id = $_GET['f_id'];
    $komentar_autor = $_SESSION['user_id'];
    $komentar_sadrzaj = $_POST['komentar_sadrzaj'];
    $komentar_ocena = $_POST['komentar_ocena'];

    if (!empty($komentar_autor) && !empty($komentar_sadrzaj)):

        $sql_komentar = "INSERT INTO komentari (film_id, autor, sadrzaj, ocena , status,datum)
        VALUES ($film_id ,'{$komentar_autor}', '{$komentar_sadrzaj}', '{$komentar_ocena}', 'approved','{$date}')";
        if (!insert_update_query($sql_komentar))
            die('Neuspelo ubacivanje komentara ' . mysqli_error($connection));
    endif;
endif;
?> 
<!-- Forma za komentare -->
<?php
if($film_status != "sakriven"):
if (isset($_SESSION['user_id'])):
?>
    <div class="well">
        <h4>Ostavite komentar:</h4>
        <form action="" method="post" onsubmit="return validateForm()" role="form">
            <div class="form-group">
                <label for="comment">Vaš komentar</label>
                <textarea name="komentar_sadrzaj" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group">
            <label>Ocenite film</label><br>
                <span class="star-cb-group">
                    <input type="radio" id="rating-5" name="komentar_ocena" value="5" /><label for="rating-5">5</label>
                    <input type="radio" id="rating-4" name="komentar_ocena" value="4" /><label for="rating-4">4</label>
                    <input type="radio" id="rating-3" name="komentar_ocena" value="3" /><label for="rating-3">3</label>
                    <input type="radio" id="rating-2" name="komentar_ocena" value="2" /><label for="rating-2">2</label>
                    <input type="radio" id="rating-1" name="komentar_ocena" value="1" /><label for="rating-1">1</label>
                    <input type="radio" id="rating-0" name="komentar_ocena" value="0" class="star-cb-clear" /><label for="rating-0">0</label>
                </span>
            </div>
            <button type="submit" name="create_comment" class="btn btn-primary">Pošalji</button>
        </form>
    </div>
<?php else: ?>
    <div class='text-center bg-warning' style='padding: 10px 0 15px 0;'>
        <h3><i class='fa fa-exclamation'></i>&nbsp;&nbsp;<b>Ulogujte se kako bi ste ostavili komentar i ocenu o filmu</b>&nbsp;&nbsp;<i class='fa fa-exclamation'></i></h3>
    </div>
<?php 
    endif;//user ulogovan
endif; //sakriven ?>
<hr>            
<?php

$ocena = 0;
$br_ocena = 0;
$trenutna_ocena = 0;

$sql_prikupi_komentare = "SELECT *, CONCAT(k.ime, ' ', k.prezime) as autor FROM komentari kom
JOIN korisnici k ON (kom.autor_id = k.id)
WHERE kom.film_id = {$film_id} ";
$sql_prikupi_komentare .= "AND status = 'approved' ";
$sql_prikupi_komentare .= "ORDER BY kom.id DESC ";
$komentari = select_query($sql_prikupi_komentare);


foreach ($komentari as $komentar):
    $komentar_datum = $komentar['datum'];
    $komentar_sadrzaj = $komentar['sadrzaj'];
    $komentar_autor = $komentar['autor'];
    $komentar_ocena = $komentar['ocena'];

    $br_ocena++;
    $ocena += $komentar_ocena;
?>        
<!-- Pregled komentara -->
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src='
            <?php
                if ($komentar_ocena == 5)
                {
                    echo "images/ocene/5.png";
                }
                else if ($komentar_ocena == 4)
                {
                    echo "images/ocene/4.png";
                }
                else if ($komentar_ocena == 3)
                {
                    echo "images/ocene/3.png";
                }
                else if ($komentar_ocena == 2)
                {
                    echo "images/ocene/2.png";
                }
                else if ($komentar_ocena == 1)
                {
                    echo "images/ocene/1.png";
                }
            ?>
            ' alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><b><?=$komentar_autor?></b>
                <small><?=$komentar_datum?></small>
            </h4>
            
            <?="<p style='font-size: 1.5rem; margin: 0;'>\"" . $komentar_sadrzaj . "\"</p>
            <span style='font-size: 1.1rem; font-style: italic'>Ocena - " . $komentar_ocena . "</span>";
?>
        </div>
    </div>
<?php
endforeach; //kraj prikaza komentara

// if ($br_ocena > 0) $trenutna_ocena += $ocena / $br_ocena;
// $query = "UPDATE posts SET post_avg_mark='{$trenutna_ocena}' WHERE post_id = {$film_id} ";
// $edit_post_query = mysqli_query($connection, $query);

?>

                </div>
            </div>
        </div>        
    </div>   
</div>
    
<script>

var initializeMap = function() {
	var mapOptions = {
		center: concordeLatLng,
		zoom: 15,
		streetViewControl: true,
		mapMaker: true,
		heading: 20,
		
    
	};
	var map = new google.maps.Map(document.getElementById("js-map"), mapOptions);

	var marker = new google.maps.Marker({
		position: concordeLatLng,
		map: map,
    icon: 'https://maps.google.com/mapfiles/ms/icons/blue-dot.png'
	});        
        }
        <?php
        $lat = explode(',', $film_studio) [0];
        $long = explode(',', $film_studio) [1];
        ?>
        var concordeLatLng = new google.maps.LatLng(<?=$lat
        ?>,<?=$long
        ?>);
        google.maps.event.addDomListener(window, 'load', initializeMap);

</script>

<script>
        function validateForm() {
            var radios = document.getElementsByName("komentar_ocena");
            var formValid = false;

            var i = 0;
            while (!formValid && i < radios.length) {
                if (radios[i].checked) formValid = true;
                i++;        
            }

            if (!formValid) alert("Morate dodeliti neku ocenu za film!");
            
            return formValid;
        }
</script>
<?php include 'includes/footer.php'; ?>
