<?php
	include("../layout/header.php");
?>
<body class="profile-page">
	<nav class="navbar navbar-default navbar-transparent navbar-fixed-top navbar-color-on-scroll" color-on-scroll=" " id="sectionsNav">
	<?php
		include("../layout/navbar.php");

		$id = $_GET['id'];

		if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
			header('Location: index.php?action=noid');
		}

		$row = getfromDBw("username, email, description, skills, location, memberID, notes, avatar, groupID, bg", "members", "memberid", $id);
	?>


	<div class="page-header header-filter" data-parallax="true" style="background-image: url('../../../uploads/bg/<?php echo $row["bg"]; ?>');"></div>

	<div class="main main-raised">
		<div class="profile-content">
            <div class="container">

                <div class="row">
	                <div class="col-xs-6 col-xs-offset-3">
        	           <div class="profile">
	                        <div class="avatar">
	                            <img src="<?php
														if ($row['avatar'] == "gravatar") {
															$email = $row['email'];;
															$default = "".$siteurl."img/default.png";
															$size = 200;

															$grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
														} else {
															$grav_url = '../../../uploads/ua/'.$row['avatar'].'';
														}
								echo $grav_url; ?>" alt="Circle Image" class="img-circle img-responsive img-raised">
	                        </div>
	                        <div class="name">

	                            <h3 class="title"><? echo $row['username']; ?><?php if($row["username"] == $_SESSION["username"]){ echo '<a href="changebg"><span class="material-icons">edit</span></a>'; }?></h3>
								<h6><? echo $l["player_id"] . $row['memberID']; ?></h6>
								<?php

								$usergroupIDp = $row['groupID'];

								if($usergroupIDp == 0){
									$lvlp = $l["user"];
								} else {
									$stmtgi = $db->prepare('SELECT * FROM groups WHERE id=:id');
									$stmtgi->execute(array(':id' => $usergroupIDp));
									$rogi = $stmtgi->fetch(PDO::FETCH_ASSOC);

									$grn = $rogi['title'];
									$grc = $rogi['color'];
									$lvlp = '<span style="color:'.$grc.'">'.$grn.'</span>';
								}

								echo '<h6><b>Rank:</b> '.$lvlp.'</h6>'

								?>
								</h6>
								<div class="description text-center">
									<p> <?php echo $row['description']; ?></p>
								</div>
								<div class="description text-center">
									<p> <?php echo $row['location']; ?></p>
								</div>
								<div class="description text-center">
									<p> <?php echo $row['skills']; ?></p>
								</div>
								<?php

								if ($_SESSION['username'] == $row['username']) {
									echo '<hr>

												<div class="description text-center">
													<p>'.$row["notes"].'</p>
												</div>

												';
								}

								?>
	                        </div>
	                    </div>
    	            </div>
                </div>
			</div>
		</div>
	</div>

<?php
	include("../layout/footer.php");
?>
