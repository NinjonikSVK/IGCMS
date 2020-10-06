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
				<?php echo $l["resetpass"] ?>
			</p>
		</div>
	</div>
<div class="container">
	<div class="text-center"> 
		<form class="form-signin" role="form" method="post" action="" autocomplete="off">
		  <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
		  <h1 class="h3 mb-3 font-weight-normal"><?php echo $l["resetpass"] ?></h1>
		  <?php
									//if logged in redirect to members page
if( $user->is_logged_in() ){ header('Location: memberpage.php'); exit(); }

$resetToken = hash('SHA256', ($_GET['key']));

$stmt = $db->prepare('SELECT resetToken, resetComplete FROM members WHERE resetToken = :token');
$stmt->execute(array(':token' => $resetToken));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//if no token from db then kill the page
if(empty($row['resetToken'])){
	$stop = 'Invalid token provided, please use the link provided in the reset email.';
} elseif($row['resetComplete'] == 'Yes') {
	$stop = 'Your password has already been changed!';
}

//if form has been submitted process it
if(isset($_POST['submit'])){

	if (!isset($_POST['password']) || !isset($_POST['passwordConfirm']))
		$error[] = 'Both Password fields are required to be entered';

	//basic validation
	if(strlen($_POST['password']) < 3){
		$error[] = 'Password is too short.';
	}

	if(strlen($_POST['passwordConfirm']) < 3){
		$error[] = 'Confirm password is too short.';
	}

	if($_POST['password'] != $_POST['passwordConfirm']){
		$error[] = 'Passwords do not match.';
	}

	//if no errors have been created carry on
	if(!isset($error)){

		//hash the password
		$hashedpassword = $user->password_hash($_POST['password'], PASSWORD_BCRYPT);

		try {

			$stmt = $db->prepare("UPDATE members SET password = :hashedpassword, resetComplete = 'Yes'  WHERE resetToken = :token");
			$stmt->execute(array(
				':hashedpassword' => $hashedpassword,
				':token' => $row['resetToken']
			));

			//redirect to index page
			header('Location: login.php?action=resetAccount');
			exit;

		//else catch the exception and show the error.
		} catch(PDOException $e) {
		    $error[] = $e->getMessage();
		}

	}

}

									?>
		  <div class="form-group">
			<label for="topicname"><?php echo $l["password"]; ?></label>
			<input type="password" class="form-control" aria-describedby="emailHelp" placeholder="" id="topicname" name="password">
		  </div>
		  <div class="form-group">
			<label for="topicname"><?php echo $l["passwordc"]; ?></label>
			<input type="password" class="form-control" aria-describedby="emailHelp" placeholder="" id="topicname" name="passwordConfirm">
		  </div>
		  <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit"><?php echo $actions["send"] ?></button>
		</form>
    </div>
</div>

    
    
    
<?php 
  require_once("../layout/footer.php");
?>