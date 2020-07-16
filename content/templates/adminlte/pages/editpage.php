<?php

include("../layout/header.php");

$permis = getperm('canmanagepages')["canmanagepages"];
if ($permis == 0) {
	header("Location: index?type=notenoughpermissions");
} else if ($permis == 1) {
	echo '';
} else {
	echo 'Error, group permission error.';
}

if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
	header('Location: '.DIRADMIN);
}

if(isset($_POST['submit'])){

	$title = $_POST['pageTitle'];
	$content = $_POST['pageCont'];
	$pageID = $_GET['id'];
	if (empty($pageTitle)) {
		return header("Location: addpage.php?action=fillallfields");
	}
	if (empty($pageCont)) {
		return header("Location: addpage.php?action=fillallfields");
	}

	//insert into database with a prepared statement
			$stmt = $db->prepare('UPDATE pages SET pageTitle=:pageTitle, pageCont=:pageCont WHERE pageID=:pageID');
			$stmt->execute(array(
				':pageTitle' => $title,
				':pageCont' => $content,
				':pageID' => $pageID
			));

	header("Location: pages.php?action=pageedited");

}

$stmt = $db->prepare('SELECT pageTitle, pageCont FROM pages WHERE pageID=:pageID');
$stmt->execute(array(':pageID' => $_GET['id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $edt["page"]; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?php echo $l["home"]; ?></a></li>
              <li class="breadcrumb-item active"><?php echo $edt["page"]; ?></li>
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
                        <label><?php echo $dbd["page_name"]; ?></label>
                        <input name="pageTitle" type="text" class="form-control" placeholder="" value="<?php echo $row['pageTitle']; ?>">
                      </div>
						<label><?php echo $dbd["page_index"]; ?></label>
					<textarea name="pageCont" id="editor1" rows="10" cols="80">
					<?php echo $row['pageCont']; ?>
					  </textarea>
					  <script>
						// Replace the <textarea id="editor1"> with a CKEditor
						// instance, using default configuration.
						CKEDITOR.replace( 'editor1' );
					  </script>
					<p><button name="submit" value="submit" class="btn btn-primary btn-round"><?php echo $actions["submit"]; ?></button></p>
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
