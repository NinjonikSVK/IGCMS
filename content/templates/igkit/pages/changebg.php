<?php 
  require_once("../layout/header.php");

  if(!$user->is_logged_in() ){ header('Location: index'); exit(); }
	
if (isset($_POST['submit'])) {

	$file = $_FILES["file"];

	$name = $_FILES["file"]["name"];
	$ext = end((explode(".", $name))); # extra () to prevent notice


	if (in_array($ext, array('png', 'jpg', 'gif'))) {

		$temp = explode(".", $_FILES["file"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		move_uploaded_file($_FILES["file"]["tmp_name"], "../../../uploads/bg/" . $newfilename);
		list($widthbg, $heightbg) = getimagesize("../../../uploads/bg/".$newfilename."");
		if ($widthbg > 849 && $heightbg > 279) {
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

						$stmt = $db->prepare('UPDATE members SET bg=:bg WHERE username="'.$_SESSION['username'].'"');
						$stmt->execute(array(
							':bg' => $newfilename
						));
			header("Location: profile.php?id=".$_SESSION['memberID']."");
		} else {
				header("Location: editprofile?action=invalidresolution&width=".$widthbg."&height=".$heightbg."");
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
			<?php echo $l["chat"] ?>
		</p>
	</div>
</div>
<div class="container">
<div class="row">
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
                    <span><i class="fas fa-upload"></i> <?php echo $actions["upload"]; ?></span>
                    <input id="logo-id" name="file" type="file" class="attachment_upload">
                  </div>
                </div>
              </div>
              <p class="help-block">* <?php echo $mk["bg_alert"]; ?> 850 x 280 px</p>
            </div>
			<p><button class="btn btn-danger" name="submit"><?php echo $actions["send"]; ?></button></p>
		</form>
		</div>
</div>
</div>
<?php 
  require_once("../layout/footer.php");
?>