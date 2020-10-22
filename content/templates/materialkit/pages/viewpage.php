<?php
	include("../layout/header.php");
?>
<body class="index-page">	
	<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<?php
		include("../layout/navbar.php");
		
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
	<div class="page-header header-filter clear-filter" style="background-image: url('../../../../assets/img/bg0.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1><?php echo $siteTitle; ?>
						</h1>

						<h3 class="title"><?php echo $pTitle; ?></h3>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main main-raised">
		<div class="section section-basic">
	    	<div class="container">
						<!--     *********     FEATURES 1      *********      -->

			<?php echo $pCont; ?>

		<!--     *********    END FEATURES 1      *********      -->


				</div>
				</div>
				</div>
<?php
	include("../layout/footer.php");
?>