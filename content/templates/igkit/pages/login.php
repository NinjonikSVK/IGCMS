<?php 
  require_once("../layout/header.php");
  
	//check if already logged in move to home page
	if( $user->is_logged_in() ){ header('Location: index.php'); exit(); }
?>
<main role="main" class="container">
	<div class="container py-5 text-center">
		<div class="jumbotron text-white jumbotron-image shadow" style="background-image: url(/assets/img/bg0.jpg">
			<h2 class="mb-4">
				<?php echo $siteTitle; ?>
			</h2>
			<p class="mb-4">
				<?php echo $l["login"] ?>
			</p>
		</div>
	</div>
<div class="container">
	<div class="text-center"> 
		<form class="form-signin" role="form" method="post" action="" autocomplete="off">
		  <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
		  <h1 class="h3 mb-3 font-weight-normal"><?php echo $l["login"] ?></h1>
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
											  </div>
											  <b>'.$l["3chara"];
										if (!isset($_POST['password'])) echo '
											  <div class="alert-icon">
											  </div>
											  <b>Chyba:</b> Prosím vyplnte všetky políčka!';
										$username = $_POST['username'];
										if ( $user->isValidUsername($username)){
											if (!isset($_POST['password'])){
												echo '
											  <div class="alert-icon">
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
											  </div>
											  <b>Chyba:</b> Vaše použivateľské meno a heslo sa nezhodujú!';
											}
										}else{
											echo '
											  <div class="alert-icon">
											  </div>
											  <b>Chyba:</b> Uživateľské mená musia byť alfanumerické, a mať 3-16 znakov!';
										}



									}//end if submit

									?>
		  <div class="form-group">
			<label for="topicname"><?php echo $l["username"]; ?></label>
			<input type="text" class="form-control" aria-describedby="emailHelp" placeholder="" id="topicname" name="username">
		  </div>
		  <div class="form-group">
			<label for="topicname"><?php echo $l["password"]; ?></label>
			<input type="password" class="form-control" aria-describedby="emailHelp" placeholder="" id="topicname" name="password">
		  </div>
		  <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit"><?php echo $l["login"] ?></button>
		</form>
    </div>
</div>

    
    
    
<?php 
  require_once("../layout/footer.php");
?>