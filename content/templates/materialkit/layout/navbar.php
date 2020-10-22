<?php

						if(isset($error)){
							foreach($error as $error){
								echo '<p class="bg-danger">'.$error.'</p>';
							}
						}

						//if action is joined show sucess
						if(isset($_GET['action']) && $_GET['action'] == 'joined'){
							echo '
								    <div class="alert alert-success">
										<div class="container">
											<div class="alert-icon">
												<i class="material-icons">check</i>
											</div>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true"><i class="material-icons">clear</i></span>
											</button>
											<b>'.$mk["alert_success"].':</b> '.$mk["alert_registration"].'
										</div>
									</div>
							';
						}
						if(isset($_GET['action']) && $_GET['action'] == 'invalidresolution'){
							echo '
								    <div class="alert alert-danger">
									 <div class="container">
										 <div class="alert-icon">
											<i class="material-icons">error_outline</i>
										</div>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true"><i class="material-icons">clear</i></span>
										</button>
										 <b>'.$mk["alert_error"].':</b> '.$mk["alert_image"].' '.$_GET['width'].'x'.$_GET['height'].'
									</div>
								</div>
							';
						}
						if(isset($_GET['action']) && $_GET['action'] == 'installed'){
							unlink("install.php");
							
						}
						if(isset($_GET['action']) && $_GET['action'] == 'fileisnotanimage'){
							echo '
								    <div class="alert alert-danger">
									 <div class="container">
										 <div class="alert-icon">
											<i class="material-icons">error_outline</i>
										</div>
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true"><i class="material-icons">clear</i></span>
										</button>
										 <b>'.$mk["alert_error"].':</b> '.$mk["alert_image2"].' .'.$_GET['filetype'].'
									</div>
								</div>
							';
						}
						//if action is loggedout show sucess
						if(isset($_GET['action']) && $_GET['action'] == 'loggedout'){
							echo '
								    <div class="alert alert-success">
										<div class="container">
											<div class="alert-icon">
												<i class="material-icons">check</i>
											</div>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true"><i class="material-icons">clear</i></span>
											</button>
											<b>'.$mk["alert_success"].':</b> '.$mk["logged_off"].'
										</div>
									</div>
							';
						}

						//if action is joined show sucess
						if(isset($_GET['action']) && $_GET['action'] == 'loggedin'){
							echo '
								    <div class="alert alert-success">
										<div class="container">
											<div class="alert-icon">
												<i class="material-icons">check</i>
											</div>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true"><i class="material-icons">clear</i></span>
											</button>
											<b>'.$mk["alert_success"].':</b> '.$mk["logged_in"].'
										</div>
									</div>
							';
						}

						?>
<div class="container">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse">
	<span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="index"><?php echo $siteTitle; ?></a>
</div>

