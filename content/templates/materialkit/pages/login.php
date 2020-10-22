<?php
include("../layout/header.php");

//check if already logged in move to home page
if( $user->is_logged_in() ){ header('Location: index.php'); exit(); }

//define page title
$title = 'Login';

?>
<body class="login-page">
	<nav class="navbar navbar-primary navbar-transparent navbar-absolute">
	<?php
		include("../layout/navbar.php");
	?>
	<div class="page-header header-filter" style="background-image: url('../../../../assets/img/bg0.jpg'); background-size: cover; background-position: top center;">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
					<div class="card card-signup">
						<form role="form" method="post" action="" autocomplete="off">
							<div class="header header-primary text-center">
								<h4 class="card-title"><?php echo $l["login"] ?></h4>
								<div>
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
												echo "Účet bol aktivovaný, môžete sa prihlásiť.";
											case 'reset':
												echo "Pozrite si váš email pre resetovací link.";
												break;
											case 'resetAccount':
												echo "Heslo bolo zmenené, môžete sa prihlásiť.";
												break;
										}

									}

																		//process login form if submitted
									if(isset($_POST['submit'])){

										if (!isset($_POST['username']))	echo '
											  <div class="alert-icon">
												<i class="material-icons">error_outline</i>
											  </div>
											  <b>'.$l["3chara"];
										if (!isset($_POST['password'])) echo '
											  <div class="alert-icon">
												<i class="material-icons">error_outline</i>
											  </div>
											  <b>Chyba:</b> Prosím vyplnte všetky políčka!';
										$username = $_POST['username'];
										if ( $user->isValidUsername($username)){
											if (!isset($_POST['password'])){
												echo '
											  <div class="alert-icon">
												<i class="material-icons">error_outline</i>
											  </div>
											  <b>Chyba:</b> Musíte zadať heslo!';
											}
											$password = $_POST['password'];

											if($user->login($username,$password)){
												$_SESSION['username'] = $username;
												$notType = 1;
												$notDate = time();
												$stmt = $db->prepare('INSERT INTO notifications (notUser,notType,notDate) VALUES (:notUser, :notType, :notDate)');
												$stmt->execute(array(
														':notUser' => $username,
														':notType' => $notType,
														':notDate' => $notDate
												));
												header('Location: index.php?action=loggedin');
												exit;

											} else {
												echo '
											  <div class="alert-icon">
												<i class="material-icons">error_outline</i>
											  </div>
											  <b>Chyba:</b> Vaše použivateľské meno a heslo sa nezhodujú!';
											}
										}else{
											echo '
											  <div class="alert-icon">
												<i class="material-icons">error_outline</i>
											  </div>
											  <b>Chyba:</b> Uživateľské mená musia byť alfanumerické, a mať 3-16 znakov!';
										}



									}//end if submit

									?>
								</div>
							</div>
							<p class="description text-center"><?php echo $l["or_classic"] ?></p>
							<div class="card-content">

								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">face</i>
									</span>
									<input type="text" name="username" id="username" class="form-control" placeholder=<?php echo $l["username"] ?> value="<?php if(isset($error)){ echo htmlspecialchars($_POST['username'], ENT_QUOTES); } ?>" tabindex="1">
								</div>

								<div class="input-group">
									<span class="input-group-addon">
										<i class="material-icons">lock_outline</i>
									</span>
									<input type="password" name="password" id="password" class="form-control" placeholder=<?php echo $l["password"] ?> tabindex="3">
								</div>

								<!-- If you want to add a checkbox to this form, uncomment this code

								<div class="checkbox">
									<label>
										<input type="checkbox" name="optionsCheckboxes" checked>
										Subscribe to newsletter
									</label>
								</div> -->
							</div>
							<div class="footer text-center">
								<input type="submit" name="submit" id="submit" value=<?php echo $l["login"] ?> class="btn btn-primary btn-round" tabindex="5">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
<?php
	include("../layout/footer.php");
?>
