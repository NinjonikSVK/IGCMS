<?php

include("../layout/header.php");

if ($Level > "2"){
		echo "";
	} else {
		header("Location: index.php");
	}

if(isset($_POST['submit'])){

	$newTitle = $_POST['newTitle'];
	$newCont = $_POST['newCont'];
	$author = $_SESSION['username'];

	$date = time();	

	
	
		
		//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO news (newTitle,newCont,newAuthor,newDate) VALUES (:newTitle, :newCont, :newAuthor, :newDate)');
			$stmt->execute(array(
					':newTitle' => $newTitle,
					':newCont' => $newCont,
					':newAuthor' => $author,
					':newDate' => $date
			));
		
		header("Location: news.php?action=newcreated");	

}

?>
<body class="index-page">	
	<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<?
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

						<h3 class="title">Create a new new</h3>
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
								<label class="control-label">New Title</label>
								<input value="" name="newTitle" type="text" class="form-control">
							</div>
						</div>	
						<div class="form-group label-floating">
							<label class="control-label"> New Content</label>
							<textarea name="newCont" class="form-control" rows="5"></textarea>
	                    </div>

						Alert: You can edit new in Administration - Edit new after creating a new new.
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