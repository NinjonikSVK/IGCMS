<?php
	include("../layout/header.php");

	$stmtr = $db->prepare('SELECT * FROM chat ORDER BY chatTime DESC LIMIT 10');
	$stmtr->execute(array(':ticketID' => $tid));
	$rowr = $stmtr->fetch(PDO::FETCH_ASSOC);

	if (!$stmtr->execute()) {
		print_r($stmtr->errorInfo());
	}

	if(isset($_POST['submit'])){

		if (empty($_POST['chatCont'])) {
			return header("Location: chat.php?action=emptymessage");
		}

		$chatCont = $_POST['chatCont'];
		$author = $_SESSION['username'];

		$date = time();



			//insert into database with a prepared statement
				$stmt3 = $db->prepare('INSERT INTO chat (chatCont,chatAuthor,chatTime) VALUES (:chatCont, :chatAuthor, :chatTime)');
				$stmt3->execute(array(
						':chatCont' => $chatCont,
						':chatAuthor' => $author,
						':chatTime' => $date
				));

			header("Location: chat.php?id=".$tid."&action=chatcreated");

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

						<h3 class="title"><?php echo $l["chat"] ?></h3>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main main-raised">
		<div class="section section-basic">
	    	<div class="container">
			<?php
			$permis = getperm('canmoderatechat')["canmoderatechat"];
			if ($permis == 0) {
				echo '';
			} else if ($permis == 1) {
				echo '<a href="actions.php?id=0&action=delallchat">'.$dbd["delete_all_chat"].'</a>';
			} else {
				echo 'Error, group permission error.';
			}
			?>
						<!--     *********     FEATURES 1      *********      -->
																<div class="media media-post">
												<?php if($user->is_logged_in())
												{
												echo '
												<a class="pull-left author" href="#pablo">
		        									<div class="avatar">
		        										<img class="media-object" src="'.$grav_urls.'">
		        									</div>
		        								</a>
												<form action="" method="post">
		        								<div class="media-body">
		        										<textarea name="chatCont" class="form-control" rows="4"></textarea>
		        										<div class="media-footer">
		        											<button name="submit" class="btn btn-primary"><i class="material-icons">reply</i>'.$actions["reply"].'</button>
		        										</div>
		        								</div>
												</form>';
												}
												else {
													echo '';
												}
								while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)) {

														$stmta = $db->prepare('SELECT email, avatar FROM members WHERE username=:username');
														$stmta->execute(array(':username' => $rowr["chatAuthor"]));
														$rowa = $stmta->fetch(PDO::FETCH_ASSOC);

														if ($rowa['avatar'] == "gravatar") {

															$emailr = $rowa['email'];;
															$default = "".$siteurl."img/default.png";
															$size = 100;

															$grav_urlr = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emails ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

														} else {

															$grav_urlr = '../../../uploads/ua/'.$rowa['avatar'].'';

														}

														$ra = $rowr["chatAuthor"];

														$rdate = date("d.m.Y H:i", $rowr["chatTime"]);

														echo '<div class="media">';
														echo '<a class="pull-left" href="#pablo">';
														echo '<div class="avatar">';
														echo '<img class="media-object" alt="64x64" src="'.$grav_urlr.'">';
														echo "</div>";
														echo "</a>";
														echo '<div class="media-body">';
														echo '<h4 class="media-heading">'.$rowr["chatAuthor"].' <small>&middot; '.$rdate.'</small></h4>';
														echo '<p>'.$rowr["chatCont"].'</p>';
														echo '</div>';
														echo '</div>';
												}
										  ?>
		<!--     *********    END FEATURES 1      *********      -->


				</div>
				</div>
				</div>
				</div>
<?php
	include("../layout/footer.php");
?>
