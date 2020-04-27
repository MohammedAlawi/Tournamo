<?php
if(isset($_SESSION['login'])){
	header('location: ?site=Home');
	die;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>Tournamo | Log in</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">


		<link rel="stylesheet" href="style/css/all.min.css">

		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

		<link rel="stylesheet" href="style/css/icheck-bootstrap.min.css">

		<link rel="stylesheet" href="style/css/adminlte.min.css">

		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	</head>
	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<b>Tournamo</b>
			</div>
			<!-- /.login-logo -->
			<div class="card">
				<div class="card-body login-card-body">
					
					<p class="login-box-msg">Sign in to start your session</p>
					
					<?php
					if(isset($msg['error'])){
						echo '<div class="alert alert-danger">'.$msg['error'].'</div>';
					} elseif(isset($msg['success'])) {
						echo '<div class="alert alert-success">'.$msg['success'].'</div>';
					}
					
					?>
					
					<form action="" method="post">
						<div class="input-group mb-3">
							<input type="email" class="form-control" placeholder="Email" name="email">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-envelope"></span>
								</div>
							</div>
						</div>
						
						<div class="input-group mb-3">
							<input type="password" class="form-control" placeholder="Password" name="password">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-8">
								<div class="icheck-primary">
									<input type="checkbox" id="remember">
									<label for="remember">Remember Me</label>
								</div>
							</div>
							
							
							<div class="col-4">
								<button type="submit" name="type" value="login" class="btn btn-primary btn-block">Sign In</button>
							</div>
							
						</div>
					</form>

					
				</div>
				
			</div>
		</div>

	</body>
</html>