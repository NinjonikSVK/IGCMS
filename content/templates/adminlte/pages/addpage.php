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

if(isset($_POST['submit'])){

	$pageTitle = $_POST['pageTitle'];
	$pageCont = $_POST['pageCont'];
	if (empty($pageTitle)) {
		return header("Location: addpage.php?action=fillallfields");
	}
	if (empty($pageCont)) {
		return header("Location: addpage.php?action=fillallfields");
	}




		//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO pages (pageTitle,pageCont) VALUES (:pageTitle, :pageCont)');
			$stmt->execute(array(
					':pageTitle' => $pageTitle,
					':pageCont' => $pageCont
			));

		header("Location: pages.php?action=pagecreated");

}

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $dbd["add_page"] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php"><?php echo $l["home"] ?></a></li>
              <li class="breadcrumb-item active"><?php echo $dbd["add_page"] ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
	<!-- NAV -->
<div class="card-body pad">
              <div class="mb-3">
<form action="" method="post">
<div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label><?php echo $dbd["page_name"] ?></label>
                        <input name="pageTitle" type="text" class="form-control" placeholder="Enter ...">
                      </div>

					  <br>
					  <textarea name="pageCont" id="editor1" rows="10" cols="80">
					  </textarea>
					  <script>
						// Replace the <textarea id="editor1"> with a CKEditor
						// instance, using default configuration.
						CKEDITOR.replace( 'editor1' );
					  </script>
				 </div>
          <!-- /.box -->
                    </div>

<p><input type="submit" name="submit" value="Send" class="btn btn-primary" /></p>
</form>
<!-- END NAV -->
    <!-- /.content -->
  </div>
                </div>
            </div>
  <!-- /.content-wrapper -->

<?php

include("../layout/footer.php");

?>
