<?php 
  require_once("../layout/header.php");
  
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
<main role="main" class="container">
	<div class="container py-5 text-center">
		<div class="jumbotron text-white jumbotron-image shadow" style="background-image: url(/assets/img/bg0.jpg">
			<h2 class="mb-4">
				<?php echo $siteTitle; ?>
			</h2>
			<p class="mb-4">
				<?php echo $mk["forum_create_topic"]; ?>
			</p>
		</div>
	</div>
	<div class="container">
		<form method="post">
		  <div class="form-group">
			<label for="topicname"><?php echo $l["topic_name"]; ?></label>
			<input type="text" class="form-control" id="topicname" name="title">
		  </div>
		  <label for="editor1"><?php echo $dbd["description"]; ?></label>
		  <textarea name="descr" id="editor1" rows="10" cols="80" class="form-control">

		</textarea>
		<script>
			// Replace the <textarea id="editor1"> with a CKEditor 4
			// instance, using default configuration.
			CKEDITOR.replace( 'editor1' );
		</script>
		  <button type="submit" class="btn btn-primary" name="submit"><?php echo $actions["submit"]; ?></button>
		</form>
	</div>

    
    
    
<?php 
  require_once("../layout/footer.php");
?>