<?php

include("../layout/header.php");

if(!$user->is_logged_in() ){ header('Location: index'); exit(); }

if(isset($_POST['submit'])){


	$username = $_POST['username'];
	$description = $_POST['description'];
	$location = $_POST['location'];
	$skills = $_POST['skills'];
	$notes = $_POST['notes'];

	if(preg_match('/^\w{3,}$/', $username)) { // \w equals "[0-9A-Za-z_]"
		$error[] = $l["numeric3"];
		$stmt = $db->prepare('SELECT username FROM members WHERE username = :username');
		$stmt->execute(array(':username' => $username));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if(!empty($row['username'])){
			$error[] = $l["usernameused"];
		}

	}


	if(!isset($error)){
		header("Location: editprofile?action=notedited");
	} else {

		//insert into database with a prepared statement
			$stmt = $db->prepare('UPDATE members SET username=:username, description=:description, location=:location, skills=:skills, notes=:notes WHERE username="'.$_SESSION['username'].'"');
			$stmt->execute(array(
				':username' => $username,
				':description' => $description,
				':location' => $location,
				':skills' => $skills,
				':notes' => $notes
			));

		header("Location: logout");
	}

}

$stmt = $db->prepare('SELECT username, email, description, skills, location, memberID, Level, notes, avatar FROM members WHERE username=:username');
$stmt->execute(array(':username' => $_SESSION['username']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['submitav'])) {

	$av = $_POST['optionsRadios'];

	if(isset($_POST['optionsRadios']))
		{
			if ($av == 'ga') {
				$stmt = $db->prepare('UPDATE members SET avatar=:avatar WHERE username="'.$_SESSION['username'].'"');
				$stmt->execute(array(
					':avatar' => 'gravatar'
				));
				header ("Location: editprofile?action=avatartypeedited");
			} else {
				$stmt = $db->prepare('UPDATE members SET avatar=:avatar WHERE username="'.$_SESSION['username'].'"');
				$stmt->execute(array(
					':avatar' => 'temporary'
				));
				header ("Location: editprofile?action=avatartypeedited");
			}
		}
}

