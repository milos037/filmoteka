  <?php ob_start(); ?>
  <?php session_start(); ?>  <!-- Navigacija -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./index.php?str=1">
                   FILMOTEKA
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   <li class="dropdown">
                      <a href="./index.php?str=1" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ŽANROVI &nbsp;<i class="fa fa-chevron-circle-down" aria-hidden="true"></i></a>
                      <ul class="dropdown-menu">
                            <?php 
                            //ocitavanje svih zanrova
                            foreach (select_zanrovi() as $zanr):
                                $naziv_kategorije = $zanr['naziv'];
                                $id_kategorije = $zanr['id'];
            
                                echo "<li><a href='./zanr.php?id=$id_kategorije'>{$naziv_kategorije}</a></li>";
                            endforeach;
                            ?>
                            <li role="separator" class="divider"></li>
                            <li><a href="./index.php?str=1">Svi žanrovi</a></li>
                        </ul>
                    </li>
            <?php
            if(isset($_SESSION['user_id'])):
                    //ako je korisnik ulogovan
                    if ($_SESSION['user_role'] == 'admin')
                        echo '<li>
                                <a href="./admin/filmovi.php">ADMIN&nbsp; <i class="fa fa-tachometer" aria-hidden="true"></i></a>
                            </li>';
   
                    if(isset($_GET['f_id']))
                            echo "<li><a href=\"admin/filmovi.php?source=izmeni_film&f_id={$_GET['f_id']}\">IZMENI&nbsp; <i class='fa fa-pencil-square-o' aria-hidden='true'></i></a></li>" ;
                
                    echo '
                        <li>
                            <a href="./includes/logout.php">ODJAVI SE&nbsp; <i class="fa fa-sign-out" aria-hidden="true"></i></a>
                        </li>
                        ';    
                else:
                //ako korisnik nije ulogovan
                echo '<li>
                            <a href="./login.php">LOGIN&nbsp; <i class="fa fa-sign-in" aria-hidden="true"></i></a>
                        </li>
                        <li>
                            <a href="./registration.php">REGISTRACIJA&nbsp; <i class="fa fa-user-plus" aria-hidden="true"></i></a>
                        </li>';
                endif;
                                        
                ?>            
                </ul>
                    <ul class="nav navbar-nav navbar-right">
                    <?php if(isset($_SESSION['user_role'])): ?>
                    <li>
                        <p style="color: #fff;margin-top: 10px;">Zdravo, <b><?=$_SESSION['firstname']?></b></p>
                    </li>
                    <?php endif; ?>
                    <li>
                        <?php
                            if(isset($_GET['pretrazi'])):
                                $search = ltrim(mysqli_escape_string($connection, $_GET['pretrazi']));
                                $sql_filmovi="SELECT * FROM filmovi WHERE 
                                    tagovi LIKE '%$search%' OR
                                    naziv LIKE '%$search%' OR
                                    autor LIKE '%$search%' ";

                                $count = return_num_rows($sql_filmovi);
                            endif;
                        ?>
                        <form action="/filmoteka/index.php" method="GET" class="navbar-form" >
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="<?=isset($search) ? $search : "Pretraga..."?>" name="pretrazi">
                                <div class="input-group-btn">
                                    <button class="btn btn-default search" type='submit' value='pretraga'><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>  
                    </li>
                </ul>
            </div>
        </div>
    </nav>