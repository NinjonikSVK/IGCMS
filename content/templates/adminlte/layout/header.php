<?php
	require("../../../config/config.php");

	$stmt = $db->prepare('SELECT siteTitle FROM settings WHERE siteID=1');
	$stmt->execute(array());
	$site = $stmt->fetch(PDO::FETCH_ASSOC);

	$siteTitle = $site['siteTitle'];

	if(!$user->is_logged_in()){ header('Location: login.php'); exit(); }

	$permis2 = getperm('canviewdashboard')["canviewdashboard"];
	if ($permis2 == 0) {
		header("Location: ../../materialkit/pages/index?type=notenoughpermissions");
	} else if ($permis2 == 1) {
		echo '';
	} else {
		echo 'Error, group permission error.';
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
 <script src="../ckeditor4/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/17.0.0/classic/ckeditor.js"></script>
  <title><?php echo $siteTitle; ?> | Panel</title>
	<!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
	<!-- summernote -->
	<link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $siteTitle; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $grav_urls; ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
		  <?php
		  echo ('

			<a href="index.php">'); echo htmlspecialchars($_SESSION['username'], ENT_QUOTES); echo ("</a>") ?>

        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                 <?php echo $dbd["main"]; ?>
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
 			  	<?php echo $l["log_out"]; ?>
              </p>
            </a>
          </li>

		  <?php
			echo '<li class="nav-header">'.$l["administration"].'</li>';
		  $permis = getperm('canmanagepages')["canmanagepages"];
			if ($permis == 0) {
				echo '';
			} else if ($permis == 1) {
				echo '
				
					<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon far fa-envelope"></i>
						<p>
						'.$dbd["sites"].'
						<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="pages.php" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>'.$dbd["sites"].'</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="addpage.php" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>'.$dbd["create_site"].'</p>
							</a>
						</li>
					</ul>
					</li>
				
				';
			} else {
				echo 'Error, group permission error.';
			}
			$permis2 = getperm('canmanagenews')["canmanagenews"];
			if ($permis2 == 0) {
				echo '';
			} else if ($permis2 == 1) {
				echo '
				
				<li class="nav-item has-treeview">
				<a href="#" class="nav-link">
					<i class="nav-icon far fa-file"></i>
					<p>
					'.$l["news"].'
					<i class="fas fa-angle-left right"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="news.php" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>'.$l["news"].'</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="addnew.php" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>'.$dbd["add_post"].'</p>
						</a>
					</li>
				</ul>
				</li>
				
				';
			} else {
				echo 'Error, group permission error.';
			}
			$permis3 = getperm('canmanagefiles')["canmanagefiles"];
			if ($permis3 == 0) {
				echo '';
			} else if ($permis3 == 1) {
				echo '
				
					<li class="nav-item has-treeview">
				<a href="#" class="nav-link">
					<i class="nav-icon fas fa-upload"></i>
					<p>
					'.$dbd["files"].'
					<i class="fas fa-angle-left right"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="files" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>'.$dbd["files"].'</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="addfile" class="nav-link">
							<i class="far fa-circle nav-icon"></i>
							<p>'.$dbd["add_file"].'</p>
						</a>
					</li>
				</ul>
				</li>
				
				';
			} else {
				echo 'Error, group permission error.';
			}
			$permis4 = getperm('canmanageusers')["canmanageusers"];
			if ($permis4 == 0) {
				echo '';
			} else if ($permis4 == 1) {
				echo '
				
				<li class="nav-item">
					<a href="members.php" class="nav-link">
						<i class="nav-icon fas fa-users"></i>
						<p>
						'.$dbd["users"].'
						</p>
					</a>
				</li>
				
				';
			} else {
				echo 'Error, group permission error.';
			}
			$permis5 = getperm('canmanagegroups')["canmanagegroups"];
			if ($permis5 == 0) {
				echo '';
			} else if ($permis5 == 1) {
				echo '
				
				<li class="nav-item">
					<a href="groups" class="nav-link">
						<i class="nav-icon fas fa-users-cog"></i>
						<p>
						'.$dbd["groups"].'
						</p>
					</a>
				</li>
				
				';
			} else {
				echo 'Error, group permission error.';
			}
			$permis6 = getperm('canmanageforum')["canmanageforum"];
			if ($permis6 == 0) {
				echo '';
			} else if ($permis6 == 1) {
				echo '
				
				<li class="nav-item">
					<a href="forums" class="nav-link">
						<i class="nav-icon fas fa-address-card"></i>
						<p>
						'.$dbd["forum_forums"].'
						</p>
					</a>
				</li>
				
				';
			} else {
				echo 'Error, group permission error.';
			}
			$permis7 = getperm('canmanagetickets')["canmanagetickets"];
			if ($permis7 == 0) {
				echo '';
			} else if ($permis7 == 1) {
				echo '
				
				<li class="nav-item">
					<a href="atickets.php" class="nav-link">
						<i class="nav-icon fas fa-ticket-alt"></i>
						<p>
						'.$dbd["tickets"].'
						</p>
					</a>
				</li>
				
				';
			} else {
				echo 'Error, group permission error.';
			}
			$permis8 = getperm('canmanagesite')["canmanagesite"];
			if ($permis8 == 0) {
				echo '';
			} else if ($permis8 == 1) {
				echo '
				
				<li class="nav-item">
					<a href="editsite.php" class="nav-link">
						<i class="nav-icon fas fa-cog"></i>
						<p>
						'.$dbd["site_settings"].'
						</p>
					</a>
				</li>
				
				';
			} else {
				echo 'Error, group permission error.';
			}

		  ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
