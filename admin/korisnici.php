<?php include "includes/admin_header.php"; ?>
<?php include_once "functions.php"; ?>
<?php include "includes/admin_navigation.php"; ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                   <h1 class="page-header">
                        KORISNICI
                        <small>Ispit</small>
                    </h1>
                    <?php 
                        $source = isset($_GET['source']) ? $_GET['source'] : "";

                        switch($source):
                            case 'add_user':
                            include "includes/add_user.php";
                            break;
                            case 'izmeni_korisnika':
                            include "includes/izmeni_korisnika.php";
                            break;
                            case '200':
                            echo "its 20";
                            break;    
                            default:
                            include "includes/svi_korisnici.php";
                            break;
                        endswitch;
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php include "includes/admin_footer.php"; ?>
