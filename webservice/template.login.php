<?php

// deklare variabel koneksi PDO
$koneksi		= koneksi();

if(isset($_POST['input_login'])) {
	$username		= (isset($_POST['username']) && !empty($_POST['username']))?$_POST['username']:'';
	$password		= (isset($_POST['password']) && !empty($_POST['password']))?$_POST['password']:'';
	$string		= "SELECT * FROM `user` WHERE `username`='$username' AND `password`='$password' AND `level`='1'";
	$q          	= $koneksi->query($string);

	if ($q && $q->rowCount () > 0) {
		$f 				  = $q->fetchAll(PDO::FETCH_NUM);
		$id					= $f[0][0];
		$level				= $f[0][3];
		$str1		= "SELECT * FROM `customer` WHERE `id_user`='$id'";
		$q1			= $koneksi->query($str1);
		
		if($q1 && $q1->rowCount()>0 && $level==1) {
			$f2		= $q1->fetchAll(PDO::FETCH_NUM);
			$_SESSION['id']       = $f[0][0];
			$_SESSION['login']    = 'user';
			$_SESSION['customer'] = $f2[0][0];
	 	 	header("Location: index.php");
		} else {
			$error		= "ID customer anda tidak ditemukan";
		}
	} else {
		$error		= "Username dan password tidak ditemukan";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login / Sign In Page</title>
	<link href="image/logo.png" rel="shortcut icon"/>
   <!--Made with love by Mutiullah Samim -->
	<link href="./vendors/bootstrap/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="./vendors/font-awesome/css/font-awesome.min.css">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="./css/login.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Sign In Customer</h3>
				<div class="d-flex justify-content-end social_icon">

				</div>
			</div>
			<div class="card-body">
				<?php
				if(isset($error)) {
					?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						
						<?php echo $error ?>
					</div>
					<?php
				}
				?>
				<form method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-user"></i></span>
						</div>
						<input type="text" name="username" class="form-control" placeholder="username">

					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-key"></i></span>
						</div>
						<input type="password" name="password" class="form-control" placeholder="password">
					</div>

					<div class="form-group">
						<input type="submit" name="input_login" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>

		</div>
	</div>
</div>


<script src="./vendors/bootstrap/bootstrap.min.js"></script>
<script src="./vendors/jquery/dist/jquery.min.js"></script>

</body>
</html>
