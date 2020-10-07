<?php
	include("../layout/header.php");

	if ($Level > "3"){
		echo "";
	} else {
		header("Location: index.php");
	}
	
	$stmt = $db->prepare('SELECT newID, newTitle, newAuthor, newDate FROM news');
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

						<h3 class="title">News</h3>
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
		                                    <th class="text-primary">New Title</th>
											<th class="text-primary">New Author</th>
											<th class="text-primary">New Date</th>
											<th class="text-primary">Actions</th>											
		                                </tr>
		                            </thead>
		                            <tbody>
											<?php
												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
														$date = date("d.m.Y H:i", $row["newDate"]);
													
														echo "<tr>";
														echo "<th class='text-center'> " . $row["newID"]. "</th>";
														echo "<th class='text-center'> " . $row["newTitle"]. "</th>";
														echo "<th class='text-center'> " . $row["newAuthor"]. "</th>";
														echo "<th class='text-center'> " . $date. "</th>";
														echo "<td><a href='viewnew.php?id=".$row["newID"]."'>Jump to the new</a></td>";
														echo '<td><a href="actions.php?id='.$row["newID"].'&action=deleten">Delete new</a></td>';
														echo '<td><a href="editnew.php?id='.$row["newID"].'">Edit new</a></td>';
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