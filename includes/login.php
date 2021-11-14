<?php include "db.php"; ?>
<?php session_start(); ?> 
<?php include "../admin/functions.php"; ?>
<?php
	checkIfUserIsLoggedInAndRedirect('/filmoteka/admin/index.php?str=1');
	if(ifItIsMethod('post')):
		if(isset($_POST['username']) && isset($_POST['password']))
			login_user($_POST['username'], $_POST['password']);
	endif;
?>
