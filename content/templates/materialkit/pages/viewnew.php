<?php
	include("../layout/header.php");
?>
<body class="index-page">	
	<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<?
	
		if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
			header('Location: index.php'); 
		}
	
		$rid = $_GET['id'];
	
		include("../layout/navbar.php");
		
		$stmt = $db->prepare("SELECT newCont, newAuthor, newTitle, newDate, filename FROM news WHERE newID='".$_GET['id']."'");
		$stmt->execute(array());
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if (!$stmt->execute()) {
			print_r($stmt->errorInfo());
		}
		
		$stmtr = $db->prepare('SELECT * FROM news_r WHERE newID=:newID ORDER BY rTime DESC');
		$stmtr->execute(array(':newID' => $_GET['id']));
		$rowr = $stmtr->fetch(PDO::FETCH_ASSOC);
		
		if (!$stmtr->execute()) {
			print_r($stmtr->errorInfo());
		}
		
	if(isset($_POST['submit'])){

		$rCont = $_POST['rCont'];
		$author = $_SESSION['username'];

		$date = time();			
			
			//insert into database with a prepared statement
				$stmt = $db->prepare('INSERT INTO news_r (newID,rCont,rAuthor,rTime) VALUES (:newID, :rCont, :respAuthor, :rTime)');
				$stmt->execute(array(
						':newID' => $rid,
						':rCont' => $rCont,
						':respAuthor' => $author,
						':rTime' => $date
				));
			
			header("Location: viewnew?id=".$rid."&action=respcreated");	

	}
	?>
	<div class="page-header header-filter clear-filter" style="background-image: url('assets/img/bg0.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="brand">
						<h1><?php echo $nTitle; ?>
						</h1>
						
						<h3 class="title"><?php echo $l["post"] ?></h3>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="main main-raised">
		<div class="section section-basic">
	    	<div class="container">
						<!--     *********     FEATURES 1      *********      -->
						<?php
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
														
														$nAuthor = $row['nAuthor'];
														
														$email = $row2['email'];;
														$default = "cms.igportals.tk/img/default.png";
														$size = 100;

														$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
													
														$date = date("d.m.Y H:i", $row["newDate"]);
													
														echo '
					<div class="card card-plain card-blog">
						<div class="row">
							<div class="col-md-5">
								<div class="card-image">
									<img class="img img-raised" src="../../../uploads/nt/'.$row['filename'].'" />
								</div>
							</div>
							<div class="col-md-7">
								<h6 class="category text-info">'.$row['rubrika'].'</h6>
								<h3 class="card-title">
									<a href="#pablo">'.substr($row['newTitle'], 0, 50).'</a>
								</h3>
								<p class="card-description">
									'.substr($row['newCont'], 0, 5000).'
								</p>
								<p class="author">
									'.$mk["wrote"].' <a href="#pablo"><b>'.$row['newAuthor'].'</b></a>, '.$date.'
								</a>
							</div>
							<a align="left" href="action.php?action=like&id='.$row['newID'].'" class="btn btn-danger btn-simple pull-right">
								<i class="material-icons">favorite</i> '.$row["likes"].'
							</a>
						</div>
					</div>';
												}?>
			<center><h3><?php echo $mk["commments"]; ?></h3></center>
		<!--     *********    END FEATURES 1      *********      -->
		<div class="media media-post">
											<?php
											if($user->is_logged_in() ){
												echo '
												<a class="pull-left author" href="#pablo">
		        									<div class="avatar">
		        										<img class="media-object" src="'.$grav_urls.'">
		        									</div>
		        								</a>
												<form action="" method="post">
		        								<div class="media-body">
		        										<textarea name="rCont" class="form-control" placeholder="'.$email.'" rows="4"></textarea>
		        										<div class="media-footer">
		        											<button name="submit" class="btn btn-primary"><i class="material-icons">reply</i>'.$actions["reply"].'</button>
		        										</div>
		        								</div>
												</form>
												';
												} else {
													echo '';
												}
												
												while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)) {
														
														$stmta = $db->prepare('SELECT email, avatar FROM members WHERE username=:username');
														$stmta->execute(array(':username' => $rowr["rAuthor"]));
														$rowa = $stmta->fetch(PDO::FETCH_ASSOC);
														
														if ($rowa['avatar'] == "gravatar") {
															
															$emailr = $rowa['email'];;
															$default = "".$siteurl."img/default.png";
															$size = 100;
															
															$grav_urlr = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $emails ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
															
														} else {
															
															$grav_urlr = '../../../uploads/ua/'.$rowa['avatar'].'';
															
														}
														
														$ra = $rowr["rAuthor"];
														
														$rdate = date("d.m.Y H:i", $rowr["rTime"]);
														echo '<div align="left" class="media">';
														echo '<a class="pull-left" href="#pablo">';
														echo '<div class="avatar">';
														echo '<img class="media-object" alt="64x64" src="'.$grav_urlr.'">';
														echo "</div>";
														echo "</a>";
														echo '<div class="media-body">';
														echo '<h4 class="media-heading">'.$rowr["rAuthor"].' <small>&middot; '.$rdate.'</small></h4>';
														echo '<p>'.$rowr["rCont"].'</p>';
														echo '</div>';
														echo '</div>';
												}	
											?>
				</div>
				</div>
				</div>
<?php
	include("../layout/footer.php");
?>