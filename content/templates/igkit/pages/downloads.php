<?php 
  require_once("../layout/header.php");
  
	$stmt = $db->prepare('SELECT * FROM files');
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
				<?php echo $dbd["to_download"] ?>
			</p>
		</div>
	</div>
	<div class="container">
		<div id="blog" class="row">
			<div class="col-md-12">
				<h4><?php echo $dbd["to_download"]; ?></h4>
				<div class="table-responsive">
					<table id="mytable" class="table table-bordred table-striped">
						<thead>
							<th><?php echo $dbd["id"] ?></th>
							<th><?php echo $dbd["file_name"] ?></th>
							<th><?php echo $dbd["file_description"] ?></th>
							<th><?php echo $dbd["times_downloaded"] ?></th>
							<th><?php echo $dbd["actions"] ?></th>
						</thead>
						<tbody>
						<?php 
							while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
								echo '
								<tr>

									<td>'.$row["fileID"].'</td>
									<td>'.$row["fileTitle"].'</td>
									<td>'.$row["fileCont"].'</td>
									<td>'.$row["fileDL"].'</td>
									<td>
										<p data-placement="top" data-toggle="tooltip" title="Edit">
											<a href="download.php?id='.$row["fileID"].'"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" >
												<i class="fas fa-download"></i> '.$dbd["download"].'
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