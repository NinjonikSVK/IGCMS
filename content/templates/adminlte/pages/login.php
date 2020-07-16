<?php
//include config
require_once("../../../config/config.php");

//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: index.php'); exit(); }
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="apple-touch-icon" sizes="180x180" href="lb/img/apple-touch-icon.png">
        <link rel="icon" type="../lb/image/png" sizes="32x32" href="img/favicon-32x32.png">
        <link rel="icon" type="../lb/image/png" sizes="16x16" href="img/favicon-16x16.png">
        <link rel="manifest" href="../lb/img/site.webmanifest">
        <link rel="mask-icon" href="../lb//img/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
	    <link href="img/assets/css/core.min.css" rel="stylesheet">
    <link href="../lb/aassets/css/thesaas.min.css" rel="stylesheet">
    <link href="../lb/aassets/css/style.css" rel="stylesheet"
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $siteTitle; ?> | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page" style="background-image: linear-gradient(to bottom, #000000 0%, #13558B 100%);">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><b><h1 class="fs-50 fw-600 lh-15 hidden-sm-down"><span class="text-primary" data-type="<?php echo $siteTitle; ?>"></span></h1></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><center><h3><b>Sign In</b></h3></center></p>
		<?php
									//check for any errors
									if(isset($error)){
										foreach($error as $error){
											echo '<p class="bg-danger">'.$error.'</p>';
										}
									}

									if(isset($_GET['action'])){

										//check the action
										switch ($_GET['action']) {
											case 'active':
												echo '
												<div class="alert alert-success alert-dismissible">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														<h5><i class="icon fas fa-ban"></i> Success</h5>
														Your account is now active you may now log in.
												  </div>';
											case 'reset':
												echo "Please check your inbox for a reset link.";
												break;
											case 'resetAccount':
												echo "Password changed, you may now login.";
												break;
										}

									}

																		//process login form if submitted
									if(isset($_POST['submit'])){

										if (!isset($_POST['username']))	echo '
											  <div class="alert alert-warning alert-dismissible">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												<h5><i class="icon fas fa-ban"></i> Alert</h5>
												Please fill out all fields!
											  </div>';   
										if (!isset($_POST['password'])) echo '
											  <div class="alert alert-warning alert-dismissible">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												<h5><i class="icon fas fa-ban"></i> Alert</h5>
												Please fill out all fields!
											  </div>'; 
										$username = $_POST['username'];
										if ( $user->isValidUsername($username)){
											if (!isset($_POST['password'])){
												echo '
											  <div class="alert alert-warning alert-dismissible">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												<h5><i class="icon fas fa-ban"></i> Alert</h5>
												A password must be entered!
											  </div>'; 
											}
											$password = $_POST['password'];

											if($user->login($username,$password)){
												$_SESSION['username'] = $username;
												header('Location: index.php?action=loggedin');
												echo '
												  <div class="alert alert-success alert-dismissible">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														<h5><i class="icon fas fa-ban"></i> Success</h5>
														Successfully loged in. Redirecting...
												  </div>';
												exit;

											} else {
												echo '
											  <div class="alert alert-danger alert-dismissible">
													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
														<h5><i class="icon fas fa-ban"></i> Error</h5>
														Wrong username or password or your account has not been activated.
											  </div>';           
											}
										}else{
											echo '
											  <div class="alert alert-warning alert-dismissible">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
												<h5><i class="icon fas fa-ban"></i> Alert</h5>
												Usernames are required to be Alphanumeric, and between 3-16 characters long.
											  </div>'; 
										}



									}//end if submit
									
									?>
      <form role="form" method="post" action="" autocomplete="off">
	  <h5><b>Name</b></h5>
        <div class="input-group mb-3">
          <input type="text" name="username" id="username" class="form-control" placeholder="Name" value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-address-card"></span>
          </div>
        </div>
		</div>
		 <h5><b>Password</b></h5>
		  <div class="input-group mb-3">
        <div class="input-group mb-3">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password">
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
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
		  </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="submit" id="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
<!--<canvas class="constellation"></canvas>
      <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> --!>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.php">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p>
	  <div>
	  </div>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script src="../lb/assets/js/core.min.js"></script>
<script src="../lb/assets/js/thesaas.min.js"></script>
<script src="../lb/assets/js/script.js"></script>
</body>
</html>