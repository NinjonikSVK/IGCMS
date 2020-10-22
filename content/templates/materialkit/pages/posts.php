<?php
	include("../layout/header.php");
?>
<body class="index-page">
	<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<?php
		include("../layout/navbar.php");

		$stmt = $db->prepare('SELECT newID, newTitle, newAuthor, newDate, newCont, filename, rubrika, likes, dislikes FROM news ORDER BY newDate DESC LIMIT 2');
		$stmt->execute(array());
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$stmt2 = $db->prepare('SELECT username, email FROM members WHERE username="'.$row['newAuthor'].'"');
		$stmt2->execute(array());
		$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

		if (!$stmt->execute()) {
			print_r($stmt->errorInfo());
		}

	?>
	<div class="page-header header-filter clear-filter" style="background-image: url('../../../../assets/img/bg0.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1><?php echo $siteTitle; ?>
						</h1>

						<h3 class="title"><?php echo $sl; ?></h3>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main main-raised">
		<div class="section section-basic">
	    	<div class="container">
						<!--     *********     FEATURES 1      *********      -->


		<div align="center" class="row">
				<div class="col-md-8 col-md-offset-2">
					<h2 class="title"><?php echo $l["news"] ?></h2>
					<h5 class="description"><?php echo $mk["news_found_here"].' '.$siteTitle; ?>.</h5>
				</div>
			</div>
											<?php
												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

														$email = $row2['email'];;
														$default = "cms.igportals.tk/img/default.png";
														$size = 100;

														$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

														$date = date("d.m.Y H:i", $row["newDate"]);

														$likes = $db->query("SELECT count(*) FROM likes WHERE newID='".$row['newID']."'")->fetchColumn();

														echo '
		<div class="card card-plain card-blog">
			<div class="row">
				<div class="col-md-5">
					<div class="card-image">
						<img class="img img-raised" src="../../../uploads/nt/' . $row['filename'] . '" />
					</div>
				</div>
				<div class="col-md-7">
					<h6 class="category text-info">' . $row['rubrika'] . '</h6>
					<h3 class="card-title">
						<a href="#pablo">' . substr($row['newTitle'], 0, 50) . '</a>
					</h3>
					<p class="card-description">
						' . substr($row['newCont'], 0, 1000) . '... <a href="viewnew.php?id=' . $row['newID'] . '"> '.$mk["readmore"].' </a>
					</p>
					<p class="author">
						'.$mk["wrote"].' <a href="#pablo"><b>' . $row['newAuthor'] . '</b></a>, ' . $date . '
					</a>
				</div>
				<a align="left" href="action.php?action=liken&id=' . $row['newID'] . '" class="btn btn-danger btn-simple pull-right">
					<i class="material-icons">favorite</i> ' . $likes . '
				</a>
			</div>
		</div>';
												}
											?>

		<!--     *********    END FEATURES 1      *********      -->



	    </div>
				</div>
				</div>
<?php
	include("../layout/footer.php");
?>
