<?php

include("../layout/header.php");

$permis = getperm('canmanageusers')["canmanageusers"];
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

	$groupID = $_POST['group'];

	//insert into database with a prepared statement
			$stmt = $db->prepare('UPDATE members SET groupID=:groupID WHERE memberID=:memberID');
			$stmt->execute(array(
				':groupID' => $groupID,
				':memberID' => $_GET["id"]
			));

	header("Location: members.php?action=grouporunassigned");

}

$stmt = $db->prepare('SELECT id, title FROM groups');
$stmt->execute(array());
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$stmt->execute()) {
	print_r($stmtf->errorInfo());
}

$stmtu2 = $db->prepare('SELECT groupID FROM members WHERE memberID=:memberID');
$stmtu2->execute(array(':memberID' => $_GET["id"]));
$rowu2 = $stmtu2->fetch(PDO::FETCH_ASSOC);

$usergroupIDp = $rowu2['groupID'];

if($usergroupIDp == 0){
	$lvlp = $l["user"];
} else {
	$stmtgi = $db->prepare('SELECT * FROM groups WHERE id=:id');
	$stmtgi->execute(array(':id' => $usergroupIDp));
	$rogi = $stmtgi->fetch(PDO::FETCH_ASSOC);

	$grn = $rogi['title'];
	$lvlp = '<span">'.$grn.'</span>';
}
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $edt["editusgroup"]; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#"><?php echo $l["home"]; ?></a></li>
              <li class="breadcrumb-item active"><?php echo $edt["editusgroup"]; ?></li>
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
                        <label><?php echo $edt["current_group"]; ?>: <?php echo $lvlp; ?></label>
                        <form method='post'>
							<select onchange='myform.submit();' name='group' class='form-control select2bs4' style='width: 100%;'>
								<?php
									while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
										echo "<option value='0'>".$l["user"]."</option>";
										echo "<option value='".$row['id']."'>".$row['title']."</option>";
									}
								?>
							</select>
						</form>
                      </div>
					<p><button name="submit" value="Odoslať" class="btn btn-primary btn-round"><?php echo $l["submit"]; ?></button></p>
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