if (isset($_POST['submita'])) {

	$file = $_FILES["file"];

	$name = $_FILES["file"]["name"];
	$ext = end((explode(".", $name))); # extra () to prevent notice


	if (in_array($ext, array('png', 'jpg', 'gif'))) {

		$temp = explode(".", $_FILES["file"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		move_uploaded_file($_FILES["file"]["tmp_name"], "../../../uploads/ua/" . $newfilename);
		list($width, $height) = getimagesize("../../../uploads/ua/".$newfilename."");
		if ($width > 99 && $height > 99) {
			if ($width / $height == 1) {
			$file = $newfilename;

			function download($file){
			  header('Content-Description: File Transfer');
			  header('Content-Type: application/octet-stream');
			  header('Content-Disposition: attachment; filename='.basename($file));
			  header('Content-Transfer-Encoding: binary');
			  header('Expires: 0');
			  header('Cache-Control: must-revalidate');
			  header('Pragma: public');
			  header('Content-Length: '.filesize($file));

			  ob_clean();
			  flush();
			  readfile($file);
			}

				$file = $_FILES['file']['name'];

						$stmt = $db->prepare('UPDATE members SET avatar=:avatar WHERE username="'.$_SESSION['username'].'"');
						$stmt->execute(array(
							':avatar' => $newfilename
						));
				header("Location: editprofile.php?action=profileedited");
			} else {
				header("Location: editprofile?action=invalidresolution&width=".$width."&height=".$height."");
			}
		} else {
				header("Location: editprofile?action=invalidresolution&width=".$width."&height=".$height."");
		}
	} else {
		header("Location: editprofile?action=fileisnotanimage&filetype=".$ext."");
	}
}
/*
if (isset($_POST['submitbg'])) {

	$filebg = $_FILES["filebg"];

	$namebg = $_FILES["filebg"]["name"];
	$extbg = end((explode(".", $namebg))); # extra () to prevent notice


	if (in_array($extbg, array('png', 'jpg', 'gif'))) {

		$tempbg = explode(".", $_FILES["filebg"]["name"]);
		$newfilename2 = round(microtime(true)) . '.' . end($tempbg);
		move_uploaded_file($_FILES["filebg"]["tmp_name"], "../../../uploads/bg/" . $newfilename2);
		list($widthbg, $heightbg) = getimagesize("../../../uploads/bg/".$newfilename2."");
		if ($widthbg > 1999 && $heightbg > 1338) {
			$filebg = $newfilename2;

			function download($filebg){
			  header('Content-Description: File Transfer');
			  header('Content-Type: application/octet-stream');
			  header('Content-Disposition: attachment; filename='.basename($filebg));
			  header('Content-Transfer-Encoding: binary');
			  header('Expires: 0');
			  header('Cache-Control: must-revalidate');
			  header('Pragma: public');
			  header('Content-Length: '.filesize($filebg));

			  ob_clean();
			  flush();
			  readfile($filebg);
			}

						$stmt = $db->prepare('UPDATE members SET bg=:bg WHERE username="'.$_SESSION['username'].'"');
						$stmt->execute(array(
							':bg' => $newfilename2
						));
		} else {
				header("Location: editprofile?action=invalidresolution&width=".$widthbg."&height=".$heightbg."");
		}
	} else {
		header("Location: editprofile?action=fileisnotanimage&filetype=".$extbg."");
	}
}*/

?>
<body class="index-page">
	<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<?
		include("../layout/navbar.php");
	?>

  <!-- Content Wrapper. Contains page content -->
  	<div class="page-header header-filter clear-filter" style="background-image: url('assets/img/bg0.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1><?php echo $siteTitle; ?>
						</h1>

						<h3 class="title"><?php echo $l["edit_profile"] ?></h3>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main main-raised">
		<div class="section section-basic">
	    	<div class="container">
						<!--     *********     FEATURES 1      *********      -->

	    			  <form action="" method="post">
						<div class="col-lg-3 col-sm-4">
						<div>
							<div class="form-group label-floating">
								<label class="control-label"><?php echo $l["username"] ?></label>
								<input value="<?php echo $row['username'];?>" name="username" type="text" class="form-control">
							</div>
						</div>
						<div class="form-group label-floating">
							<label class="control-label"><?php echo $dbd["description"] ?></label>
							<textarea name="description" class="form-control" rows="5"><?php echo $row['description'];?></textarea>
	                    </div>
						<div class="form-group label-floating">
							<label class="control-label"> <?php echo $dbd["location"] ?></label>
							<textarea name="location" class="form-control" rows="5"><?php echo $row['location'];?></textarea>
	                    </div>
						<div class="form-group label-floating">
							<label class="control-label"> <?php echo $l["skills"] ?></label>
							<textarea name="skills" class="form-control" rows="5"><?php echo $row['skills'];?></textarea>
	                    </div>
						<div class="form-group label-floating">
							<label class="control-label"> <?php echo $dbd["notes"] ?></label>
							<textarea name="notes" class="form-control" rows="5"><?php echo $row['notes'];?></textarea>
	                    </div>

						<?php echo $l["warning_edit"] ?>
						<?php echo $av; ?>
			  <p><button name="submit" value="submit" class="btn btn-primary btn-round"><?php echo $actions["send"] ?></button></p>
			  </form>
			  </div>
			  <form action="" method="post">
			  <label>Avatar</label>
			  <?php
				if ($row["avatar"] == 'gravatar') {
					echo '
						<div class="radio">
								<label>
									<input type="radio" name="optionsRadios" value="fu">
									'.$actions["upload_file"].'
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="optionsRadios" value="ga" checked="true">
									Gravatar
								</label>
							</div>
					';
				} else {
					echo '
						<div class="radio">
								<label>
									<input type="radio" name="optionsRadios" value="fu" checked="true">
									'.$actions["upload_file"].'
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="optionsRadios" value="ga">
									Gravatar
								</label>
							</div>
					';
				}
			  ?>
							 <p><button name="submitav" value="submitav" class="btn btn-primary btn-round"><?php echo $actions["save"] ?></button></p>
			</form>
			<?php
			if ($row["avatar"] !== 'gravatar') {
				echo '
			<form enctype="multipart/form-data" action="" method="post">
				<div class="col-md-3 col-sm-4">
								<h4><small>Avatar</small></h4>
								<div class="fileinput fileinput-new text-center" data-provides="fileinput">
									<div class="fileinput-new thumbnail img-circle img-raised">
										<img src="../../../../assets/img/placeholder.jpg" alt="...">
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail img-circle img-raised"></div>
									<div>
										<span class="btn btn-raised btn-round btn-default btn-file">
											<span class="fileinput-new">'.$mk["add_photo"].'</span>
											<span class="fileinput-exists">'.$actions["change"].'</span>
											<input type="file" name="file" id="file" /></span>
										<br />
										<a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> '.$actions["delete"].'</a>
									</div>
								</div>
								<button name="submita" value="submita" class="btn btn-primary btn-round">'.$actions["upload"].'</button>
							</div>
							'.$mk["profile_alert"].'
			</form>
				';
			}
			?>
			<!--
			<form enctype="multipart/form-data" action="" method="post">
				<div class="col-md-3 col-sm-4">
								<h4><small><?php # echo $mk["background"]; ?></small></h4>
								<div class="fileinput fileinput-new text-center" data-provides="fileinput">
									<div class="fileinput-new thumbnail img-circle img-raised">
										<img src="../../../../assets/img/placeholder.jpg" alt="...">
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail img-circle img-raised"></div>
									<div>
										<span class="btn btn-raised btn-round btn-default btn-file">
											<span class="fileinput-new"><?php # echo $mk["add_photo"]; ?></span>
											<span class="fileinput-exists"><?php # echo $actions["change"]; ?></span>
											<input type="file" name="filebg" id="filebg" /></span>
										<br />
										<a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> <?php # echo $actions["delete"]; ?></a>
									</div>
								</div>
								<button name="submitbg" value="submitbg" class="btn btn-primary btn-round"><?php # echo $actions["upload"]; ?></button>
							</div>
							<?php # echo $mk["bg_alert"]; ?>
			</form>
		<!--     *********    END FEATURES 1      *********      -->


				</div>
				</div>
				</div>

    <!-- Main content -->
	<!-- NAV -->
            <!-- /.card-header -->

        <!-- /.col-->
      <!-- ./row -->
<!-- END NAV -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php

include("../layout/footer.php");

?>
