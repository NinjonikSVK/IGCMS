<?php 
  require_once("../layout/header.php");
  
	$stmt = $db->prepare('SELECT notID, notType, notUser, notDate FROM notifications WHERE notUser="'.$_SESSION['username'].'" ORDER BY notDate DESC');
	$stmt->execute(array());
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
				<?php echo $l["notification"] ?>
			</p>
		</div>
	</div>
	<div class="container">
		<div id="blog" class="row">
			<div class="col-md-12">
				<h4><a href="action.php?id=0&action=delallno"><?php echo $l["notdel"]; ?></a></h4>
				<div class="table-responsive">
					<table id="mytable" class="table table-bordred table-striped">
						<thead>
							<th><?php echo $dbd["id"] ?></th>
							<th><?php echo $l["notification"]; ?></th>
							<th><?php echo $dbd["time"]; ?></th>
							<th><?php echo $actions["actions"]; ?></th>
						</thead>
						<tbody>
						<?php 
							while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
								$date = date("d.m.Y H:i:s", $row["notDate"]);
													
													$nType = $row["notType"];
													
													if ($nType == '1'){
														$noType = $l["not1"];
													}
													else if ($nType == '2'){
														$noType = $l["not2"];
													}
													else if ($nType == '3'){
														$noType = $l["not3"];
													}
													else if ($nType == '4'){
														$noType = $l["not4"];
													}
													else if ($nType == '5'){
														$noType = $l["not5"];
													}
													else if ($nType == '6'){
														$noType = $l["not6"];
													}
													else if ($nType == '7'){
														$noType = $l["not7"];
													}
													else if ($nType == '8'){
														$noType = $l["not8"];
													}
													else {
														$noType = $l["not9"];
													}
								echo '
								<tr>

									<td>'.$row["notID"].'</td>
									<td>'.noType.'</td>
									<td>'.$date.'</td>
									<td>
										<p data-placement="top" data-toggle="tooltip" title="Edit">
											<a href="action.php?id='.$row["notID"].'&action=deleteno"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" >
												'.$actions["delete"].'
											</button></a>
										</p>
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