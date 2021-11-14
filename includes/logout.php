
<?php session_start(); ?> 
<?php
    $_SESSION['username'] = null ;
    $_SESSION['password'] = null ;
    $_SESSION['firstname'] = null ;
    $_SESSION['lastname'] = null ;
    $_SESSION['user_role'] = null ;
    $_SESSION['user_id'] = null ;
    $_SESSION['email'] = null ;
    $_SESSION['image'] = null ;

    header("Location: ../index.php?str=1");
?>
