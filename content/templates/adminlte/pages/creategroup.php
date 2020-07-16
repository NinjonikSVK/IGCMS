<?php

include("../layout/header.php");

$permis = getperm('canmanagegroups')["canmanagegroups"];
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
            <h1><?php echo $dbd["group_add"]; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index"><?php echo $l['home']; ?></a></li>
              <li class="breadcrumb-item active"><?php echo $dbd["group_add"]; ?></li>
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
  if ($step == '1'){
    echo '
    <form method="post">
    <div class="col-sm-6">
                          <!-- text input -->
                          <div class="form-group">
                            <label>'.$dbd["group_name"].'</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter ...">
                          </div>
                    <div class="form-group">
                      <label>'.$dbd["group_color"].':</label>

                      <div class="input-group my-colorpicker2">
                        <input type="text" class="form-control" name="color">

                        <div class="input-group-append">
                          <span class="input-group-text"><i class="fas fa-square"></i></span>
                        </div>
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
    ';
    if(isset($_POST['submit'])){

    	$name = $_POST['name'];
    	$color = $_POST['color'];
		if (empty($name)) {
			return header("Location: creategroup.php?action=fillallfields&step=1");
		}
		if (empty($color)) {
			return header("Location: creategroup.php?action=fillallfields&step=1");
		}

    		$idget = insertDB("groups", "title,color", "'".$name."', '".$color."'");
    		header("Location: creategroup?step=2&id=".$idget."");

    }
  } else if ($step == '2') {
	$edit = $_GET['edit'];
	if($edit = '1'){
		
		 $stmtpp = $db->prepare('SELECT * FROM groups WHERE id=:id');
			 $stmtpp->execute(array(':id' => $_GET['id']));
			 $rowpp = $stmtpp->fetch(PDO::FETCH_ASSOC);

			 if (!$stmtpp->execute()) {
				 print_r($stmtpp->errorInfo());
			 }
		
		function issetperm($perm){
				 
				global $rowpp;
				 
				if($rowpp[$perm] == 1){
					$ischecked[$perm] = "checked";
					return $ischecked[$perm];
				} else {
					$ischecked[$perm] = "";
					return $ischecked[$perm];
				}
			 }
		
		echo '
		<form action="" method="post">
		<div class="col-sm-6">
		<div><h2>'.$perl["permissions"].':</h2></div>
		<div class="form-group">
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1" name="canviewdashboard" '.issetperm("canviewdashboard").'>
				<label for="customCheckbox1" class="custom-control-label">'.$perl["show_dashboard"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox2" value="option2" name="canmanagetickets" '.issetperm("canmanagetickets").'>
				<label for="customCheckbox2" class="custom-control-label">'.$perl["manage_tickets"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox3" value="option3" name="canmanagepages" '.issetperm("canmanagepages").'>
				<label for="customCheckbox3" class="custom-control-label">'.$perl["manage_pages"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox4" value="option4" name="canmanagenews" '.issetperm("canmanagenews").'>
				<label for="customCheckbox4" class="custom-control-label">'.$perl["manage_news"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox5" value="option5" name="canmanagefiles" '.issetperm("canmanagefiles").'>
				<label for="customCheckbox5" class="custom-control-label">'.$perl["manage_files"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox6" value="option6" name="canmanageusers" '.issetperm("canmanageusers").'>
				<label for="customCheckbox6" class="custom-control-label">'.$perl["manage_users"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox7" value="option7" name="canmanagesite" '.issetperm("canmanagesite").'>
				<label for="customCheckbox7" class="custom-control-label">'.$perl["manage_site"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox8" value="option8" name="canmanagegroups" '.issetperm("canmanagegroups").'>
				<label for="customCheckbox8" class="custom-control-label">'.$perl["manage_groups"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox9" value="option9" name="canmoderatechat" '.issetperm("canmoderatechat").'>
				<label for="customCheckbox9" class="custom-control-label">'.$perl["moderate_chat"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox10" value="option10" name="canmanageforum" '.issetperm("canmanageforum").'>
				<label for="customCheckbox10" class="custom-control-label">'.$perl["manage_forum"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox11" value="option11" name="canmoderateforum" '.issetperm("canmoderateforum").'>
				<label for="customCheckbox11" class="custom-control-label">'.$perl["moderate_forum"].'</label>
			  </div>
		  </div>
	</div>
	<!-- /.box -->
			';
			if(isset($_POST['canviewdashboard'])){
			  $canviewdashboard = 1;
			} else {
			  $canviewdashboard = 0;
			}
			if(isset($_POST['canmanagetickets'])){
			  $canmanagetickets = 1;
			} else {
			  $canmanagetickets = 0;
			}
			if(isset($_POST['canmanagepages'])){
			  $canmanagepages = 1;
			} else {
			  $canmanagepages = 0;
			}
			if(isset($_POST['canmanagenews'])){
			  $canmanagenews = 1;
			} else {
			  $canmanagenews = 0;
			}
					if(isset($_POST['canmanagefiles'])){
			  $canmanagefiles = 1;
			} else {
			  $canmanagefiles = 0;
			}
			if(isset($_POST['canmanageusers'])){
			  $canmanageusers = 1;
			} else {
			  $canmanageusers = 0;
			}
			if(isset($_POST['canmanagesite'])){
			  $canmanagesite = 1;
			} else {
			  $canmanagesite = 0;
			}
			if(isset($_POST['canmanagegroups'])){
			  $canmanagegroups = 1;
			} else {
			  $canmanagegroups = 0;
			}
			 if(isset($_POST['canmoderatechat'])){
			  $canmoderatechat = 1;
			} else {
			  $canmoderatechat = 0;
			}
			if(isset($_POST['canmanageforum'])){
			  $canmanageforum = 1;
			} else {
			  $canmanageforum = 0;
			}
			 if(isset($_POST['canmoderateforum'])){
			  $canmoderateforum = 1;
			} else {
			  $canmoderateforum = 0;
			}

			if(isset($_POST['submit'])){
				updateDB("groups", "canviewdashboard='".$canviewdashboard."', canmanagetickets='".$canmanagetickets."', canmanagepages='".$canmanagepages."', canmanagenews='".$canmanagenews."', canmanagefiles='".$canmanagefiles."', canmanageusers='".$canmanageusers."', canmanagesite='".$canmanagesite."', canmanagegroups='".$canmanagegroups."', canmoderatechat='".$canmoderatechat."', canmanageforum='".$canmanageforum."', canmoderateforum='".$canmoderateforum."'", "id=".$_GET['id']."");
				header("Location: groups?action=groupcreated");
			}
	} else {
		echo '
		<form action="" method="post">
		<div class="col-sm-6">
		<div><h2>'.$perl["permissions"].':</h2></div>
		<div class="form-group">
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1" name="canviewdashboard">
				<label for="customCheckbox1" class="custom-control-label">'.$perl["show_dashboard"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox2" value="option2" name="canmanagetickets">
				<label for="customCheckbox2" class="custom-control-label">'.$perl["manage_tickets"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox3" value="option3" name="canmanagepages">
				<label for="customCheckbox3" class="custom-control-label">'.$perl["manage_pages"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox4" value="option4" name="canmanagenews">
				<label for="customCheckbox4" class="custom-control-label">'.$perl["manage_news"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox5" value="option5" name="canmanagefiles">
				<label for="customCheckbox5" class="custom-control-label">'.$perl["manage_files"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox6" value="option6" name="canmanageusers">
				<label for="customCheckbox6" class="custom-control-label">'.$perl["manage_users"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox7" value="option7" name="canmanagesite">
				<label for="customCheckbox7" class="custom-control-label">'.$perl["manage_site"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox8" value="option8" name="canmanagegroups">
				<label for="customCheckbox8" class="custom-control-label">'.$perl["manage_groups"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox9" value="option9" name="canmoderatechat">
				<label for="customCheckbox9" class="custom-control-label">'.$perl["moderate_chat"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox10" value="option10" name="canmanageforum">
				<label for="customCheckbox10" class="custom-control-label">'.$perl["manage_forum"].'</label>
			  </div>
			  <div class="custom-control custom-checkbox">
				<input class="custom-control-input" type="checkbox" id="customCheckbox11" value="option11" name="canmoderateforum">
				<label for="customCheckbox11" class="custom-control-label">'.$perl["moderate_forum"].'</label>
			  </div>
		  </div>
	</div>
	<!-- /.box -->
			';
			if(isset($_POST['canviewdashboard'])){
			  $canviewdashboard = 1;
			} else {
			  $canviewdashboard = 0;
			}
			if(isset($_POST['canmanagetickets'])){
			  $canmanagetickets = 1;
			} else {
			  $canmanagetickets = 0;
			}
			if(isset($_POST['canmanagepages'])){
			  $canmanagepages = 1;
			} else {
			  $canmanagepages = 0;
			}
			if(isset($_POST['canmanagenews'])){
			  $canmanagenews = 1;
			} else {
			  $canmanagenews = 0;
			}
					if(isset($_POST['canmanagefiles'])){
			  $canmanagefiles = 1;
			} else {
			  $canmanagefiles = 0;
			}
			if(isset($_POST['canmanageusers'])){
			  $canmanageusers = 1;
			} else {
			  $canmanageusers = 0;
			}
			if(isset($_POST['canmanagesite'])){
			  $canmanagesite = 1;
			} else {
			  $canmanagesite = 0;
			}
			if(isset($_POST['canmanagegroups'])){
			  $canmanagegroups = 1;
			} else {
			  $canmanagegroups = 0;
			}
			 if(isset($_POST['canmoderatechat'])){
			  $canmoderatechat = 1;
			} else {
			  $canmoderatechat = 0;
			}
			if(isset($_POST['canmanageforum'])){
			  $canmanageforum = 1;
			} else {
			  $canmanageforum = 0;
			}
			 if(isset($_POST['canmoderateforum'])){
			  $canmoderateforum = 1;
			} else {
			  $canmoderateforum = 0;
			}

			if(isset($_POST['submit'])){
				updateDB("groups", "canviewdashboard='".$canviewdashboard."', canmanagetickets='".$canmanagetickets."', canmanagepages='".$canmanagepages."', canmanagenews='".$canmanagenews."', canmanagefiles='".$canmanagefiles."', canmanageusers='".$canmanageusers."', canmanagesite='".$canmanagesite."', canmanagegroups='".$canmanagegroups."', canmoderatechat='".$canmoderatechat."', canmanageforum='".$canmanageforum."', canmoderateforum='".$canmoderateforum."'", "id=".$_GET['id']."");
				header("Location: groups?action=groupcreated");
			}
	}
  } else {
    echo 'Error: Step is not defined in the URL.';
  }
?>

</div>
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
