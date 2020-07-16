<?php

include("../layout/header.php");

$permis = getperm('canmanagefiles')["canmanagefiles"];
if ($permis == 0) {
    header("Location: index?type=notenoughpermissions");
} else if ($permis == 1) {
    echo '';
} else {
    echo 'Error, group permission error.';
}

if(isset($_POST['submit'])){

	$file = $_FILES["file"];


	// Saving file in uploads folder

	move_uploaded_file($file["tmp_name"], "../../../uploads/" . $file["name"]);

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

	$fileTitle = $_POST['fileTitle'];
	$fileCont = $_POST['fileCont'];





		//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO files (fileTitle,fileCont,fileName,fileDL) VALUES (:fileTitle, :fileCont, :fileName, :fileDL)');
			$stmt->execute(array(
					':fileTitle' => $fileTitle,
					':fileCont' => $fileCont,
					':fileName' => $file,
					':fileDL' => '0'
			));

		header("Location: addfile.php?action=fileuploaded");

}

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $dbd["add_file"] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $l["home"] ?></a></li>
              <li class="breadcrumb-item active"><?php echo $dbd["add_file"] ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
	<!-- NAV -->
<div class="card-body pad">
              <div class="mb-3">
<form enctype="multipart/form-data" action="" method="post">
<div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label><?php echo $dbd["file_name"] ?></label>
                        <input name="fileTitle" type="text" class="form-control" placeholder="Enter ...">
                      </div>

					<textarea id="editor" class="textarea" name="fileCont" placeholder="<?php echo $dbd["file_description"] ?>" cols="100" rows="20" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
					<br><script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
						<input type="file" name="file" id="file" class="inputfile inputfile-4" data-multiple-caption="{count} files selected" multiple />
					</div>
				 </div>
          <!-- /.box -->

<p><input type="submit" name="submit" value="<?php echo $actions["send"] ?>" class="btn btn-primary" /></p>
</form>
<!-- END NAV -->
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->

<?php

include("../layout/footer.php");

?>
