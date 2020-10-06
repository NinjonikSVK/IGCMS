<?php
	include("../layout/header.php");

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
		if ($widthbg > 1999 && $heightbg > 1338) {
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
<body class="index-page">
	<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<?
		include("../layout/navbar.php");
	?>
	<div class="page-header header-filter clear-filter" style="background-image: url('assets/img/bg0.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1><?php echo $siteTitle; ?>
						</h1>

						<h3 class="title"><?php echo $dbd["site_background_image"]; ?></h3>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main main-raised">
		<div class="section section-basic">
	    	<div class="container">

				<div class="row">
					<form enctype="multipart/form-data" action="" method="post">
						<div class="col-md-5 col-sm-8">
							<h4><small><?php echo $mk["background"]; ?></small></h4>
							<div class="fileinput fileinput-new text-center" data-provides="fileinput">
								<div class="fileinput-new thumbnail img-raised">
									<img src="../../../../assets/img/image_placeholder.jpg" alt="...">
								</div>
								<div class="fileinput-preview fileinput-exists thumbnail img-raised"></div>
								<div>
									<span class="btn btn-raised btn-round btn-default btn-file">
										<span class="fileinput-new"><?php echo $mk["add_photo"]; ?></span>
										<span class="fileinput-exists"><?php echo $actions["change"]; ?></span>
										<input type="file" name="file" /></span>
									</span>
									<a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> <?php echo $actions["delete"]; ?></a>
								</div>
								<button name="submit" value="submit" class="btn btn-primary btn-round"><?php echo $actions["upload"]; ?></button>
							</div>
							<p><?php echo $mk["bg_alert"]; ?> 2000 x 1339 px.</p>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>
<?php
	include("../layout/footer.php");
?>
