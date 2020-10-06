<?php

include("../layout/header.php");

$sid = 1;

$permis = getperm('canmanagesite')["canmanagesite"];
if ($permis == 0) {
	header("Location: index?type=notenoughpermissions");
} else if ($permis == 1) {
	echo '';
} else {
	echo 'Error, group permission error.';
}

if(isset($_POST['submit'])){

	$title = $_POST['siteTitle'];
	$slogan = $_POST['slogan'];
	$ip = $_POST['ip'];
	$port = $_POST['port'];
	$template = $_POST['tpl'];

	//insert into database with a prepared statement
			$stmt = $db->prepare('UPDATE settings SET siteTitle=:siteTitle, slogan=:slogan, ip=:ip, port=:port, template=:template WHERE siteID=:siteID');
			$stmt->execute(array(
				':siteTitle' => $title,
				':slogan' => $slogan,
				':siteID' => $sid,
				':ip' => $ip,
				':port' => $port,
				':template' => $template
			));
			//insert into database with a prepared statement
					$stmt8 = $db->prepare('UPDATE footer SET title=:title, descr=:descr WHERE id=:id');
					$stmt8->execute(array(
						':title' => $_POST["f1"],
						':descr' => $_POST["f1d"],
						':id' => 1
					));
					$stmt9 = $db->prepare('UPDATE footer SET title=:title, descr=:descr WHERE id=:id');
					$stmt9->execute(array(
						':title' => $_POST["f2"],
						':descr' => $_POST["f2d"],
						':id' => 2
					));
					$stmt10 = $db->prepare('UPDATE footer SET title=:title, descr=:descr WHERE id=:id');
					$stmt10->execute(array(
						':title' => $_POST["f3"],
						':descr' => $_POST["f3d"],
						':id' => 3
					));

	header("Location: editsite.php?action=siteedited");

}

if(isset($_POST['submit2'])){

	$file = $_FILES["file"];

	$name = $_FILES["file"]["name"];
	$ext = end((explode(".", $name))); # extra () to prevent notice

	if (in_array($ext, array('jpg', 'png'))) {
		$newfilename = "bg0.jpg";
		unlink("../../../../assets/img/bg0.jpg");
		move_uploaded_file($file["tmp_name"], "../../../../assets/img/" . $newfilename);
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

			header("Location: editsite?action=backgroundedited");
	} else {
		header("Location: editsite?action=fileisnotanimage&filetype=".$ext."");
	}

	// Saving file in uploads folder


}


$stmt = $db->prepare('SELECT * FROM settings WHERE siteID=:siteID');
$stmt->execute(array(':siteID' => $sid));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt2 = $db->prepare('SELECT * FROM footer WHERE id=:id');
$stmt2->execute(array(':id' => 1));
$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
$stmt3 = $db->prepare('SELECT * FROM footer WHERE id=:id');
$stmt3->execute(array(':id' => 2));
$row3 = $stmt3->fetch(PDO::FETCH_ASSOC);
$stmt4 = $db->prepare('SELECT * FROM footer WHERE id=:id');
$stmt4->execute(array(':id' => 3));
$row4 = $stmt4->fetch(PDO::FETCH_ASSOC);

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $dbd["edit_site"] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $l["home"] ?></a></li>
              <li class="breadcrumb-item active"><?php echo $dbd["edit_site"] ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
	<!-- NAV -->
            <!-- /.card-header -->
			<form action="" method="post">
            <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label><?php echo $dbd["site_name"] ?></label>
                        <input name="siteTitle" type="text" class="form-control" placeholder="" value="<?php echo $row['siteTitle']; ?>">
                      </div>
					  <div class="form-group">
                        <label><?php echo $dbd["slogan"] ?></label>
                        <input name="slogan" type="text" class="form-control" placeholder="" value="<?php echo $row['slogan']; ?>">
                      </div>
					  <div class="form-group">
                        <label><?php echo $dbd["ip_address"] ?></label>
                        <input name="ip" type="text" class="form-control" placeholder="" value="<?php echo $row['ip']; ?>">
                      </div>
					  <div class="form-group">
                        <label><?php echo $dbd["port"] ?></label>
                        <input name="port" type="number" class="form-control" placeholder="" value="<?php echo $row["port"]; ?>">
                      </div>
					  <div class="form-group">
                        <label><?php echo $l["theme"] ?></label>
                        <input name="tpl" type="text" class="form-control" placeholder="" value="<?php echo $row["template"]; ?>">
                      </div>
					  <?php echo $dbd["footer"]; ?>
					  <div class="form-group">
                        <label><?php echo $dbd["footer"]; ?> 1</label>
                        <input name="f1" type="text" class="form-control" placeholder="" value="<?php echo htmlspecialchars($row2["title"]); ?>">
                      </div>
					  <div class="form-group">
                        <label><?php echo $dbd["footer"]; ?> 2</label>
                        <input name="f2" type="text" class="form-control" placeholder="" value="<?php echo htmlspecialchars($row3["title"]); ?>">
                      </div>
					  <div class="form-group">
                        <label><?php echo $dbd["footer"]; ?> 3</label>
                        <input name="f3" type="text" class="form-control" placeholder="" value="<?php echo htmlspecialchars($row4["title"]); ?>">
                      </div>
					  <div class="form-group">
                        <label><?php echo $dbd["footer"]; ?> 1 <?php echo $dbd["description"]; ?></label>
                        <input name="f1d" type="text" class="form-control" placeholder="" value="<?php echo htmlspecialchars($row2["descr"]); ?>">
                      </div>
					  <div class="form-group">
                        <label><?php echo $dbd["footer"]; ?> 2 <?php echo $dbd["description"]; ?></label>
                        <input name="f2d" type="text" class="form-control" placeholder="" value="<?php echo htmlspecialchars($row3["descr"]); ?>">
                      </div>
					  <div class="form-group">
                        <label><?php echo $dbd["footer"]; ?> 3 <?php echo $dbd["description"]; ?></label>
                        <input name="f3d" type="text" class="form-control" placeholder="" value="<?php echo htmlspecialchars($row4["descr"]); ?>">
                      </div>
					<p><button name="submit" value="submit" class="btn btn-primary btn-round"><?php echo $actions["submit"] ?></button></p>	
				 </div>
				  </form>
				<form enctype="multipart/form-data" action="" method="post">
					<div class="col-sm-6">
						
						<p><label><?php echo $dbd["site_background_image"]; ?></label></p>
						<p><input type="file" name="file" id="file" class="inputfile inputfile-4" data-multiple-caption="{count} files selected" multiple /></p>
						
						<p><button name="submit2" value="submit" class="btn btn-primary btn-round"><?php echo $actions["submit"] ?></button></p>	
						
					</div>
				</form>
				  </div>

        <!-- /.col-->
      <!-- ./row -->
<!-- END NAV -->
    <!-- /.content -->
  <!-- /.content-wrapper -->

<?php

include("../layout/footer.php");

?>
