<?php

include("../layout/header.php");

	if($user->is_logged_in())
	{
		echo '';
	} else {
		header("Location: login.php");
	}

	if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
		header('Location: index.php');
	}

	$stmt = $db->prepare("SELECT * FROM stocks WHERE stockID='".$_GET['id']."'");
	$stmt->execute(array());
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$stmt->execute()) {
		print_r($stmt->errorInfo());
	}

	if($_SESSION['username'] == $row['creator'])
	{
		echo '';
	} else {
		header("Location: index.php");
	}

if(isset($_POST['submit'])){

	$spolocnost = $_POST['spolocnost'];
	$majitel = $_POST['majitel'];
	$cena = $_POST['cena'];
	$vyvoj = $_POST['vyvoj'];
	$hodnota = $_POST['hodnota'];
	$pocetakcii = $_POST['pocetakcii'];
	$percento = $_POST['percento'];
	$creator = $_SESSION['username'];

		//insert into database with a prepared statement
			$stmt = $db->prepare('UPDATE stocks SET spolocnost=:spolocnost, majitel=:majitel, cena=:cena, vyvoj=:vyvoj, hodnota=:hodnota, pocetakcii=:pocetakcii, percento=:percento WHERE stockID=:stockID');
			$stmt->execute(array(
					':spolocnost' => $spolocnost,
					':majitel' => $majitel,
					':cena' => $cena,
					':vyvoj' => $vyvoj,
					':hodnota' => $hodnota,
					':pocetakcii' => $pocetakcii,
					':percento' => $percento,
					':stockID' => $_GET["id"]
			));

		header("Location: stocks?action=stockedited");

}

?>
<body class="index-page">
	<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<?
		include("../layout/navbar.php");
	?>

  <!-- Content Wrapper. Contains page content -->
  	<div class="page-header header-filter clear-filter" style="background-image: url('assets/img/bg0.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1><?php echo $siteTitle; ?>
						</h1>

						<h3 class="title">Pridať akcie spoločnosti na predaj</h3>
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
								<label class="control-label">Názov spoločnosti</label>
								<input value="<?php echo $row['spolocnost']; ?>" name="spolocnost" type="text" class="form-control">
							</div>
						</div>
						<div>
							<div class="form-group label-floating">
								<label class="control-label">Majiteľ spoločnosti</label>
								<input value="<?php echo $row['majitel']; ?>" name="majitel" type="text" class="form-control">
							</div>
						</div>
						<div>
							<div class="form-group label-floating">
								<label class="control-label">Cena jednej akcie</label>
								<input value="<?php echo $row['cena']; ?>" name="cena" type="number" class="form-control">
							</div>
						</div>
						<div>
							<div class="form-group label-floating">
								<label class="control-label">Vývoj ceny</label>
								<input value="<?php echo $row['vyvoj']; ?>" name="vyvoj" type="text" class="form-control">
							</div>
						</div>
						<div>
							<div class="form-group label-floating">
								<label class="control-label">Hodnota spoločnosti</label>
								<input value="<?php echo $row['hodnota']; ?>" name="hodnota" type="number" class="form-control">
							</div>
						</div>
						<div>
							<div class="form-group label-floating">
								<label class="control-label">Počet akcií na predaj</label>
								<input value="<?php echo $row['pocetakcii']; ?>" name="pocetakcii" type="number" class="form-control">
							</div>
						</div>
						<div>
							<div class="form-group label-floating">
								<label class="control-label">Percento podielu z jednej akcie</label>
								<input value="<?php echo $row['percento']; ?>" name="percento" type="number" class="form-control" min=0.0000001" max="100">
							</div>
						</div>

			  <p><button name="submit" value="submit" class="btn btn-primary btn-round">Odoslať</button></p>
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
