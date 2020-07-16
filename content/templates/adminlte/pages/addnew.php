<?php

include("../layout/header.php");

$permis = getperm('canmanagenews')["canmanagenews"];
if ($permis == 0) {
	header("Location: index?type=notenoughpermissions");
} else if ($permis == 1) {
	echo '';
} else {
	echo 'Error, group permission error.';
}

if(isset($_POST['submit'])){

	$file = $_FILES["file"];

	$name = $_FILES["file"]["name"];
	$ext = end((explode(".", $name))); # extra () to prevent notice

	if (in_array($ext, array('png', 'jpg', 'gif'))) {
		move_uploaded_file($file["tmp_name"], "../../../uploads/nt/" . $file["name"]);

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

		$newTitle = $_POST['newTitle'];
		$newCont = $_POST['newCont'];
		$rubrika = $_POST['rubrika'];
		$author = $_SESSION['username'];

		$date = time();
		if (empty($newTitle)) {
			return header("Location: addnew.php?action=fillallfields");
		}
		if (empty($newCont)) {
			return header("Location: addnew.php?action=fillallfields");
		}
		if (empty($rubrika)) {
			return header("Location: addnew.php?action=fillallfields");
		}



			//insert into database with a prepared statement
				$stmt = $db->prepare('INSERT INTO news (newTitle,newCont,newAuthor,newDate,filename,rubrika) VALUES (:newTitle, :newCont, :newAuthor, :newDate, :filename, :rubrika)');
				$stmt->execute(array(
						':newTitle' => $newTitle,
						':newCont' => $newCont,
						':newAuthor' => $author,
						':newDate' => $date,
						':filename' => $file,
						':rubrika' => $rubrika
				));

			header("Location: news.php?action=newcreated");
	} else {
		header("Location: addnew.php?action=fileisnotanimage&filetype=".$ext."");
	}

	// Saving file in uploads folder


}

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $edt["newa"]; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $l["home"]; ?></a></li>
              <li class="breadcrumb-item active"><?php echo $edt["newa"]; ?></li>
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
                        <label><?php echo $edt["newn"]; ?></label>
                        <input name="newTitle" type="text" class="form-control" placeholder="">
                      </div>
					  <div class="form-group">
                        <label><?php echo $dbd["rubrika"]; ?></label>
                        <input name="rubrika" type="text" class="form-control" placeholder="">
                      </div>
					<label><?php echo $edt["newc"]; ?></label>
					<textarea name="newCont" id="editor1" rows="10" cols="80">
					  </textarea>
					  <script>
						// Replace the <textarea id="editor1"> with a CKEditor
						// instance, using default configuration.
						CKEDITOR.replace( 'editor1' );
					  </script>
					<br><label><?php echo $dbd["image_within_page"] ?></label>
					<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
					<br><br>
					<input type="file" name="file" id="file" class="inputfile inputfile-4" data-multiple-caption="{count} files selected" multiple />
				 </div>
          <!-- /.box -->
                    </div>

<p><input type="submit" name="submit" value="<?php echo $actions["submit"] ?>" class="btn btn-primary" /></p>
</form>
<!-- END NAV -->
    <!-- /.content -->
  </div>
            </div>
  <!-- /.content-wrapper -->

<?php

include("../layout/footer.php");

?>
