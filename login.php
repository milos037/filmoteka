<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<!-- Navigacija -->
<?php  include "includes/navigation.php"; ?>
<?php
	if(isset($_SESSION['user_id']))
        header("Location: index.php?str=1");
?>
<!-- Sadrzaj -->
<div class="container" style="margin-top: 20vh">
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="text-center">
							<h3><i class="fa fa-user fa-2x"></i></h3>
							<h2 class="text-center">Ulogujte se</h2>
							<div class="panel-body">
								<form id="login-form" role="form" autocomplete="off" class="form" action="includes/login.php" method="post">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"></i></span>

											<input name="username" type="text" class="form-control" placeholder="Unesite korisničko ime">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-lock"></i></span>
											<input name="password" type="password" class="form-control" placeholder="Unesite šifru">
										</div>
									</div>
									<div class="form-group">
										<input name="login" class="btn btn-lg btn-danger btn-block" value="Potvrdi" type="submit">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include "includes/footer.php";?>
</div>