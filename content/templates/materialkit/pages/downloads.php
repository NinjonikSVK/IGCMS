<?php
	include("../layout/header.php");

	$stmt = $db->prepare('SELECT * FROM files');
	$stmt->execute(array());
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$stmt->execute()) {
		print_r($stmt->errorInfo());
	}

?>
<body class="index-page">
	<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<?
		include("../layout/navbar.php");
	?>
	<div class="page-header header-filter clear-filter" style="background-image: url('../../../../assets/img/bg0.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1><?php echo $siteTitle; ?>
						</h1>

						<h3 class="title"><?php echo $dbd["to_download"] ?></h3>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main main-raised">
		<div class="section section-basic">
	    	<div class="container">
						<!--     *********     FEATURES 1      *********      -->

<div class="table-responsive">
		                        <table class="table">
		                            <thead>
		                                <tr>
		                                    <th class="text-center"><?php echo $dbd["id"] ?></th>
		                                    <th class="text-primary"><?php echo $dbd["file_name"] ?></th>
											<th class="text-primary"><?php echo $dbd["file_description"] ?></th>
											<th class="text-primary"><?php echo $dbd["times_downloaded"] ?></th>
											<th class="text-primary"><?php echo $dbd["actions"] ?></th>											
		                                </tr>
		                            </thead>
		                            <tbody>
											<?php
												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
														echo "<tr>";
														echo "<th class='text-center'> " . $row["fileID"]. "</th>";
														echo "<th > " . $row["fileTitle"]. "</th>";
														echo "<th> " . $row["fileCont"]. "</th>";
														echo "<th> " . $row["fileDL"]. "</th>";
														echo '<td><a href="download.php?id='.$row["fileID"].'">'.$dbd["download"].'</a></td>';
														echo "</tr>";
												}
											?>
		                                <!--<tr>

		                                    <td class="text-center">2</td>
		                                    <td class="text-info">Fanda Kříž</td>
		                                    <td class="text-info">Developer</td>
		                                    <td class="text-info">2019</td>
		                                </tr>
		                                <tr>
		                                    <td class="text-center">3</td>
		                                    <td>Alex Mike</td>
		                                    <td>Design</td>
		                                    <td>2010</td>
		                                </tr>
		                                <tr>
		                                    <td class="text-center">4</td>
		                                    <td>Mike Monday</td>
		                                    <td>Marketing</td>
		                                    <td>2013</td>
		                                </tr>
		                                <tr>
		                                    <td class="text-center">5</td>
		                                    <td>Paul Dickens</td>
		                                    <td>Communication</td>
		                                    <td>2015</td>
		                                </tr>-->
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