<div class="collapse navbar-collapse">
<ul class="nav navbar-nav navbar-right">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="material-icons">supervisor_account</i> <?php echo $l["lang"]; ?>
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu dropdown-with-icons">
			<li>
				<a href="index?lang=sk">
					<img src="/img/sk.png" width="150" height="100">
				</a>
			</li>
			<li>
				<a href="index?lang=cs">
					<img src="/img/cz.png" width="150" height="100">
				</a>
			</li>
			<li>
				<a href="index?lang=en">
					<img src="/img/en.png" width="150" height="100">
				</a>
			</li>
			<!--
			<li>
				<a href="sections.html#pricing">
					<i class="material-icons">monetization_on</i> Pricing
				</a>
			</li>
			<li>
				<a href="sections.html#testimonials">
					<i class="material-icons">chat</i> Testimonials
				</a>
			</li>
			<li>
				<a href="sections.html#contactus">
					<i class="material-icons">call</i> Contacts
				</a>
			</li>
			-->
		</ul>
	</li>
	<li>
		<a href="index">
			<i class="material-icons">home</i> <?php echo $l['home']; ?>
		</a>
	</li>
	<!--<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="material-icons">view_day</i> IGPortals
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu dropdown-with-icons">
			<li>
				<a href="http://panel.igportals.eu/">
					<i class="material-icons">build</i> IGHost
				</a>
			</li>
			<li>
				<a href="http://www.teamspeak.com/invite/ts3.igportals.eu/">
					<i class="material-icons">headset</i> TeamSpeak3
				</a>
			</li>
			<li>
				<a href="http://www.igpacks.eu">
					<i class="material-icons">people</i> IGPacks
				</a>
			</li>
			<li>
				<a href="http://www.igupload.tk">
					<i class="material-icons">cloud_upload</i> IGUpload
				</a>
			</li>
			<li>
			<a href="job">
				<i class="material-icons">business_center</i> Práca
			</a>
			</li>
			<li class="button-container">
				<a href="cms">
					<i class="material-icons">extension</i> CMS
				</a>
			</li>
			<li>
				<a href="upload/index">
					<i class="material-icons">cloud_upload</i> Upload
				</a>
			</li>
			<!--
			<li>
				<a href="sections.html#pricing">
					<i class="material-icons">monetization_on</i> Pricing
				</a>
			</li>
			<li>
				<a href="sections.html#testimonials">
					<i class="material-icons">chat</i> Testimonials
				</a>
			</li>
			<li>
				<a href="sections.html#contactus">
					<i class="material-icons">call</i> Contacts
				</a>
			</li>

		</ul>
	</li>

	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="material-icons">view_day</i> IGPortals
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu dropdown-with-icons">
	<li>
		<a href="igmall">
			<i class="material-icons">shopping_cart</i> IGMall
		</a>
	</li>
	<li>
		<a href="stocks">
			<i class="material-icons">trending_up</i> Akciový trh
		</a>
	</li>
	<li>
		<a href="tops">
			<i class="material-icons">star_outline</i> Rebríčky
		</a>
	</li>
	<li>
		<a href="bans/index">
			<i class="material-icons">list</i> Banlist
		</a>
	</li>
	<li>
		<a href="inz">
			<i class="material-icons">list_alt</i> Inzeráty
		</a>
	</li>
	<li>
		<a href="viewdynmap">
			<i class="material-icons">map</i> Dynmapa
		</a>
	</li>

		</ul>
	</li>-->
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="material-icons">view_day</i> <?php echo $l["sites"]; ?>
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu dropdown-with-icons">
		<li>
		<a href="posts">
			<i class="material-icons">announcement</i> <?php echo $l["news"]; ?>
		</a>
	</li>
	<li>
		<a href="downloads">
			<i class="material-icons">cloud_download</i> <?php echo $l["to_download"]; ?>
		</a>
	</li>
	<li>
		<a href="chat">
			<i class="material-icons">chat</i> <?php echo $l["chat"]; ?>
		</a>
	</li>
		<?php

		$stmtp = $db->prepare('SELECT pageID, pageTitle FROM pages');
		$stmtp->execute(array());
		$rowp = $stmtp->fetch(PDO::FETCH_ASSOC);

		if (!$stmtp->execute()) {
			print_r($stmt->errorInfo());
		}

								while ($rowp = $stmtp->fetch(PDO::FETCH_ASSOC)) {
										echo '
										<li>
											<a href="viewpage?id='.$rowp["pageID"].'">
												'.$rowp["pageTitle"].'
											</a>
										</li>
										';
								}

		?>
		</ul>
	</li>

