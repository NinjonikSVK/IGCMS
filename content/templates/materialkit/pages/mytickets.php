<?php
	include("../layout/header.php");

	if($user->is_logged_in())
	{
		echo '';
	} else {
		header("Location: login.php");
	}

	$stmt = $db->prepare('SELECT * FROM tickets WHERE ticketAuthor=:ticketAuthor ORDER BY ticketTime DESC');
	$stmt->execute(array(':ticketAuthor' => $usern));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$stmt->execute()) {
		print_r($stmt->errorInfo());
	}
?>
<body class="index-page">
	<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<?php
		include("../layout/navbar.php");
	?>
	<div class="page-header header-filter clear-filter" style="background-image: url('../../../../assets/img/bg0.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1><?php echo $siteTitle; ?>
						</h1>

						<h3 class="title"><?php echo $mk["support-tickets"] ?></h3>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main main-raised">
		<div class="section section-basic">
	    	<div class="container">
			<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th><?php echo $dbd["created"] ?></th>
						<th><?php echo $dbd["title"] ?></th>
						<th><?php echo $dbd["preferated_administrator"] ?></th>
						<th><?php echo $dbd["status"] ?></th>
						<th><?php echo $dbd["actions"] ?></th>
					</tr>
				</thead>
				<tbody>
<!--     *********     FEATURES 1      *********      -->
	<?php
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

				$date = date("d.m.Y H:i", $row["ticketTime"]);

				if ($row["ticketStatus"] == '1'){
					$status = '<span class="label label-success">'.$statuses["opened"].'</span>';
				}
				else if ($row["ticketStatus"]== '2'){
					$status = '<span class="label label-default">'.$statuses["working_on"].'</span>';
				}
				else if ($row["ticketStatus"] == '3'){
					$status = '<span class="label label-danger">'.$statuses["closed"].'</span>';
				}
				else if ($row["ticketStatus"] == '4'){
					$status = '<span class="label label-rose">'.$statuses["stored"].'</span>';
				}
				else {
					$status = '<span class="label label-danger">'.$statuses["error"].'</span>';
				}

				echo '
						<tr>';
							echo '<td>'.$row["ticketID"].'</td>';
							echo '<td>'.$date.'</td>';
							echo '<td>'.$row["ticketTitle"].'</td>';
							echo '<td>'.$row["ticketAdmin"].'</td>';
							echo '<td>'.$status.'</td>';
							echo '<td class="td-actions">';
							echo '<a href="viewticket?id='.$row["ticketID"].'">';
							echo'<button type="button" rel="tooltip" class="btn btn-success">
									<i class="material-icons">edit</i>
								</button>
								</a>';
							echo '<a href="action?id='.$row["ticketID"].'&action=deletet">';
							echo '<button type="button" rel="tooltip" class="btn btn-danger">
									<i class="material-icons">close</i>
								</button>
								</a>
							</td>
						</tr>
				';
				
		}
	?>
	</tbody>
				</table>
				</div>


		<!--     *********    END FEATURES 1      *********      -->


				</div>
				</div>
				</div>
<?php
	include("../layout/footer.php");
?>
