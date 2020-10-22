<?php

include("../layout/header.php");

if (empty($_GET["id"])){
	header("Location: forums.php?action=idnotfound");
}

if(!$user->is_logged_in() ){ header('Location: index'); exit(); }

if(isset($_POST['submit'])){

	$title = $_POST['title'];
	$descr = $_POST['descr'];
	$date = time();
	$locked = 0;
	$pinned = 0;
	if (empty($title)) {
		return header("Location: createtopic.php?action=fillallfields&id=".$_GET['id']."");
	}
	if (empty($descr)) {
		return header("Location: createtopic.php?action=fillallfields&id=".$_GET['id']."");
	}

		$idget = insertDB("topics", "name,authorID,forumID,date,locked,pinned,views", "'".$title."', '".$_SESSION["memberID"]."', '".$_GET["id"]."', '".$date."', '".$locked."', '".$pinned."', 0");
		$idget2 = insertDB("topics_r", "topicID,authorID,descr,time", "'".$idget."', '".$_SESSION["memberID"]."', '".$descr."', '".$date."'");

		header("Location: viewtopic?action=topiccreated&id=".$idget."");

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

						<h3 class="title"><?php echo $mk["forum_create_topic"]; ?></h3>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main main-raised">
		<div class="section section-basic">
	    	<div class="container">
						<!--     *********     FEATURES 1      *********      -->

	    			  <form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1"><?php echo $l["topic_name"]; ?></label>
    <input type="text" class="form-control" name="title">
  </div>
  <label for="editor1"><?php echo $dbd["description"]; ?></label>
  <textarea name="descr" id="editor1" rows="10" cols="80" class="form-control">

            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>

  <button type="submit" name="submit" class="btn btn-primary"><?php echo $actions["submit"]; ?></button>
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
