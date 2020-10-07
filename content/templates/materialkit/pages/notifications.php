<?php
	include("../layout/header.php");
	
	$stmt = $db->prepare('SELECT notID, notType, notUser, notDate FROM notifications WHERE notUser="'.$_SESSION['username'].'" ORDER BY notDate DESC');
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

						<h3 class="title">Notifikácie</h3>
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
			<a href="action.php?id=0&action=delallno"><?php echo $l["notdel"]; ?></a>
		                        <table class="table">
		                            <thead>
		                                <tr>
		                                    <th class="text-center">ID</th>
		                                    <th class="text-primary"><?php echo $l["notification"]; ?></th>
		                                    <th class="text-primary"><?php echo $dbd["time"]; ?></th>
											<th class="text-primary"><?php echo $actions["actions"]; ?></th>											
		                                </tr>
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
														echo "<tr>";
														echo "<th class='text-center'> " . $row["notID"]. "</th>";
														echo "<td> " . $noType. "</td>";
														echo "<td> " . $date. "</td>";
														echo '<td><a href="action.php?id='.$row["notID"].'&action=deleteno">'.$actions["delete"].'</a></td>';
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