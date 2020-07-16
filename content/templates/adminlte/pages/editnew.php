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
if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
	header('Location: '.DIRADMIN);
}

if(isset($_POST['submit'])){

	$title = $_POST['newTitle'];
	$content = $_POST['newCont'];
	$newID = $_GET['id'];
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
			$stmt = $db->prepare('UPDATE news SET newTitle=:newTitle, newCont=:newCont WHERE newID=:newID');
			$stmt->execute(array(
				':newTitle' => $title,
				':newCont' => $content,
				':newID' => $newID
			));

	header("Location: news.php?action=newedited");

}

$stmt = $db->prepare('SELECT newTitle, newCont FROM news WHERE newID=:newID');
$stmt->execute(array(':newID' => $_GET['id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $edt["new"]?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?php echo $l["home"]?></a></li>
              <li class="breadcrumb-item active"><?php echo $edt["new"]?></li>
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
                        <label><?php echo $edt["newn"]; ?></label>
                        <input name="newTitle" type="text" class="form-control" placeholder="" value="<?php echo $row['newTitle']; ?>">
                      </div>
						<label><?php echo $edt["newc"]; ?></label>
					<textarea name="newCont" id="editor1" rows="10" cols="80">
					<?php echo $row['newCont']; ?>
					  </textarea>
					  <script>
						// Replace the <textarea id="editor1"> with a CKEditor
						// instance, using default configuration.
						CKEDITOR.replace( 'editor1' );
					  </script>
					<p><button name="submit" value="Odoslať" class="btn btn-primary btn-round">Odoslať</button></p>
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
