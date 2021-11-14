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

                if(isset($_GET['source'])){

                $source = escape($_GET['source']);

                } else {

                $source = '';

                }

                switch($source) {
                    
                        
                    case '200';
                    ;
                    break;
                    
                    default:
                    
                    include "includes/view_all_comments.php";
                    
                    break;
                    
                    
                    
                    
                }

                ?>
            </div>
        </div>
        <!-- /.row -->

</div>
<!-- /.container-fluid -->

</div>
    
     
        <!-- /#page-wrapper -->
        
    <?php include "includes/admin_footer.php" ?>
