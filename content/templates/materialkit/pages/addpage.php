<?php

include("../layout/header.php");

if ($Level > "3"){
                echo "";
        } else {
                header("Location: index.php");
        }

if(isset($_POST['submit'])){

	$pageTitle = $_POST['pageTitle'];
	$pageCont = $_POST['pageCont'];
	

	
	
		
		//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO pages (pageTitle,pageCont) VALUES (:pageTitle, :pageCont)');
			$stmt->execute(array(
					':pageTitle' => $pageTitle,
					':pageCont' => $pageCont
			));
		
		header("Location: pages.php?action=pagecreated");	

}

?>
<body class="index-page">	
	<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<?php
		include("../layout/navbar.php");
	?>

  <!-- Content Wrapper. Contains page content -->
  	<div class="page-header header-filter clear-filter" style="background-image: url('../../../../assets/img/bg0.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1><?php echo $siteTitle; ?>
						</h1>

						<h3 class="title">Create a new page</h3>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main main-raised">
		<div class="section section-basic">
	    	<div class="container">
						<!--     *********     FEATURES 1      *********      -->

	    			  <form action="" method="post">
						<div class="col-lg-3 col-sm-4">
						<div>
							<div class="form-group label-floating">
								<label class="control-label">Page Title</label>
								<input value="" name="pageTitle" type="text" class="form-control">
							</div>
						</div>	
						<div class="form-group label-floating">
							<label class="control-label"> Page Content</label>
							<textarea name="pageCont" class="form-control" rows="5"></textarea>
	                    </div>

						Alert: You can edit page in Administration - Edit page after creating a new page.
			  <p><button name="submit" value="submit" class="btn btn-primary btn-round">Submit</button></p>
			  </form>

		<!--     *********    END FEATURES 1      *********      -->


				</div>
				</div>
				</div>
	
    <!-- Main content -->
	<!-- NAV -->
            <!-- /.card-header -->

        <!-- /.col-->
      <!-- ./row -->
<!-- END NAV -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
<?php

include("../layout/footer.php");

?>