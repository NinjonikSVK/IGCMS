<?php 
  require_once("../layout/header.php");
  
	$stmt = $db->prepare("SELECT pageTitle, pageCont FROM pages WHERE pageID='".$_GET['id']."'");
	$stmt->execute(array());
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if (!$stmt->execute()) {
		print_r($stmt->errorInfo());
	}
	
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$pTitle = $row["pageTitle"];
		$pCont = $row["pageCont"];
	}
?>
<main role="main" class="container">
	<div class="container py-5 text-center">
		<div class="jumbotron text-white jumbotron-image shadow" style="background-image: url(/assets/img/bg0.jpg">
			<h2 class="mb-4">
				<?php echo $siteTitle; ?>
			</h2>
			<p class="mb-4">
				<?php echo $pTitle; ?>
			</p>
		</div>
	</div>
	<div class="container">
			<?php echo $pCont; ?>
	</div>

    
    
    
<?php 
  require_once("../layout/footer.php");
?>