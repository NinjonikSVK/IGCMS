<?php 
  require_once("../layout/header.php");
  
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
<main role="main" class="container">
	<div class="container py-5 text-center">
		<div class="jumbotron text-white jumbotron-image shadow" style="background-image: url('../../../../assets/img/bg0.jpg');>
			<h2 class="mb-4">
				<?php echo $siteTitle; ?>
			</h2>
			<p class="mb-4">
				<?php echo $mk["support-tickets"] ?>
			</p>
		</div>
	</div>
	<div class="container">
		<div id="blog" class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="mytable" class="table table-bordred table-striped">
						<thead>
						<th><?php echo $dbd["created"] ?></th>
						<th><?php echo $dbd["title"] ?></th>
						<th><?php echo $dbd["preferated_administrator"] ?></th>
						<th><?php echo $dbd["status"] ?></th>
						<th><?php echo $dbd["actions"] ?></th>
						</thead>
						<tbody>
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
								<tr>

									<td>'.$row["ticketID"].'</td>
									<td>'.$date.'</td>
									<td>'.$row["ticketTitle"].'</td>
									<td>'.$status.'</td>
									<td>
											<a href="viewticket?id='.$row["ticketID"].'"><button class="btn btn-primary btn-sm" data-title="Edit" data-toggle="modal" data-target="#edit" >
												<i class="fas fa-eye"></i>
											</button></a>
											<a href="action?id='.$row["ticketID"].'&action=deletet"><button class="btn btn-danger btn-sm" data-title="Edit" data-toggle="modal" data-target="#edit" >
												<i class="fas fa-close"></i>
											</button></a>
									</td>
								</tr>';
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

    
    
    
<?php 
  require_once("../layout/footer.php");
?>