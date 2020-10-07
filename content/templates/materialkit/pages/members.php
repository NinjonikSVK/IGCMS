<?php
	include("../layout/header.php");

	if ($Level > "3"){
		echo "";
	} else {
		header("Location: index.php");
	}
	
	$stmt = $db->prepare('SELECT memberID, username, email, active, resetComplete, Level FROM members');
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

						<h3 class="title">Uživatelia</h3>
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
		                                    <th class="text-center">ID</th>
		                                    <th class="text-primary">Meno</th>
		                                    <th class="text-primary">Email</th>
		                                    <th class="text-primary">Účet</th>
											<th class="text-primary">Reset</th>
											<th class="text-primary">Level</th>
											<th class="text-primary">Profil</th>
											<th class="text-primary">Akcie</th>											
		                                </tr>
		                            </thead>
		                            <tbody>
											<?php
												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
														echo "<tr>";
														echo "<th class='text-center'> " . $row["memberID"]. "</th>";
														echo "<td> " . $row["username"]. "</td>";
														echo "<td> " . $row["email"]. "</td>";
														echo "<td> " . $row["active"]. "</td>";
														echo "<td> " . $row["resetComplete"]. "</td>";
														echo "<td> " . $row["Level"]. "</td>";
														echo "<td><a href='profile.php?id=".$row["memberID"]."'>Skočiť na profil</a></td>";
														echo '<td><a href="actions.php?id='.$row["memberID"].'&action=deleteu">Odstrániť</a></td>';
														echo '<td><a href="actions.php?id='.$row["memberID"].'&action=verifyu">Overiť uživateľa</a></td>';
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