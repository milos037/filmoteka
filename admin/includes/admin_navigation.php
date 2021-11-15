        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header ">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-left top-nav">
            <li>
                <a href="filmovi.php?source=dodaj_film"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Dodaj novi film</a>
            </li>
            
            <li>
                <a href="filmovi.php"><i class="fa fa-film" aria-hidden="true"></i>&nbsp;&nbsp;Svi filmovi</a>
            </li>
            <li>
                <a href="zanrovi.php"><i class="fa fa-navicon"></i>&nbsp;&nbsp;Žanrovi</a>
            </li>
            <li>
                <a href="komentari.php"><i class="fa fa-comments"></i>&nbsp;&nbsp;Komentari</a>
            </li>
            <li>
                <a href="korisnici.php"><i class="fa fa-users"></i>&nbsp;&nbsp;Korisnici</a>
            </li>
            
            </ul>
            <ul class="nav navbar-right top-nav">
            <li>
                    <a href="../index.php?str=1"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;&nbsp; Glavna Strana</a>
            </li>
              
                 <li class="dropdown" style="padding-right: 15px">
                    <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><?php echo " ". $_SESSION['firstname']; ?> <b class="caret"></b></a>-->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="../images/<?php echo $_SESSION['image']; ?>" class='avatar'>&nbsp;<?php echo " ". $_SESSION['firstname']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../admin/profil.php"><i class="fa fa-fw fa-user"></i> Profil</a>
                        </li>
                        <li>
                        <li><a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Odjavi se</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>