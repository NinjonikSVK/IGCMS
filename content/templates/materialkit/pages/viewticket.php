<?php
	include("../layout/header.php");

	$tid = $_GET['id'];

	$stmt = $db->prepare('SELECT * FROM tickets WHERE ticketID=:ticketID ORDER BY ticketTime DESC');
	$stmt->execute(array(':ticketID' => $tid));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if (!$stmt->execute()) {
		print_r($stmt->errorInfo());
	}

	$stmtr = $db->prepare('SELECT * FROM ticketr WHERE ticketID=:ticketID ORDER BY respTime DESC');
	$stmtr->execute(array(':ticketID' => $tid));
	$rowr = $stmtr->fetch(PDO::FETCH_ASSOC);

	if (!$stmtr->execute()) {
		print_r($stmtr->errorInfo());
	}

	if(isset($_POST['submit'])){

		$respCont = $_POST['respCont'];
		$author = $_SESSION['username'];

		if (empty($respCont)) {
			return header("Location: viewticket.php?action=fillallfields&id=".$_GET["id"]."");
		}
		
		$date = time();

			//insert into database with a prepared statement
				$stmt = $db->prepare('INSERT INTO ticketr (ticketID,respCont,respAuthor,respTime,type) VALUES (:ticketID, :respCont, :respAuthor, :respTime, :type)');
				$stmt->execute(array(
						':ticketID' => $tid,
						':respCont' => $respCont,
						':respAuthor' => $author,
						':respTime' => $date,
						':type' => '0'
				));

			header("Location: viewticket.php?id=".$tid."&action=respcreated");

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
																	<th class="text-center">#</th>
																	<th><?php echo $dbd["created"] ?></th>
																	<th><?php echo $dbd["title"] ?></th>
																	<th><?php echo $dbd["preferated_administrator"] ?></th>
																	<th class="text-right"><?php echo $dbd["status"] ?></th>
																	<th class="text-right"><?php echo $dbd["actions"] ?></th>
																</tr>
															</thead>
															<tbody>
						<!--     *********     FEATURES 1      *********      -->
											<?php
												while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

														if ($row["ticketAuthor"] == $_SESSION['username']){
															echo "";
														} else {
															header("Location: index.php");
														}

														$stmtt = $db->prepare('SELECT username, email, description, skills, location, memberID, Level, notes, avatar FROM members WHERE username=:username');
														$stmtt->execute(array(':username' => $row['ticketAuthor']));
														$rowt = $stmtt->fetch(PDO::FETCH_ASSOC);

														if ($rowt['avatar'] == "gravatar") {
															$emailt = $rowt['email'];;
															$default = "".$siteurl."img/default.png";
															$size = 100;

															$grav_urlt = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emailt ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
														} else {
															$grav_urlt = '../../../uploads/ua/'.$rows['avatar'].'';
														}

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
																	<td class="text-center">'.$row["ticketID"].'</td>
																	<td>'.$date.'</td>
																	<td>'.$row["ticketTitle"].'</td>
																	<td>'.$row["ticketAdmin"].'</td>
																	<td>'.$status.'</td>
																	<td class="td-actions text-right">
																		<a href="viewticket.php?id='.$row["ticketID"].'">
																		<button type="button" rel="tooltip" class="btn btn-success">
																			<i class="material-icons">edit</i>
																		</button>
																		</a>
																		<a href="action.php?id='.$row["ticketID"].'&action=deletet">
																		<button type="button" rel="tooltip" class="btn btn-danger">
																			<i class="material-icons">close</i>
																		</button>
																		</a>
																	</td>
																</tr>
																</tbody>
																</table>
																</div>
																<div class="media media-post">
		        								<a class="pull-left author" href="#pablo">
		        									<div class="avatar">
		        										<img class="media-object" src="'.$grav_urls.'">
		        									</div>
		        								</a>
												<form action="" method="post">
		        								<div class="media-body">
		        										<textarea name="respCont" class="form-control" placeholder="'.$email.'" rows="4"></textarea>
		        										<div class="media-footer">
		        											<button name="submit" class="btn btn-primary"><i class="material-icons">reply</i>'.$actions["reply"].'</button>
		        										</div>
		        								</div>
												</form>
																<div class="media">
								<a class="pull-left" href="#pablo">
		        							<div class="avatar">
		        								<img class="media-object" src="'.$grav_urlt.'"/>
		        							</div>
		        						</a>
									<div class="media-body">
		        							<h4 class="media-heading">'.$row["ticketAuthor"].' <small>&middot; '.$date.'</small></h4>
		        							<h6 class="text-muted"></h6>

		        							<p>'.$row["ticketCont"].'</p>

		        							</div>
		        						</div>
										</div>
														';
												}
											?>
								<?php
								while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)) {

														$stmta = $db->prepare('SELECT email, avatar FROM members WHERE username=:username');
														$stmta->execute(array(':username' => $rowr["respAuthor"]));
														$rowa = $stmta->fetch(PDO::FETCH_ASSOC);

														if ($rowa['avatar'] == "gravatar") {
															$emailt = $rowr['email'];;
															$default = "".$siteurl."img/default.png";
															$size = 100;

															$grav_urlr = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emailt ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
														} else {
															$grav_urlr = '../../../uploads/ua/'.$rowa['avatar'].'';
														}

														$ra = $rowr["respAuthor"];

														$rdate = date("d.m.Y H:i", $rowr["respTime"]);
														if ($rowr['type'] == '0'){
															echo '<div align="left" class="media">';
															echo '<a class="pull-left" href="#pablo">';
														}
														else {
															echo '<div align="right" class="media">';
															echo '<a class="pull-right" href="#pablo">';
														}
														echo '<div class="avatar">';
														echo '<img class="media-object" alt="64x64" src="'.$grav_urlr.'">';
														echo "</div>";
														echo "</a>";
														echo '<div class="media-body">';
														if ($rowr['type'] == '0'){
															echo '<h4 class="media-heading">'.$rowr["respAuthor"].' <small>&middot; '.$rdate.'</small></h4>';
														}
														else {
															echo '<h4 class="media-heading"><i class="material-icons">contact_support</i>'.$rowr["respAuthor"].' <small>&middot; '.$rdate.'</small></h4>';
														}
														echo '<p>'.$rowr["respCont"].'</p>';
														echo '</div>';
														echo '</div>';
												}
										  ?>
		<!--     *********    END FEATURES 1      *********      -->


				</div>
				</div>
				</div>
<?php
	include("../layout/footer.php");
?>
