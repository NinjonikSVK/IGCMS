<?php 
  require_once("../layout/header.php");
  
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
?>
<main role="main" class="container">
	<div class="container py-5 text-center">
		<div class="jumbotron text-white jumbotron-image shadow" style="background-image: url(/assets/img/bg0.jpg">
			<h2 class="mb-4">
				<?php echo $siteTitle; ?>
			</h2>
			<p class="mb-4">
				<?php echo $l["edit_profile"] ?>
			</p>
		</div>
	</div>
<div class="container">
	<div class="row">
	<form action="" method="post">
						<div>
							<div class="form-group">
								<label><?php echo $l["username"]; ?></label>
								<input value="<?php echo $row['username']; ?>" type="text" class="form-control" aria-describedby="emailHelp" name="username">
							</div>
						</div>
						<div class="form-group">
							<label><?php echo $dbd["description"] ?></label>
							<textarea class="form-control" rows="5" name="description"><?php echo $row['description']; ?></textarea>
						</div>
						<div class="form-group">
							<label><?php echo $dbd["location"] ?></label>
							<textarea class="form-control" rows="3" name="location"><?php echo $row['location']; ?></textarea>
						</div>
						<div class="form-group">
							<label class="control-label"> <?php echo $l["skills"] ?></label>
							<textarea name="skills" class="form-control" rows="3"><?php echo $row['skills']; ?></textarea>
	                    </div>
						<div class="form-group">
							<label class="control-label"> <?php echo $dbd["notes"] ?></label>
							<textarea name="notes" class="form-control" rows="3"><?php echo $row['notes']; ?></textarea>
	                    </div>

						<?php echo $l["warning_edit"] ?>
						<?php echo $av; ?>
			  <p><button name="submit" value="submit" class="btn btn-danger btn-round"><?php echo $actions["send"] ?></button></p>
			  </form>
	<div class="col-md-4 col-md-offset-4">
	<p>
	<form action="" method="post">
		<?php
				if ($row["avatar"] == 'gravatar') {
					echo '
						<div class="form-check">
								<label>
									<input type="radio" name="optionsRadios" value="fu">
									'.$actions["upload_file"].'
								</label>
							</div>
							<div class="form-check">
								<label>
									<input type="radio" name="optionsRadios" value="ga" checked="true">
									Gravatar
								</label>
							</div>
					';
				} else {
					echo '
						<div class="form-check">
								<label>
									<input type="radio" name="optionsRadios" value="fu" checked="true">
									'.$actions["upload_file"].'
								</label>
							</div>
							<div class="form-check">
								<label>
									<input type="radio" name="optionsRadios" value="ga">
									Gravatar
								</label>
							</div>
					';
				}
		?>
		
		<p align="right"><button name="submitav" value="submitav" class="btn btn-danger btn-round"><?php echo $actions["save"] ?></button></p>
		</form>
		</div>
		<?php
			if ($row["avatar"] !== 'gravatar') {
				echo '
		<div class="col-md-4 col-md-offset-4">
		<form enctype="multipart/form-data" action="" method="post">
		    <div class="form-group">
			<p>
              <div class="main-img-preview">
                <img class="thumbnail img-preview" src="http://farm4.static.flickr.com/3316/3546531954_eef60a3d37.jpg" title="">
              </div>
			</p>
              <div class="input-group">
                <input id="fakeUploadLogo" class="form-control fake-shadow" placeholder="Choose File" disabled="disabled">
                <div class="input-group-btn">
                  <div class="fileUpload btn btn-danger fake-shadow">
                    <span><i class="fas fa-upload"></i> '.$actions["upload"].'</span>
                    <input id="logo-id" name="file" type="file" class="attachment_upload">
                  </div>
                </div>
              </div>
              <p class="help-block">* '.$mk["profile_alert"].'</p>
            </div>
			<p><button class="btn btn-danger" name="submita">'.$actions["send"].'</button>
		</form>
			</div>'; }  ?>
	</p>
</div>
</div>

    
    
    
<?php 
  require_once("../layout/footer.php");
?>