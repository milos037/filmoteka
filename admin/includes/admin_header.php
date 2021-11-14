<?php include "../includes/db.php";?>
<?php include_once "./functions.php";?>

<?php ob_start(); ?>
<?php session_start(); ?>
<?php
    if(!isset($_SESSION['user_role']) || ($_SESSION['user_role'] != 'admin')) {
            
            header("Location: ../index.php");

    }
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel='icon' href='../images/favicon-admin.ico' type='image/x-icon'/ >
    <title>Filmovi - Admin</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" rel="stylesheet">
    

    <!-- Custom fontovi -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,700&display=swap&subset=latin-ext" rel="stylesheet"> 
    <link href=" https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
 
    
    
    <script src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
   
</head>

<body>
<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
