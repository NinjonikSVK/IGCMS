<?php
	include("../layout/header.php");
	
	$stmtr = $db->prepare('SELECT * FROM inzeraty ORDER BY date DESC LIMIT 10');
	$stmtr->execute();
	$rowr = $stmtr->fetch(PDO::FETCH_ASSOC);
	
	if (!$stmtr->execute()) {
		print_r($stmtr->errorInfo());
	}
	
	
?>
<body class="index-page">	
	<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<?
		include("../layout/navbar.php");
	?>
	<div class="page-header header-filter clear-filter" style="background-image: url('assets/img/bg0.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1><?php echo $siteTitle; ?>
						</h1>

						<h3 class="title">Inzeráty</h3>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main main-raised">
		<div class="section section-basic">
	    	<div class="container">
			<?php
			if ($Level > "2"){
				echo '<p><a href="actions?id=0&action=delallchat">Zmazať všetky inzeráty</a></p>';
			} else {
				echo '';
			}
			if ($user->is_logged_in() ){
				echo '<p><a href="addinz">Pridať nový inzerát</a></p>';
			} else {
				echo '';
			}
			?>
						<!--     *********     FEATURES 1      *********      -->
																<div class="media media-post">
												<?php
								while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)) {
														
														$stmta = $db->prepare('SELECT email, avatar FROM members WHERE username=:username');
														$stmta->execute(array(':username' => $rowr["author"]));
														$rowa = $stmta->fetch(PDO::FETCH_ASSOC);
														
														if ($rowa['avatar'] == "gravatar") {
															
															$emailr = $rowa['email'];;
															$default = "".$siteurl."img/default.png";
															$size = 100;
															
															$grav_urlr = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emails ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
															
														} else {
															
															$grav_urlr = '../../../uploads/ua/'.$rowa['avatar'].'';
															
														}
														
														$ra = $rowr["author"];
														
														$rdate = date("d.m.Y H:i", $rowr["date"]);
													
														echo '<div class="media">';
														echo '<a class="pull-left" href="#pablo">';
														echo '<div class="avatar">';
														echo '<img class="media-object" alt="64x64" src="'.$grav_urlr.'">';
														echo "</div>";
														echo "</a>";
														echo '<div class="media-body">';
														echo '<h4 class="media-heading">'.$rowr["author"].' <small>&middot; '.$rdate.'</small></h4>';
														if ($Level > "2"){
															echo '<p><a href="actions?id='.$rowr["inzID"].'&action=delinz">Zmazať</a></p>';
														} else {
															echo '';
														}
														echo '<h6 class="category text-info">'.$rowr['title'].'</h6>';
														echo '<p>'.$rowr["cont"].'</p>';
														echo '
														<div>Kontakt tel. č.: '.$rowr["pn"].'</div>
														<div>Iný kontakt: '.$rowr["o"].'</div>
														';
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