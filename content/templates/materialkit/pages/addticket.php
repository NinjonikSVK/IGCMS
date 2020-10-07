<?php

include("../layout/header.php");

if($user->is_logged_in())
	{
		echo '';
	} else {
		header("Location: login.php");
	}

if(isset($_POST['submit'])){

	$Title = $_POST['ticketTitle'];
	$Cont = $_POST['ticketCont'];
	$Admin = $_POST['ticketAdmin'];
	$author = $_SESSION['username'];

	$date = time();




		//insert into database with a prepared statement
			$stmt = $db->prepare('INSERT INTO tickets (ticketTitle,ticketCont,ticketAuthor,ticketTime,ticketAdmin,ticketStatus) VALUES (:ticketTitle, :ticketCont, :ticketAuthor, :ticketDate, :ticketAdmin, 1)');
			$stmt->execute(array(
					':ticketTitle' => $Title,
					':ticketCont' => $Cont,
					':ticketAuthor' => $author,
					':ticketDate' => $date,
					':ticketAdmin' => $Admin
			));

		$notType = 5;
		$notDate = time();
		$stmt = $db->prepare('INSERT INTO notifications (notUser,notType,notDate) VALUES (:notUser, :notType, :notDate)');
		$stmt->execute(array(
			':notUser' => $_SESSION['username'],
			':notType' => $notType,
			':notDate' => $notDate
		));

		header("Location: mytickets.php?action=ticketcreated");

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

						<h3 class="title"><?php echo $mk["support-create-ticket"] ?></h3>
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
								<label class="control-label"><?php echo $mk["ticket_name"] ?></label>
								<input value="" name="ticketTitle" type="text" class="form-control">
							</div>
						</div>
						<div>
							<div class="form-group label-floating">
								<label class="control-label"><?php echo $dbd["preferated_administrator"].' *' ?></label>
								<input value="" name="ticketAdmin" type="text" class="form-control">
							</div>
						</div>
						<div class="form-group label-floating">
							<label class="control-label"><?php echo $mk["ticket_index"] ?></label>
							<textarea name="ticketCont" class="form-control" rows="5"></textarea>
	                    </div>
						<?php echo $mk["if_not_preferred"] ?>
			  <p><button name="submit" value="submit" class="btn btn-primary btn-round"><?php echo $actions["send"] ?></button></p>
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