<!--	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="material-icons">view_carousel</i> Examples
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu dropdown-with-icons">
			<li>
				<a href="examples/about-us.html">
					<i class="material-icons">account_balance</i> About Us
				</a>
			</li>
			<li>
				<a href="examples/blog-post.html">
					<i class="material-icons">art_track</i> Blog Post
				</a>
			</li>
			<li>
				<a href="examples/blog-posts.html">
					<i class="material-icons">view_quilt</i> Blog Posts
				</a>
			</li>
			<li>
				<a href="examples/contact-us.html">
					<i class="material-icons">location_on</i> Contact Us
				</a>
			</li>
			<li>
				<a href="examples/landing-page.html">
					<i class="material-icons">view_day</i> Landing Page
				</a>
			</li>
			<li>
				<a href="examples/login-page.html">
					<i class="material-icons">fingerprint</i> Login Page
				</a>
			</li>
			<li>
				<a href="examples/pricing.html">
					<i class="material-icons">attach_money</i> Pricing Page
				</a>
			</li>
			<li>
				<a href="examples/ecommerce.html">
					<i class="material-icons">shop</i> Ecommerce Page
				</a>
			</li>
			<li>
				<a href="examples/product-page.html">
					<i class="material-icons">beach_access</i> Product Page
				</a>
			</li>
			<li>
				<a href="examples/profile-page.html">
					<i class="material-icons">account_circle</i> Profile Page
				</a>
			</li>
			<li>
				<a href="examples/signup-page.html">
					<i class="material-icons">person_add</i> Signup Page
				</a>
			</li>
		</ul>
	</li>
	-->
	<?php if($user->is_logged_in())
			{
			echo('
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="material-icons">supervisor_account</i> '.$l["support"].'
			<b class="caret"></b>
		</a>
		<ul class="dropdown-menu dropdown-with-icons">
			<li>
				<a href="mytickets">
					<i class="material-icons">view_list</i> '.$l["my_tickets"].'
				</a>
			</li>
			<li>
				<a href="addticket">
					<i class="material-icons">create</i> '.$l["add_new_ticket"].'
				</a>
			</li>
			<!--
			<li>
				<a href="sections.html#pricing">
					<i class="material-icons">monetization_on</i> Pricing
				</a>
			</li>
			<li>
				<a href="sections.html#testimonials">
					<i class="material-icons">chat</i> Testimonials
				</a>
			</li>
			<li>
				<a href="sections.html#contactus">
					<i class="material-icons">call</i> Contacts
				</a>
			</li>
			-->
		</ul>
	</li>
	');
			} else {
				echo '';
			}
	?>
	<li>
		<a href="forums">
			<i class="material-icons">chat</i> <?php echo $mk["forum"]; ?>
		</a>
	</li>
	<?php

			if(!$user->is_logged_in())
			{
			echo('
			<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<i class="material-icons">account_circle</i> '.$l["profile"].'
				<b class="caret"></b>
			</a>
			<ul class="dropdown-menu dropdown-with-icons">
			<li class="nav-item"><a class="nav-link" href="register">'.$l['registerpage'].'</a></li>
			<li class="nav-item"><a class="nav-link" href="login">'.$l['login'].'</a></li>
			<li class="nav-item"><a class="nav-link" href="reset">'.$l["resetpass"].'</a></li>
			</ul>
			</li>
			');
			} else {

				$pocetno = $db->query("SELECT count(*) FROM notifications WHERE notUser='".$_SESSION["username"]."'")->fetchColumn();

			echo ('
				<li>
                    <a href="notifications">
                        <i class="material-icons">email</i>'.$pocetno.'
                    </a>
                </li>
				<li class="dropdown">
                    <a href="#pablo" class="profile-photo dropdown-toggle" data-toggle="dropdown">
                        <div class="profile-photo-small">
                            <img src="'.$grav_urls.'" alt="Circle Image" class="img-circle img-responsive">
                        </div>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">
                            '.$l["me"].'
                        </li>
						<li>
                            <a href="profile?id='.$_SESSION['memberID'].'">
								<i class="material-icons">account_circle</i> '.$l["my_profile"].'
							</a>
                        </li>
                       <li>
							<a href="editprofile">
								<i class="material-icons">edit</i> '.$l["edit_profile"].'
							</a>
						</li>
                        <li class="divider"></li>
                        <li>
							<a href="logout">
								<i class="material-icons">exit_to_app</i> '.$l["log_out"].'
							</a>
						</li>
                    </ul>
                </li>
			');
			};

			$rowg = getperm('canviewdashboard')["canviewdashboard"];
			if ($rowg == 0) {
				echo '';
			} else if ($rowg == 1) {
				echo '
					<li>
						<a href="../../adminlte/pages/index" class="btn btn-rose btn-round">
							<i class="material-icons">build</i> '.$l["administration"].'
						</a>
					</li>
				';
			} else {
				echo 'Error, group permission error.';
			}

			?>
</ul>
</div>
</div>
</nav>
