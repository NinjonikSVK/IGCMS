<?php

include("../layout/header.php");

$permis = getperm('canmanageforum')["canmanageforum"];
if ($permis == 0) {
	header("Location: index?type=notenoughpermissions");
} else if ($permis == 1) {
	echo '';
} else {
	echo 'Error, group permission error.';
}

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $dbd["forum_add"] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index"><?php echo $l['home']; ?></a></li>
              <li class="breadcrumb-item active"><?php echo $dbd["forum_add"]; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
	<!-- NAV -->
<div class="card-body pad">
              <div class="mb-3">
<?php
  $step = $_GET["step"];
  $type = $_GET["type"];
  if ($step == '1'){
    echo '
    '.$dbd["forum_choose"].'
      <form method="post">
                <div class="col-sm-6">
                  <!-- radio -->
                  <div class="form-group clearfix">
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimary1" name="r1">
                      <label for="radioPrimary1">
                        '.$dbd["forum_category"].'
                      </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="radioPrimary2" name="r2">
                      <label for="radioPrimary2">
                        '.$dbd["forum_forum"] .'
                      </label>
                    </div>
                  </div>
                </div>
    ';
    if(isset($_POST["r1"])){
      $r = "c";
    }

    if(isset($_POST["r2"])){
      $r = "f";
    }
    echo $r;
		if(isset($_POST["submit"])){
			header("Location: createforum.php?step=2&type=".$r."");
		}
  } else if ($step == '2') {
		echo '
		<form action="" method="post">
		<div class="col-sm-6">
				<!-- text input -->
					<div class="form-group">
						<label>'.$dbd["forum_name"].'</label>
						<input name="name" type="text" class="form-control">
					</div>
					<div class="form-group">
						<label>'.$dbd["forum_order"].'</label>
						<input name="order" type="number" class="form-control">
					</div>
		';
		if($type == 'c'){
			$type = 0;
			if(isset($_POST["submit"])){
				$name = $_POST["name"];
				$order = $_POST["order"];
				$stmtd = $db->prepare('INSERT INTO forums (name,sortn,type) VALUES (:name, :sortn, :type)');
				$stmtd->execute(array(
						':name' => $name,
						':sortn' => $order,
						':type' => $type
				));
				header("Location: forums.php?action=forumcreated");
			}
		} else if ($type == 'f') {
			echo '
			<div class="form-group">
				<label>'.$dbd["forum_desc"].'</label>
				<input name="desc" type="text" class="form-control">
			</div>
			<div class="form-group">
				<label>'.$dbd["forum_icon"].' (fa fa-)</label>
				<input name="icon" type="text" class="form-control">
			</div>
			<label>'.$dbd["forum_parent"].'</label>
	      <select name="parent" class="form-control select2bs4" style="width: 100%;">
				 ';
				 $stmtf = $db->prepare('SELECT name FROM forums');
	 			$stmtf->execute(array());
	 			$rowf = $stmtf->fetch(PDO::FETCH_ASSOC);

	 			if (!$stmtf->execute()) {
	 				print_r($stmtf->errorInfo());
	 			}

	 			while ($rowf = $stmtf->fetch(PDO::FETCH_ASSOC)) {
	 				echo '<option value="'.$rowf["name"].'">'.$rowf["name"].'</option>';
	 			}
				echo '
	      </select>';

				$parent = $_POST["parent"];

			if(isset($_POST["submit"])){
				$name = $_POST["name"];
				$order = $_POST["order"];
				$desc = $_POST["desc"];
				$icon = $_POST["icon"];
				$type = 1;
				if (empty($icon)) {
					$icon = "commenting";
				}
				if (empty($name)) {
					return header("Location: createforum.php?action=fillallfields&step=1");
				}
				if (empty($order)) {
					return header("Location: createforum.php?action=fillallfields&step=1");
				}
				if (empty($desc)) {
					return header("Location: createforum.php?action=fillallfields&step=1");
				}
				

			 $stmtpp = $db->prepare('SELECT id FROM forums WHERE name=:name');
			 $stmtpp->execute(array(':name' => $parent));
			 $rowpp = $stmtpp->fetch(PDO::FETCH_ASSOC);

			 if (!$stmtpp->execute()) {
				 print_r($stmtpp->errorInfo());
			 }

				$stmtd = $db->prepare('INSERT INTO forums (name,sortn,descr,icon,parent,type) VALUES (:name, :sortn, :descr, :icon, :parent, :type)');
				$stmtd->execute(array(
						':name' => $name,
						':sortn' => $order,
						':descr' => $desc,
						':icon' => $icon,
						':parent' => $rowpp["id"],
						':type' => $type
				));
			header("Location: forums.php?action=forumcreated");
			}

		} else {
			echo 'Error: Type of forum is not defined in the URL.';
		}
		echo '
		</div>
		 <!-- /.box -->
							 </div>
		';
  } else {
    echo 'Error: Step is not defined in the URL.';
  }
?>
<p><input type="submit" name="submit" value="<?php echo $actions["send"]; ?>" class="btn btn-primary" /></p>
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
