<?php
	include("../layout/header.php");
	require_once("../../../config/config.php");
?>
<body class="index-page">
	<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<?
		include("../layout/navbar.php");
	?>
	<div class="page-header header-filter clear-filter" style="background-image: url('assets/img/bg0.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1><?php echo $siteTitle; ?>
							<div class="pro-badge">
								404
							</div>
						</h1>

						<h3 class="title"><?php echo $mk["404"] ?></h3>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	include("../layout/footer.php");
?>
